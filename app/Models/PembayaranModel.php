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
        'user_id', 'kamar_id', 'booking_id', 'jenis_pembayaran', 'tagihan_bulan', 
        'jumlah', 'tanggal_bayar', 'metode', 'bukti_transfer', 'status'
    ];

    // Aturan Validasi
    protected $validationRules = [
        'user_id' => 'required|integer',
        'kamar_id' => 'required|integer',
        'jenis_pembayaran' => 'required|in_list[DP/Awal,Bulanan]',
        // tagihan_bulan hanya wajib untuk pembayaran Bulanan; tidak wajib untuk DP/Awal
        'tagihan_bulan' => 'permit_empty',
        'jumlah' => 'required|numeric|greater_than[0]',
    ];

    /**
     * Get validation rules for pembayaran
     * @param array $options
     * @return array
     */
    public function getValidationRules(array $options = []): array
    {
        return $this->validationRules;
    }

    /**
     * Metode untuk mendapatkan detail pembayaran beserta informasi penyewa dan kamar
     * @param int|null $id
     * @return array
     */
    public function getPembayaranDetail($id = null)
    {
        $builder = $this->db->table($this->table);
        $builder->select('pembayaran.*, user.nama as nama_penyewa, user.username, kamar.nomor_kamar, booking.status as booking_status');
        $builder->join('user', 'user.user_id = pembayaran.user_id');
        $builder->join('kamar', 'kamar.kamar_id = pembayaran.kamar_id', 'left');
        $builder->join('booking', 'booking.booking_id = pembayaran.booking_id', 'left');

        if ($id) {
            return $builder->where('pembayaran.pembayaran_id', $id)->get()->getFirstRow('array');
        }

        return $builder->get()->getResultArray();
    }
}