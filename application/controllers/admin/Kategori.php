<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Kategori extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        is_logged_in();
    }

    public function index()
    {
        $data['page'] = 'admin/kategori/index';
        $data['active'] = 'kategori';
        $data['kategori'] = $this->db->order_by('kategori asc')->get('kategori')->result_array();
        $data['user'] = $this->db->get_where('admin', ['emails' => $this->session->userdata("emails")])->row_array();
        $data['desa'] = $this->db->get("profil_desa")->result_array();
        

        $this->load->view('layouts/backend/main_layout', $data);
    }

    public function add()
    {
        $data['page'] = 'admin/kategori/add';
        $data['active'] = 'kategori';
        $data['kategori'] = $this->db->order_by('kategori asc')->get('kategori')->result_array();
        $data['user'] = $this->db->get_where('admin', ['emails' => $this->session->userdata("emails")])->row_array();
        $data['desa'] = $this->db->get("profil_desa")->result_array();
        $this->load->view('layouts/backend/main_layout', $data);
    }

    public function save()
    {
        $user = $this->db->get_where('admin', ['emails' => $this->session->userdata("emails")])->row_array();
        
        $data = array(
            "kategori" => $this->input->post("kategori"),
            "id_admin" => $user['id_admin']
        );

        $insert = $this->db->insert('kategori', $data);
        if ($insert) {
            $this->session->set_flashdata('add', '<div class="alert alert-success text-center">Sukses menambah data</div>');
            redirect('admin/kategori');
        } else {
            $this->session->set_flashdata('add', '<div class="alert alert-danger text-center">Gagal menambah data</div>');
            redirect('admin/kategori');
        }
    }

    public function edit($id)
    {
        $data['page'] = 'admin/kategori/edit';
        $data['active'] = 'kategori';
        $data['kategori'] =$this->db->get_where('kategori', ["kategori_id" => $id])->row_array();
        $data['user'] = $this->db->get_where('admin', ['emails' => $this->session->userdata("emails")])->row_array();
        $data['desa'] = $this->db->get("profil_desa")->result_array();
        $this->load->view('layouts/backend/main_layout', $data);

    }

    public function update($id)
    {
        
        // $user = $this->db->get_where('admin', ['emails' => $this->session->userdata("emails")])->row_array();
       
        $where = ['kategori_id' => $id];

      
            $data = [
                "kategori" => $this->input->post("kategori"),
                // "id_admin" => $user['id_admin']
               
            ];
            $update = $this->db->update('kategori', $data, $where);
    

        if ($update) {
            $this->session->set_flashdata('add', '<div class="alert alert-success text-center">Sukses ubah data</div>');
            redirect('admin/kategori');
        } else {
            $this->session->set_flashdata('add', '<div class="alert alert-danger text-center">Gagal ubah data</div>');
            redirect('admin/kategori');
        }
    }

    public function delete($id)
    {
        $delete = $this->db->delete('kategori', ["kategori_id" => $id]);
        if ($delete) {
            $this->session->set_flashdata('add', '<div class="alert alert-success text-center">Sukses hapus data</div>');
            redirect('admin/kategori');
        } else {
            $this->session->set_flashdata('add', '<div class="alert alert-danger text-center">Gagal hapus data</div>');
            redirect('admin/kategori');
        }
    }
}