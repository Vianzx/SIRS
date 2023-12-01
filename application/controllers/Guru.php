<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Guru extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        error_reporting(0);
        is_logged_in();
        $this->load->model('M_user');
    }

    public function index()
    {
        $data['title'] = 'Dashboard';
        $data['user'] = $this->db->get_where('guru', ['username' => $this->session->userdata('username')])->row_array();

        $this->load->view('guru/templates/user_header', $data);
        $this->load->view('guru/templates/sidebar', $data);
        $this->load->view('guru/templates/topbar', $data);
        $this->load->view('guru/index', $data);
        $this->load->view('guru/templates/user_footer');
    }

    public function permintaan()
    {
        $data['title'] = "Permintaan Remedial";
        $data['user'] = $this->db->get_where('guru', ['username' => $this->session->userdata('username')])->row_array(); 

        $data['permintaan'] = $this->M_user->getPermintaan($data['user']);

        $query = "SELECT siswa.*, laporan.*, kelas.* FROM laporan 
        JOIN siswa ON laporan.siswa_id = siswa.id
        join kelas on siswa.kelas_id = kelas.id
        ";

        $data['laporan'] = $this->db->query($query)->result_array();

            $this->load->view('guru/templates/user_header', $data);
            $this->load->view('guru/templates/sidebar', $data);
            $this->load->view('guru/templates/topbar', $data);
            $this->load->view('guru/permintaan', $data);
            $this->load->view('guru/templates/user_footer');
    }

    public function jadwal(){
        $data['title'] = "Jadwal Remedial";
        $data['user'] = $this->db->get_where('guru', ['username' => $this->session->userdata('username')])->row_array(); 

        $guru_id = $data['user']['id'];
        $data['jadwal'] = $this->db->query("SELECT jadwal_remedial.*, mapel.* FROM jadwal_remedial JOIN mapel ON jadwal_remedial.mapel_id = mapel.id WHERE guru_id LIKE '%$guru_id%' and status = 'scheduled'")->result_array();

        // $data['jadwal'] = "SELECT jadwal_remedial.* FROM jadwal_remedial WHERE cansee_nim LIKE '%$data[user][username]%'";   

        $this->form_validation->set_rules('tanggal_remedial', 'Tanggal Remdial', 'required');
        $this->form_validation->set_rules('keterangan', 'Keterangan', 'required');

        if($this->form_validation->run() == false) {
            $this->load->view('guru/templates/user_header', $data);
            $this->load->view('guru/templates/sidebar', $data);
            $this->load->view('guru/templates/topbar', $data);
            $this->load->view('guru/jadwal', $data);
            $this->load->view('guru/templates/user_footer');
        } else {
            $input = $this->input->post();

            $this->db->insert('jadwal_remedial', $input);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Jadwal Added!</div>');
            redirect('guru/jadwal');
        }
    }

    public function accept($id)
    {
        $this->db->update('pengajuan', ['status' => "accept" ] ,[ 'id' => $id ]);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Permintaan di Accept!</div>'); 
        redirect('guru/permintaan');
    }

    public function decline($id)
    {
        $this->db->update('pengajuan', ['status' => "decline" ] ,[ 'id' => $id ]);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Permintaan di Decline!</div>'); 
        redirect('guru/permintaan');
    }

    public function proses()
    {         
        $input = $this->input->post();
        var_dump($input);

        $this->db->insert('laporan', $input);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Nilai has been Update</div>');
        redirect('guru/permintaan');
        
    }
}