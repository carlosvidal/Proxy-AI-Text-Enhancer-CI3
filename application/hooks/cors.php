<?php
defined('BASEPATH') or exit('No direct script access allowed');

function handle_cors()
{
    // Obtener la instancia de CI
    $CI = &get_instance();

    // Cargar configuración de CORS
    $CI->config->load('llm_proxy', TRUE);
    $allowed_origins = $CI->config->item('allowed_origins', 'llm_proxy');

    // Obtener el origen de la solicitud
    $origin = isset($_SERVER['HTTP_ORIGIN']) ? $_SERVER['HTTP_ORIGIN'] : '';

    // Verificar si el origen está permitido
    if ($allowed_origins === '*') {
        header('Access-Control-Allow-Origin: *');
    } elseif (is_array($allowed_origins) && in_array($origin, $allowed_origins)) {
        header("Access-Control-Allow-Origin: $origin");
    }

    // Headers comunes
    header('Access-Control-Allow-Methods: GET, POST, OPTIONS');
    header('Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With');
    header('Access-Control-Max-Age: 86400');

    // Para solicitudes OPTIONS, terminar aquí
    if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
        header('Content-Type: text/plain');
        header('Content-Length: 0');
        header('HTTP/1.1 200 OK');
        exit();
    }
}
