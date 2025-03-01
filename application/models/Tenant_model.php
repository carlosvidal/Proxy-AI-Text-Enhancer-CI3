<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Modelo para gestión de Tenants
 * 
 * Este modelo maneja las operaciones CRUD para tenants y sus cuotas
 */
class Tenant_model extends CI_Model
{
    /**
     * Constructor
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->helper('logger');
    }
    
    /**
     * Obtiene todos los tenants con sus cuotas correspondientes
     * 
     * @param int $limit Límite de registros a obtener
     * @param int $offset Inicio de la consulta para paginación
     * @return array Listado de tenants con sus cuotas
     */
    public function get_all_tenants($limit = NULL, $offset = NULL)
    {
        // Consulta principal que obtiene tenants únicos y su información de cuota consolidada
        $this->db->select('DISTINCT tenant_id, COUNT(DISTINCT user_id) as user_count', FALSE);
        $this->db->from('user_quotas');
        $this->db->group_by('tenant_id');
        $this->db->order_by('tenant_id', 'ASC');
        
        if ($limit !== NULL) {
            $this->db->limit($limit, $offset);
        }
        
        $query = $this->db->get();
        $tenants = $query->result();
        
        // Enriquecer los datos con información de uso
        foreach ($tenants as &$tenant) {
            // Obtener cuota total asignada al tenant
            $this->db->select_sum('total_quota');
            $this->db->where('tenant_id', $tenant->tenant_id);
            $quota_query = $this->db->get('user_quotas');
            $tenant->total_quota = $quota_query->row()->total_quota ?: 0;
            
            // Obtener uso actual (últimos 30 días)
            $thirty_days_ago = date('Y-m-d H:i:s', strtotime('-30 days'));
            $this->db->select_sum('tokens', 'used_tokens');
            $this->db->where('tenant_id', $tenant->tenant_id);
            $this->db->where('usage_date >=', $thirty_days_ago);
            $usage_query = $this->db->get('usage_logs');
            $tenant->used_tokens = $usage_query->row()->used_tokens ?: 0;
            
            // Calcular porcentaje de uso
            $tenant->usage_percentage = ($tenant->total_quota > 0) ? 
                min(100, ($tenant->used_tokens / $tenant->total_quota) * 100) : 0;
                
            // Obtener uso por provider
            $this->db->select('provider, COUNT(*) as count');
            $this->db->where('tenant_id', $tenant->tenant_id);
            $this->db->group_by('provider');
            $this->db->order_by('count', 'DESC');
            $providers_query = $this->db->get('usage_logs');
            $tenant->providers = $providers_query->result();
            
            // Obtener fecha del último uso
            $this->db->select_max('usage_date');
            $this->db->where('tenant_id', $tenant->tenant_id);
            $last_usage_query = $this->db->get('usage_logs');
            $tenant->last_usage = $last_usage_query->row()->usage_date;
        }
        
        return $tenants;
    }
    
    /**
     * Cuenta el total de tenants
     * 
     * @return int Total de tenants
     */
    public function count_tenants()
    {
        $this->db->select('COUNT(DISTINCT tenant_id) as total', FALSE);
        $this->db->from('user_quotas');
        $query = $this->db->get();
        return $query->row()->total;
    }
    
