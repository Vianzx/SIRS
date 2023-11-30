<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Siswa extends CI_Controller
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
        $data['user'] = $this->db->get_where('siswa', ['username' => $this->session->userdata('username')])->row_array();

        $this->load->view('siswa/templates/user_header', $data);
        $this->load->view('siswa/templates/sidebar', $data);
        $this->load->view('siswa/templates/topbar', $data);
        $this->load->view('siswa/index', $data);
        $this->load->view('siswa/templates/user_footer');
    }

    public function pengajuan()
    {
        $data['title'] = "Ajukan Remedial";
        $data['user'] = $this->db->get_where('siswa', ['username' => $this->session->userdata('username')])->row_array();
        $kelas = $data['user']['kelas_id'];

        $data['pengajuan'] = $this->M_user->getPengajuan();

        $query = "SELECT pengajaran.id as id_pengajaran, mapel.* from pengajaran join mapel on pengajaran.mapel_id = mapel.id where kelas_id LIKE '$kelas'";

        $data['mapel'] = $this->db->query($query)->result_array();
        $data['murid'] = $this->db->get('siswa')->result_array();

        $this->form_validation->set_rules('np', 'Nilai Pengetahuan', 'required');
        $this->form_validation->set_rules('nk', 'Nilai Keterampilan', 'required');

         if($this->form_validation->run() == false) {
            $this->load->view('siswa/templates/user_header', $data);
            $this->load->view('siswa/templates/sidebar', $data);
            $this->load->view('siswa/templates/topbar', $data);
            $this->load->view('siswa/pengajuan', $data);
            $this->load->view('siswa/templates/user_footer');
        } else {
            $input = $this->input->post();

            $this->db->insert('pengajuan', $input);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Pengajuan added!</div>');
            redirect('siswa/pengajuan');
        }
    }

    public function Jadwal(){
        $data['title'] = "Jadwal Remedial";
        $data['user'] = $this->db->get_where('siswa', ['username' => $this->session->userdata('username')])->row_array();

        $username = $data['user']['username'];
        $data['jadwal'] = $this->db->query("SELECT jadwal_remedial.*, mapel.* FROM jadwal_remedial JOIN mapel ON jadwal_remedial.mapel_id = mapel.id WHERE cansee_nim LIKE '%$username%'")->result_array();

        // $data['jadwal'] = "SELECT jadwal_remedial.* FROM jadwal_remedial WHERE cansee_nim LIKE '%$data[user][username]%'";   


        $this->form_validation->set_rules('np', 'Nilai Pengetahuan', 'required');
        $this->form_validation->set_rules('nk', 'Nilai Keterampilan', 'required');

        if($this->form_validation->run() == false) {
            $this->load->view('siswa/templates/user_header', $data);
            $this->load->view('siswa/templates/sidebar', $data);
            $this->load->view('siswa/templates/topbar', $data);
            $this->load->view('siswa/jadwal', $data);
            $this->load->view('siswa/templates/user_footer');
        } else {
            $input = $this->input->post();

            $this->db->insert('pengajuan', $input);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Pengajuan added!</div>');
            redirect('siswa/pengajuan');
        }
    }

    // public function profile()
    // {
    //     $data['title'] = 'My Profile';
    //     $data['user'] = $this->db->select("u.*, k.nama_kelas, j.nama_panjang")->from('user as u')->join('tb_kelas as k', 'u.id_kelas = k.id')->join('tb_jurusan as j', 'u.id_jurusan = j.id')->where('u.username',  $this->session->userdata('username'))->get()->row_array();

    //     $this->load->view('siswa/templates/user_header', $data);
    //     $this->load->view('siswa/templates/sidebar', $data);
    //     $this->load->view('siswa/templates/topbar', $data);
    //     $this->load->view('siswa/myProfile', $data);
    //     $this->load->view('siswa/templates/user_footer');
    // }


    // public function perusahaanRekom()
    // {
    //     $data['title'] = 'Perusahaan Rekomendasi';
    //     $data['user'] = $this->db->select("u.*, k.nama_kelas, j.nama_panjang")->from('user as u')->join('tb_kelas as k', 'u.id_kelas = k.id')->join('tb_jurusan as j', 'u.id_jurusan = j.id')->where('u.username',  $this->session->userdata('username'))->get()->row_array();

    //     $data['rekomendasi'] = $this->M_perusahaan->getPerusahaan();
    //     $data['pengajuan'] = $this->M_perusahaan->getPengajuan();

    //     $this->form_validation->set_rules('user_id', 'ID User', 'required');

    //     if($this->form_validation->run() == false) {
    //         $this->load->view('siswa/templates/user_header', $data);
    //         $this->load->view('siswa/templates/sidebar', $data);
    //         $this->load->view('siswa/templates/topbar', $data);
    //         $this->load->view('siswa/rekom_perusahaan', $data);
    //         $this->load->view('siswa/templates/user_footer');
    //     } else {
    //         $input = $this->input->post();

    //         $this->db->insert('tb_pengajuan', $input);
    //         $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data form sudah terkirim dan akan segera divalidasi!</div>');
    //         redirect('siswa/perusahaanRekom');
    //     }
    // }
}