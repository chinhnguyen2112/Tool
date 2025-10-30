<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Seo extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('session');
        $this->load->model('Seo_model');

        if (!$this->session->userdata('user')) {
            redirect('home');
        }
    }

    public function check_index() {
        $data['title'] = 'Tool Check Index SEO (Google CSE API)';
        $data['results'] = [];

        if ($this->input->post('urls')) {
            $urls = array_filter(array_map('trim', explode("\n", trim($this->input->post('urls')))));
            $results = [];

            foreach ($urls as $url) {
                if (!$url) continue;

                if (!preg_match('#^https?://#i', $url)) {
                    $url = 'https://' . $url;
                }
                $url = rtrim($url, '/');

                $indexed = $this->checkWithGoogleCSE($url);

                $results[] = [
                    'url' => $url,
                    'status' => $indexed ? 'Indexed' : 'Not Indexed'
                ];

                usleep(750000);
            }

            $data['results'] = $results;
        }

        $this->load->view('admin/template/header', $data);
        $this->load->view('admin/template/sidebar');
        $this->load->view('admin/seo/check_index', $data);
        $this->load->view('admin/template/footer');
    }

    private function checkWithGoogleCSE($url) {
        $settings = $this->Seo_model->get_settings();

        if (empty($settings['cse_id']) || empty($settings['api_key'])) {
            return false;
        }

        $query = 'info:' . $url;
        $apiUrl = "https://www.googleapis.com/customsearch/v1";

        $params = [
            'key' => $settings['api_key'],   
            'cx'  => $settings['cse_id'],  
            'q'   => $query,
            'num' => 1
        ];

        $url = $apiUrl . '?' . http_build_query($params);

        $ch = curl_init();
        curl_setopt_array($ch, [
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_SSL_VERIFYPEER => true,
            CURLOPT_USERAGENT => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36'
        ]);

        $response = curl_exec($ch);
        $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        if ($http_code !== 200) {
            return false;
        }

        $data = json_decode($response, true);
        return !empty($data['items']);
    }

    public function export_excel() {
        $this->load->library('session');

        $urls = $this->input->post('urls');
        $status = $this->input->post('status');

        if (empty($urls) || empty($status) || count($urls) != count($status)) {
            show_error('Không có dữ liệu để xuất Excel.');
        }
        require 'vendor/autoload.php';

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setTitle('Check Index');
        $sheet->setCellValue('A1', 'URL');
        $sheet->setCellValue('B1', 'Trạng thái');

        $row = 2;
        for ($i = 0; $i < count($urls); $i++) {
            $sheet->setCellValue('A' . $row, $urls[$i]);
            $sheet->setCellValue('B' . $row, $status[$i]);
            $row++;
        }

        $filename = 'check_index_' . date('Ymd_His') . '.xlsx';

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="'. $filename .'"');
        header('Cache-Control: max-age=0');

        $writer = new Xlsx($spreadsheet);
        $writer->save('php://output');
        exit;
    }
}
