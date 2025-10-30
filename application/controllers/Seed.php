<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Seed extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function users() {
        $password = password_hash('123456', PASSWORD_BCRYPT);

        $data = [
            'username' => 'admin',
            'password' => $password,
            'email'    => 'admin@example.com',
        ];

        // Kiểm tra nếu chưa có user này thì mới insert
        $exists = $this->db->get_where('users', ['username' => 'admin'])->row();
        if (!$exists) {
            $this->db->insert('users', $data);
            echo "Đã tạo tài khoản admin (user: admin / pass: 123456)";
        } else {
            echo "Tài khoản admin đã tồn tại!";
        }
    }
}
