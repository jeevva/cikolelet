<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
    }

    public function index()
    {
        if ($this->session->userdata('emails')) {
            redirect('admin/home');
        }

        // set rules
        $this->form_validation->set_rules('emails', 'Email', 'trim|required|valid_email');
        $this->form_validation->set_rules('password', 'password', 'trim|required');

        if ($this->form_validation->run() == false) {
            $data['title'] = 'Login Page';
            $data['page'] = 'admin/auth/login';
            $this->load->view('layouts/backend/auth_layout', $data);
        } else {
            // validasi success
            $this->_login();
        }
    }

    private function _login()
    {
        $emails = $this->input->post('emails');
        $password = $this->input->post('password');

        // ambil data user lalu kita cocokan
        $admin = $this->db->get_where('admin', ['emails' => $emails])->row_array();
        // jika admin ada di database
        if ($admin) {
            // jika adminnya active
            if ($admin['is_active'] == 1) {
                // cek password
                if (password_verify($password, $admin['password'])) {
                    $data = [
                        'emails' => $admin['emails'],
                        'id_admin' => 'id_admin'
                    ];
                    $this->session->set_userdata($data);
                    redirect('admin/home');
                } else {
                    $this->session->set_flashdata('message', '
                    <div class="alert alert-danger" role="alert">Password Salah!</div>');
                    redirect('admin/auth');
                }
            } else {
                $this->session->set_flashdata('message', '
                    <div class="alert alert-danger" role="alert">Email belum di aktivasi!</div>');
                redirect('admin/auth');
            }
        } else {
            $this->session->set_flashdata('message', '
                <div class="alert alert-danger" role="alert">Email tidak terdaftar!</div>');
            redirect('admin/auth');
        }
    }

    public function registration()
    {

        if ($this->session->userdata('emails')) {
            redirect('admin/home');
        }
        // rules
        // params 1 (name), params 2 (alias), params 3 (rules nya)
        // rules is_unique digunakan untuk mengecek apakah email yg diinput sudah terdaftar di databse apa belum.
        $this->form_validation->set_rules('name', 'Name', 'required|trim');
        $this->form_validation->set_rules('emails', 'Emails', 'required|trim|valid_email|is_unique[admin.emails]', [
            'is_unique' => 'email sudah terdaftar'
        ]);
        $this->form_validation->set_rules('password1', 'Password', 'required|trim|min_length[6]|matches[password2]', [
            'matches' => 'Password tidak cocok!',
            'min_length' => 'Password terlalu pendek'
        ]);
        $this->form_validation->set_rules('password2', 'Password', 'required|trim|matches[password1]');

        if ($this->form_validation->run() == false) {
            $data['title'] = 'Pendaftaran Akun';
            $data['page'] = 'admin/auth/register';
            $this->load->view('layouts/backend/auth_layout', $data);
        } else {
            // role_id 2 adalah default user sebagai member untuk administrtor role_id nya 2
            $data = [
                'name' => htmlspecialchars($this->input->post('name', true)),
                'emails' => htmlspecialchars($this->input->post('emails', true)),
                'image' => 'default.jpg',
                'password' => password_hash($this->input->post('password1'), PASSWORD_DEFAULT),
                'is_active' => 1,
                'created_at' => time()
            ];

            // insert ke database
            $this->db->insert('admin', $data);
            $this->session->set_flashdata('message', '
                <div class="alert alert-success" role="alert">Selamat, akun anda telah terdaftar</div>');
            redirect('admin/auth');
        }
    }

    public function logout()
    {
        $this->session->unset_userdata('emails');

        $this->session->set_flashdata('message', '
            <div class="alert alert-success" role="alert">Berhasil logout!</div>');
        redirect('admin/auth');
    }
}
