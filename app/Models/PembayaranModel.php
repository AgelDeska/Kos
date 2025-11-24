<?php namespace App\Models;

use CodeIgniter\Model;

class PembayaranModel extends Model
{
    // Konfigurasi Dasar
    protected $table      = 'pembayaran';
    protected $primaryKey = 'pembayaran_id';
    
    // Tipe kembalian dan Timestamp
    protected $returnType     = 'array';
    protected $useTimestamps  = true;
    protected $createdField   = 'created_at';
    protected $updatedField   = 'updated_at';

    // Field yang diizinkan untuk diisi
    protected $allowedFields = [
        'user_id', 'kamar_id', 'jenis_pembayaran', 'tagihan_bulan', 
        'jumlah', 'tanggal_bayar', 'metode', 'bukti_transfer', 'status'
    ];

    // Aturan Validasi
    protected $validationRules = [
        'user_id' => 'required|integer',
        'jumlah' => 'required|numeric',
        'tanggal_bayar' => 'required|valid_date',
        'jenis_pembayaran' => 'required|in_list[DP/Awal,Bulanan,Lainnya]',
        'status' => 'required|in_list[Menunggu Verifikasi,Lunas,Ditolak]',
    ];

    /**
     * Metode untuk mendapatkan detail pembayaran beserta informasi penyewa dan kamar
     * @param int|null $id
     * @return array
     */
    public function getPembayaranDetail($id = null)
    {
        $builder = $this->db->table($this->table);
        $builder->select('pembayaran.*, user.nama as nama_penyewa, kamar.nomor_kamar');
        $builder->join('user', 'user.user_id = pembayaran.user_id');
        $builder->join('kamar', 'kamar.kamar_id = pembayaran.kamar_id', 'left'); // Menggunakan LEFT join karena kamar_id bisa null

        if ($id) {
            return $builder->where('pembayaran.pembayaran_id', $id)->first();
        }

        return $builder->findAll();
    }
}