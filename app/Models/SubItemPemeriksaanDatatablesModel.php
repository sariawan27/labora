<?php

namespace App\Models;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\Model;

class SubItemPemeriksaanDatatablesModel extends Model
{
    protected $table  = 'm_subPemeriksaan';
    protected $column_order = ['id', 'idPemeriksaan', 'nama', 'harga', 'deskripsi'];
    protected $column_search = ['nama', 'harga', 'deskripsi'];
    protected $order = ['id' => 'DESC'];
    protected $request;
    protected $db;
    protected $dt;

    public function __construct($request, $idPemeriksaan)
    {
        parent::__construct();
        $this->db = db_connect();
        $this->request = $request;
        // $this->table = $table;
        $this->dt = $this->db->table($this->table)->where(["idPemeriksaan" => $idPemeriksaan, "deleted_at IS NULL" => null]);
    }

    private function getDatatablesQuery()
    {
        $i = 0;
        foreach ($this->column_search as $item) {
            if ($this->request->getGet('search')['value']) {
                if ($i === 0) {
                    $this->dt->groupStart();
                    $this->dt->like($item, $this->request->getGet('search')['value']);
                } else {
                    $this->dt->orLike($item, $this->request->getGet('search')['value']);
                }
                if (count($this->column_search) - 1 == $i)
                    $this->dt->groupEnd();
            }
            $i++;
        }

        if ($this->request->getGet('order')) {
            $this->dt->orderBy($this->column_order[$this->request->getGet('order')['0']['column']], $this->request->getGet('order')['0']['dir']);
        } else if (isset($this->order)) {
            $order = $this->order;
            $this->dt->orderBy(key($order), $order[key($order)]);
        }
    }

    public function getDatatables()
    {
        $this->getDatatablesQuery();
        if ($this->request->getGet('length') != -1)
            $this->dt->limit($this->request->getGet('length'), $this->request->getGet('start'));
        $query = $this->dt->get();
        return $query->getResult();
    }

    public function countFiltered()
    {
        $this->getDatatablesQuery();
        return $this->dt->countAllResults();
    }

    public function countAll()
    {
        $tbl_storage = $this->db->table($this->table);
        return $tbl_storage->countAllResults();
    }
}
