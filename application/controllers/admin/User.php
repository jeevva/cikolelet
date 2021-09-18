<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
         is_logged_in();
    }

    public function index()
    {
        $data['page'] = 'admin/user/index';
        $data['user'] = $this->db->get_where('admin', ['emails' => $this->session->userdata('emails')])->row_array();
        $data['nama'] = $data['user']['name'];
        $data['emails'] = $data['user']['emails'];
        $data['active'] = 'user';
        $data['desa'] = $this->db->get("profil_desa")->result_array();
        
        $this->load->view('layouts/backend/main_layout', $data);
    }


    public function changepassword()
    {
        $data['title'] = 'Ubah Password';
        $data['user'] = $this->db->get_where('admin', ['emails' => $this->session->userdata('emails')])->row_array();
        $data['active'] = 'user';
        
        // $this->load->view('layouts/frontend/main_layout', $data);

        

        $this->form_validation->set_rules('password', 'Password', 'trim|required');
        $this->form_validation->set_rules('newpassword', 'Password Baru', 'trim|required|min_length[6]|matches[repassword]');
        $this->form_validation->set_rules('repassword', 'Kofirmasi Password', 'trim|required|min_length[6]|matches[newpassword]');


        if ($this->form_validation->run() == false) 
        {
            $data['page'] = 'admin/user/changepassword';
            $data['desa'] = $this->db->get("profil_desa")->result_array();
            $this->load->view('layouts/backend/main_layout', $data);
        }else {
            $password = $this->input->post('password');
            $newpassword = $this->input->post('newpassword');
            $repassword = $this->input->post('repassword');
            if(!password_verify($password,$data['user']['password'])){
                $this->session->set_flashdata('message', '
            <div class="alert alert-danger" role="alert">Password Anda Salah</div>');
            redirect('admin/user/changepassword');
            }else {
            if($password == $newpassword){
                $this->session->set_flashdata('message', '
            <div class="alert alert-danger" role="alert">Password Baru tidak boleh sama dengan password lama</div>');
            redirect('admin/user/changepassword');
            }
                
            else{

                $newpassword = $this->input->post('newpassword');
                $repassword = $this->input->post('repassword');

                if ( $repassword == $newpassword   ) {
                    $password_hash = password_hash($newpassword, PASSWORD_DEFAULT);
                $this->db->set('password',$password_hash);
                $this->db->get_where('admin', ['emails' => $this->session->userdata('emails')])->row_array();
                $this->db->update('admin');

                $this->session->set_flashdata('message', '
            <div class="alert alert-success" role="alert">Password Berhasil dirubah</div>');
            redirect('admin/user/changepassword');
                    # code...
                } else  {
                        $this->session->set_flashdata('message', '
            <div class="alert alert-danger" role="alert">Konfirmasi gagal</div>');
            redirect('admin/user/changepassword');
                }
            }
        }
        }

    }

    // --list--
    public function list()
    {
        $data['page'] = 'admin/user/list';
        $data['active'] = 'user';
        $data['userList'] = $this->db->order_by('name asc')->get('admin')->result_array();
        $data['user'] = $this->db->get_where('admin', ['emails' => $this->session->userdata("emails")])->row_array();
        $data['desa'] = $this->db->get("profil_desa")->result_array();
        

        $this->load->view('layouts/backend/main_layout', $data);
    }

    public function add()
    {
       
        $data['page'] = 'admin/user/add';
        $data['active'] = 'user';
        $data['admin'] = $this->db->get_where('admin', ["id_admin" => $id])->row_array();
        $data['user'] = $this->db->get_where('admin', ['emails' => $this->session->userdata("emails")])->row_array();
        $data['desa'] = $this->db->get("profil_desa")->result_array();
        $this->load->view('layouts/backend/main_layout', $data);

    }
    public function save()
    {
 
        // rules
        // params 1 (name), params 2 (alias), params 3 (rules nya)
        // rules is_unique digunakan untuk mengecek apakah email yg diinput sudah terdaftar di databse apa belum.
        $this->form_validation->set_rules('name', 'Name', 'required|trim');
        $this->form_validation->set_rules('emails', 'Emails', 'required|trim|valid_email|is_unique[admin.emails]', [
            'is_unique' => 'email sudah terdaftar'
        ]);
        $this->form_validation->set_rules('role', 'role', 'required|trim');
        $this->form_validation->set_rules('password1', 'Password', 'required|trim|min_length[6]|matches[password2]', [
            'matches' => 'Password tidak cocok!',
            'min_length' => 'Password terlalu pendek'
        ]);
        $this->form_validation->set_rules('password2', 'Password', 'required|trim|matches[password1]');

        if ($this->form_validation->run() == false) {
            // $data['title'] = 'Tambah User';
            // $data['page'] = 'admin/user/add';
            // $data['admin'] = $this->db->get_where('admin', ["id_admin" => $id])->row_array();
            // $data['user'] = $this->db->get_where('admin', ['emails' => $this->session->userdata("emails")])->row_array();
            // $data['desa'] = $this->db->get("profil_desa")->result_array();
            // $this->load->view('layouts/backend/auth_layout', $data);
            $data['page'] = 'admin/user/add';
            $data['active'] = 'user';
            $data['admin'] = $this->db->get_where('admin', ["id_admin" => $id])->row_array();
            $data['user'] = $this->db->get_where('admin', ['emails' => $this->session->userdata("emails")])->row_array();
            $data['desa'] = $this->db->get("profil_desa")->result_array();
            $this->load->view('layouts/backend/main_layout', $data);
        } else {
            // role_id 2 adalah default user sebagai member untuk administrtor role_id nya 2
            $data = [
                'name' => htmlspecialchars($this->input->post('name', true)),
                'emails' => htmlspecialchars($this->input->post('emails', true)),
                'role' => htmlspecialchars($this->input->post('role', true)),
                'image' => 'default.jpg',
                'password' => password_hash($this->input->post('password1'), PASSWORD_DEFAULT),
                'is_active' => 1,
                'created_at' => time()
            ];

            // insert ke database
            $this->db->insert('admin', $data);
            $this->session->set_flashdata('add', '<div class="alert alert-success text-center">Sukses menambah User</div>');
            redirect('admin/user/list');
        }
    }

    public function edit($id)
    {
        // $data['page'] = 'admin/user/edit';
        // $data['active'] = 'user';
        // $data['userList'] = $this->db->order_by('name asc')->get('admin')->result_array();
        $data['page'] = 'admin/user/edit';
        $data['active'] = 'user';
        $data['admin'] = $this->db->get_where('admin', ["id_admin" => $id])->row_array();
        $data['user'] = $this->db->get_where('admin', ['emails' => $this->session->userdata("emails")])->row_array();
        $data['desa'] = $this->db->get("profil_desa")->result_array();
        $this->load->view('layouts/backend/main_layout', $data);

    }

    public function editpassword($id)
    {
        // $data['page'] = 'admin/user/edit';
        // $data['active'] = 'user';
        // $data['userList'] = $this->db->order_by('name asc')->get('admin')->result_array();
        $data['page'] = 'admin/user/editpassword';
        $data['active'] = 'user';
        $data['admin'] = $this->db->get_where('admin', ["id_admin" => $id])->row_array();
        $data['user'] = $this->db->get_where('admin', ['emails' => $this->session->userdata("emails")])->row_array();
        $data['desa'] = $this->db->get("profil_desa")->result_array();
        $this->load->view('layouts/backend/main_layout', $data);

    }

    public function update($id)
    {
        
        $user = $this->db->get_where('admin', ['emails' => $this->session->userdata("emails")])->row_array();
       
        $where = ['id_admin' => $id];

      
            $data = [
                "name" => $this->input->post("name"),
                "emails" => $this->input->post("emails"),
                "role" => $this->input->post("role")
                // "id_admin" => $user['id_admin']
               
            ];
            $update = $this->db->update('admin', $data, $where);
    

        if ($update) {
            $this->session->set_flashdata('add', '<div class="alert alert-success text-center">Sukses ubah data</div>');
            redirect('admin/user/list');
        } else {
            $this->session->set_flashdata('add', '<div class="alert alert-danger text-center">Gagal ubah data</div>');
            redirect('admin/user/list');
        }
    }
    public function updatepassword($id)
    {
        
        $user = $this->db->get_where('admin', ['emails' => $this->session->userdata("emails")])->row_array();
       
        $where = ['id_admin' => $id];

        // $this->db->set('password',$password_hash);
        // $this->db->get_where('admin', ['emails' => $this->session->userdata('emails')])->row_array();
        // $this->db->update('admin');
      
            $data = [
                'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
                // "password" => $this->input->post->password_hash("password"),
                
                // $this->db->set('password',$password_hash)
                // "id_admin" => $user['id_admin']
               
            ];
            $update = $this->db->update('admin', $data, $where);
    

        if ($update) {
            $this->session->set_flashdata('add', '<div class="alert alert-success text-center">Sukses ubah data</div>');
            redirect('admin/user/list');
        } else {
            $this->session->set_flashdata('add', '<div class="alert alert-danger text-center">Gagal ubah data</div>');
            redirect('admin/user/list');
        }
    }

    
    public function deletelist($id)
    {
        $delete = $this->db->delete('admin', ["id_admin" => $id]);
        if ($delete) {
            $this->session->set_flashdata('add', '<div class="alert alert-success text-center">Sukses hapus data</div>');
            redirect('admin/user/list');
        } else {
            $this->session->set_flashdata('add', '<div class="alert alert-danger text-center">Gagal hapus data</div>');
            redirect('admin/user/list');
        }
    }
}




// public function updatepassword($id)
//     {
        
//         $user = $this->db->get_where('admin', ['emails' => $this->session->userdata("emails")])->row_array();
       
//         $where = ['id_admin' => $id];

      
//             $data = [
//                 $password = $this->input->post('password');
//                 $password_hash = password_hash($password, PASSWORD_DEFAULT);
//                 $this->db->set('password',$password_hash);

               
//             ];
//             $update = $this->db->update('admin', $data, $where);
    

//         if ($update) {
//             $this->session->set_flashdata('add', '<div class="alert alert-success text-center">Sukses ubah data</div>');
//             redirect('admin/user/list');
//         } else {
//             $this->session->set_flashdata('add', '<div class="alert alert-danger text-center">Gagal ubah data</div>');
//             redirect('admin/user/list');
//         }
//     }

