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