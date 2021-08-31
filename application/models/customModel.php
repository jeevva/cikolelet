<?php
defined('BASEPATH') or exit('No direct script access allowed');
class customModel extends CI_model
{

    public function get_by_kategori()
    {
        // $this->db->select('
        // jenis.jenis_id,jenis.nama, kategori.kategori_id AS id_kategori, kategori.kategori AS nama_kategori, jenis.id_admin
        // ');
        $this->db->select('
        jenis.jenis_id,jenis.nama, jenis.kategori_id , kategori.kategori , jenis.id_admin
        ');
        $this->db->join('kategori', 'jenis.kategori_id = kategori.kategori_id');
        $this->db->from('jenis');
        $query = $this->db->get();
        return $query->result();
        

        // $this->db->select('jenis.jenis_id,jenis.nama, jenis.kategori_id,kategori.kategori, jenis.id_admin');
        // $this->db->from('jenis');
        // $this->db->join('kategori','kategori.kategori_id = jenis.kategori_id');      
        // $query = $this->db->get();
        // return $query;

        // $this->db->select('*');
        // $this->db->from('jenis');
        // $this->db->join('kategori','kategori.kategori_id = jenis.kategori_id');      
        // $query = $this->db->get();
        // return $query;

       
    }
   
}
