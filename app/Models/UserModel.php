<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table            = 'user';
    protected $primaryKey       = 'user_id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['username', 'password', 'role', 'nama', 'email', 'no_telp', 'is_active', 'tanggal_masuk', 'reset_token', 'reset_expires'];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    /**
     * Cari pengguna berdasarkan username atau email
     * dan gabungkan dengan nama role.
     * * @param string $identifier Username atau Email
     * @return array|null
     */
    public function findUserByIdentifier(string $identifier)
    {
        // Sesuaikan dengan struktur tabel 'user' (migration CreateUserTable)
        return $this->db->table('user')
            ->select('user.*')
            ->groupStart()
                ->where('username', $identifier)
                ->orWhere('email', $identifier)
            ->groupEnd()
            ->get()
            ->getRowArray();
    }
}