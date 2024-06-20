<?php

class Mahasiswa extends CI_Controller
{


    public function __construct()
    {
        parent::__construct();

        checkNotLogin();
        
        if ($this->session->userdata('id_group') != 1 && $this->session->userdata('id_group') != 2) {
            redirect(base_url('dashboard'));
        }

        $this->load->model('MhsModel', 'mahasiswa');
        $this->load->model('DosenModel', 'dosen');
    }

    public function index()
    {

        $input = $this->dosen->get_dosen();
        $data['dosen'] = $input;
        $data['title'] = 'Data Mahasiswa';
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar');
        $this->load->view('admin/viewMahasiswa');
        $this->load->view('templates/footer');
    }

    public function showMhs()
    {

        $list =  $this->mahasiswa->get_data_mahasiswa();
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
            if ($mhs->id_dosen == null) {
                $row[] = '<a class="btn btn-danger btn-sm" href="javascript:void(0)" title="hapus" onclick="modal_dospem(' . "'" . $mhs->id . "'" . ')"><i class="fa-sharp fa-solid fa-plus"></i></a>';
            } else {
                $row[] = $mhs->nama_dsn;
            }
            $row[] = '<a class="btn btn-info btn-sm" href="javascript:void(0)" title="detail" onclick="detail(' . "'" . $mhs->id . "'" . ')"><i class="fa-regular fa-eye"></i></a>';
            $row[] = '<a class="btn btn-success btn-rounded btn-sm" href="javascript:void(0)" title="edit data" onclick="updateMahasiswa(' . "'" . $mhs->id . "'" . ')"><i class="fa-solid fa-pencil"></i></a>';

            if ($this->session->userdata('id_group') == 1) {
                $row[] = '<a class="btn btn-danger btn-sm" href="javascript:void(0)" title="hapus" onclick="deleteMahasiswa(' . "'" . $mhs->id . "'" . ')"><i class="fa-solid fa-trash"></i></a>';
            }

            $data[] = $row;
            $nomor++;
        }
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->mahasiswa->count_all(),
            "recordsFiltered" => $this->mahasiswa->count_filtered(),
            "data" => $data
        );

        echo json_encode($output);
    }

    public function addMhs()
    {

        
        $this->_validate();

        $input = $this->input->post();
        $this->mahasiswa->save($input);


        echo json_encode(array('status' => TRUE));
    }

    public function getMhs($id)
    {
        $data = $this->mahasiswa->get_by_id($id);
        echo json_encode($data);
    }

    public function addDospem()
    {
        $data = $this->input->post();
        $this->mahasiswa->save_dospem($data);

        echo json_encode(array('status' => TRUE));
    }

    public function updateMhs()
    {

        $this->_validate();

        $data = $this->input->post();

        $this->mahasiswa->updateMahasiswa($data);

        echo json_encode(array('status' => TRUE));
    }

    public function deleteMhs($id)
    {

        if ($this->session->userdata('id_group') != 1) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Tidak Boleh akses halaman ini!</div>');
            redirect('mahasiswa');
        }

        $this->mahasiswa->delete_by_id($id);

        echo json_encode(array("status" => TRUE));
    }

    public function laporanPdf()
    {

        $this->load->library('pdf');

        $this->pdf->setPaper('A4', 'potrait');
        $this->pdf->filename = "Laporan mahasiswa.pdf";
        $this->pdf->load_view('laporan', $data);
    }

    private function _validate()
    {

        $data = array();
        $data['error_string'] = array();
        $data['inputerror'] = array();
        $data['status'] = TRUE;

        //validasi mahasiswa
        if ($this->input->post('nim')  == '') {
            $data['inputerror'][] = 'nim';
            $data['error_string'][] = 'NIM wajib di isi!';
            $data['status'] = false;
        }

        if ($this->input->post('nama') == '') {
            $data['inputerror'][] = 'nama';
            $data['error_string'][] = 'Nama wajib di isi!';
            $data['status'] = false;
        }

        if ($this->input->post('email') == '') {
            $data['inputerror'][] = 'email';
            $data['error_string'][] = 'Email wajib di isi!';
            $data['status'] = false;
        }

        if ($this->input->post('jenis_kelamin') == '') {
            $data['inputerror'][] =  'jenis_kelamin';
            $data['error_string'][] = 'Jenis Kelamin wajib di pilih';
            $data['status'] = false;
        }

        if ($this->input->post('alamat') == '') {
            $data['inputerror'][] = 'alamat';
            $data['error_string'][] = 'Alamat wajib di isi!';
            $data['status'] = false;
        }

        if ($this->input->post('no_hp') == '') {
            $data['inputerror'][] = 'no_hp';
            $data['error_string'][] = 'No Hp wajib di isi!';
            $data['status'] = false;
        }

        //validasi orang tua

        if ($this->input->post('nama_ayah') == '') {
            $data['inputerror'][] = 'nama_ayah';
            $data['error_string'][] = 'nama ayah wajib di isi';
            $data['status'] = false;
        }

        if ($this->input->post('nama_ibu') == '') {
            $data['inputerror'][] = 'nama_ibu';
            $data['error_string'][] = 'Nama Ibu wajib di isi!';
            $data['status'] = false;
        }

        if ($data['status'] == false) {
            echo json_encode($data);
            exit();
        }
    }
}
