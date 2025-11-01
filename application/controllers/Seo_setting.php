<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Seo_setting extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('session');
        $this->load->model('Seo_model');

        if (!$this->session->userdata('logged_in')) {
            redirect('home');
        }
    }

    public function index($edit_id = null) {
        $data['title'] = 'Cấu hình Google CSE API';
        $data['all_keys'] = $this->Seo_model->get_all_keys();
        $data['edit_key'] = $edit_id ? $this->Seo_model->get_key($edit_id) : null;
        $data['success'] = $this->session->flashdata('success');

        $this->load->view('admin/template/header', $data);
        $this->load->view('admin/template/sidebar');
        $this->load->view('admin/seo/settings', $data);
        $this->load->view('admin/template/footer');
    }

    public function save() {
        $id = $this->input->post('id', true);
        $cse_id = $this->input->post('cse_id', true);
        $api_key = $this->input->post('api_key', true);

        if ($id) {
            $this->Seo_model->update_key($id, $cse_id, $api_key);
            $this->session->set_flashdata('success', 'Cập nhật key thành công!');
        } else {
            $this->Seo_model->add_key($cse_id, $api_key);
            $this->session->set_flashdata('success', 'Thêm key thành công!');
        }
        redirect('seo_setting');
    }

    public function delete($id) {
        $this->Seo_model->soft_delete($id);
        $this->session->set_flashdata('success', 'Xóa key thành công!');
        redirect('seo_setting');
    }
}
