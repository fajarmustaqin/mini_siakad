<?php

class PebimbingModel extends CI_Model
{

    var $tb_mhs = 'mahasiswa';
    var $tb_dsn = 'dosen';
    var $column_order = array('nim', 'nama', 'email', 'jenis_kelamin', 'alamat');
    var $column_search = array('nim', 'nama', 'email', 'alamat');
    var $order = array('id' => 'desc');

    public function __construct()
    {
        parent::__construct();
    }

    private function _get_query_dosen()
    {
        $this->db->from($this->tb_mhs);
        $this->db->where('id_dosen', $this->session->userdata('id_dosen'));

        $i = 0;
        foreach ($this->column_search as $val) {
            if ($_POST['search']['value']) {
                if ($i === 0) {
                    $this->db->group_start();
                    $this->db->like($val, $_POST['search']['value']);
                } else {
                    $this->db->or_like($val, $_POST['search']['value']);
                }

                if (count($this->column_search) - 1 == $i)
                    $this->db->group_end();
            }
            $i++;
        }
        if (isset($_POST['order'])) {
            $this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } else if (isset($this->order)) {
            $order = $this->order;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }


    function get_datatables()
    {
        $this->_get_query_dosen();
        if ($_POST['length'] != -1)
            $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }

    function count_filtered()
    {
        $this->_get_query_dosen();
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function count_all()
    {
        $this->db->from($this->tb_mhs);
        return $this->db->count_all_results();
    }

    public function get_mhs_bimbingan($id)
    {
        $this->db->from($this->tb_mhs);
        $this->db->join('orangtua', 'orangtua.id_ortu = mahasiswa.id_orangtua', 'left');
        $this->db->where('id', $id);
        $query = $this->db->get();

        return $query->row();
    }
}
