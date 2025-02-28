<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Controlador de Migración
 * 
 * Permite ejecutar migraciones a través de una URL
 * Guardar en: application/controllers/Migrate.php
 */
class Migrate extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();

        // Solo permitir en entorno de desarrollo por seguridad
        if (ENVIRONMENT === 'production') {
            show_error('Migration controller is not available in production environment.');
            exit;
        }

        // Verificar clave de instalación (opcional)
        $install_key = $this->input->get('key');
        $config_key = $this->config->item('install_key', 'llm_proxy');
        if ($config_key && $install_key !== $config_key) {
            show_error('Invalid installation key.');
            exit;
        }

        $this->load->library('migration');
    }

    /**
     * Ejecuta las migraciones hasta la última versión
     */
    public function index()
    {
        $this->output->set_content_type('application/json');

        if ($this->migration->current() === FALSE) {
            $this->output->set_output(json_encode([
                'success' => FALSE,
                'message' => 'Error executing migrations: ' . $this->migration->error_string()
            ]));
            return;
        }

        $this->output->set_output(json_encode([
            'success' => TRUE,
            'message' => 'Migrations executed successfully'
        ]));
    }

    /**
     * Ejecuta las migraciones hasta una versión específica
     * 
     * @param int $version Número de versión
     */
    public function version($version = 0)
    {
        $this->output->set_content_type('application/json');

        if ($this->migration->version($version) === FALSE) {
            $this->output->set_output(json_encode([
                'success' => FALSE,
                'message' => 'Error executing migrations: ' . $this->migration->error_string()
            ]));
            return;
        }

        $this->output->set_output(json_encode([
            'success' => TRUE,
            'message' => "Migration to version $version executed successfully"
        ]));
    }

    /**
     * Ejecuta un reset de todas las migraciones (peligroso)
     */
    public function reset()
    {
        $this->output->set_content_type('application/json');

        // Primero hacemos downgrade a 0
        if ($this->migration->version(0) === FALSE) {
            $this->output->set_output(json_encode([
                'success' => FALSE,
                'message' => 'Error resetting migrations: ' . $this->migration->error_string()
            ]));
            return;
        }

        $this->output->set_output(json_encode([
            'success' => TRUE,
            'message' => 'Migrations reset successfully'
        ]));
    }

    /**
     * Muestra el estado actual de las migraciones
     */
    public function status()
    {
        $this->output->set_content_type('application/json');

        // Verificar si la tabla de migraciones existe
        if (!$this->db->table_exists('migrations')) {
            $this->output->set_output(json_encode([
                'success' => FALSE,
                'message' => 'Migrations table does not exist'
            ]));
            return;
        }

        // Obtener la versión actual
        $query = $this->db->get('migrations');
        $row = $query->row();

        // Obtener archivos de migración
        $migrations_path = $this->config->item('migration_path');
        $migration_files = glob($migrations_path . '*_*.php');
        $available_versions = [];

        foreach ($migration_files as $file) {
            $filename = basename($file, '.php');
            if (preg_match('/^(\d+)_(.+)$/', $filename, $matches)) {
                $available_versions[] = [
                    'version' => (int)$matches[1],
                    'name' => $matches[2]
                ];
            }
        }

        usort($available_versions, function ($a, $b) {
            return $a['version'] - $b['version'];
        });

        $this->output->set_output(json_encode([
            'success' => TRUE,
            'current_version' => isset($row->version) ? (int)$row->version : 0,
            'available_migrations' => $available_versions
        ]));
    }
}
