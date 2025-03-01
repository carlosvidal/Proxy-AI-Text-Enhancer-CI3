<?php
// Modificaciones para llm_proxy.php
defined('BASEPATH') or exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| LLM Proxy Configuration
|--------------------------------------------------------------------------
|
| Este archivo contiene la configuración para el proxy de LLM
|
*/

// Registrar al inicio del archivo
error_log('Iniciando carga de configuración LLM Proxy');

// Cargar la clase Environment
$environment_path = APPPATH . 'config/environment.php';
error_log('Intentando cargar environment.php desde: ' . $environment_path);

if (file_exists($environment_path)) {
    require_once $environment_path;
    error_log('Archivo environment.php cargado correctamente');
} else {
    error_log('ERROR: No se pudo encontrar el archivo environment.php');
    // Implementación de respaldo si no se encuentra environment.php
    function parse_env_file($path)
    {
        error_log('Usando función de respaldo parse_env_file()');
        $env_vars = [];

        if (file_exists($path)) {
            error_log('Archivo .env encontrado en: ' . $path);
            $lines = file($path, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
            error_log('Total de líneas en .env: ' . count($lines));

            foreach ($lines as $line) {
                // Ignorar comentarios
                if (strpos(trim($line), '#') === 0) {
                    continue;
                }

                // Solo procesar líneas que parecen variables de entorno
                if (strpos($line, '=') !== false) {
                    list($name, $value) = explode('=', $line, 2);
                    $name = trim($name);
                    $value = trim($value);

                    // Eliminar comillas si existen
                    if (strpos($value, '"') === 0 && strrpos($value, '"') === strlen($value) - 1) {
                        $value = substr($value, 1, -1);
                    } elseif (strpos($value, "'") === 0 && strrpos($value, "'") === strlen($value) - 1) {
                        $value = substr($value, 1, -1);
                    }

                    $env_vars[$name] = $value;
                }
            }
        } else {
            error_log('ERROR: Archivo .env no encontrado en: ' . $path);
        }

        return $env_vars;
    }

    // Cargar variables de entorno desde .env
    $env_file = FCPATH . '.env';
    error_log('Buscando archivo .env en: ' . $env_file);
    $env_vars = parse_env_file($env_file);
    error_log('Variables cargadas desde .env: ' . count($env_vars));

    // Función para obtener variables de entorno con fallback
    if (!function_exists('env')) {
        function env($key, $default = null)
        {
            global $env_vars;
            $value = isset($env_vars[$key]) && $env_vars[$key] !== '' ? $env_vars[$key] : $default;
            error_log("Variable $key = " . ($value === $default ? "[valor por defecto]" : "[valor del .env]"));
            return $value;
        }
    }
}

// Verificar si la función env() existe después de cargar environment.php
if (function_exists('env')) {
    error_log('Función env() disponible');
} else {
    error_log('ERROR: Función env() no disponible');
}

// API Keys para diferentes proveedores
$config['openai_api_key'] = env('OPENAI_API_KEY', '');
error_log('OpenAI API Key configurada: ' . (empty($config['openai_api_key']) ? 'NO' : 'SÍ'));

$config['anthropic_api_key'] = env('ANTHROPIC_API_KEY', '');
$config['deepseek_api_key'] = env('DEEPSEEK_API_KEY', '');
$config['cohere_api_key'] = env('COHERE_API_KEY', '');
$config['google_api_key'] = env('GOOGLE_API_KEY', '');
$config['mistral_api_key'] = env('MISTRAL_API_KEY', '');

// Configuración CORS
$allowed_origins_str = env('ALLOWED_ORIGINS', 'http://127.0.0.1:5500,http://localhost:5500');
$config['allowed_origins'] = $allowed_origins_str === '*' ? '*' : explode(',', $allowed_origins_str);
error_log('Orígenes permitidos: ' . $allowed_origins_str);

// Configuración de cuotas y límites
$config['default_quota'] = (int)env('DEFAULT_QUOTA', 100);
$config['rate_limit_requests'] = (int)env('RATE_LIMIT_REQUESTS', 10);
$config['rate_limit_window'] = (int)env('RATE_LIMIT_WINDOW', 60);

// Configuración de caché
$config['cache_enabled'] = (bool)env('CACHE_ENABLED', TRUE);
$config['cache_lifetime'] = (int)env('CACHE_LIFETIME', 3600);

// Clave de instalación (para migraciones)
$config['install_key'] = env('INSTALL_KEY', 'your-secure-key');

$config['use_simulated_responses'] = (bool)env('USE_SIMULATED_RESPONSES', false);

error_log('Configuración de LLM Proxy cargada completamente');
