<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Id extends CI_Controller
{
    public function index()
    {
        $data['judul'] = "Ansania Services Zone";
        $data['skill_counts'] = $this->fungsi->get_project_count()->result();
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
        $data['skill_counts2'] = $this->fungsi->get_project_count2()->result();
        foreach ($data['skill_counts2'] as $skill_count) {
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
        $this->load->view('front/index');
        $this->load->view('layout/foot');
    }
}
