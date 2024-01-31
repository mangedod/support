<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Main extends CI_Model
{
    public function get_project_count()
    {
        $this->db->select('project_main.id_promain, project_main.nama_promain, COUNT(project_list.id_prolist) as count_skill');
        $this->db->from('project_main');
        $this->db->join('project_list', 'project_main.id_promain = project_list.id_promain', 'left');
        $this->db->where('project_list.status_prolist', 1);
        $this->db->group_by('project_main.id_promain');
        $this->db->order_by('RAND()');
        $this->db->limit(3);
        // $this->db->where('project_main.id_promain<4');
        return $this->db->get();
    }
    public function get_project_count2()
    {
        $this->db->select('project_main.id_promain, project_main.nama_promain, COUNT(project_list.id_prolist) as count_skill');
        $this->db->from('project_main');
        $this->db->join('project_list', 'project_main.id_promain = project_list.id_promain', 'left');
        $this->db->where('project_list.status_prolist', 1);
        $this->db->group_by('project_main.id_promain');
        // Mengembalikan data untuk tabel kedua (sisanya random)
        $this->db->order_by('RAND()');
        // $this->db->where('project_main.id_promain>3');
        return $this->db->get();
    }
    public function get_total_project_list($id_promain)
    {
        $this->db->where('id_promain', $id_promain);
        return $this->db->count_all_results('project_list');
    }
    public function get_last_week_count($id_promain)
    {
        $this->db->where('id_promain', $id_promain);
        $this->db->where("pencapaian >= CURDATE() - INTERVAL DAYOFWEEK(CURDATE())+6 DAY AND pencapaian < CURDATE() - INTERVAL DAYOFWEEK(CURDATE())-1 DAY", null, false);
        return $this->db->count_all_results('project_list');
    }

    public function get_last_month_count($id_promain)
    {
        $this->db->where('id_promain', $id_promain);
        $this->db->where("MONTH(pencapaian) = MONTH(CURDATE() - INTERVAL 1 MONTH) AND YEAR(pencapaian) = YEAR(CURDATE() - INTERVAL 1 MONTH)");
        return $this->db->count_all_results('project_list');
    }
    public function KirimRequest()
    {
        $data = [
            'nama_req' => $this->input->post('nama', true),
            'email_req' => $this->input->post('email', true),
            'dev_req' => $this->input->post('dev', true),
            'butuh_req' => $this->input->post('butuh', true),
            'link_req' => $this->input->post('link', true),
            'desc_req' => $this->input->post('desc', true),
            'status_req' => 0,
        ];
        $this->db->insert('request', $data);
    }
    public function EditProfil()
    {
        $data = [
            'nama_user' => $this->input->post('nama', true),
            'jenkel_user' => $this->input->post('gender', true),
            'ttl' => $this->input->post('ttl', true),
            'email_user' => $this->input->post('email', true),
            'alamat' => $this->input->post('alamat', true),
            'kota' => $this->input->post('kota', true),
            'negara' => $this->input->post('negara', true),
            'kode_pos' => $this->input->post('code_pos', true),
            'tentang_user' => $this->input->post('ttg', true),
            'status_online' => 0,
        ];

        $this->db->where('email_user', $this->session->userdata('email'));
        $this->db->update('user', $data);
    }

    public function Departemen()
    {
        return $this->db->get('departemen')->result();
    }
    public function Menus()
    {
        $this->db->select('*');
        $this->db->join('user_menu', 'user_menu.id = user_sub_menu.menu_id');

        return $this->db->get('user_sub_menu')->result_array();
    }
}
