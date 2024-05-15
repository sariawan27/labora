<?php

namespace App\Models;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\Model;

class PemeriksaanDatatablesModel extends Model
{
    protected $table  = 't_pemeriksaan';
    protected $column_order = [
        'id',
        'idPasien',
        'status',
        'tanggalPemeriksaan',
        'statusSelesai',
        'NomorAntrian',
        'userIdPendaftar',
        'metode_pembayaran',
        'totalPembayaran'
    ];
    protected $column_search = [
        'status',
        'tanggalPemeriksaan',
        'statusSelesai',
        'NomorAntrian',
        'userIdPendaftar',
        'metode_pembayaran',
        'totalPembayaran'
    ];
    protected $order = ['id' => 'DESC'];
    protected $request;
    protected $db;
    protected $dt;

    public function __construct($request)
    {
        parent::__construct();
        $this->db = db_connect();
        $this->request = $request;
        // $this->table = $table;
        $this->dt = $this->db->table($this->table)->select('t_pemeriksaan.id, t_pemeriksaan.idPasien, t_pemeriksaan.status, t_pemeriksaan.tanggalPemeriksaan, t_pemeriksaan.statusSelesai, t_pemeriksaan.NomorAntrian, t_pemeriksaan.userIdPendaftar, t_pemeriksaan.metode_pembayaran, t_pemeriksaan.totalPembayaran, t_pemeriksaan.updated_at, m_pasien.nomorRekamMedis, m_pasien.namaPasien, m_pasien.jk, m_pasien.tempatLahir, m_pasien.tanggalLahir, m_pasien.email, m_pasien.nomor, m_pasien.alamat, m_pasien.usia')->join('m_pasien', 't_pemeriksaan.idPasien=m_pasien.id', 'left');
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
