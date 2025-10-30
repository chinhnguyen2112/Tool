<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ManualIndexCheck extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper(['url', 'form']);
    }

    public function index() {
        $data = [];

        if ($this->input->post('urls')) {
            $raw_urls = preg_split('/\r\n|\r|\n/', $this->input->post('urls'));
            $raw_urls = array_map('trim', $raw_urls);
            $raw_urls = array_filter($raw_urls);

            $urls = [];
            foreach ($raw_urls as $url) {
                if (empty($url)) continue;

                $decoded = urldecode($url);
         
                $cleaned = preg_replace('/\?/', ' ', $decoded);
     
                $key = strtolower(preg_replace('#^https?://#i', '', $cleaned));
                $key = rtrim($key, '/');

                $urls[] = [
                    'original' => $decoded,
                    'key'      => $key
                ];
            }

            $data['urls'] = $urls;
        }

        $this->load->view('admin/template/header', $data);
        $this->load->view('admin/template/sidebar');
        $this->load->view('admin/seo/manual_index_check', $data);
        $this->load->view('admin/template/footer');
    }
}