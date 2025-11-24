<?php namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\KamarModel;

class Home extends BaseController
{
    protected $kamarModel;

    public function __construct()
    {
        $this->kamarModel = new KamarModel();
    }

    // Menampilkan halaman beranda publik
    public function index()
    {
        $data['kamar_tersedia'] = $this->kamarModel->where('status', 'Tersedia')->findAll(6); // Tampilkan 6 kamar tersedia
        return view('home/index', $data); // L1: Halaman Beranda
    }

    // Menampilkan semua kamar yang tersedia
    public function katalogKamar()
    {
        $data['kamars'] = $this->kamarModel->whereIn('status', ['Tersedia', 'Di Booking'])->findAll();
        return view('kamar/katalog', $data); // Halaman Lihat Kamar Tersedia
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