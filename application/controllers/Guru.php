<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Guru extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        error_reporting(0);
        is_logged_in();
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
}