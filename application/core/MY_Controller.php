<?php

defined('BASEPATH') or exit('No direct script access allowed');

class My_Controller extends CI_Controller
{


    public function __construct()
    {
        parent::__construct();
        $user = $this->db->get_where('user', ['email_user' => $this->session->userdata('email')])->row_array();
        if (!isset($user)) {

            redirect('auth/');
        }
    }
}

/* End of file My_Controller.php */
