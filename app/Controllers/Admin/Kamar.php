<?php namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\KamarModel;

class Kamar extends BaseController
{
    protected $kamarModel;

    public function __construct()
    {
        $this->kamarModel = new KamarModel();
    }

    // [C R U D] - R (Read/Index): Menampilkan daftar semua kamar dengan filter dan search
    public function index()
    {
        log_message('info', 'Kamar::index - Starting index method');
        
        $search = $this->request->getGet('search') ?? '';
        $status = $this->request->getGet('status') ?? '';
        $sortBy = $this->request->getGet('sortBy') ?? 'nomor_kamar';
        $sortOrder = $this->request->getGet('sortOrder') ?? 'ASC';

        log_message('info', 'Kamar::index - Parameters: search=' . $search . ', status=' . $status . ', sortBy=' . $sortBy . ', sortOrder=' . $sortOrder);

        $query = $this->kamarModel;

        // Filter berdasarkan search (nomor kamar atau tipe kamar)
        if (!empty($search)) {
            $query = $query->groupStart()
                ->like('nomor_kamar', $search)
                ->orLike('tipe_kamar', $search)
                ->orLike('deskripsi', $search)
                ->groupEnd();
        }

        // Filter berdasarkan status
        if (!empty($status)) {
            $query = $query->where('status', $status);
        }

        // Sort (hanya izinkan kolom yang valid)
        $allowedColumns = ['nomor_kamar', 'tipe_kamar', 'kapasitas', 'harga', 'status'];
        if (in_array($sortBy, $allowedColumns)) {
            $query = $query->orderBy($sortBy, strtoupper($sortOrder));
        } else {
            $query = $query->orderBy('nomor_kamar', 'ASC');
        }

        try {
            $data['kamars'] = $query->findAll();
            log_message('info', 'Kamar::index - Found ' . count($data['kamars']) . ' kamars');
        } catch (\Exception $e) {
            log_message('error', 'Kamar::index - Error fetching kamars: ' . $e->getMessage());
            $data['kamars'] = [];
        }
        
        $data['search'] = $search;
        $data['status'] = $status;
        $data['sortBy'] = $sortBy;
        $data['sortOrder'] = $sortOrder;

        log_message('info', 'Kamar::index - Rendering view with data');
        return view('admin/kamar/index', $data); // View daftar tabel kamar
    }

    // [C R U D] - C (Create): Menampilkan form tambah kamar
    public function create()
    {
        // helper('form'); // Pastikan helper form dimuat di Config/Autoload.php atau di sini
        $data = ['validation' => \Config\Services::validation()];
        return view('admin/kamar/create', $data);
    }

