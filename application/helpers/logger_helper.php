<?php
// application/helpers/logger_helper.php
defined('BASEPATH') or exit('No direct script access allowed');

if (!function_exists('log_custom')) {
    function log_custom($level, $section, $message, $data = null)
    {
        $CI = &get_instance();

        $log_message = "[{$section}] {$message}";

        if ($data !== null) {
            if (is_array($data) || is_object($data)) {
                $log_message .= " | Data: " . json_encode($data, JSON_UNESCAPED_UNICODE);
            } else {
                $log_message .= " | Data: {$data}";
            }
        }

        // Añadir información de la petición
        $request_info = [
            'IP' => $CI->input->ip_address(),
            'Method' => $CI->input->method(),
            'URL' => current_url(),
            'User Agent' => $CI->input->user_agent(),
        ];

        $log_message .= " | Request: " . json_encode($request_info, JSON_UNESCAPED_UNICODE);

        log_message($level, $log_message);
        return true;
    }
}

if (!function_exists('log_debug')) {
    function log_debug($section, $message, $data = null)
    {
        return log_custom('debug', $section, $message, $data);
    }
}

if (!function_exists('log_info')) {
    function log_info($section, $message, $data = null)
    {
        return log_custom('info', $section, $message, $data);
    }
}

if (!function_exists('log_error')) {
    function log_error($section, $message, $data = null)
    {
        return log_custom('error', $section, $message, $data);
    }
}

if (!function_exists('log_warning')) {
    function log_warning($section, $message, $data = null)
    {
        return log_custom('debug', $section, $message, $data);
    }
}
