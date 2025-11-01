<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('User_model');
        $this->load->library(['session', 'form_validation']);
        $this->load->helper(['url', 'form']);
    }

    public function index() {
        if ($this->session->userdata('logged_in')) {
            redirect('admin');
        }
        redirect('auth/login');
    }

    public function login() {
        $this->load->view('auth/login');
    }

    public function do_login() {
        $this->form_validation->set_rules('username', 'Tên đăng nhập', 'required|trim');
        $this->form_validation->set_rules('password', 'Mật khẩu', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('error', validation_errors());
            redirect('auth/login');
        }

        $username = $this->input->post('username');
        $password = $this->input->post('password');
        $user = $this->User_model->get_user($username);

        if ($user && password_verify($password, $user['password'])) {
            $sess_data = [
                'user_id'   => $user['id'],
                'username'  => $user['username'],
                'email'     => $user['email'],
                'role'      => $user['role'],
                'logged_in' => TRUE
            ];
            $this->session->set_userdata(['logged_in' => $sess_data]);
            redirect('admin'); // Dùng route admin
        } else {
            $this->session->set_flashdata('error', 'Tên đăng nhập hoặc mật khẩu không đúng!');
            redirect('auth/login');
        }
    }

    public function register() {
        $this->load->view('auth/register');
    }

    public function do_register() {
        $this->form_validation->set_rules('username', 'Tên đăng nhập', 
            'required|min_length[4]|max_length[20]|is_unique[users.username]|regex_match[/^[a-zA-Z0-9_]+$/]', [
                'is_unique' => 'Tên đăng nhập đã tồn tại.',
                'regex_match' => 'Chỉ dùng chữ, số và gạch dưới.'
            ]);
        $this->form_validation->set_rules('email', 'Email', 
            'required|valid_email|is_unique[users.email]', [
                'is_unique' => 'Email đã được sử dụng.'
            ]);
        $this->form_validation->set_rules('password', 'Mật khẩu', 
            'required|min_length[6]');

        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('error', validation_errors());
            redirect('auth/register');
        }

        $data = [
            'username'   => $this->input->post('username'),
            'email'      => $this->input->post('email'),
            'password'   => password_hash($this->input->post('password'), PASSWORD_BCRYPT),
            'role'       => 'user',
            'deleted'    => 0,
            'created_at' => date('Y-m-d H:i:s')
        ];

        if ($this->User_model->insert_user($data)) {
            $this->session->set_flashdata('success', 'Đăng ký thành công! Vui lòng đăng nhập.');
            redirect('auth/login');
        } else {
            $this->session->set_flashdata('error', 'Đăng ký thất bại. Vui lòng thử lại.');
            redirect('auth/register');
        }
    }

    public function logout() {
        $this->session->sess_destroy();
        redirect('auth/login');
    }
}