    // [C R U D] - C (Store): Menyimpan data kamar baru
    public function store()
    {
        // 1. Validasi Input
        if (!$this->validate($this->kamarModel->getValidationRules())) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        // 2. Upload Foto Kamar (Multiple, Opsional)
        $uploadedPhotos = [];

        log_message('info', 'Kamar::store - Starting multiple photo upload process');

        // Check for foto_kamar_1, foto_kamar_2, foto_kamar_3
        for ($i = 1; $i <= 3; $i++) {
            $fileFoto = $this->request->getFile('foto_kamar_' . $i);

            if ($fileFoto && $fileFoto->isValid()) {
                log_message('info', 'Kamar::store - Processing foto_kamar_' . $i . ': name=' . $fileFoto->getName() . ', size=' . $fileFoto->getSize());

                // Validasi ukuran file (max 2MB)
                if ($fileFoto->getSize() > 2048 * 1024) {
                    log_message('error', 'Kamar::store - File too large for foto_kamar_' . $i . ': ' . $fileFoto->getSize());
                    return redirect()->back()->withInput()->with('error', 'Ukuran file foto ' . $i . ' maksimal 2MB');
                }

                // Validasi tipe file
                $allowedMimes = ['image/jpeg', 'image/jpg', 'image/png', 'image/webp'];
                $allowedExtensions = ['jpg', 'jpeg', 'png', 'webp'];

                if (!in_array($fileFoto->getMimeType(), $allowedMimes)) {
                    log_message('error', 'Kamar::store - Invalid file type for foto_kamar_' . $i . ': ' . $fileFoto->getMimeType());
                    return redirect()->back()->withInput()->with('error', 'Tipe file foto ' . $i . ' tidak didukung. Gunakan JPG, PNG, atau WebP');
                }

                // Validasi ekstensi file
                $fileExtension = strtolower($fileFoto->getExtension());
                if (!in_array($fileExtension, $allowedExtensions)) {
                    log_message('error', 'Kamar::store - Invalid file extension for foto_kamar_' . $i . ': ' . $fileExtension);
                    return redirect()->back()->withInput()->with('error', 'Ekstensi file foto ' . $i . ' tidak didukung. Gunakan JPG, PNG, atau WebP');
                }

                // Move file
                if ($fileFoto->isValid() && !$fileFoto->hasMoved()) {
                    $namaFoto = $fileFoto->getRandomName();
                    log_message('info', 'Kamar::store - Attempting to move foto_kamar_' . $i . ' to: ' . FCPATH . 'img/kamar/' . $namaFoto);

                    try {
                        $fileFoto->move(FCPATH . 'img/kamar', $namaFoto);
                        $uploadedPhotos[] = $namaFoto;
                        log_message('info', 'Kamar::store - foto_kamar_' . $i . ' moved successfully: ' . $namaFoto);
                    } catch (\Exception $e) {
                        log_message('error', 'Kamar::store - foto_kamar_' . $i . ' upload failed: ' . $e->getMessage());
                        return redirect()->back()->withInput()->with('error', 'Upload foto ' . $i . ' gagal: ' . $e->getMessage());
                    }
                }
            }
        }

        // Validate at least one photo is uploaded
        if (empty($uploadedPhotos)) {
            log_message('error', 'Kamar::store - No photos uploaded');
            return redirect()->back()->withInput()->with('error', 'Harap upload minimal 1 foto kamar');
        }

        // Convert photos array to JSON for storage
        $fotoKamarJson = json_encode($uploadedPhotos);
        log_message('info', 'Kamar::store - Photos JSON: ' . $fotoKamarJson);

        // 3. Proses data fasilitas, aturan, dan informasi penting
        $fasilitas_fitur = $this->request->getPost('fasilitas_fitur');
        $fasilitas_lainnya = $this->request->getPost('fasilitas_lainnya');
        
        $aturan_kamar = $this->request->getPost('aturan_kamar');
        $aturan_lainnya = $this->request->getPost('aturan_lainnya');
        
        $informasi_penting = $this->request->getPost('informasi_penting');
        $info_lainnya = $this->request->getPost('info_lainnya');
        
        // Gabungkan fasilitas
        $fasilitas_combined = [];
        if (is_array($fasilitas_fitur)) {
            $fasilitas_combined = array_merge($fasilitas_combined, $fasilitas_fitur);
        }
        if (!empty($fasilitas_lainnya)) {
            $fasilitas_combined[] = $fasilitas_lainnya;
        }
        
        // Gabungkan aturan
        $aturan_combined = [];
        if (is_array($aturan_kamar)) {
            $aturan_combined = array_merge($aturan_combined, $aturan_kamar);
        }
        if (!empty($aturan_lainnya)) {
            $aturan_combined[] = $aturan_lainnya;
        }
        
        // Gabungkan informasi penting
        $info_combined = [];
        if (is_array($informasi_penting)) {
            $info_combined = array_merge($info_combined, $informasi_penting);
        }
        if (!empty($info_lainnya)) {
            $info_combined[] = $info_lainnya;
        }

        // 4. Simpan Data ke Database
        $success = $this->kamarModel->save([
            'nomor_kamar' => $this->request->getPost('nomor_kamar'),
            'tipe_kamar'  => $this->request->getPost('tipe_kamar'),
            'kapasitas'   => $this->request->getPost('kapasitas'),
            'harga'       => $this->request->getPost('harga'),
            'deskripsi'   => $this->request->getPost('deskripsi'),
            'fasilitas_fitur' => implode("\n", array_filter($fasilitas_combined)),
            'informasi_kamar' => $this->request->getPost('informasi_kamar'),
            'aturan_kamar' => implode("\n", array_filter($aturan_combined)),
            'informasi_penting' => implode("\n", array_filter($info_combined)),
            'foto_kamar'  => $fotoKamarJson,
            'status'      => $this->request->getPost('status') ?? 'Tersedia',
        ]);
        
        if ($success) {
            return redirect()->to(route_to('admin_kamar_index'))->with('success', 'Data Kamar berhasil ditambahkan.');
        } else {
            return redirect()->back()->with('error', 'Gagal menyimpan data kamar.');
        }
    }

