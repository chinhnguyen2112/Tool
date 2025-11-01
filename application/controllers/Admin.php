<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('session');
        $this->load->model('User_model');

        // if (!$this->session->userdata('logged_in')) {
        //     redirect('home');
        // }
        if (!$this->session->userdata('logged_in')) {
            redirect('auth/login'); // ĐÚNG: về auth/login
        }
    }
    public function admin_dashboard() {
        // $user = $this->session->userdata('user');
        $user = $this->session->userdata('logged_in');
        $data['username'] = $user['username'];
        $data['title'] = 'Dashboard';
        $this->load->view('admin/template/header', $data);
        $this->load->view('admin/template/sidebar');
        $this->load->view('admin/admin_dashboard');
        $this->load->view('admin/template/footer');
    }

    public function users() {
        $data['title'] = 'Quản lý người dùng';
        $data['users'] = $this->User_model->get_all_users(); // Soft delete filter

        $this->load->view('admin/template/header', $data);
        $this->load->view('admin/template/sidebar');
        $this->load->view('admin/users/list', $data);
        $this->load->view('admin/template/footer');
    }

    public function add_user() {
        if ($this->input->post()) {
            $data = [
                'username' => $this->input->post('username'),
                'email'    => $this->input->post('email'),
                'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
                'role'     => $this->input->post('role'),
                'deleted'  => 0
            ];
            $this->User_model->insert_user($data);
            $this->session->set_flashdata('success', 'Thêm người dùng thành công!');
            redirect('admin/users');
        }

        $data['title'] = 'Thêm người dùng';
        $this->load->view('admin/template/header', $data);
        $this->load->view('admin/template/sidebar');
        $this->load->view('admin/users/add');
        $this->load->view('admin/template/footer');
    }

    public function edit_user($id) {
        $user = $this->User_model->get_user_by_id($id);
        if (!$user || $user['deleted']) {
            show_404();
        }

        if ($this->input->post()) {
            $update = [
                'username' => $this->input->post('username'),
                'email'    => $this->input->post('email'),
                'role'     => $this->input->post('role')
            ];
            if ($this->input->post('password')) {
                $update['password'] = password_hash($this->input->post('password'), PASSWORD_DEFAULT);
            }
            $this->User_model->update_user($id, $update);
            $this->session->set_flashdata('success', 'Cập nhật thành công!');
            redirect('admin/users');
        }

        $data['title'] = 'Sửa người dùng';
        $data['user'] = $user;

        $this->load->view('admin/template/header', $data);
        $this->load->view('admin/template/sidebar');
        $this->load->view('admin/users/edit', $data);
        $this->load->view('admin/template/footer');
    }

    public function delete_user($id) {
        $this->User_model->soft_delete_user($id);
        $this->session->set_flashdata('success', 'Xóa người dùng thành công!');
        redirect('admin/users');
    }

    public function logout() {
        $this->session->unset_userdata('user');
        $this->session->sess_destroy();
        redirect('home');
    }
}