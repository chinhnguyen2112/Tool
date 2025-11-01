<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    // Lấy user theo username (dùng cho login)
    public function get_user($username) {
        $this->db->where('username', $username);
        $this->db->where('deleted', 0);
        return $this->db->get('users')->row_array();
    }

    // Lấy user theo ID
    public function get_user_by_id($id) {
        $this->db->where('id', $id);
        $this->db->where('deleted', 0);
        return $this->db->get('users')->row_array();
    }

    // Lấy tất cả user (chưa xóa)
    public function get_all_users() {
        $this->db->where('deleted', 0);
        return $this->db->get('users')->result_array();
    }

    // Thêm user mới (dùng cho register)
    public function insert_user($data) {
        return $this->db->insert('users', $data);
    }

    // Cập nhật user
    public function update_user($id, $data) {
        $this->db->where('id', $id);
        return $this->db->update('users', $data);
    }

    // Xóa mềm
    public function soft_delete_user($id) {
        return $this->db->update('users', ['deleted' => 1], ['id' => $id]);
    }

    // Khôi phục
    public function restore_user($id) {
        return $this->db->update('users', ['deleted' => 0], ['id' => $id]);
    }
}