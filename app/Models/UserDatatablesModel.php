<?php

namespace App\Models;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\Model;

class UserDatatablesModel extends Model
{
    protected $table  = 'm_user';
    protected $column_order = ['id', 'namaDepan', 'namaBelakang'];
    protected $column_search = ['namaDepan', 'namaBelakang'];
    protected $order = ['m_user.id' => 'DESC'];
    protected $request;
    protected $db;
    protected $dt;

    public function __construct($request)
    {
        parent::__construct();
        $this->db = db_connect();
        $this->request = $request;
        // $this->table = $table;
        $this->dt = $this->db->table($this->table)->select('m_user.id, m_user.namaDepan, m_user.namaBelakang, m_user.nomor, m_user.roleId, m_roles.nama ')->join('m_roles', 'm_user.roleId=m_roles.id', 'left');
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
