<?php namespace App\Models;

use CodeIgniter\Model;

class BookingModel extends Model
{
    // Konfigurasi Dasar
    protected $table      = 'booking';
    protected $primaryKey = 'booking_id';
    
    // Tipe kembalian dan Timestamp
    protected $returnType     = 'array';
    protected $useTimestamps  = true;
    protected $createdField   = 'created_at';
    protected $updatedField   = 'updated_at';

    // Field yang diizinkan untuk diisi
    protected $allowedFields = [
        'user_id', 'kamar_id', 'tanggal_booking', 'durasi_sewa_bulan', 
        'tanggal_mulai_sewa', 'tanggal_selesai_sewa', 'status'
    ];

    // Aturan Validasi
    protected $validationRules = [
        'user_id' => 'required|integer',
        'kamar_id' => 'required|integer',
        'tanggal_booking' => 'required|valid_date',
        'durasi_sewa_bulan' => 'required|integer|greater_than[0]',
        'status' => 'required|in_list[Menunggu,Diterima,Ditolak,Aktif]',
    ];

    /**
     * Metode untuk mendapatkan detail booking beserta data user dan kamar (Join)
     * @param int|null $id
     * @return array
     */
    public function getBookingDetail($id = null)
    {
        $builder = $this->db->table($this->table);
        $builder->select('booking.*, user.nama as nama_penyewa, kamar.nomor_kamar, kamar.harga');
        $builder->join('user', 'user.user_id = booking.user_id');
        $builder->join('kamar', 'kamar.kamar_id = booking.kamar_id');

        if ($id) {
            return $builder->where('booking.booking_id', $id)->first();
        }

        return $builder->findAll();
    }
}