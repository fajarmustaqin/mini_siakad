<?php

class Dosen extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();

        checkNotLogin();
        if ($this->session->userdata('id_group') != 1 && $this->session->userdata('id_group') != 2) {
            redirect('dashboard');
        }

        $this->load->model('DosenModel', 'dosen');
    }

    public function index()
    {
        $data['title'] = 'Data Dosen';
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar');
        $this->load->view('admin/viewDosen');
        $this->load->view('templates/footer');
    }

    public function showDosen()
    {

        $list = $this->dosen->get_datatables();
        $data = array();
        $no = $_POST['start'];
        $nomor = 1;
        foreach ($list as $dsn) {
            $no++;
            $row = array();
            $row[] = $nomor;
            $row[] = $dsn->nidn;
            $row[] = $dsn->nama_dsn;
            $row[] = $dsn->jenis_kelamin_dsn;
            $row[] = $dsn->no_hp_dsn;
            $row[] = $dsn->email_dsn;
            $row[] = $dsn->alamat_dsn;

            $row[] = '<a class="btn btn-success btn-rounded btn-sm" href="javascript:void(0)" title="edit data" onclick="updateDosen(' . "'" . $dsn->id_dsn . "'" . ')"><i class="fa-solid fa-pencil"></i></a>';

            if ($this->session->userdata('id_group') == 1) {
                $row[] = '<a class="btn btn-danger btn-sm" href="javascript:void(0)" title="hapus" onclick="deleteDosen(' . "'" . $dsn->id_dsn . "'" . ')"><i class="fa-solid fa-trash"></i></a>';
            }
            $data[] = $row;
            $nomor++;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->dosen->count_all(),
            "recordsFiltered" => $this->dosen->count_filtered(),
            "data" => $data
        );

        echo json_encode($output);
    }


    public function addDosen()
    {


        $this->_validate_dosen();

        $input = $this->input->post();

        $this->dosen->save($input);


        echo json_encode(array('status' => TRUE));
    }

    public function getDosen($id)
    {
        $data = $this->dosen->get_id($id);

        echo json_encode($data);
    }

    public function deleteDosen($id)
    {

        if ($this->session->userdata('id_group') != 1) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Tidak Boleh Mengakses halaman ini!</div>');
            redirect('dosen');
        }

        $this->dosen->delete_dosen($id);

        echo json_encode(array('status' => TRUE));
    }

    public function updateDosen()
    {

        $data = $this->input->post();

        $this->dosen->updateDosen($data);

        echo json_encode(array('status' => TRUE));
    }


    // form validation dosen
    private function _validate()
    {

        $data = array();
        $data['error_string'] = array();
        $data['inputerror'] = array();
        $data['status'] = TRUE;

        if ($this->input->post('nidn') == '') {
            $data['inputerror'][] = 'nidn';
            $data['error_string'][] = 'NIDN wajib di isi!';
            $data['status'] = false;
        }
        if ($this->input->post('nama_dosen') == '') {
            $data['inputerror'][] = 'nama_dosen';
            $data['error_string'][] = 'Nama wajib di isi!';
            $data['status'] = false;
        }
        if ($this->input->post('jenis_kelamin') == '') {
            $data['inputerror'][] =  'jenis_kelamin';
            $data['error_string'][] = 'Jenis Kelamin wajib di isi!';
            $data['status'] = false;
        }
        if ($this->input->post('no_hp') == '') {
            $data['inputerror'][] = 'no_hp';
            $data['error_string'][] = 'field No Hp tidak boleh kosong';
            $data['status'] = false;
        }
        if ($this->input->post('email') == '') {
            $data['inputerror'][] = 'email';
            $data['error_string'][] = 'Email wajib di isi!';
            $data['status'] = false;
        }
        if ($this->input->post('alamat') == '') {
            $data['inputerror'][] = 'alamat';
            $data['error_string'][] = 'Alamat wajib di isi!';
            $data['status'] = false;
        }

        if ($data['status'] == false) {
            echo json_encode($data);
            exit();
        }
    }
}
