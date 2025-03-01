<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Usage Controller
 * 
 * Controlador para mostrar estadísticas de uso del LLM Proxy
 */
class Usage extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->helper('url');
        $this->load->helper('form');
        $this->load->library('session');
        $this->load->model('llm_proxy_model');
    }

    /**
     * Página principal de estadísticas
     */
    public function index()
    {
        $data['title'] = 'LLM Proxy Usage Statistics';

        // Comprobar si las tablas existen
        $data['tables_exist'] = [
            'user_quotas' => $this->db->table_exists('user_quotas'),
            'usage_logs' => $this->db->table_exists('usage_logs'),
            'llm_cache' => $this->db->table_exists('llm_cache')
        ];

        // Obtener estadísticas generales
        $data['stats'] = $this->_get_general_stats();

        // Obtener datos para gráficos
        $data['charts_data'] = $this->_get_charts_data();

        // Mostrar vista
        $this->load->view('usage/header', $data);
        $this->load->view('usage/index', $data);
        $this->load->view('usage/footer');
    }

    /**
     * Ver registros de uso detallados
     */
    public function logs($page = 0)
    {
        $data['title'] = 'LLM Proxy Usage Logs';

        // Comprobar si la tabla existe
        if (!$this->db->table_exists('usage_logs')) {
            $data['error'] = 'The usage_logs table does not exist. Please run migrations first.';
            $this->load->view('usage/header', $data);
            $this->load->view('usage/error', $data);
            $this->load->view('usage/footer');
            return;
        }

        // Configuración de paginación
        $per_page = 20;
        $offset = $page * $per_page;

        // Obtener total de registros
        $total_rows = $this->db->count_all('usage_logs');
        $data['total_pages'] = ceil($total_rows / $per_page);
        $data['current_page'] = $page;

        // Obtener registros para esta página
        $this->db->order_by('usage_date', 'DESC');
        $this->db->limit($per_page, $offset);
        $data['logs'] = $this->db->get('usage_logs')->result();

        // Mostrar vista
        $this->load->view('usage/header', $data);
        $this->load->view('usage/logs', $data);
        $this->load->view('usage/footer');
    }

    /**
     * Ver cuotas de usuarios
     */
    public function quotas()
    {
        $data['title'] = 'LLM Proxy User Quotas';

        // Comprobar si las tablas existen
        if (!$this->db->table_exists('user_quotas') || !$this->db->table_exists('usage_logs')) {
            $data['error'] = 'The user_quotas or usage_logs table does not exist. Please run migrations first.';
            $this->load->view('usage/header', $data);
            $this->load->view('usage/error', $data);
            $this->load->view('usage/footer');
            return;
        }

        // Obtener registros de cuotas con uso actual
        $query = $this->db->query("
            SELECT 
                q.tenant_id,
                q.user_id,
                q.total_quota,
                q.reset_period,
                COALESCE(SUM(u.tokens), 0) as used_tokens,
                q.total_quota - COALESCE(SUM(u.tokens), 0) as remaining_quota
            FROM 
                user_quotas q
            LEFT JOIN 
                usage_logs u ON q.tenant_id = u.tenant_id AND q.user_id = u.user_id AND 
                u.usage_date >= datetime('now', '-30 days')
            GROUP BY 
                q.tenant_id, q.user_id
            ORDER BY
                q.tenant_id, q.user_id
        ");

        $data['quotas'] = $query->result();

        // Mostrar vista
        $this->load->view('usage/header', $data);
        $this->load->view('usage/quotas', $data);
        $this->load->view('usage/footer');
    }

    /**
     * Estadísticas por proveedor LLM
     */
    public function providers()
    {
        $data['title'] = 'LLM Proxy Provider Statistics';

        // Comprobar si la tabla existe
        if (!$this->db->table_exists('usage_logs')) {
            $data['error'] = 'The usage_logs table does not exist. Please run migrations first.';
            $this->load->view('usage/header', $data);
            $this->load->view('usage/error', $data);
            $this->load->view('usage/footer');
            return;
        }

        // Obtener estadísticas por proveedor
        $query = $this->db->query("
            SELECT 
                provider,
                COUNT(*) as request_count,
                SUM(tokens) as total_tokens,
                COUNT(DISTINCT tenant_id) as tenant_count,
                COUNT(DISTINCT user_id) as user_count,
                SUM(CASE WHEN has_image = 1 THEN 1 ELSE 0 END) as image_requests
            FROM 
                usage_logs
            GROUP BY 
                provider
            ORDER BY 
                request_count DESC
        ");

        $data['provider_stats'] = $query->result();

        // Obtener estadísticas por modelo
        $query = $this->db->query("
            SELECT 
                provider,
                model,
                COUNT(*) as request_count,
                SUM(tokens) as total_tokens
            FROM 
                usage_logs
            GROUP BY 
                provider, model
            ORDER BY 
                provider, request_count DESC
        ");

        $data['model_stats'] = $query->result();

        // Mostrar vista
        $this->load->view('usage/header', $data);
        $this->load->view('usage/providers', $data);
        $this->load->view('usage/footer');
    }

    /**
     * Estadísticas de caché
     */
    public function cache()
    {
        $data['title'] = 'LLM Proxy Cache Statistics';

        // Comprobar si la tabla existe
        if (!$this->db->table_exists('llm_cache')) {
            $data['error'] = 'The llm_cache table does not exist. Please run migrations first.';
            $this->load->view('usage/header', $data);
            $this->load->view('usage/error', $data);
            $this->load->view('usage/footer');
            return;
        }

        // Obtener estadísticas de caché
        $data['cache_size'] = $this->db->count_all('llm_cache');

        // Obtener estadísticas por proveedor
        $query = $this->db->query("
            SELECT 
                provider,
                COUNT(*) as entry_count,
                AVG(LENGTH(response)) as avg_response_size
            FROM 
                llm_cache
            GROUP BY 
                provider
            ORDER BY 
                entry_count DESC
        ");

        $data['provider_stats'] = $query->result();

        // Obtener entradas más recientes
        $this->db->order_by('created_at', 'DESC');
        $this->db->limit(10);
        $data['recent_entries'] = $this->db->get('llm_cache')->result();

        // Mostrar vista
        $this->load->view('usage/header', $data);
        $this->load->view('usage/cache', $data);
        $this->load->view('usage/footer');
    }

    /**
     * Obtiene estadísticas generales para el dashboard
     */
    private function _get_general_stats()
    {
        $stats = [];

        if ($this->db->table_exists('usage_logs')) {
            // Total de peticiones
            $stats['total_requests'] = $this->db->count_all('usage_logs');

            // Peticiones en las últimas 24 horas
            $this->db->where('usage_date >=', date('Y-m-d H:i:s', strtotime('-24 hours')));
            $stats['recent_requests'] = $this->db->count_all_results('usage_logs');

            // Tokens totales consumidos
            $query = $this->db->query("SELECT SUM(tokens) as total FROM usage_logs");
            $stats['total_tokens'] = isset($query->row()->total) ? $query->row()->total : '0';

            // Número de tenants y usuarios únicos
            $query = $this->db->query("SELECT COUNT(DISTINCT tenant_id) as tenants, COUNT(DISTINCT user_id) as users FROM usage_logs");
            $row = $query->row();
            $stats['unique_tenants'] = isset($row->tenants) ? $row->tenants : 0;
            $stats['unique_users'] = isset($row->users) ? $row->users : 0;

            // Peticiones con imágenes
            $this->db->where('has_image', 1);
            $stats['image_requests'] = $this->db->count_all_results('usage_logs');
        } else {
            // Valores por defecto si no existe la tabla
            $stats = [
                'total_requests' => 0,
                'recent_requests' => 0,
                'total_tokens' => 0,
                'unique_tenants' => 0,
                'unique_users' => 0,
                'image_requests' => 0
            ];
        }

        return $stats;
    }

    /**
     * Obtiene datos para los gráficos del dashboard
     */
    private function _get_charts_data()
    {
        $charts_data = [];

        if ($this->db->table_exists('usage_logs')) {
            // Uso por día (últimos 30 días)
            $query = $this->db->query("
                SELECT 
                    date(usage_date) as date,
                    COUNT(*) as requests,
                    SUM(tokens) as tokens
                FROM 
                    usage_logs
                WHERE 
                    usage_date >= datetime('now', '-30 days')
                GROUP BY 
                    date(usage_date)
                ORDER BY 
                    date ASC
            ");

            $charts_data['usage_by_date'] = $query->result();

            // Uso por proveedor
            $query = $this->db->query("
                SELECT 
                    provider,
                    COUNT(*) as count
                FROM 
                    usage_logs
                GROUP BY 
                    provider
                ORDER BY 
                    count DESC
            ");

            $charts_data['usage_by_provider'] = $query->result();

            // Uso por modelo
            $query = $this->db->query("
                SELECT 
                    model,
                    COUNT(*) as count
                FROM 
                    usage_logs
                GROUP BY 
                    model
                ORDER BY 
                    count DESC
                LIMIT 
                    5
            ");

            $charts_data['usage_by_model'] = $query->result();
        } else {
            // Valores por defecto si no existe la tabla
            $charts_data = [
                'usage_by_date' => [],
                'usage_by_provider' => [],
                'usage_by_model' => []
            ];
        }

        return $charts_data;
    }
}
