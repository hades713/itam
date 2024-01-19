<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Model_assets extends CI_Model {
    
    public function get_all_assets() {
        $query = $this->db->get('assets');
        return $query->result();
    }
    
    public function save_asset($data) {
        $this->db->insert('assets', $data);
        return $this->db->insert_id();
    }

    public function update_asset($id, $data) {
        $this->db->where('id', $id);
        $this->db->update('assets', $data);
    }
    
    public function update_footprint($id, $data) {
        $this->db->where('id', $id);
        $this->db->update('footprint', $data);
    }

    public function get_asset($id) {
        $this->db->where('id', $id);
        $query = $this->db->get('assets');
        return $query->row();
    }

    public function get_total_records() {
        return $this->db->count_all('assets');
    }

    public function get_distinct_values($column) {
        $this->db->distinct();
        $this->db->select($column);
        $this->db->order_by($column);
        $query = $this->db->get('assets');
        return $query->result();
    }

    public function get_footprints($id) {
        $this->db->where('asset_id', $id);
        $this->db->order_by('action_date', 'DESC');
        $query = $this->db->get('footprint');
        return $query->result();
    }
}