    // [C R U D] - U (Edit): Menampilkan form edit kamar
    public function edit($kamar_id)
    {
        $data['kamar'] = $this->kamarModel->find($kamar_id);
        if (!$data['kamar']) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound('Data kamar tidak ditemukan.');
        }
        
        $data['validation'] = \Config\Services::validation();
        
        // Jika ada validation errors dari redirect sebelumnya, set ke validation object
        if ($errors = session()->getFlashdata('errors')) {
            $data['validation']->setErrors($errors);
        }
        
        return view('admin/kamar/edit', $data);
    }

    // [C R U D] - U (Update): Memperbarui data kamar
    public function update($kamar_id)
    {
        log_message('info', 'Kamar::update - STARTING UPDATE PROCESS for kamar_id: ' . $kamar_id);
        log_message('info', 'Kamar::update - REQUEST METHOD: ' . $this->request->getMethod());
        log_message('info', 'Kamar::update - POST data received: ' . json_encode($this->request->getPost()));
        log_message('info', 'Kamar::update - FILES data received: ' . json_encode($this->request->getFiles()));
        
        // Check if this is a POST request
        if (!$this->request->is('post')) {
            log_message('error', 'Kamar::update - Not a POST request, method: ' . $this->request->getMethod());
            return redirect()->to('/admin/kamar/edit/' . $kamar_id)->with('error', 'Metode request tidak valid.');
        }
        
        // Check CSRF token
        if (!$this->request->getPost('csrf_test_name')) {
            log_message('error', 'Kamar::update - CSRF token missing');
            return redirect()->to('/admin/kamar/edit/' . $kamar_id)->with('error', 'Token keamanan tidak valid. Silakan refresh halaman dan coba lagi.');
        }
        
        // Basic validation - check if essential POST data exists
        $basicFields = ['nomor_kamar', 'tipe_kamar', 'kapasitas', 'harga', 'status'];
        $missingFields = [];
        foreach ($basicFields as $field) {
            if ($this->request->getPost($field) === null) {
                $missingFields[] = $field;
            }
        }
        
        if (!empty($missingFields)) {
            log_message('error', 'Kamar::update - Missing POST fields: ' . implode(', ', $missingFields));
            return redirect()->to('/admin/kamar/edit/' . $kamar_id)->with('error', 'Data form tidak lengkap. Pastikan semua field terisi.');
        }
        
        $kamarLama = $this->kamarModel->find($kamar_id);
        if (!$kamarLama) {
            log_message('error', 'Kamar::update - Kamar not found: ' . $kamar_id);
            return redirect()->to('/admin/kamar')->with('error', 'Kamar yang akan diupdate tidak ditemukan.');
        }

        // 1. Validasi Input (dengan pengecualian untuk nomor_kamar unik)
        $rules = [
            'nomor_kamar' => 'required|max_length[50]',
            'tipe_kamar'  => 'required|max_length[100]',
            'kapasitas'   => 'required|integer',
            'harga'       => 'required|numeric',
            'status'      => 'required|in_list[Tersedia,Di Booking,Terisi,Perbaikan]',
        ];
        
        if (!$this->validate($rules)) {
            log_message('error', 'Kamar::update - Validation failed: ' . json_encode($this->validator->getErrors()));
            return redirect()->to('/admin/kamar/edit/' . $kamar_id)->withInput()->with('errors', $this->validator->getErrors());
        }

        // Validasi manual untuk nomor_kamar unik (kecuali untuk kamar yang sedang diupdate)
        $nomorKamarBaru = $this->request->getPost('nomor_kamar');
        if ($nomorKamarBaru !== $kamarLama['nomor_kamar']) {
            // Hanya cek unik jika nomor kamar berubah
            $existingKamar = $this->kamarModel->where('nomor_kamar', $nomorKamarBaru)->where('kamar_id !=', $kamar_id)->first();
            if ($existingKamar) {
                log_message('error', 'Kamar::update - Duplicate nomor_kamar: ' . $nomorKamarBaru);
                return redirect()->to('/admin/kamar/edit/' . $kamar_id)->withInput()->with('errors', ['nomor_kamar' => 'Nomor kamar sudah digunakan kamar lain.']);
            }
        }

        // 2. Upload Foto Baru (opsional - multiple files max 3)
        $uploadedPhotos = [];
        $namaFoto = $kamarLama['foto_kamar']; // Default ke nama foto lama

        // Handle multiple photo uploads
        $photoFiles = $this->request->getFiles();
        log_message('info', 'Kamar::update - Files received: ' . json_encode(array_keys($photoFiles)));

        // Check for foto_kamar_1, foto_kamar_2, foto_kamar_3
        for ($i = 1; $i <= 3; $i++) {
            $fieldName = 'foto_kamar_' . $i;
            if (isset($photoFiles[$fieldName]) && $photoFiles[$fieldName]->isValid() && !$photoFiles[$fieldName]->hasMoved()) {
                $file = $photoFiles[$fieldName];
                log_message('info', 'Kamar::update - Processing file ' . $fieldName . ': name=' . $file->getName() . ', size=' . $file->getSize());

                // Validasi ukuran file (max 2MB per file)
                if ($file->getSize() > 2048 * 1024) {
                    log_message('error', 'Kamar::update - File ' . $fieldName . ' too large: ' . $file->getSize());
                    return redirect()->to('/admin/kamar/edit/' . $kamar_id)->withInput()->with('error', 'Ukuran file ' . $fieldName . ' maksimal 2MB');
                }

                // Validasi tipe file
                $allowedMimes = ['image/jpeg', 'image/jpg', 'image/png', 'image/webp'];
                $allowedExtensions = ['jpg', 'jpeg', 'png', 'webp'];

                if (!in_array($file->getMimeType(), $allowedMimes)) {
                    log_message('error', 'Kamar::update - Invalid file type for ' . $fieldName . ': ' . $file->getMimeType());
                    return redirect()->to('/admin/kamar/edit/' . $kamar_id)->withInput()->with('error', 'Tipe file ' . $fieldName . ' tidak didukung. Gunakan JPG, PNG, atau WebP');
                }

                // Validasi ekstensi file
                $fileExtension = strtolower($file->getExtension());
                if (!in_array($fileExtension, $allowedExtensions)) {
                    log_message('error', 'Kamar::update - Invalid file extension for ' . $fieldName . ': ' . $fileExtension);
                    return redirect()->to('/admin/kamar/edit/' . $kamar_id)->withInput()->with('error', 'Ekstensi file ' . $fieldName . ' tidak didukung. Gunakan JPG, PNG, atau WebP');
                }

                // Generate unique filename
                $newFileName = $file->getRandomName();

                try {
                    if ($file->move(FCPATH . 'img/kamar', $newFileName)) {
                        $uploadedPhotos[] = $newFileName;
                        log_message('info', 'Kamar::update - File ' . $fieldName . ' uploaded successfully: ' . $newFileName);
                    } else {
                        log_message('error', 'Kamar::update - Failed to move file ' . $fieldName);
                        return redirect()->to('/admin/kamar/edit/' . $kamar_id)->withInput()->with('error', 'Gagal mengupload file ' . $fieldName);
                    }
                } catch (\Exception $e) {
                    log_message('error', 'Kamar::update - Exception uploading file ' . $fieldName . ': ' . $e->getMessage());
                    return redirect()->to('/admin/kamar/edit/' . $kamar_id)->withInput()->with('error', 'Error mengupload file ' . $fieldName . ': ' . $e->getMessage());
                }
            }
        }

        // If new photos uploaded, update the foto_kamar field with JSON array
        if (!empty($uploadedPhotos)) {
            // Delete old photos if they exist
            if (!empty($kamarLama['foto_kamar'])) {
                $oldPhotos = json_decode($kamarLama['foto_kamar'], true);
                if (is_array($oldPhotos)) {
                    foreach ($oldPhotos as $oldPhoto) {
                        $oldFilePath = FCPATH . 'img/kamar/' . $oldPhoto;
                        if (file_exists($oldFilePath)) {
                            @unlink($oldFilePath);
                            log_message('info', 'Kamar::update - Deleted old photo: ' . $oldPhoto);
                        }
                    }
                } else {
                    // Handle legacy single photo
                    $oldFilePath = FCPATH . 'img/kamar/' . $kamarLama['foto_kamar'];
                    if (file_exists($oldFilePath)) {
                        @unlink($oldFilePath);
                        log_message('info', 'Kamar::update - Deleted legacy photo: ' . $kamarLama['foto_kamar']);
                    }
                }
            }

            $namaFoto = json_encode($uploadedPhotos);
            log_message('info', 'Kamar::update - New photos JSON: ' . $namaFoto);
        } else {
            // Keep existing photos
            $namaFoto = $kamarLama['foto_kamar'];
            log_message('info', 'Kamar::update - Keeping existing photos: ' . $namaFoto);
        }

        // 3. Proses data fasilitas, aturan, dan informasi penting
        $fasilitas_fitur = $this->request->getPost('fasilitas_fitur');
        $fasilitas_lainnya = $this->request->getPost('fasilitas_lainnya');
        
        $aturan_kamar = $this->request->getPost('aturan_kamar');
        $aturan_lainnya = $this->request->getPost('aturan_lainnya');
        
        $informasi_penting = $this->request->getPost('informasi_penting');
        $info_lainnya = $this->request->getPost('info_lainnya');
        
        // Gabungkan fasilitas
        $fasilitas_combined = [];
        if (is_array($fasilitas_fitur)) {
            $fasilitas_combined = array_merge($fasilitas_combined, $fasilitas_fitur);
        }
        if (!empty($fasilitas_lainnya)) {
            // Split by comma and trim each item
            $custom_fasilitas = array_map('trim', explode(',', $fasilitas_lainnya));
            $fasilitas_combined = array_merge($fasilitas_combined, $custom_fasilitas);
        }
        $fasilitas_final = !empty($fasilitas_combined) ? implode("\n", $fasilitas_combined) : '';
        
        // Gabungkan aturan
        $aturan_combined = [];
        if (is_array($aturan_kamar)) {
            $aturan_combined = array_merge($aturan_combined, $aturan_kamar);
        }
        if (!empty($aturan_lainnya)) {
            // Split by comma and trim each item
            $custom_aturan = array_map('trim', explode(',', $aturan_lainnya));
            $aturan_combined = array_merge($aturan_combined, $custom_aturan);
        }
        $aturan_final = !empty($aturan_combined) ? implode("\n", $aturan_combined) : '';
        
        // Gabungkan informasi penting
        $info_combined = [];
        if (is_array($informasi_penting)) {
            $info_combined = array_merge($info_combined, $informasi_penting);
        }
        if (!empty($info_lainnya)) {
            // Split by comma and trim each item
            $custom_info = array_map('trim', explode(',', $info_lainnya));
            $info_combined = array_merge($info_combined, $custom_info);
        }
        $info_final = !empty($info_combined) ? implode("\n", $info_combined) : '';

        log_message('info', 'Kamar::update - Final processed data - fasilitas_final: ' . $fasilitas_final);
        log_message('info', 'Kamar::update - Final processed data - aturan_final: ' . $aturan_final);
        log_message('info', 'Kamar::update - Final processed data - info_final: ' . $info_final);

        // 4. Update Data ke Database
        try {
            $updateData = [
                'nomor_kamar' => $this->request->getPost('nomor_kamar'),
                'tipe_kamar'  => $this->request->getPost('tipe_kamar'),
                'kapasitas'   => $this->request->getPost('kapasitas'),
                'harga'       => $this->request->getPost('harga'),
                'deskripsi'   => $this->request->getPost('deskripsi'),
                'fasilitas_fitur' => $fasilitas_final,
                'informasi_kamar' => $this->request->getPost('informasi_kamar'),
                'aturan_kamar' => $aturan_final,
                'informasi_penting' => $info_final,
                'foto_kamar'  => $namaFoto,
                'status'      => $this->request->getPost('status'),
            ];
            
            log_message('info', 'Kamar::update - Update data: ' . json_encode($updateData));
            
            // Validate that all required fields are present
            $requiredFields = ['nomor_kamar', 'tipe_kamar', 'kapasitas', 'harga', 'status'];
            foreach ($requiredFields as $field) {
                if (!isset($updateData[$field]) || $updateData[$field] === null || $updateData[$field] === '') {
                    log_message('error', 'Kamar::update - Missing required field: ' . $field);
                    return redirect()->to('/admin/kamar/edit/' . $kamar_id)->withInput()->with('error', 'Field ' . $field . ' tidak boleh kosong.');
                }
            }
            
            $result = $this->kamarModel->update($kamar_id, $updateData);
            log_message('info', 'Kamar::update - Model update result: ' . ($result ? 'true' : 'false'));
            
            if ($result) {
                log_message('info', 'Kamar::update - Update successful for kamar_id: ' . $kamar_id);
                return redirect()->to('/admin/kamar')->with('success', 'Data Kamar berhasil diperbarui.');
            } else {
                log_message('error', 'Kamar::update - Update failed, model returned false for kamar_id: ' . $kamar_id);
                
                // Get more specific error information
                $modelErrors = $this->kamarModel->errors();
                $dbError = $this->kamarModel->db->error();
                
                log_message('error', 'Kamar::update - Model errors: ' . json_encode($modelErrors));
                log_message('error', 'Kamar::update - DB error: ' . json_encode($dbError));
                
                // Provide specific error message based on the error type
                $errorMessage = 'Gagal memperbarui data kamar. ';
                
                if (!empty($dbError['message'])) {
                    // Database-specific errors
                    if (strpos($dbError['message'], 'Duplicate entry') !== false) {
                        $errorMessage .= 'Nomor kamar sudah digunakan kamar lain.';
                    } elseif (strpos($dbError['message'], 'Data too long') !== false) {
                        $errorMessage .= 'Data yang dimasukkan terlalu panjang.';
                    } elseif (strpos($dbError['message'], 'foreign key constraint') !== false) {
                        $errorMessage .= 'Data terkait dengan booking atau pembayaran yang masih aktif.';
                    } elseif (strpos($dbError['message'], 'MySQL server has gone away') !== false) {
                        $errorMessage .= 'Koneksi database terputus. Silakan coba lagi dalam beberapa saat.';
                    } else {
                        $errorMessage .= 'Error database: ' . $dbError['message'];
                    }
                } elseif (!empty($modelErrors)) {
                    // Model validation errors
                    $errorMessages = [];
                    foreach ($modelErrors as $field => $error) {
                        $errorMessages[] = ucfirst($field) . ': ' . $error;
                    }
                    $errorMessage .= implode(', ', $errorMessages);
                } else {
                    $errorMessage .= 'Silakan periksa data yang dimasukkan dan coba lagi.';
                }
                
                return redirect()->to('/admin/kamar/edit/' . $kamar_id)->withInput()->with('error', $errorMessage);
            }
        } catch (\Exception $e) {
            log_message('error', 'Kamar::update - Exception during update: ' . $e->getMessage());
            log_message('error', 'Kamar::update - Exception trace: ' . $e->getTraceAsString());
            
            // Provide specific error message based on exception type
            $errorMessage = 'Terjadi kesalahan saat memperbarui data kamar. ';
            
            if (strpos($e->getMessage(), 'MySQL server has gone away') !== false) {
                $errorMessage .= 'Koneksi database terputus. Silakan refresh halaman dan coba lagi.';
            } elseif (strpos($e->getMessage(), 'Connection refused') !== false) {
                $errorMessage .= 'Tidak dapat terhubung ke database. Silakan coba lagi nanti.';
            } elseif (strpos($e->getMessage(), 'Access denied') !== false) {
                $errorMessage .= 'Akses database ditolak. Silakan hubungi administrator.';
            } elseif (strpos($e->getMessage(), 'disk space') !== false || strpos($e->getMessage(), 'space') !== false) {
                $errorMessage .= 'Ruang penyimpanan server penuh. Silakan hubungi administrator.';
            } else {
                $errorMessage .= 'Error sistem: ' . $e->getMessage() . '. Silakan coba lagi.';
            }
            
            return redirect()->to('/admin/kamar/edit/' . $kamar_id)->withInput()->with('error', $errorMessage);
        }
    }

    public function updateStatus($kamar_id)
    {
        $kamar = $this->kamarModel->find($kamar_id);
        if (!$kamar) {
            return redirect()->to('/admin/kamar')->with('error', 'Kamar tidak ditemukan.');
        }

        $status = $this->request->getPost('status');
        $allowed = ['Tersedia', 'Di Booking', 'Terisi', 'Perbaikan'];
        if (!in_array($status, $allowed)) {
            return redirect()->to('/admin/kamar')->with('error', 'Status tidak valid.');
        }

        $this->kamarModel->update($kamar_id, ['status' => $status]);
        return redirect()->to('/admin/kamar')->with('success', 'Status kamar berhasil diperbarui.');
    }

    // [C R U D] - D (Delete): Menghapus data kamar
    public function delete($kamar_id)
    {
        $kamar = $this->kamarModel->find($kamar_id);
        if (!$kamar) {
             return redirect()->to('/admin/kamar')->with('error', 'Kamar yang akan dihapus tidak ditemukan.');
        }

        // Peringatan: Pastikan tidak ada data booking/pembayaran yang terkait.
        // Karena kita menggunakan CASCADE di migrasi, data terkait akan ikut terhapus.
        try {
            // Hapus file foto jika ada (handle multiple photos)
            if (!empty($kamar['foto_kamar'])) {
                $decoded = json_decode($kamar['foto_kamar'], true);
                if (is_array($decoded)) {
                    // Multiple photos
                    foreach ($decoded as $photo) {
                        $filePath = FCPATH . 'img/kamar/' . $photo;
                        if (file_exists($filePath)) {
                            @unlink($filePath);
                            log_message('info', 'Kamar::delete - Deleted photo: ' . $photo);
                        }
                    }
                } else {
                    // Legacy single photo
                    $filePath = FCPATH . 'img/kamar/' . $kamar['foto_kamar'];
                    if (file_exists($filePath)) {
                        @unlink($filePath);
                        log_message('info', 'Kamar::delete - Deleted legacy photo: ' . $kamar['foto_kamar']);
                    }
                }
            }

            $this->kamarModel->delete($kamar_id);
            return redirect()->to('/admin/kamar')->with('success', 'Data Kamar berhasil dihapus.');
        } catch (\Exception $e) {
            // Handle error jika ada batasan Foreign Key yang gagal dihapus (misalnya: jika CASCADE tidak diatur)
            return redirect()->to('/admin/kamar')->with('error', 'Gagal menghapus kamar. Kamar mungkin memiliki riwayat transaksi aktif.');
        }
    }

    // [R E P A I R] - Menampilkan daftar kamar yang sedang diperbaiki
    public function perbaikan()
    {
        log_message('info', 'Kamar::perbaikan - Starting repair management');

        $data['kamars'] = $this->kamarModel->where('status', 'Perbaikan')->findAll();
        $data['title'] = 'Kelola Kamar Perbaikan';

        return view('admin/kamar/perbaikan', $data);
    }

    // [R E P A I R] - Menandai kamar selesai diperbaiki
    public function selesaiPerbaikan($kamar_id)
    {
        $kamar = $this->kamarModel->find($kamar_id);
        if (!$kamar) {
            return redirect()->to('/admin/kamar/perbaikan')->with('error', 'Kamar tidak ditemukan.');
        }

        if ($kamar['status'] !== 'Perbaikan') {
            return redirect()->to('/admin/kamar/perbaikan')->with('error', 'Kamar ini tidak dalam status perbaikan.');
        }

        // Update status menjadi Tersedia
        $result = $this->kamarModel->update($kamar_id, ['status' => 'Tersedia']);

        if ($result) {
            log_message('info', 'Kamar::selesaiPerbaikan - Kamar ' . $kamar_id . ' marked as repaired');
            return redirect()->to('/admin/kamar/perbaikan')->with('success', 'Kamar ' . $kamar['nomor_kamar'] . ' telah selesai diperbaiki dan tersedia kembali.');
        } else {
            return redirect()->to('/admin/kamar/perbaikan')->with('error', 'Gagal memperbarui status kamar.');
        }
    }
}