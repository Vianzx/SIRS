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

        $data['pengajuan'] = $this->db->get('pengajuan')->result_array();
        $data['mapel'] = $this->db->get('mapel')->result_array();
        $data['remedial'] = $this->db->get('remedial')->result_array();

        $this->form_validation->set_rules('nama_mapel', 'Mapel', 'required');
        $this->form_validation->set_rules('pekerjaan', 'Pekerjaan Yang Dilakukan', 'required');
        $this->form_validation->set_rules('kompetensi', 'Kompetensi Yang Didapat', 'required');

         if($this->form_validation->run() == false) {
            $this->load->view('siswa/templates/user_header', $data);
            $this->load->view('siswa/templates/sidebar', $data);
            $this->load->view('siswa/templates/topbar', $data);
            $this->load->view('siswa/jurnal', $data);
            $this->load->view('siswa/templates/user_footer');
        } else {
            $input = $this->input->post();

            $this->db->insert('', $input);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">New data added!</div>');
            redirect('siswa/jurnal');
        }
    }

    public function deletePengajuan($id)
    {
        $this->db->delete('tb_jurnal', ['id' => $id]);
        $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Data Kegiatan has been Deleted!</div>');
        redirect('siswa/jurnal');
    }

    public function editPengajuan($id)
    {
        $input = $this->input->post();

        $this->db->where('id', $id);
        $this->db->update('tb_jurnal', $input);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data Kegiatan has been Changed!</div>');
        redirect('siswa/jurnal');
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