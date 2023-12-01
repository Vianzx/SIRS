<?php

use PSpell\Config;

defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        error_reporting(0);
        $this->load->library('form_validation');
    }

    public function index()
    {

        $this->form_validation->set_rules('username', 'username', 'required|trim');
        $this->form_validation->set_rules('password', 'Password', 'required|trim');
        
        if ($this->form_validation->run() == false) {
            $data['title'] = 'login Page';
            $this->load->view('templates/auth_header', $data);
            $this->load->view('auth/login');
            $this->load->view('templates/auth_footer');
        } else {
            // validasinya Success
            $this->_login();
        }
    }

    private function _login()
    {
        $username = $this->input->post('username');
        $password = $this->input->post('password');

        $user = $this->db->get_where('admin', ['username' => $username])->row_array();

        // jika usernya ada
        if ($user) {
                // cek password
                if (password_verify($password, $user['password'])) {
                    $data = [
                        'username' => $user['username'],
                        'role_id' => $user['role_id']
                    ];
                    $this->session->set_userdata($data);
                    if($user['role_id'] == 1) {
                        redirect('admin');

                    } else {
                        redirect('auth');
                    }
                } else {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                    Wrong password!</div>');
                    redirect('auth');
                }
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
            Account NULL!</div>');
            redirect('auth');
        }
    }

    public function loginS()
    {

        $this->form_validation->set_rules('username', 'NIS', 'required|trim');
        $this->form_validation->set_rules('password', 'Password', 'required|trim');
        
        if ($this->form_validation->run() == false) {
            $data['title'] = 'login Page';
            $this->load->view('templates/auth_header', $data);
            $this->load->view('auth/loginS');
            $this->load->view('templates/auth_footer');
        } else {
            // validasinya Success
            $this->_loginSiswa();
        }
    }

    private function _loginSiswa()
    {
        $username = $this->input->post('username');
        $password = $this->input->post('password');

        $user = $this->db->get_where('siswa', ['username' => $username])->row_array();

        // jika usernya ada
        if ($user) {
                // cek password
            if (password_verify($password, $user['password'])) {
                $data = [
                    'username' => $user['username'],
                    'role_id' => $user['role_id']
                ];
                $this->session->set_userdata($data);
                if($user['role_id'] == 3) {
                    redirect('siswa');
                } else {
                    redirect('auth/loginS');
                }
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                Wrong password!</div>');
                redirect('auth/loginS');
            }
        
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
            Account NULL!</div>');
            redirect('auth/loginS');
        }
    }
    
    public function loginG()
    {

        $this->form_validation->set_rules('username', 'Username', 'required|trim');
        $this->form_validation->set_rules('password', 'Password', 'required|trim');
        
        if ($this->form_validation->run() == false) {
            $data['title'] = 'login Page';
            $this->load->view('templates/auth_header', $data);
            $this->load->view('auth/loginG');
            $this->load->view('templates/auth_footer');
        } else {
            // validasinya Success
            $this->_loginGuru();
        }
    }

    private function _loginGuru()
    {
        $username = $this->input->post('username');
        $password = $this->input->post('password');

        $user = $this->db->get_where('guru', ['username' => $username])->row_array();

        // jika usernya ada
        if ($user) {
                // cek password
            if (password_verify($password, $user['password'])) {
                $data = [
                    'username' => $user['username'],
                    'role_id' => $user['role_id']
                ];
                $this->session->set_userdata($data);
                if($user['role_id'] == 2) {
                    redirect('guru');
                } else {
                    redirect('auth/loginG');
                }
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                Wrong password!</div>');
                redirect('auth/loginG');
            }
        
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
            Account NULL!</div>');
            redirect('auth/loginG');
        }
    }

    // public function registration()
    // {

    //     $this->form_validation->set_rules('username', 'Username', 'required|trim');
    //     $this->form_validation->set_rules('password1', 'Password', 'required|trim|min_length[3]|matches[password2]', [
    //         'matches' => 'Password dont match!',
    //         'min_length' => 'Password too short!'
    //     ]);
    //     $this->form_validation->set_rules('password2', 'Password', 'required|trim|matches[password1]');

    //     if ($this->form_validation->run() == false) {
    //         $data['title'] = "SEM User Registration";
    //         $this->load->view('templates/auth_header', $data);
    //         $this->load->view('auth/registration');
    //         $this->load->view('templates/auth_footer');
    //     } else {
    //         $data = [
    //             'name' => htmlspecialchars($this->input->post('name', true)),
    //             'username' => htmlspecialchars($this->input->post('username', true)),
    //             'image' => 'default.jpg',
    //             'password' => password_hash($this->input->post('password1'), PASSWORD_DEFAULT),
    //             'role_id' => 1,
    //             // 'is_active' => 1,
    //             // 'date_created' => time()
    //         ];

    //         $this->db->insert('admin', $data);

    //         // $this->_sendEmail();

    //         $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
    //         Congratulation! your account has been created. please login</div>');
    //         redirect('auth');
    //     }
    // }

    // private function _sendEmail()
    // {
    //     $config = [
    //         'protocol' => 'smtp',
    //         'smtp_host' => 'ssl://smtp.googlemail.com',
    //         'smtp_user' => 'semestaengine21@gmail.com',
    //         'smtp_pass' => 'softengine21',
    //         'smtp_port' => 465,
    //         'mailtype' => 'html',
    //         'charset' => 'utf-8',
    //         'newline' => "\r\n"
    //     ];

    //     $this->load->library('email', $config);

    //     $this->email->initialize($config);
    //     $this->email->from('semestaengine21@gmail.com', 'Semesta');
    //     $this->email->to('mbeeeeerrrrr16@gmail.com');
    //     $this->email->subject('Testing');
    //     $this->email->message('hello World!');

    //     if($this->email->send()) {
    //         return true;
    //     } else {
    //         echo $this->email->print_debugger();
    //         die;
    //     }
    // }

    public function logout()
    {
        $this->session->unset_userdata('username');
        $this->session->unset_userdata('role_id');

        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
        You have been logout</div>');
        redirect('/');
    }

    public function blocked()
    {
        $this->load->view('auth/blocked');
    }
}
