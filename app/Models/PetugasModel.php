<?php

namespace App\Models;

use CodeIgniter\Model;

class PetugasModel extends Model
{
    protected $table            = 'm_petugas';
    protected $primaryKey       = 'id';
    protected $returnType       = 'array';
    protected $useSoftDeletes   = true;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'id',
        'namaLengkap',
        'tglLahir',
        'nik',
        'tglTugas',
    ];
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';


    public function getById($id)
    {
        return $this->builder()->where($this->primaryKey, $id)->get()->getRowArray();
    }
}