    /**
     * Obtiene información de un tenant específico con sus usuarios y cuotas
     * 
     * @param string $tenant_id ID del tenant
     * @return object Información del tenant y sus usuarios
     */
    public function get_tenant($tenant_id)
    {
        // Verificar si existe el tenant
        $this->db->where('tenant_id', $tenant_id);
        $exists = $this->db->count_all_results('user_quotas') > 0;
        
        if (!$exists) {
            return NULL;
        }
        
        // Obtener datos básicos del tenant
        $tenant = new stdClass();
        $tenant->tenant_id = $tenant_id;
        
        // Obtener información consolidada de cuotas
        $this->db->select_sum('total_quota');
        $this->db->where('tenant_id', $tenant_id);
        $quota_query = $this->db->get('user_quotas');
        $tenant->total_quota = $quota_query->row()->total_quota ?: 0;
        
        // Obtener uso actual (últimos 30 días)
        $thirty_days_ago = date('Y-m-d H:i:s', strtotime('-30 days'));
        $this->db->select_sum('tokens', 'used_tokens');
        $this->db->where('tenant_id', $tenant_id);
        $this->db->where('usage_date >=', $thirty_days_ago);
        $usage_query = $this->db->get('usage_logs');
        $tenant->used_tokens = $usage_query->row()->used_tokens ?: 0;
        
        // Obtener usuarios con sus cuotas
        $this->db->where('tenant_id', $tenant_id);
        $this->db->order_by('user_id', 'ASC');
        $users_query = $this->db->get('user_quotas');
        $tenant->users = $users_query->result();
        
        // Enriquecer datos de usuarios con información de uso
        foreach ($tenant->users as &$user) {
            $this->db->select_sum('tokens', 'used_tokens');
            $this->db->where('tenant_id', $tenant_id);
            $this->db->where('user_id', $user->user_id);
            $this->db->where('usage_date >=', $thirty_days_ago);
            $user_usage_query = $this->db->get('usage_logs');
            $user->used_tokens = $user_usage_query->row()->used_tokens ?: 0;
            $user->remaining_quota = $user->total_quota - $user->used_tokens;
            $user->usage_percentage = ($user->total_quota > 0) ? 
                min(100, ($user->used_tokens / $user->total_quota) * 100) : 0;
        }
        
        // Obtener uso por provider
        $this->db->select('provider, COUNT(*) as count, SUM(tokens) as tokens');
        $this->db->where('tenant_id', $tenant_id);
        $this->db->group_by('provider');
        $this->db->order_by('count', 'DESC');
        $providers_query = $this->db->get('usage_logs');
        $tenant->providers = $providers_query->result();
        
        // Obtener estadísticas de uso
        $this->db->select('
            COUNT(*) as total_requests,
            SUM(CASE WHEN has_image = 1 THEN 1 ELSE 0 END) as image_requests,
            COUNT(DISTINCT user_id) as unique_users
        ');
        $this->db->where('tenant_id', $tenant_id);
        $stats_query = $this->db->get('usage_logs');
        $tenant->stats = $stats_query->row();
        
        return $tenant;
    }
    
    /**
     * Crea o actualiza la cuota para un usuario específico de un tenant
     * 
     * @param string $tenant_id ID del tenant
     * @param string $user_id ID del usuario
     * @param int $total_quota Cuota total de tokens
     * @param string $reset_period Periodo de reinicio (daily, weekly, monthly)
     * @return bool Éxito o fracaso
     */
    public function update_user_quota($tenant_id, $user_id, $total_quota, $reset_period = 'monthly')
    {
        // Sanitizar inputs
        $tenant_id = $this->db->escape_str($tenant_id);
        $user_id = $this->db->escape_str($user_id);
        $total_quota = intval($total_quota);
        $reset_period = in_array($reset_period, ['daily', 'weekly', 'monthly']) ? $reset_period : 'monthly';
        
        // Verificar si ya existe
        $this->db->where('tenant_id', $tenant_id);
        $this->db->where('user_id', $user_id);
        $exists = $this->db->get('user_quotas')->num_rows() > 0;
        
        if ($exists) {
            // Actualizar registro existente
            $this->db->where('tenant_id', $tenant_id);
            $this->db->where('user_id', $user_id);
            return $this->db->update('user_quotas', [
                'total_quota' => $total_quota,
                'reset_period' => $reset_period,
                'updated_at' => date('Y-m-d H:i:s')
            ]);
        } else {
            // Crear nuevo registro
            return $this->db->insert('user_quotas', [
                'tenant_id' => $tenant_id,
                'user_id' => $user_id,
                'total_quota' => $total_quota,
                'reset_period' => $reset_period,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ]);
        }
    }
    
    /**
     * Elimina un usuario específico de un tenant
     * 
     * @param string $tenant_id ID del tenant
     * @param string $user_id ID del usuario
     * @return bool Éxito o fracaso
     */
    public function delete_user($tenant_id, $user_id)
    {
        $this->db->where('tenant_id', $tenant_id);
        $this->db->where('user_id', $user_id);
        return $this->db->delete('user_quotas');
    }
    
    /**
     * Elimina un tenant completo y todos sus usuarios
     * 
     * @param string $tenant_id ID del tenant
     * @return bool Éxito o fracaso
     */
    public function delete_tenant($tenant_id)
    {
        $this->db->where('tenant_id', $tenant_id);
        return $this->db->delete('user_quotas');
    }
    
    /**
     * Obtiene el historial de uso de un tenant
     * 
     * @param string $tenant_id ID del tenant
     * @param int $limit Límite de registros a obtener
     * @param int $offset Inicio de la consulta para paginación
     * @return array Registros de uso
     */
    public function get_tenant_usage($tenant_id, $limit = NULL, $offset = NULL)
    {
        $this->db->where('tenant_id', $tenant_id);
        $this->db->order_by('usage_date', 'DESC');
        
        if ($limit !== NULL) {
            $this->db->limit($limit, $offset);
        }
        
        return $this->db->get('usage_logs')->result();
    }
    
    /**
     * Obtiene el historial de uso diario del tenant (para gráficos)
     * 
     * @param string $tenant_id ID del tenant
     * @param int $days Número de días para obtener historial
     * @return array Datos de uso diario
     */
    public function get_tenant_daily_usage($tenant_id, $days = 30)
    {
        $start_date = date('Y-m-d H:i:s', strtotime("-{$days} days"));
        
        $this->db->select('date(usage_date) as date, COUNT(*) as requests, SUM(tokens) as tokens');
        $this->db->where('tenant_id', $tenant_id);
        $this->db->where('usage_date >=', $start_date);
        $this->db->group_by('date(usage_date)');
        $this->db->order_by('date', 'ASC');
        
        return $this->db->get('usage_logs')->result();
    }
}