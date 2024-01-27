<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Logout extends CI_Controller
{
    public function index()
    {
        // Mendapatkan email pengguna dari session
        $email = $this->session->userdata('email');

        // Menghapus data sesi
        $this->session->sess_destroy();

        // Update status_online menjadi 0
        $this->db->where('email_user', $email);
        $this->db->update('user', array('status_online' => 0));

        redirect('auth');
    }
}
