<?php

namespace App\Models;

use CodeIgniter\Model;

class BukuModel extends Model
{
    protected $table            = 'buku';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['isbn', 'judul', 'penulis', 'tahun', 'stok'];

    // Timestamps
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    // Validasi tambahan di level model (double-check selain di controller)
    protected $validationRules = [
        'isbn'    => 'required|min_length[10]|max_length[20]',
        'judul'   => 'required|min_length[3]|max_length[255]',
        'penulis' => 'required|min_length[3]|max_length[100]',
        'tahun'   => 'required|numeric',
        'stok'    => 'required|numeric|greater_than_equal_to[0]',
    ];
}
