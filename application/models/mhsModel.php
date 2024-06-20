<?php

class MhsModel extends CI_Model
{

    var $column_order = array(null, 'nim', 'nama', 'email', 'jenis_kelamin');
    var $column_search = array('nim', 'nama', 'email', 'jenis_kelamin', 'nama_dsn');
    var $order = array('id' =>  'desc');

    public function __construct()
    {
        parent::__construct();
    }

    private function _get_query_mahasiswa()
    {
        $this->db->from('mahasiswa');
        $this->db->join('orangtua', 'orangtua.id_ortu = mahasiswa.id_orangtua', 'left');
        $this->db->join('dosen', 'dosen.id_dsn = mahasiswa.id_dosen', 'left');
        $i = 0;
        foreach ($this->column_search as $item) {
            if ($_POST['search']['value']) {
                if ($i === 0) {
                    $this->db->group_start();
                    $this->db->like($item, $_POST['search']['value']);
                } else {
                    $this->db->or_like($item, $_POST['search']['value']);
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

    function get_data_mahasiswa()
    {
        $this->_get_query_mahasiswa();
        if ($_POST['length'] != -1)
            $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }

    function count_filtered()
    {
        $this->_get_query_mahasiswa();
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function count_all()
    {
        $this->db->from('mahasiswa');
        return  $this->db->count_all_results();
    }

    public function get_by_id($id)
    {
        $this->db->from('mahasiswa');
        $this->db->join('orangtua', 'orangtua.id_ortu = mahasiswa.id_orangtua', 'left');
        $this->db->join('dosen', 'dosen.id_dsn = mahasiswa.id_dosen', 'left');
        $this->db->where('id', $id);
        $query = $this->db->get();

        return $query->row();
    }

    public function save($data)
    {
        $data_ortu = array(
            'nama_ayah' => $data['nama_ayah'],
            'no_hp_ayah' => $data['no_hp_ayah'],
            'nama_ibu' => $data['nama_ibu'],
            'no_hp_ibu' => $data['no_hp_ibu'],
            'alamat_ortu' => $data['alamat_ortu'],
            'created_by' => $this->session->userdata('id')
        );

        $this->db->trans_start();

        $this->db->insert('orangtua', $data_ortu);

        $id_ortu = $this->db->insert_id();

        $data_user = array(
            'username' => $data['nim'],
            'real_name' => $data['nama'],
            'email' => $data['email'],
            'password' => hash('sha256', $data['nim']),
            'id_group' => '4'
        );

        $this->db->insert('user', $data_user);

        $id_user = $this->db->insert_id();

        $data_mhs = array(
            'id' => '',
            'nim' => $data['nim'],
            'nama' => $data['nama'],
            'email' => $data['email'],
            'jenis_kelamin' => $data['jenis_kelamin'],
            'alamat' => $data['alamat'],
            'no_hp' => $data['no_hp'],
            'id_orangtua' => $id_ortu,
            'id_user' => $id_user,
            'created_by' => $this->session->userdata('id')
        );

        $this->db->insert('mahasiswa', $data_mhs);

        if ($this->db->trans_status() == FALSE) {
            $this->db->trans_rollback();
        } else {
            $this->db->trans_commit();
        }
    }

    public function updateMahasiswa($data)
    {

        $id = array(
            'id' => $data['id']
        );

        $id_ortu = array(
            'id_ortu' => $data['id_ortu']
        );

        $data_mhs = array(
            'nim'           => $data['nim'],
            'nama'          => $data['nama'],
            'email'         => $data['email'],
            'jenis_kelamin' => $data['jenis_kelamin'],
            'alamat'        => $data['alamat'],
            'no_hp'         => $data['no_hp'],
            'update_by'    => $this->session->userdata('id')
        );

        $data_ortu = array(
            'nama_ayah' => $data['nama_ayah'],
            'no_hp_ayah' => $data['no_hp_ayah'],
            'nama_ibu' => $data['nama_ibu'],
            'no_hp_ibu' => $data['no_hp_ibu'],
            'alamat_ortu' => $data['alamat_ortu'],
            'update_by'  => $this->session->userdata('id')
        );

        $this->db->trans_start();
        $this->db->update('mahasiswa', $data_mhs, $id);

        $this->db->update('orangtua', $data_ortu, $id_ortu);

        if ($this->db->trans_status() == false) {
            $this->db->trans_rollback();
        } else {
            $this->db->trans_commit();
        }

        return $this->db->affected_rows();
    }

    public function delete_by_id($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('mahasiswa');
    }

    public function get_data($id)
    {

        $this->db->from('mahasiswa');
        $this->db->join('orangtua', 'orangtua.id_ortu = mahasiswa.id_orangtua', 'left');
        $this->db->where('id_user', $id);

        $query = $this->db->get()->row();

        return $query;
    }

    public function save_dospem($data)
    {
        $id = array('id' => $data['id_mhs']);

        $data_dospem = array('id_dosen' => $data['dospem']);

        $this->db->update('mahasiswa', $data_dospem, $id);
    }
}
