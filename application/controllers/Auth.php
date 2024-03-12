<?php
ob_start();
defined('BASEPATH') or exit('No direct script access allowed');
class Auth extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('encryption');
        $user = $this->db->get_where('user', ['email_user' => $this->session->userdata('email')])->row_array();
    }
    public function index()
    {
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
        $this->form_validation->set_rules('password', 'Password', 'trim|required');
        if ($this->form_validation->run() == false) {
            // $data['namaweb'] = $this->fungsi->About();
            $data['judul'] = "Service Zone";
            $this->load->view('auth/login', $data);
        } else {
            $this->_login();
        }
    }
    private function _login()
    {
        $email = $this->input->post('email');
        $password = $this->input->post('password');
        $user = $this->db->get_where('user', ['email_user' => $email])->row_array();
        if ($user) {
            if ($user['is_active'] == 1) {
                if (password_verify($password, $user['password'])) {
                    $data = [
                        'email' => $user['email_user'],
                        'role_id' => $user['role_id'],
                    ];
                    $this->session->set_userdata($data);
                    $this->db->where('email_user', $email);
                    $this->db->update('user', array('status_online' => 1));

                    if (!empty($this->input->post('save_id'))) {
                        setcookie("loginId", $email, time() + (10 * 365 * 24 * 60 * 60));
                        setcookie("loginPass", $password, time() + (10 * 365 * 24 * 60 * 60));
                    } else {
                        setcookie("loginId", "");
                        setcookie("loginPass", "");
                    }

                    if ($user['role_id'] == 1) {
                        redirect('is');
                    } elseif ($user['role_id'] == 2) {
                        redirect('is');
                    } elseif ($user['role_id'] == 3) {
                        redirect('is');
                    } elseif ($user['role_id'] == 4) {
                        redirect('id/masuk');
                    } elseif ($user['role_id'] == 5) {
                        redirect('id/keluar');
                    } else {
                        redirect('is/print');
                    }
                } else {
                    $this->session->set_flashdata('pesan', '<div class="alert alert-danger text-center alert-dismissible fade show" role="alert">Password yang kamu masukkan salah!</div>');
                    redirect('auth');
                }
            } else {
                $this->session->set_flashdata('pesan', '<div class="alert alert-danger text-center alert-dismissible fade show" role="alert">Akunmu masih dalam peninjauan</div>');
                redirect('auth');
            }
        } else {
            $this->session->set_flashdata('pesan', '<div class="alert alert-danger text-center alert-dismissible fade show" role="alert">Email yang kamu masukkan belum terdaftar!</div>');
            redirect('auth');
        }
    }
    public function daftar()
    {
        $this->form_validation->set_rules('nama', 'Nama', 'required|trim');
        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|is_unique[user.email_user]');
        $this->form_validation->set_rules('password1', 'Password', 'required|trim|min_length[3]|matches[password2]');
        $this->form_validation->set_rules('password2', 'Password', 'required|trim|matches[password1]');
        if ($this->form_validation->run() == false) {
            $data['judul'] = "Akun Baru";
            $data['namaweb'] = $this->fungsi->About();
            $this->load->view('login/template/header', $data);
            $this->load->view('login/daftar');
            $this->load->view('login/template/footer');
        } else {
            $email = $this->input->post('email', true);
            $data = [
                'nama_user' => htmlspecialchars($this->input->post('nama', true)),
                'email_user' => htmlspecialchars($email),
                'gambar_user' => 'default.jpg',
                'password' => password_hash($this->input->post('password1'), PASSWORD_DEFAULT),
                'role_id' => 4,
                'is_active' => 0,
                'moto_user' => 'Mitra',
                'img_ktp' => 'default_ktp.jpg',
                'img_atm' => 'default_atm.jpg',
                'date_created' => time(),
                'saldo' => 0,
                'status_online' => 0,
            ];
            $token = bin2hex($this->encryption->create_key(16));
            $user_token = [
                'email' => $email,
                'token' => $token,
                'date_created' => time(),
            ];
            $this->db->insert('user', $data);
            $this->db->insert('user_token', $user_token);
            $this->_sendEmail($token, 'verify');
            $this->session->set_flashdata('pesan', '<div class="alert alert-info alert-dismissible fade show" role="alert">Pendaftaran berhasil, silahkan cek email untuk mengaktifkan akunmu!</div>');
            redirect('auth/daftar');
        }
    }
    private function _sendEmail($token, $type)
    {
        $config = [
            'protocol' => 'smtp',
            'smtp_host' => 'ssl://smtp.googlemail.com',
            'smtp_user' => 'lensains.official@gmail.com',
            'smtp_pass' => 'eorufflsgzkrflrr',
            'smtp_port' => '465',
            'mailtype' => 'html',
            'charset' => 'iso-8859-1',
            'newline' => "\r\n",
        ];
        $this->load->library('email', $config);
        $this->email->from('lensains.official@gmail.com', 'Ansania Official');
        $this->email->to(($this->input->post('email')));

        if ($type == 'verify') {
            $this->email->subject('Verifikasi Mitra Ansania');
            $this->email->message('Assalamu&#39;alaikum.. <br/>Selamat, akun Mitra Kakak tinggal selangkah lagi, silahkan klik link dibawah ini untuk aktivasi akun Mitra Ansania<br/><br/>
			<a href="' . base_url() . 'auth/verify?email=' . $this->input->post('email') . '&token=' . urlencode($token) . '">Aktifkan Akun</a><br/><br/>
			<small><strong>Penting: Jangan balas. Email ini berupa system otomatis dan hanya melakukan koneksi satu arah.</strong></small><br/><br/><br/>
			<p>Terima Kasih<br/>Tim Support Ansania ' . date('Y') . '.');
        } elseif ($type == 'forgot') {
            $this->email->subject('Reset Password');
            $this->email->message('Assalamu&#39;alaikum.. <br/>Silahkan untuk mengganti password baru Anda pada link dibawah ini:<br/><br/>
			<a href="' . base_url() . 'auth/reset?email=' . $this->input->post('email') . '&token=' . urlencode($token) . '">Reset Password</a><br/><br/>
			<small><strong>Penting: Jangan balas. Email ini berupa system otomatis dan hanya melakukan koneksi satu arah.</strong></small><br/><br/><br/>
			<p>Terima Kasih<br/>Tim Support Ansania ' . date('Y') . '.');
        }
        if ($this->email->send()) {
            return true;
        } else {
            echo $this->email->print_debugger();
            die;
        }
    }
    public function verify()
    {
        $email = $this->input->get('email');
        $token = $this->input->get('token');
        $user = $this->db->get_where('user', ['email_user' => $email])->row_array();
        if ($user) {
            $user_token = $this->db->get_where('user_token', ['token' => $token])->row_array();
            if ($user_token) {
                if (time() - $user_token['date_created'] < (60 * 60 * 24)) {
                    $this->db->set('is_active', 1);
                    $this->db->where('email_user', $email);
                    $this->db->update('user');
                    $this->db->delete('user_token', ['email' => $email]);
                    $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">Selamat, Email ' . $email . ' telah aktif, silahkan login!</div>');
                    redirect('auth');
                } else {
                    $this->db->delete('user', ['email_user' => $email]);
                    $this->db->delete('user_token', ['email' => $email]);
                    $this->session->set_flashdata('pesan', '<div class="alert alert-danger text-center alert-dismissible fade show" role="alert">Maaf akses ditolak, token sudah melebihi 24 jam!</div>');
                    redirect('auth');
                }
            } else {
                $this->session->set_flashdata('pesan', '<div class="alert alert-danger text-center alert-dismissible fade show" role="alert">Maaf akses ditolak, token sudah tidak valid!</div>');
                redirect('auth');
            }
        } else {
            $this->session->set_flashdata('pesan', '<div class="alert alert-danger text-center alert-dismissible fade show" role="alert">Maaf akses ditolak, emailmu belum terdaftar!</div>');
            redirect('auth');
        }
    }
    public function lupa()
    {
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
        if ($this->form_validation->run() == false) {
            $data['judul'] = "Lupa Password";
            $data['namaweb'] = $this->fungsi->About();
            $this->load->view('login/template/header', $data);
            $this->load->view('login/lupa');
            $this->load->view('login/template/footer');
        } else {
            $email = $this->input->post('email');
            $user = $this->db->get_where('user', ['email_user' => $email, 'is_active' => 1])->row_array();
            if ($user) {
                $token = base64_encode(random_bytes(32));
                $user_token = [
                    'email' => $email,
                    'token' => $token,
                    'date_created' => time(),
                ];
                $this->db->insert('user_token', $user_token);
                $this->_sendEmail($token, 'forgot');
                $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">Reset email sudah kami kirimkan ke email Anda!</div>');
                redirect('auth/lupa');
            } else {
                $this->session->set_flashdata('pesan', '<div class="alert alert-danger text-center alert-dismissible fade show" role="alert">Email belum terdaftar atau belum diaktifkan!</div>');
                redirect('auth/lupa');
            }
        }
    }
    public function reset()
    {
        $email = $this->input->get('email');
        $token = $this->input->get('token');
        $user = $this->db->get_where('user', ['email_user' => $email])->row_array();
        if ($user) {
            $user_token = $this->db->get_where('user_token', ['token' => $token])->row_array();
            if ($user_token) {
                $this->session->set_userdata('reset_email', $email);
                $this->changepassword();
            } else {
                $this->session->set_flashdata('pesan', '<div class="alert alert-danger text-center alert-dismissible fade show" role="alert">Reset password gagal, token salah!</div>');
                redirect('auth');
            }
        } else {
            $this->session->set_flashdata('pesan', '<div class="alert alert-danger text-center alert-dismissible fade show" role="alert">Reset password gagal, email salah!</div>');
            redirect('auth');
        }
    }
    public function changepassword()
    {
        if (!$this->session->userdata('reset_email')) {
            redirect('auth');
        }
        $this->form_validation->set_rules('password1', 'Password', 'trim|required|min_length[3]|matches[password2]');
        $this->form_validation->set_rules('password2', 'Pengulangan Password', 'trim|required|min_length[3]|matches[password1]');
        if ($this->form_validation->run() == false) {
            $data['judul'] = "Ubah Password";
            $data['namaweb'] = $this->fungsi->About();
            $this->load->view('login/template/header', $data);
            $this->load->view('login/change');
            $this->load->view('login/template/footer');
        } else {
            $password = password_hash($this->input->post('password1'), PASSWORD_DEFAULT);
            $email = $this->session->userdata('reset_email');
            $this->db->set('password', $password);
            $this->db->where('email_user', $email);
            $this->db->update('user');
            $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">Password berhasil diubah, silahkan login!</div>');
            redirect('auth');
        }
    }
}
