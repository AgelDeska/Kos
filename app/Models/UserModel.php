<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table            = 'users';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['role_id', 'nama', 'username', 'email', 'no_hp', 'password', 'is_active', 'created_at', 'updated_at'];

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
        // Join dengan tabel roles untuk mendapatkan nama_role
        return $this->db->table('users')
            ->select('users.*, roles.nama_role')
            ->join('roles', 'roles.id = users.role_id')
            ->where('username', $identifier)
            ->orWhere('email', $identifier)
            ->get()
            ->getRowArray();
    }
}