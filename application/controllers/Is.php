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
}
