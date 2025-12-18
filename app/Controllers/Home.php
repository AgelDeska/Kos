<?php namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\KamarModel;
use App\Models\SettingModel;

class Home extends BaseController
{
    protected $kamarModel;
    protected $settingModel;

    public function __construct()
    {
        $this->kamarModel = new KamarModel();
        $this->settingModel = new SettingModel();
    }

    // Menampilkan halaman beranda publik
    public function index()
    {
        $data['kamar_tersedia'] = $this->kamarModel->where('status', 'Tersedia')->findAll(6); // Tampilkan 6 kamar tersedia
        $data['kos_latitude'] = $this->settingModel->getSetting('kos_latitude') ?? '-6.2088';
        $data['kos_longitude'] = $this->settingModel->getSetting('kos_longitude') ?? '106.8456';
        $data['kos_address'] = $this->settingModel->getSetting('kos_address') ?? 'Jakarta, Indonesia';
        return view('home/index', $data); // L1: Halaman Beranda
    }

    // Menampilkan semua kamar yang tersedia
    public function katalogKamar()
    {
        // Ambil data kamar dengan filter
        $tipe = $this->request->getGet('tipe');
        $status = $this->request->getGet('status');
        $harga = $this->request->getGet('harga');
        $kapasitas = $this->request->getGet('kapasitas');

        $query = $this->kamarModel->whereIn('status', ['Tersedia', 'Di Booking']);

        // Filter berdasarkan tipe
        if (!empty($tipe)) {
            $query = $query->where('tipe_kamar', $tipe);
        }

        // Filter berdasarkan status
        if (!empty($status)) {
            $query = $query->where('status', $status);
        }

        // Filter berdasarkan harga
        if (!empty($harga)) {
            if ($harga == '1000000') {
                $query = $query->where('harga <', 1000000);
            } elseif ($harga == '1000000-2000000') {
                $query = $query->where('harga >=', 1000000)->where('harga <=', 2000000);
            } elseif ($harga == '2000000') {
                $query = $query->where('harga >', 2000000);
            }
        }

        // Filter berdasarkan kapasitas
        if (!empty($kapasitas)) {
            $query = $query->where('kapasitas', $kapasitas);
        }

        $data['kamars'] = $query->findAll();
        
        // Ambil data untuk filter dropdown
        $data['tipe_options'] = $this->kamarModel->select('tipe_kamar')->distinct()->findAll();
        $data['kapasitas_options'] = $this->kamarModel->select('kapasitas')->distinct()->orderBy('kapasitas')->findAll();
        
        // Filter values untuk form
        $data['filter_tipe'] = $tipe;
        $data['filter_status'] = $status;
        $data['filter_harga'] = $harga;
        $data['filter_kapasitas'] = $kapasitas;
        
        return view('kamar/katalog', $data);
    }

    // Menampilkan detail kamar
    public function detailKamar($kamar_id)
    {
        $data['kamar'] = $this->kamarModel->find($kamar_id);
        
        if (!$data['kamar'] || $data['kamar']['status'] == 'Terisi') {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound('Kamar tidak ditemukan atau sedang terisi.');
        }

        return view('kamar/detail', $data);
    }
}