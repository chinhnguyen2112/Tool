<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model {

    // Lấy user theo username (dùng cho login)
    public function get_user($username) {
        return $this->db->get_where('users', [
            'username' => $username,
            'deleted' => 0
        ])->row_array();
    }

    // Lấy user theo ID (dùng cho edit)
    public function get_user_by_id($id) {
        return $this->db->get_where('users', [
            'id' => $id,
            'deleted' => 0
        ])->row_array();
    }

    // Lấy tất cả user (chỉ lấy chưa xóa)
    public function get_all_users() {
        return $this->db->get_where('users', ['deleted' => 0])->result_array();
    }

    // Thêm user mới
    public function insert_user($data) {
        return $this->db->insert('users', $data);
    }

    // Cập nhật user
    public function update_user($id, $data) {
        $this->db->where('id', $id);
        return $this->db->update('users', $data);
    }

    // Soft delete: chỉ đánh dấu deleted = 1
    public function soft_delete_user($id) {
        return $this->db->update('users', ['deleted' => 1], ['id' => $id]);
    }

    // (Tùy chọn) Khôi phục user
    public function restore_user($id) {
        return $this->db->update('users', ['deleted' => 0], ['id' => $id]);
    }
}