<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Is extends My_Controller
{
    public function __construct()
    {
        parent::__construct();
    }
    public function index()
    {
        date_default_timezone_set('Asia/Jakarta');
        $time = date('H');
        if ($time < '10') {
            $greeting = 'Selamat pagi';
        } elseif ($time >= '10' && $time < '17') {
            $greeting = 'Selamat siang';
        } elseif ($time >= '17' && $time < '18') {
            $greeting = 'Selamat sore';
        } elseif ($time >= '18' && $time < '24') {
            $greeting = 'Selamat malam';
        } else {
            $greeting = 'Selamat pagi';
        }
        $data['greeting'] = $greeting;
        $data['user'] = $this->db->get_where('user', ['email_user' => $this->session->userdata('email')])->row_array();
        $data['judul'] = "Dashboard";
        $this->load->view('layout/head', $data);
        $this->load->view('layout/nav');
        $this->load->view('back/index');
        $this->load->view('layout/foot');
    }
    public function ubah_profil()
    {
        date_default_timezone_set('Asia/Jakarta');
        $time = date('H');
        if ($time < '10') {
            $greeting = 'Selamat pagi';
        } elseif ($time >= '10' && $time < '17') {
            $greeting = 'Selamat siang';
        } elseif ($time >= '17' && $time < '18') {
            $greeting = 'Selamat sore';
        } elseif ($time >= '18' && $time < '24') {
            $greeting = 'Selamat malam';
        } else {
            $greeting = 'Selamat pagi';
        }
        $data['greeting'] = $greeting;
        $data['user'] = $this->db->get_where('user', ['email_user' => $this->session->userdata('email')])->row_array();
        $data['judul'] = 'Edit Profil';

        $this->form_validation->set_rules('nama', 'Nama Lengkap', 'trim');
        $this->form_validation->set_rules('gender', 'Gender', 'trim');
        $this->form_validation->set_rules('ttl', 'Tempat tanggal lahir', 'trim');
        $this->form_validation->set_rules('email', 'Email', 'trim');
        $this->form_validation->set_rules('alamat', 'Alamat', 'trim');
        $this->form_validation->set_rules('kota', 'Kota', 'trim');
        $this->form_validation->set_rules('negara', 'Negara', 'trim');
        $this->form_validation->set_rules('code_pos', 'Kode Pos', 'trim');
        $this->form_validation->set_rules('ttg', 'Tentang', 'trim');
        if ($this->form_validation->run() == false) {
            $this->load->view('layout/head', $data);
            $this->load->view('layout/nav');
            $this->load->view('back/edit_user');
            $this->load->view('layout/foot');
        } else {
            $this->fungsi->EditProfil();
            $this->session->set_flashdata('pesan', '<div class="alert alert-success text-center alert-dismissible fade show" role="alert">Profil berhasil diubah!<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
            redirect('profile');
        }
    }
    public function editProfil()
    {
        date_default_timezone_set('Asia/Jakarta');
        $time = date('H');
        if ($time < '10') {
            $greeting = 'Selamat pagi';
        } elseif ($time >= '10' && $time < '17') {
            $greeting = 'Selamat siang';
        } elseif ($time >= '17' && $time < '18') {
            $greeting = 'Selamat sore';
        } elseif ($time >= '18' && $time < '24') {
            $greeting = 'Selamat malam';
        } else {
            $greeting = 'Selamat pagi';
        }
        $data['greeting'] = $greeting;
        $data['user'] = $this->db->get_where('user', ['email_user' => $this->session->userdata('email')])->row_array();
        $data['judul'] = 'Edit Profil';

        $this->form_validation->set_rules('image', 'Foto', 'trim');
        if ($this->form_validation->run() == false) {
            $this->load->view('layout/head', $data);
            $this->load->view('layout/nav');
            $this->load->view('back/edit_user');
            $this->load->view('layout/foot');
        } else {

            $upload_image = $_FILES['image']['name'];

            if ($upload_image) {
                $config['allowed_types'] = 'gif|jpg|png';
                $config['max_size'] = '2048';
                $config['upload_path'] = FCPATH . 'assets/img/theme/';

                $this->load->library('upload', $config);

                if ($this->upload->do_upload('image')) {
                    $gambar_lama = $data['user']['gambar_user'];
                    if ($gambar_lama != 'default.jpg') {
                        unlink(FCPATH . 'assets/img/theme/' . $gambar_lama);
                    }

                    $new_image = $this->upload->data('file_name');
                    $this->db->set('gambar_user', $new_image);
                } else {
                    echo $this->upload->display_errors();
                }
            }

            // Pastikan variabel $nama dan $email terdefinisi sebelum digunakan
            $nama = $this->input->post('nama');
            $email = $this->input->post('email');

            $this->db->set('nama_user', $nama);
            $this->db->where('email_user', $email);
            $this->db->update('user');
            $this->session->set_flashdata('pesan', '<div class="alert alert-success text-center alert-dismissible fade show" role="alert">Account berhasil diubah!<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
            redirect('profile');
        }
    }
    public function menus()
    {
        date_default_timezone_set('Asia/Jakarta');
        $time = date('H');
        if ($time < '10') {
            $greeting = 'Selamat pagi';
        } elseif ($time >= '10' && $time < '17') {
            $greeting = 'Selamat siang';
        } elseif ($time >= '17' && $time < '18') {
            $greeting = 'Selamat sore';
        } elseif ($time >= '18' && $time < '24') {
            $greeting = 'Selamat malam';
        } else {
            $greeting = 'Selamat pagi';
        }
        $data['greeting'] = $greeting;
        $data['user'] = $this->db->get_where('user', ['email_user' => $this->session->userdata('email')])->row_array();
        $data['menus'] = $this->fungsi->Menus();
        $data['judul'] = 'Menus';

        $this->load->view('layout/head', $data);
        $this->load->view('layout/nav');
        $this->load->view('back/menus');
        $this->load->view('layout/foot');

    }
}
