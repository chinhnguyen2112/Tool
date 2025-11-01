<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

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

    public function export_excel() {
        $statusData = json_decode($this->input->post('status_data'), true);
        if (empty($statusData)) {
            show_error('Không có dữ liệu để xuất Excel.');
        }
        header("Content-Type: application/vnd.ms-excel; charset=utf-8");
        header("Content-Disposition: attachment; filename=check_index_google_" . date('Ymd_His') . ".xlsx");
        header("Pragma: no-cache");
        header("Expires: 0");

        echo '<table border="1">';
        echo '<tr style="background-color:#f2f2f2;">';
        echo '<th>STT</th>';
        echo '<th>URL</th>';
        echo '<th>Trạng thái</th>';
        echo '</tr>';

        $stt = 1;
        foreach ($statusData as $item) {
            echo '<tr>';
            echo '<td>' . $stt++ . '</td>';
            echo '<td><a href="' . htmlspecialchars($item['url']) . '">' . htmlspecialchars($item['url']) . '</a></td>';
            echo '<td>' . htmlspecialchars($item['status']) . '</td>';
            echo '</tr>';
        }
        echo '</table>';
        exit;
    }
}