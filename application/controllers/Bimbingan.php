<?php

class Bimbingan extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();

        checkNotLogin();

        if ($this->session->userdata('id_group') != 4) {
            redirect('dashboard');
        }

        $this->load->model('MhsModel', 'mahasiswa');
        $this->load->model('BimbinganModel', 'bimbingan');
    }

    public function index()
    {
        $data['title'] = "Data Pribadi";

        $id = $this->session->userdata('id');
        $input = $this->mahasiswa->get_data($id);

        $mahasiswa = array(
            'nim' => $input->nim,
            'nama' => $input->nama,
            'email' => $input->email,
            'jenis_kelamin' => $input->jenis_kelamin,
            'alamat' => $input->alamat,
            'no_hp' => $input->no_hp,
            'nama_ayah' => $input->nama_ayah,
            'no_hp_ayah' => $input->no_hp_ayah,
            'nama_ibu' => $input->nama_ibu,
            'no_hp_ibu' => $input->no_hp_ibu,
            'alamat_ortu' => $input->alamat_ortu
        );

        $ses = array(
            'id_mahasiswa' => $input->id,
            'dosen_id' => $input->id_dosen
        );
        $this->session->set_userdata($ses);

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar');
        $this->load->view('mahasiswa/dataPribadi', $mahasiswa);
        $this->load->view('templates/footer');
    }

    public function dosenPebimbing()
    {
        $data['title'] = 'Dosen Pebimbing';
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar');
        $this->load->view('mahasiswa/pebimbing');
        $this->load->view('templates/footer');
    }

    public function showDosen()
    {

        $list = $this->bimbingan->get_datatables();
        $data = array();
        $no = $_POST['start'];
        $nomor = 1;
        foreach ($list as $bimbing) {
            $no++;
            $row = array();
            $row[] = $nomor;
            $row[] = $bimbing->nidn;
            $row[] = $bimbing->nama;
            $row[] = $bimbing->jenis_kelamin;
            $row[] = $bimbing->no_hp;
            $row[] = $bimbing->email;
            $row[] = $bimbing->alamat;

            $row[] = '<a class="btn btn-success btn-rounded btn-sm" href="javascript:void(0)" title="edit data" onclick="updateDosen(' . "'" . $bimbing->id . "'" . ')"><i class="fa-solid fa-pencil"></i></a>';
            $data[] = $row;
            $nomor++;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->bimbingan->count_all(),
            "recordsFiltered" => $this->bimbingan->count_filtered(),
            "data" => $data
        );

        echo json_encode($output);
    }
}
