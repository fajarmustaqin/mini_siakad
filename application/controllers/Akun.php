<?php

class Akun extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();

        checkNotLogin();
        if ($this->session->userdata('id_group') != 1) {
            redirect('dashboard');
        }

        $this->load->model('AkunModel', 'akun');
    }

    public function index()
    {
        $data['title'] = 'Data Akun';
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar');
        $this->load->view('admin/akun');
        $this->load->view('templates/footer');
    }

    public function showAkun()
    {
        $list = $this->akun->get_datatables();
        $data = array();
        $no = $_POST['start'];

        foreach ($list as $akun) {

            $row = array();
            $row[] = $akun->id;
            $row[] = $akun->username;
            $row[] = $akun->real_name;
            $row[] = $akun->email;

            if ($akun->id_group == 1) {
                $row[] = "Administrator";
            } else if ($akun->id_group == 2) {
                $row[] = "Admin Baak";
            } else if ($akun->id_group == 3) {
                $row[] = "Dosen";
            } else if ($akun->id_group == 4) {
                $row[] = "Mahasiswa";
            }

            $row[] = '<a class="btn btn-danger btn-sm" href="javascript:void(0)" title="hapus" onclick="deleteUser(' . "'" . $akun->id . "'" . ')"><i class="fa-solid fa-trash"></i></a>';
            $row[] = '<a class="btn btn-success btn-sm" href="javascript:void(0)" title="edit" onclick="updateUser(' . "'" . $akun->id . "'" . ')"><i class="fa-solid fa-pencil"></i></a>';
            $data[] = $row;
        }

        $output = [
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->akun->count_all(),
            "recordsFiltered" => $this->akun->count_filtered(),
            "data" => $data
        ];

        echo json_encode($output);
    }

    public function addAkun()
    {

        $this->_validate_akun();

        $input = $this->input->post();

        $this->akun->create($input);

        echo json_encode(array('status' => TRUE));
    }

    public function deleteAkun($id)
    {

        $this->akun->deleteAkun($id);

        echo json_encode(array('status' => TRUE));
    }

    public function getAkun($id)
    {
        $data = $this->akun->get_data($id);

        echo json_encode($data);
    }


    public function updateAkun()
    {
        $data = $this->input->post();

        $this->akun->update($data);

        echo json_encode(array('status' => TRUE));
    }

    // form validation 
    private function _validate_akun()
    {
        $data = array();
        $data['error_string'] = array();
        $data['inputerror'] = array();
        $data['status'] = true;

        if ($this->input->post('username') == '') {
            $data['inputerror'][] = 'username';
            $data['error_string'][] = 'Username wajib di isi!';
            $data['status'] = false;
        }
        if ($this->input->post('real_name') == '') {
            $data['inputerror'][] = 'real_name';
            $data['error_string'][] = 'Nama Lengkap wajib di isi!';
            $data['status'] = false;
        }
        if ($this->input->post('email') == '') {
            $data['inputerror'][] = 'email';
            $data['error_string'][] = 'Email wajib di isi!';
            $data['status'] = false;
        }
        if ($this->input->post('password') == '') {
            $data['inputerror'][] = 'password';
            $data['error_string'][] = 'Password wajib di isi!';
            $data['status'] = false;
        }
        if ($this->input->post('id_group') == '') {
            $data['inputerror'][] = 'id_group';
            $data['error_string'][] = 'Id Group wajib di pilih!';
            $data['status'] = false;
        }

        if ($data['status'] == false) {
            echo json_encode($data);
            exit();
        }
    }
}
