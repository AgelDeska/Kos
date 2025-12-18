<?php namespace App\Models;

use CodeIgniter\Model;

class KamarModel extends Model
{
    // Konfigurasi Dasar
    protected $table      = 'kamar';
    protected $primaryKey = 'kamar_id';
    
    // Tipe kembalian dan Timestamp
    protected $returnType     = 'array';
    protected $useTimestamps  = true;
    protected $createdField   = 'created_at';
    protected $updatedField   = 'updated_at';

    // Field yang diizinkan untuk diisi
    protected $allowedFields = [
        'nomor_kamar', 'tipe_kamar', 'kapasitas', 'harga', 'deskripsi', 'foto_kamar', 'status', 'fasilitas_fitur', 'informasi_kamar', 'aturan_kamar', 'informasi_penting'
    ];

    // Aturan Validasi
    protected $validationRules = [
        'nomor_kamar' => 'required|max_length[50]',
        'tipe_kamar'  => 'required|max_length[100]',
        'kapasitas'   => 'required|integer',
        'harga'       => 'required|numeric',
        'status'      => 'required|in_list[Tersedia,Di Booking,Terisi,Perbaikan]',
    ];

    // Metode untuk mendapatkan validation rules dengan signature yang sesuai parent class
    public function getValidationRules(array $options = []): array
    {
        $rules = $this->validationRules;

        // Untuk update, nomor_kamar sudah divalidasi secara manual di controller
        // Tidak perlu validasi is_unique di sini karena sudah ditangani di controller

        return $rules;
    }

    /**
     * Metode kustom untuk mendapatkan daftar kamar yang tersedia atau dibooking
     * @param string $status
     * @return array
     */
    public function getKamarByStatus($status = 'Tersedia')
    {
        return $this->where('status', $status)->findAll();
    }
}