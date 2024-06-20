
<?php

class ApiModel extends CI_Model{

    function check_logins($username,$password){

        $this->db->select('*');
        $this->db->from('user');
        $this->db->where('username',$username);
        $this->db->where('password',$password);
        
        $query = $this->db->get();

        if($query->num_rows()>0){
            return $query->result_array();
        }else{
            return false;
        }
    }

    function ambil_data($where){
        return $this->db->get_where('user', $where)->row();
    }

    function cek_login($where){
        return $this->db->get_where('user', $where)->num_rows();
    }

    public function get_mahasiswa($id = null){
        if($id === null){
            return $this->db->get('mahasiswa')->result_array();
        }else{
            return $this->db->get_where('mahasiswa', ['id' => $id])->result_array();
        }
    }

    public function post_mahasiswa($data){
        $this->db->insert('mahasiswa', $data);

        return $this->db->affected_rows();
    }

    public function update_mahasiswa($id, $data){
        $this->db->update('mahasiswa', $data, ['id' => $id]);

        return $this->db->affected_rows();
    }

    public function delete_mahasiswa($id){
        $this->db->delete('mahasiswa', ['id' => $id]);

        return $this->db->affected_rows();
    }

    public function get_dosen($id = null){
        
        if($id === null){
            return $this->db->get('dosen')->result_array();
        }else{
            return $this->db->get_where('dosen', ['id_dsn' => $id])->result_array();
        }
    }

    public function post_dosen($data){
        $this->db->insert('dosen', $data);

        return $this->db->affected_rows();
    }

    public function update_dosen($id, $data){
        $this->db->update('dosen', $data, ['id_dsn' => $id]);

        return $this->db->affected_rows();
    }
    
    public function delete_dosen($id){
        $this->db->delete('dosen', ['id_dsn' => $id]);

        return $this->db->affected_rows();
    }

    public function get_user($id = null){
        
        if($id === null){
            return $this->db->get('user')->result_array();
        }else{
            return $this->db->get_where('user', ['id' => $id])->result_array();
        }
    }

    public function post_user($data){
        $this->db->insert('user', $data);

        return $this->db->affected_rows();
    }

    public function update_user($id, $data){
        $this->db->update('user', $data, ['id' => $id]);

        return $this->db->affected_rows();
    }

    public function delete_user($id){
        $this->db->delete('user', ['id' => $id]);

        return $this->db->affected_rows();
    }

    public function is_valid($username){
        $this-> db->select('*');
        $this->db->from('user');
        $this->db->where('username', $username);
        $query = $this->db->get();
        return $query->row();
    }

    public function is_valid_num($username){
        $this->db->select('*');
        $this->db->from('user');
        $this->db->where('username', $username);
        $query = $this->db->get();
        return $query->num_rows();
    }
}