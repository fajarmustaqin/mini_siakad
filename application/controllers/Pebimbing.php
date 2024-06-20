<?php

class Pebimbing extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();

        $this->load->model('DosenModel', 'dosen');
        $this->load->model('PebimbingModel', 'pebimbing');

        if ($this->session->userdata('id_group') != 3) {
            redirect('dashboard');
        }
    }

    public function index()
    {

        $data['title'] = 'Data Pribadi';
        $id = $this->session->userdata('id');
        $post = $this->dosen->get_data($id);

        $dt = array(
            'nidn' => $post->nidn,
            'nama' => $post->nama,
            'jenis_kelamin' => $post->jenis_kelamin,
            'no_hp' => $post->no_hp,
            'email' => $post->email,
            'alamat' => $post->alamat
        );

        // membuat session id dosen
        $data_ses = array('id_dosen' => $post->id);
        $this->session->set_userdata($data_ses);

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar');
        $this->load->view('dosen/profileDosen', $dt);
        $this->load->view('templates/footer');
    }

    public function showMahasiswa()
    {
        $data['title'] = 'Data Mahasiswa';
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar');
        $this->load->view('dosen/mahasiswaBimbingan');
        $this->load->view('templates/footer');
    }

    public function ajaxMahasiswa()
    {

        $list =  $this->pebimbing->get_datatables();
        $data = array();
        $no = $_POST['start'];
        $nomor = 1;
        foreach ($list as $mhs) {
            $no++;
            $row = array();
            $row[] = $nomor;
            $row[] = $mhs->nim;
            $row[] = $mhs->nama;
            $row[] = $mhs->email;
            $row[] = $mhs->jenis_kelamin;
            $row[] = '<a class="btn btn-info btn-sm" href="javascript:void(0)" title="detail" onclick="cekDetail(' . "'" . $mhs->id . "'" . ')"><i class="fa-regular fa-eye"></i></a>';

            $data[] = $row;
            $nomor++;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->pebimbing->count_all(),
            "recordsFiltered" => $this->pebimbing->count_filtered(),
            "data" => $data
        );

        echo json_encode($output);
    }

    public function getMhs($id)
    {
        $data = $this->pebimbing->get_mhs_bimbingan($id);
        echo json_encode($data);
    }
}
