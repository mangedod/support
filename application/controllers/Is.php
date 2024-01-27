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
        $this->load->view('back/index');
        $this->load->view('layout/foot');

    }
    private function loadDataFromDatabase()
    {
        $this->db->select('tanggal, SUM(stock_barang) AS total_stock');
        $this->db->order_by('tanggal', 'desc');
        $this->db->group_by('tanggal');
        $this->db->limit(30);
        $query = $this->db->get('in_his');
        $result = $query->result();
        $labels = array();
        $data = array();
        foreach ($result as $row) {
            $labels[] = date('d-M-y', strtotime($row->tanggal));
            $data[] = $row->total_stock / 20;
        }
        $chartData = array(
            'labels' => array_reverse($labels),
            'datasets' => array(
                array(
                    'label' => 'Barang Masuk',
                    'data' => array_reverse($data),
                    'backgroundColor' => '#4B49AC',
                ),
                array(
                    'label' => 'Barang Keluar',
                    'data' => $this->getBarangKeluarDataFromDatabase(),
                    'backgroundColor' => '#d83b76',
                ),
            ),
        );
        return $chartData;
    }
    private function getBarangKeluarDataFromDatabase()
    {
        $this->db->select('tanggal, SUM(stock_barang) AS total_stock');
        $this->db->order_by('tanggal', 'desc');
        $this->db->group_by('tanggal');
        $this->db->limit(30);
        $query = $this->db->get('telah_keluar');
        $result = $query->result();
        $data = array();
        foreach ($result as $row) {
            $data[] = $row->total_stock / 20;
        }
        return array_reverse($data);
    }
    public function print()
    {
        $data['data_api'] = $this->fungsi->dataMigrasiKRD();
        $data['user'] = $this->db->get_where('user', ['email_user' => $this->session->userdata('email')])->row_array();
        $data['namaweb'] = $this->fungsi->About();
        $data['judul'] = "Printing";
        $this->load->view('user/layout/header', $data);
        $this->load->view('admin/produk/all_krd_print', $data);
        $this->load->view('user/layout/footer', $data);
    }
}
