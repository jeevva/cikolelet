<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Jenis extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model(array('customModel'));
        $this->load->library('form_validation');
        is_logged_in();
    }

    public function index()
    {
        $data['page'] = 'admin/jenis/index';
        $data['active'] = 'jenis';
        $data['jenis'] = $this->db->order_by('nama asc')->get('jenis')->result_array();
        $data['dataJenis'] = $this->customModel->get_by_kategori();
        // $data['jenis'] = $this->customModel->join_jenis_kategori();
        $data['kategori'] = $this->db->get("kategori")->result_array();
        $data['user'] = $this->db->get_where('admin', ['emails' => $this->session->userdata("emails")])->row_array();
         $data['desa'] = $this->db->get("profil_desa")->result_array();
        

        $this->load->view('layouts/backend/main_layout', $data);
    }

    public function add()
    {
        $data['page'] = 'admin/jenis/add';
        $data['active'] = 'jenis';
        $data['user'] = $this->db->get_where('admin', ['emails' => $this->session->userdata("emails")])->row_array();
        $data['kategori'] = $this->db->order_by('kategori' , 'ASC')->get("kategori")->result_array();
        $data['desa'] = $this->db->get("profil_desa")->result_array();
        $this->load->view('layouts/backend/main_layout', $data);
    }

    public function save()
    {
        $user = $this->db->get_where('admin', ['emails' => $this->session->userdata("emails")])->row_array();
        
        $data = array(
            "nama" => $this->input->post("nama"),
            "kategori_id" => $this->input->post("kategori_id"),
            "id_admin" => $user['id_admin']
        );

        $insert = $this->db->insert('jenis', $data);
        if ($insert) {
            $this->session->set_flashdata('add', '<div class="alert alert-success text-center">Sukses menambah data</div>');
            redirect('admin/jenis');
        } else {
            $this->session->set_flashdata('add', '<div class="alert alert-danger text-center">Gagal menambah data</div>');
            redirect('admin/jenis');
        }
    }

    public function edit($id)
    {
        $data['page'] = 'admin/jenis/edit';
        $data['active'] = 'jenis';
        $data['jenis'] = $this->db->get_where('jenis', ["jenis_id" => $id])->row_array();
        $data['user'] = $this->db->get_where('admin', ['emails' => $this->session->userdata("emails")])->row_array();
        $data['dataJenis'] = $this->customModel->get_by_kategori();
        $data['kategori'] = $this->db->order_by('kategori' , 'ASC')->get("kategori")->result_array();
        $data['desa'] = $this->db->get("profil_desa")->result_array();
        $this->load->view('layouts/backend/main_layout', $data);

    }

    public function update($id)
    {
        
        // $user = $this->db->get_where('admin', ['emails' => $this->session->userdata("emails")])->row_array();
       
        $where = ['jenis_id' => $id];

      
            $data = [
                "nama" => $this->input->post("nama"),
                "kategori_id" => $this->input->post("kategori_id"),
                // "id_admin" => $user['id_admin']
               
            ];
            $update = $this->db->update('jenis', $data, $where);
    

        if ($update) {
            $this->session->set_flashdata('add', '<div class="alert alert-success text-center">Sukses ubah data</div>');
            redirect('admin/jenis');
        } else {
            $this->session->set_flashdata('add', '<div class="alert alert-danger text-center">Gagal ubah data</div>');
            redirect('admin/jenis');
        }
    }

    public function delete($id)
    {
        $delete = $this->db->delete('jenis', ["jenis_id" => $id]);
        if ($delete) {
            $this->session->set_flashdata('add', '<div class="alert alert-success text-center">Sukses hapus data</div>');
            redirect('admin/jenis');
        } else {
            $this->session->set_flashdata('add', '<div class="alert alert-danger text-center">Gagal hapus data</div>');
            redirect('admin/jenis');
        }
    }
}