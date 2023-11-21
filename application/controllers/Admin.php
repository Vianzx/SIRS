<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
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
        $data['user'] = $this->db->get_where('admin', ['username' => $this->session->userdata('username')])->row_array();

        $this->load->view('admin/templates/user_header', $data);
        $this->load->view('admin/templates/sidebar', $data);
        $this->load->view('admin/templates/topbar', $data);
        $this->load->view('admin/dashboard', $data);
        $this->load->view('admin/templates/user_footer');
    }

    public function kelas()
    {
        $data['title'] = 'Kelas';
        $data['user'] = $this->db->get_where('admin', ['username' => $this->session->userdata('username')])->row_array();

        $data['kelas'] = $this->db->get('kelas')->result_array();

        $this->form_validation->set_rules('nama_kelas', 'Nama Kelas', 'required|trim');

        if ($this->form_validation->run() == false) {
            $this->load->view('admin/templates/user_header', $data);
            $this->load->view('admin/templates/sidebar', $data);
            $this->load->view('admin/templates/topbar', $data);
            $this->load->view('admin/kelas', $data);
            $this->load->view('admin/templates/user_footer');
        } else {
            $this->db->insert('kelas', ['nama_kelas' => $this->input->post('nama_kelas')]);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            New Kelas added!</div>');
            redirect('admin/kelas');
        }
    }

    public function editKelas($id)
    {
        $this->db->update('kelas', ['nama_kelas' => $this->input->post('nama_kelas') ] ,[ 'id' => $id ]);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Kelas has been Changed!</div>'); 
        redirect('admin/kelas');
    }

    public function deleteKelas($id)
    {
        $this->db->delete('kelas', ['id' => $id]);
        $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Kelas has been Deleted!</div>');
        redirect('admin/kelas');
    }

    public function mapel()
    {
        $data['title'] = 'Mata Pelajaran';
        $data['user'] = $this->db->get_where('admin', ['username' => $this->session->userdata('username')])->row_array();

        $data['mapel'] = $this->db->get('mapel')->result_array();

        $this->form_validation->set_rules('nama_mapel', 'Nama Mapel', 'required|trim');

        if ($this->form_validation->run() == false) {
            $this->load->view('admin/templates/user_header', $data);
            $this->load->view('admin/templates/sidebar', $data);
            $this->load->view('admin/templates/topbar', $data);
            $this->load->view('admin/mapel', $data);
            $this->load->view('admin/templates/user_footer');
        } else {
            $this->db->insert('mapel', ['nama_mapel' => $this->input->post('nama_mapel')]);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            New Kelas added!</div>');
            redirect('admin/mapel');
        }
    }

    public function editMapel($id)
    {
        $this->db->update('mapel', ['nama_mapel' => $this->input->post('nama_mapel') ] ,[ 'id' => $id ]);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Mapel has been Changed!</div>'); 
        redirect('admin/mapel');
    }

    public function deleteMapel($id)
    {
        $this->db->delete('mapel', ['id' => $id]);
        $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Mapel has been Deleted!</div>');
        redirect('admin/mapel');
    }

    public function daftarSiswa()
    {
        $data['title'] = 'Siswa';
        $data['user'] = $this->db->get_where('admin', ['username' => $this->session->userdata('username')])->row_array();

        $data['siswa'] = $this->M_user->getSiswa();
        $data['kelas'] = $this->db->get('kelas')->result_array();

        $this->form_validation->set_rules('username', 'NIS', 'required|trim');
        $this->form_validation->set_rules('name', 'Nama', 'required');
        $this->form_validation->set_rules('kelas_id', 'Kelas', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');

    if ($this->form_validation->run() == false) {
        $this->load->view('admin/templates/user_header', $data);
        $this->load->view('admin/templates/sidebar', $data);
        $this->load->view('admin/templates/topbar', $data);
        $this->load->view('admin/siswa/index', $data);
        $this->load->view('admin/templates/user_footer');
    } else {
        $config['upload_path'] = './assets/img/profile/'; 
        $config['allowed_types'] = 'gif|jpg|png|jpeg|PNG'; 
        $now = date('Y-m-d-H-i-s'); 
        $config['file_name'] = $now.'.png'; 
        $config['max_size'] = 0; 
        // $config['max_width'] = 1024;
        // $config['max_height'] = 768; 
        $this->load->library('upload', $config); 
        $this->upload->initialize($config); 
        if ( ! $this->upload->do_upload('userfile')) { 
        $error = array('error' => $this->upload->display_errors()); 
        print_r($error); 
        } else { 
        $data = array('upload_data' => $this->upload->data()); 
        } 
        $pet = $config['upload_path'].$config['file_name'];
        $data = [
            'username' => $this->input->post('username'),
            'name' => $this->input->post('name'),
            'kelas_id' => $this->input->post('kelas_id'),
            'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
            'image' => $pet,
            'role_id' => 3,
        ];
        $this->db->insert('siswa', $data);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">New data Siswa added!</div>');
        redirect('admin/daftarSiswa');
        }
    }

    public function editSiswa($id)

    {
            //kondisi upload file 
            if ($_FILES["userfile"]["name"] !== '') { 
                $config['upload_path'] = './assets/img/profile/'; 
                $config['allowed_types'] = 'gif|jpg|png|jpeg|PNG';
                $now = date('Y-m-d-H-i-s'); 
                $config['file_name'] = 
                $now.'.jpg'; 
                $config['max_size'] = 0; 
                // $config['max_width'] = 1024; 
                // $config['max_height'] = 768; 
                $this->load->library('upload', $config); 
                $this->upload->initialize($config); 

                if ( ! $this->upload->do_upload('userfile')) { 
                $error = array('error' => $this->upload->display_errors());
                print_r($error); 
                } else{ 
                $data = array('upload_data' => $this->upload->data()); 
                } 
                
                $pet = $config['upload_path'].$config['file_name'];
                $data = [
                    "name" => $this->input->post('name'),
                    "kelas_id" => $this->input->post('kelas_id'),
                    'image' => $pet
                ]; 
    
                $this->db->where('id', $id);
                $this->db->update('siswa', $data);
                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data Siswa has been Changed!</div>'); 
            redirect('admin/daftarSiswa');
            }else {
                $data = [
                    "name" => $this->input->post('name'),
                    "kelas_id" => $this->input->post('kelas_id'),
                    'image' => $this->input->post('before_path')
                ]; 
    
                $this->db->where('id', $id);
                $this->db->update('siswa', $data);
                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data Siswa has been Changed!</div>'); 
            redirect('admin/daftarSiswa');
            }
        } 

    public function deleteSiswa($id)
    {
        $this->db->delete('siswa', ['id' => $id]);
        $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Data Siswa has been Deleted!</div>');
        redirect('admin/daftarSiswa');
    }

    public function daftarGuru()
    {
        $data['title'] = 'Guru';
        $data['user'] = $this->db->get_where('admin', ['username' => $this->session->userdata('username')])->row_array();

        $data['guru'] = $this->M_user->getGuru();
        $data['mapel'] = $this->db->get('mapel')->result_array();

        $this->form_validation->set_rules('username', 'Username', 'required|trim');
        $this->form_validation->set_rules('name', 'Nama', 'required');
        $this->form_validation->set_rules('mapel_id', 'Mapel', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');

    if ($this->form_validation->run() == false) {
        $this->load->view('admin/templates/user_header', $data);
        $this->load->view('admin/templates/sidebar', $data);
        $this->load->view('admin/templates/topbar', $data);
        $this->load->view('admin/guru/index', $data);
        $this->load->view('admin/templates/user_footer');
    } else {
        $config['upload_path'] = './assets/img/profile/'; 
        $config['allowed_types'] = 'gif|jpg|png|jpeg|PNG'; 
        $now = date('Y-m-d-H-i-s'); 
        $config['file_name'] = $now.'.png'; 
        $config['max_size'] = 0; 
        // $config['max_width'] = 1024;
        // $config['max_height'] = 768; 
        $this->load->library('upload', $config); 
        $this->upload->initialize($config); 
        if ( ! $this->upload->do_upload('userfile')) { 
        $error = array('error' => $this->upload->display_errors()); 
        print_r($error); 
        } else { 
        $data = array('upload_data' => $this->upload->data()); 
        } 
        $pet = $config['upload_path'].$config['file_name'];
        $data = [
            'username' => $this->input->post('username'),
            'name' => $this->input->post('name'),
            'mapel_id' => $this->input->post('mapel_id'),
            'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
            'image' => $pet,
            'role_id' => 2,
        ];
        $this->db->insert('guru', $data);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">New data Guru added!</div>');
        redirect('admin/daftarGuru');
        }
    }

    public function editGuru($id)

    {
            //kondisi upload file 
            if ($_FILES["userfile"]["name"] !== '') { 
                $config['upload_path'] = './assets/img/profile/'; 
                $config['allowed_types'] = 'gif|jpg|png|jpeg|PNG';
                $now = date('Y-m-d-H-i-s'); 
                $config['file_name'] = 
                $now.'.jpg'; 
                $config['max_size'] = 0; 
                // $config['max_width'] = 1024; 
                // $config['max_height'] = 768; 
                $this->load->library('upload', $config); 
                $this->upload->initialize($config); 

                if ( ! $this->upload->do_upload('userfile')) { 
                $error = array('error' => $this->upload->display_errors());
                print_r($error); 
                } else{ 
                $data = array('upload_data' => $this->upload->data()); 
                } 
                
                $pet = $config['upload_path'].$config['file_name'];
                $data = [
                    "name" => $this->input->post('name'),
                    "mapel_id" => $this->input->post('mapel_id'),
                    'image' => $pet
                ]; 
    
                $this->db->where('id', $id);
                $this->db->update('guru', $data);
                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data Guru has been Changed!</div>'); 
            redirect('admin/daftarGuru');
            }else {
                $data = [
                    "name" => $this->input->post('name'),
                    "mapel_id" => $this->input->post('mapel_id'),
                    'image' => $this->input->post('before_path')
                ]; 
    
                $this->db->where('id', $id);
                $this->db->update('guru', $data);
                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data Siswa has been Changed!</div>'); 
            redirect('admin/daftarGuru');
            }
        } 

    public function deleteGuru($id)
    {
        $this->db->delete('guru', ['id' => $id]);
        $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Data Guru has been Deleted!</div>');
        redirect('admin/daftarGuru');
    }

    // public function perusahaanRekom()
    // {
    //     $data['title'] = 'Perusahaan Rekomendasi';
    //     $data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();

    //     $data['rekomendasi'] = $this->M_perusahaan->getPerusahaan();
    //     $data['kategori'] = $this->db->get('tb_kategori')->result_array();

    //     $this->form_validation->set_rules('nama_perusahaan', 'Nama Perusahaan', 'required|trim');
    //     $this->form_validation->set_rules('id_kategori', 'id_kategori', 'required');
    //     $this->form_validation->set_rules('visi', 'Visi', 'required');
    //     $this->form_validation->set_rules('alamat', 'Alamat', 'required');
    //     $this->form_validation->set_rules('image', 'Foto Perusahaan', 'required');

    //     if($this->form_validation->run() == false) {
    //         $this->load->view('admin/templates/user_header', $data);
    //         $this->load->view('admin/templates/sidebar', $data);
    //         $this->load->view('admin/templates/topbar', $data);
    //         $this->load->view('admin/perusahaan_rekom/index', $data);
    //         $this->load->view('admin/templates/user_footer');
    //     } else {
    //         $input = $this->input->post();
    //         $config['upload_path']          = './assets/img/perusahaan/';
    //         $config['allowed_types']        = 'jpg|png|jpeg';
    //         $config['encrypt_name'] = TRUE;

    //         $this->load->library('upload', $config);

    //         $image = "";
    //         if (!$this->upload->do_upload('foto_perusahaan')) {
    //             $error = array('error' => $this->upload->display_errors());
    //             // echo json_encode($error);
    //         } else {
    //             $upload_data = $this->upload->data();
    //             // echo json_encode($upload_data['file_name']);
    //             $image = $config['upload_path'] . $upload_data['file_name'];
    //         }
            
    //         // die;
    //         // $config['upload_path'] = './assets/img/perusahaan/'; 
    //         // $config['allowed_types'] = 'gif|jpg|png|jpeg|PNG'; 
    //         // $now = date('Y-m-d H:i:s'); 
    //         // $config['file_name'] = $now.'.jpg'; 
           
    //         // $this->load->library('upload', $config); 

    //         // if ( ! $this->upload->do_upload('userfile')) { 
    //         // $error = array('error' => $this->upload->display_errors()); 
    //         // echo json_encode($error);die; 
    //         // } else { 
    //         // $data = array('upload_data' => $this->upload->data()); 
    //         // } 
    //         // $path = $config['upload_path'].$config['file_name'];
    //         // $data = [
    //         //     "nama_perusahaan" => $this->input->post('nama_perusahaan'),
    //         //     "jenis_perusahaan" => $this->input->post('jenis_perusahaan'),
    //         //     "visi" => $this->input->post('visi'),
    //         //     "alamat" => $this->input->post('alamat'),
    //         //     "image" => $path
    //         // ];

    //         $this->db->insert('tb_rekomendasi', array_merge($input, ["image" => $image]));
    //         $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">New data Perusahaan added!</div>');
    //         redirect('admin/perusahaanRekom');
    //     }
    // }

    // public function editPerusahaanRekom($id)
    // {
    //     $input = $this->input->post();
    //     if ($_FILES["poto_perusahaan"]["name "] !== '') {
    //         $config['upload_path']          = './assets/img/perusahaan/';
    //         $config['allowed_types']        = 'jpg|png|jpeg';
    //         $config['encrypt_name'] = TRUE;

    //         $this->load->library('upload', $config);

    //         $image = "";
    //         if (!$this->upload->do_upload('poto_perusahaan')) {
    //             $error = array('error' => $this->upload->display_errors());
    //             // echo json_encode($error);
    //         } else {
    //             $upload_data = $this->upload->data();
    //             // echo json_encode($upload_data['file_name']);
    //             $image = $config['upload_path'] . $upload_data['file_name'];
    //         }
    //         unset($input['before_path']);
    //         $this->db->where('id', $id)->update('tb_rekomendasi', array_merge($input, ["image" => $image]));
    //         $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">New data Perusahaan added!</div>');
    //         redirect('admin/perusahaanRekom');
    //     } else {
    //         $input = $this->input->post();
    //         unset($input['before_path']);
    //         $this->db->where('id', $id);
    //         $this->db->update('tb_rekomendasi', array_merge($input, ["image" => $image]));
    //         $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data Perusahaan has been Changed!</div>'); 
    //         redirect('admin/perusahaanRekom');
    //     }
    // }

    // public function deletePerusahaanRekom($id)
    // {
    //     $this->db->delete('tb_rekomendasi', ['id' => $id]);
    //     $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Data Perusahaan has been Deleted!</div>');
    //     redirect('admin/perusahaanRekom');
    // }

    // public function kategori()
    // {
    //     $data['title'] = 'Kategori';
    //     $data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();

    //     $data['kategori'] = $this->db->get('tb_kategori')->result_array();

    //     $this->form_validation->set_rules('kategori', 'Nama Perusahaan', 'required|trim');

    //     if ($this->form_validation->run() == false) {
    //         $this->load->view('admin/templates/user_header', $data);
    //         $this->load->view('admin/templates/sidebar', $data);
    //         $this->load->view('admin/templates/topbar', $data);
    //         $this->load->view('admin/perusahaan_rekom/kategori', $data);
    //         $this->load->view('admin/templates/user_footer');
    //     } else {
    //         $this->db->insert('tb_kategori', ['kategori' => $this->input->post('kategori')]);
    //         $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
    //         New Kelas added!</div>');
    //         redirect('admin/kategori');
    //     }
    // }

    // public function editKategori($id)
    // {
    //     $this->db->update('tb_kategori', ['kategori' => $this->input->post('kategori') ] ,[ 'id' => $id ]);
    //     $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Kelas has been Changed!</div>'); 
    //     redirect('admin/kategori');
    // }

    // public function deleteKategori($id)
    // {
    //     $this->db->delete('tb_kategori', ['id' => $id]);
    //     $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Kelas has been Deleted!</div>');
    //     redirect('admin/kategori');
    // }

    // public function pengajuan()
    // {
    //     $data['title'] = "Pengajuan Tempat PKL";
    //     // $data['perusahaan'] = $this->db->select("p.*, k.kategori")->from('tb_tempat_rekomendasi as tr')->join('tb_kategori as k', 'tr.id_kategori = k.id')->where('s.nis',  $this->session->userdata('nis'))->get()->row_array();

    //     $data['pengajuan'] = $this->M_pengajuan->getPengajuan();

    //     $this->load->view('admin/templates/user_header', $data);
    //     $this->load->view('admin/templates/sidebar', $data);
    //     $this->load->view('admin/templates/topbar', $data);
    //     $this->load->view('admin/pengajuan', $data);
    //     $this->load->view('admin/templates/user_footer');
    // }

    // public function role()
    // {
    //     $data['title'] = 'Role';
    //     $data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();

    //     $data['role'] = $this->db->get('user_role')->result_array();

    //     $this->form_validation->set_rules('role', 'Role', 'required');

    //     if ($this->form_validation->run() == false) {
    //         $this->load->view('templates/user_header', $data);
    //         $this->load->view('templates/sidebar', $data);
    //         $this->load->view('templates/topbar', $data);
    //         $this->load->view('admin/role', $data);
    //         $this->load->view('templates/user_footer');
    //     } else {
    //         $this->db->insert('user_role', ['role' => $this->input->post('role')]);
    //         $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
    //         New role added!</div>');
    //         redirect('admin/role');
    //     }
    // }

    // public function edit($id)
    // {
    //     $this->db->update('user_role', ['role' => $this->input->post('role')], ['id' => $id]);
    //     $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">The role has ben edited!</div>');
    //     redirect('admin/role');
    // }

    // public function delete($id)
    // {
    //     $this->db->delete('user_role', ['id' => $id]);
    //     $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">The role has ben deleted!</div>');
    //     redirect('admin/role');
    // }


    // public function roleAccess($role_id)
    // {
    //     $data['title'] = 'Role Access';
    //     $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

    //     $data['role'] = $this->db->get_where('user_role', ['id' => $role_id])->row_array();

    //     $this->db->where('id !=', 1);
    //     $data['menu'] = $this->db->get('user_menu')->result_array();

    //     $this->load->view('templates/user_header', $data);
    //     $this->load->view('templates/sidebar', $data);
    //     $this->load->view('templates/topbar', $data);
    //     $this->load->view('admin/role-access', $data);
    //     $this->load->view('templates/user_footer');
    // }


    // public function changeaccess()
    // {
    //     $menu_id = $this->input->post('menuId');
    //     $role_id = $this->input->post('roleId');

    //     $data = [
    //         'role_id' => $role_id,
    //         'menu_id' => $menu_id
    //     ];

    //     $result = $this->db->get_where('user_access_menu', $data);

    //     if ($result->num_rows() < 1) {
    //         $this->db->insert('user_access_menu', $data);
    //     } else {
    //         $this->db->delete('user_access_menu', $data);
    //     }

    //     $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
    //     Access Changed!</div>');
    // }
}
