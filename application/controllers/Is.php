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
        $data['user'] = $this->db->get_where('user', ['email_user' => $this->session->userdata('email')])->row_array();
        $data['judul'] = "Dashboard";
        $data['skill_counts'] = $this->fungsi->get_project_count5()->result();
        foreach ($data['skill_counts'] as $skill_count) {
            $total = $this->fungsi->get_total_project_list($skill_count->id_promain);
            $skill_count->percentage = ($total > 0) ? ($skill_count->count_skill / $total) * 100 : 0;

            // Hitung presentase last week
            $last_week_count = $this->fungsi->get_last_week_count($skill_count->id_promain);
            $skill_count->last_week_percentage = ($total > 0) ? ($last_week_count / $total) * 100 : 0;

            // Hitung presentase last month
            $last_month_count = $this->fungsi->get_last_month_count($skill_count->id_promain);
            $skill_count->last_month_percentage = ($total > 0) ? ($last_month_count / $total) * 100 : 0;
        }

        $this->load->view('layout/head', $data);
        $this->load->view('layout/nav');
        $this->load->view('back/index');
        $this->load->view('layout/foot');
    }
    public function ubah_profil()
    {
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
        $data['user'] = $this->db->get_where('user', ['email_user' => $this->session->userdata('email')])->row_array();
        $data['judul'] = 'Edit Profil';
        $this->form_validation->set_rules('image', 'Foto', 'trim');
        if ($this->form_validation->run() == false) {
            $this->load->view('layout/head', $data);
            $this->load->view('layout/nav2');
            $this->load->view('back/edit_user');
            $this->load->view('layout/foot');
        } else {

            $upload_image = $_FILES['image']['name'];

            if ($upload_image) {
                $config['allowed_types'] = 'gif|jpg|png';
                $config['max_size'] = '20480';
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
        $data['user'] = $this->db->get_where('user', ['email_user' => $this->session->userdata('email')])->row_array();
        $data['menus'] = $this->fungsi->Menus();
        $data['judul'] = 'Menus';
        $this->form_validation->set_rules('judul', 'Judul', 'required');
        $this->form_validation->set_rules('url', 'URL', 'required');
        $this->form_validation->set_rules('icon', 'Icon', 'required');
        if ($this->form_validation->run() == false) {
            $this->load->view('layout/head', $data);
            $this->load->view('layout/nav');
            $this->load->view('back/menus');
            $this->load->view('layout/foot');
        } else {
            $data = [
                'judul_menu' => $this->input->post('judul'),
                'menu_id' => 1,
                'url' => $this->input->post('url'),
                'icon' => $this->input->post('icon'),
                'is_active' => $this->input->post('is_active'),
            ];
            $this->db->insert('user_sub_menu', $data);
            $this->session->set_flashdata('pesan', '<div class="alert alert-success text-center alert-dismissible fade show" role="alert">Menu berhasil diubah!<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
            redirect('is/menus');
        }
    }
    public function e_submenu($id)
    {
        $data['user'] = $this->db->get_where('user', ['email_user' => $this->session->userdata('email')])->row_array();
        $data['menu'] = $this->fungsi->Menus1($id);
        $data['menus'] = $this->fungsi->Menus();
        $data['judul'] = 'Menus';
        $this->form_validation->set_rules('judul', 'Judul', 'required');
        $this->form_validation->set_rules('url', 'URL', 'required');
        $this->form_validation->set_rules('icon', 'Icon', 'required');
        if ($this->form_validation->run() == false) {
            $this->load->view('layout/head', $data);
            $this->load->view('layout/nav');
            $this->load->view('back/e_menus');
            $this->load->view('layout/foot');
        } else {
            $data = [
                'judul_menu' => $this->input->post('judul'),
                'menu_id' => 1,
                'url' => $this->input->post('url'),
                'icon' => $this->input->post('icon'),
                'is_active' => $this->input->post('is_active'),
            ];
            $this->db->where('id_sub', $id);
            $this->db->update('user_sub_menu', $data);
            $this->session->set_flashdata('pesan', '<div class="alert alert-success text-center alert-dismissible fade show" role="alert">Menu berhasil diubah!<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
            redirect('is/menus');
        }
    }
    // HAPUS SUB MENU
    public function h_submenu($id)
    {
        $this->fungsi->HapusSubMenu($id);
        $this->session->set_flashdata('pesan', '<div class="alert alert-danger text-center alert-dismissible fade show" role="alert">Menu berhasil dihapus!<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
        redirect('is/menus');
    }
    public function settings()
    {
        $data['user'] = $this->db->get_where('user', ['email_user' => $this->session->userdata('email')])->row_array();
        $data['judul'] = "Dashboard";
        $this->load->view('layout/head', $data);
        $this->load->view('layout/nav');
        $this->load->view('back/settings');
        $this->load->view('layout/foot');
    }
    public function role()
    {
        $data['user'] = $this->db->get_where('user', ['email_user' => $this->session->userdata('email')])->row_array();
        $data['role'] = $this->db->get('role')->result_array();
        $data['judul'] = 'Role Access';
        // $data['roles'] = $this->fungsi->Role();
        $this->form_validation->set_rules('role', 'Role', 'trim');
        if ($this->form_validation->run() == false) {
            $this->load->view('layout/head', $data);
            $this->load->view('layout/nav');
            $this->load->view('back/role', $data);
            $this->load->view('layout/foot');

        } else {
            $this->fungsi->TambahRole();
            $this->session->set_flashdata('pesan', '<div class="alert alert-success text-center alert-dismissible fade show" role="alert">berhasil dihapus!<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
            redirect('is/role');
        }
    }
    public function e_role($id)
    {
        $data['user'] = $this->db->get_where('user', ['email_user' => $this->session->userdata('email')])->row_array();
        $data['namaweb'] = $this->fungsi->About();
        $data['role1'] = $this->fungsi->Role1($id);
        $data['judul'] = 'Role Access';

        $this->form_validation->set_rules('role', 'Role', 'trim');
        if ($this->form_validation->run() == false) {
            $this->load->view('layout/head', $data);
            $this->load->view('layout/nav');
            $this->load->view('back/ubah_role', $data);
            $this->load->view('layout/foot');
        } else {
            $this->fungsi->UbahRole();
            $this->session->set_flashdata('pesan', '<div class="alert alert-info text-center alert-dismissible fade show" role="alert">berhasil diubah!<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
            redirect('admin/role');
        }
    }

    public function h_role($id)
    {
        $this->fungsi->HapusRole($id);
        $this->session->set_flashdata('pesan', '<div class="alert alert-danger text-center alert-dismissible fade show" role="alert">berhasil dihapus!<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
        redirect('is/role');
    }

    public function akses($role_id)
    {
        $data['user'] = $this->db->get_where('user', ['email_user' => $this->session->userdata('email')])->row_array();
        $data['role'] = $this->db->get_where('role', ['id' => $role_id])->row_array();
        $data['menu'] = $this->db->get('user_menu')->result_array();

        $data['judul'] = 'Role Access';
        $this->load->view('layout/head', $data);
        $this->load->view('layout/nav');
        $this->load->view('back/aksesrole', $data);
        $this->load->view('layout/foot');
    }

    public function changeAccess()
    {
        $menu_id = $this->input->post('menuId');
        $role_id = $this->input->post('roleId');
        $data = [
            'role_id' => $role_id,
            'menu_id' => $menu_id,
        ];
        $result = $this->db->get_where('user_access_menu', $data);
        if ($result->num_rows() < 1) {
            $this->db->insert('user_access_menu', $data);
        } else {
            $this->db->delete('user_access_menu', $data);
        }
        $this->session->set_flashdata('pesan', '<div class="alert alert-info text-center alert-dismissible fade show" role="alert">akses berhasil!<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
    }
    public function jobdesk()
    {
        $data['user'] = $this->db->get_where('user', ['email_user' => $this->session->userdata('email')])->row_array();
        $data['role'] = $this->db->get('role')->result_array();
        $data['judul'] = 'Daily Job';
        // $data['roles'] = $this->fungsi->Role();
        $this->form_validation->set_rules('role', 'Role', 'trim');
        if ($this->form_validation->run() == false) {
            $this->load->view('layout/head', $data);
            $this->load->view('layout/nav');
            $this->load->view('back/job', $data);
            $this->load->view('layout/foot');

        } else {
            $this->fungsi->TambahRole();
            $this->session->set_flashdata('pesan', '<div class="alert alert-success text-center alert-dismissible fade show" role="alert">berhasil dihapus!<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
            redirect('is/role');
        }
    }
}
