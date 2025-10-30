<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Seo_model extends CI_Model {

    private $table = 'seo_settings';

    public function get_settings() {
        return $this->db->get($this->table)->row_array();
    }

    public function get_all_keys() {
        return $this->db->where('deleted_at', null)->order_by('id','DESC')->get($this->table)->result_array();
    }

    public function get_key($id) {
        return $this->db->where('id', $id)->where('deleted_at', null)->get($this->table)->row_array();
    }

    public function add_key($cse_id, $api_key) {
        return $this->db->insert($this->table, [
            'cse_id' => $cse_id,
            'api_key' => $api_key,
            'created_at' => date('Y-m-d H:i:s')
        ]);
    }

    public function update_key($id, $cse_id, $api_key) {
        return $this->db->where('id', $id)->update($this->table, [
            'cse_id' => $cse_id,
            'api_key' => $api_key,
            'updated_at' => date('Y-m-d H:i:s')
        ]);
    }

    public function soft_delete($id) {
        return $this->db->where('id', $id)->update($this->table, [
            'deleted_at' => date('Y-m-d H:i:s')
        ]);
    }
}
