<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('User_model');
        $this->load->library('session');
    }

    public function index() {
        if ($this->session->userdata('user_id')) {
            redirect('admin');
        }
        $this->load->view('home');
    }

    public function login() {
        $username = $this->input->post('username');
        $password = $this->input->post('password');

        $user = $this->User_model->get_user($username);

        if ($user && password_verify($password, $user['password'])) {
        $this->session->set_userdata('user', $user);
            redirect('admin/admin_dashboard');
        } else {
            $this->session->set_flashdata('error', 'Sai tên đăng nhập hoặc mật khẩu!');
            redirect('home');
        }
    }

    public function register() {
        $data = [
            'username' => $this->input->post('username'),
            'email' => $this->input->post('email'),
            'password' => password_hash($this->input->post('password'), PASSWORD_BCRYPT),
        ];

        $this->User_model->register($data);
        $this->session->set_flashdata('success', 'Đăng ký thành công! Hãy đăng nhập.');
        redirect('home');
    }

    public function logout() {
        $this->session->sess_destroy();
        redirect('home');
    }
}
