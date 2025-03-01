<?php
// Archivo: application/config/environment.php

defined('BASEPATH') or exit('No direct script access allowed');

error_log('Iniciando carga de Environment.php');

/**
 * Carga variables de entorno desde .env
 */
class Environment
{
    private static $env_vars = [];
    private static $loaded = false;

    /**
     * Carga variables de entorno desde el archivo .env
     */
    public static function load($path = null)
    {
        error_log('Environment::load() llamado');

        if (self::$loaded) {
            error_log('Environment ya cargado, devolviendo variables en caché');
            return self::$env_vars;
        }

        if ($path === null) {
            $path = FCPATH . '.env';
            error_log('Usando ruta por defecto para .env: ' . $path);
        }

        self::$env_vars = self::parse_env_file($path);
        self::$loaded = true;
        error_log('Variables cargadas desde .env: ' . count(self::$env_vars));

        return self::$env_vars;
    }

    /**
     * Parsea el archivo .env
     */
    private static function parse_env_file($path)
    {
        error_log('Parseando archivo .env: ' . $path);
        $env_vars = [];

        if (file_exists($path)) {
            error_log('Archivo .env encontrado');

            // Verificar permisos
            $perms = fileperms($path);
            $perms_str = sprintf('%o', $perms);
            error_log('Permisos del archivo .env: ' . $perms_str);

            // Verificar si es legible
            if (is_readable($path)) {
                error_log('Archivo .env es legible');
            } else {
                error_log('ERROR: Archivo .env no es legible');
            }

            try {
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
                        error_log("Variable cargada: $name");
                    }
                }
            } catch (Exception $e) {
                error_log('ERROR al leer el archivo .env: ' . $e->getMessage());
            }
        } else {
            error_log('ERROR: Archivo .env no existe en: ' . $path);
        }

        return $env_vars;
    }

    /**
     * Obtiene un valor de entorno
     */
    public static function get($key, $default = null)
    {
        if (!self::$loaded) {
            error_log('Environment no cargado, cargando ahora...');
            self::load();
        }

        $value = isset(self::$env_vars[$key]) && self::$env_vars[$key] !== ''
            ? self::$env_vars[$key]
            : $default;

        error_log("Obteniendo variable $key: " . ($value === $default ? "[valor por defecto]" : "[valor del .env]"));

        return $value;
    }
}

// Carga las variables al iniciar
error_log('Ejecutando Environment::load() inicial');
Environment::load();

// Función de ayuda para acceder fácilmente a las variables
if (!function_exists('env')) {
    error_log('Definiendo función env() desde environment.php');
    function env($key, $default = null)
    {
        return Environment::get($key, $default);
    }
} else {
    error_log('ADVERTENCIA: La función env() ya estaba definida');
}

error_log('Carga de Environment.php completada');
