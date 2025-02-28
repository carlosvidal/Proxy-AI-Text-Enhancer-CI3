<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Cors_test extends CI_Controller
{
    public function index()
    {
        header('Access-Control-Allow-Origin: *');
        echo json_encode(['status' => 'ok']);
    }

    public function options()
    {
        header('Access-Control-Allow-Origin: *');
        header('Access-Control-Allow-Methods: GET, POST, OPTIONS');
        header('Access-Control-Allow-Headers: Content-Type, Authorization');
        header('HTTP/1.1 200 OK');
        exit;
    }
}
