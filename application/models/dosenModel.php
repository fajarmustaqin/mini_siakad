<?php

class dosenModel extends CI_Model
{

    var $table_dosen = 'dosen';
    var $column_order = array('null', 'nidn', 'nama_dsn', 'jenis_kelamin_dsn', 'email_dsn', 'alamat_dsn');
    var $column_search = array('nidn', 'nama_dsn', 'email_dsn', 'alamat_dsn');
    var $order = array('id_dsn' => 'desc');

    public function __construct()
    {
        parent::__construct();
    }

    private function _get_query_dosen()
    {
        $this->db->from($this->table_dosen);

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
        $this->db->from($this->table_dosen);
        return $this->db->count_all_results();
    }

    public function save($data)
    {

        $id_group = 3;
        $data_user = [
            'username' => $data['nidn'],
            'real_name' => $data['nama_dosen'],
            'email' => $data['email'],
            'password' => hash('sha256', $data['nidn']),
            'id_group' => $id_group
        ];

        $this->db->trans_start();

        $this->db->insert('user', $data_user);

        $last_id = $this->db->insert_id();

        $data_dosen = [
            'nidn' => $data['nidn'],
            'nama_dosen' => $data['nama_dosen'],
            'jenis_kelamin' => $data['jenis_kelamin'],
            'no_hp' => $data['no_hp'],
            'email' => $data['email'],
            'alamat' => $data['alamat'],
            'id_user' => $last_id,
            'created_by' => $this->session->userdata('id')
        ];

        $this->db->insert($this->table_dosen, $data_dosen);

        if ($this->db->trans_status() == false) {
            $this->db->trans_rollback();
        } else {
            $this->db->trans_commit();
        }
    }

    public function delete_dosen($id)
    {
        $this->db->where('id_dsn', $id);
        $this->db->delete($this->table_dosen);
    }

    public function get_id($id)
    {
        $this->db->from($this->table_dosen);
        $this->db->where('id_dsn', $id);
        $query = $this->db->get();

        return $query->row();
    }

    public function updateDosen($data)
    {

        $data_dosen = array(
            'nidn'      => $data['nidn'],
            'nama_dosen'      => $data['nama_dosen'],
            'jenis_kelamin' => $data['jenis_kelamin'],
            'no_hp'         => $data['no_hp'],
            'email'         => $data['email'],
            'alamat'        => $data['alamat'],
            'update_by'     => $this->session->userdata('id')
        );

        $id = array('id' => $data['id']);

        $this->db->update($this->table_dosen, $data_dosen, $id);
    }

    public function get_data($id)
    {

        $this->db->from($this->table_dosen);

        $this->db->where('id_user', $id);

        $query = $this->db->get()->row();

        return $query;
    }

    public function get_dosen()
    {
        $this->db->from('dosen');
        $query = $this->db->get();

        return $query->result();
    }
}
