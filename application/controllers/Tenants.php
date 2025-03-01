<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Controlador para gestión de Tenants
 * 
 * Este controlador maneja todas las operaciones CRUD para tenants y sus cuotas
 */
class Tenants extends CI_Controller
{
    /**
     * Constructor
     */
    public function __construct()
    {
        parent::__construct();

        // Cargar modelos y helpers necesarios
        $this->load->model('tenant_model');
        $this->load->helper('url');
        $this->load->helper('form');
        $this->load->library('session');
        $this->load->library('pagination');

        // Verificar si la tabla existe, redirigir a migración si no
        if (!$this->db->table_exists('user_quotas')) {
            $this->session->set_flashdata('error', 'The database tables are not set up. Please run migrations first.');
            redirect('migrate');
        }
    }

    /**
     * Página principal con listado de tenants
     */
    public function index()
    {
        // Configuración de paginación
        $config['base_url'] = site_url('tenants/index');
        $config['total_rows'] = $this->tenant_model->count_tenants();
        $config['per_page'] = 10;
        $config['uri_segment'] = 3;

        // Estilo de paginación Bootstrap
        $config['full_tag_open'] = '<ul class="pagination">';
        $config['full_tag_close'] = '</ul>';
        $config['first_link'] = '&laquo;';
        $config['first_tag_open'] = '<li class="page-item">';
        $config['first_tag_close'] = '</li>';
        $config['last_link'] = '&raquo;';
        $config['last_tag_open'] = '<li class="page-item">';
        $config['last_tag_close'] = '</li>';
        $config['next_link'] = '&gt;';
        $config['next_tag_open'] = '<li class="page-item">';
        $config['next_tag_close'] = '</li>';
        $config['prev_link'] = '&lt;';
        $config['prev_tag_open'] = '<li class="page-item">';
        $config['prev_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="page-item active"><a class="page-link" href="#">';
        $config['cur_tag_close'] = '</a></li>';
        $config['num_tag_open'] = '<li class="page-item">';
        $config['num_tag_close'] = '</li>';
        $config['attributes'] = array('class' => 'page-link');

        $this->pagination->initialize($config);

        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

        // Obtener datos con paginación
        $data['tenants'] = $this->tenant_model->get_all_tenants($config['per_page'], $page);
        $data['pagination'] = $this->pagination->create_links();
        $data['title'] = 'Tenant Management';

        // Cargar vistas
        $this->load->view('usage/header', $data);
        $this->load->view('tenants/index', $data);
        $this->load->view('usage/footer');
    }

    /**
     * Mostrar detalles de un tenant específico
     * 
     * @param string $tenant_id ID del tenant
     */
    public function view($tenant_id = NULL)
    {
        if (!$tenant_id) {
            $this->session->set_flashdata('error', 'No tenant ID provided');
            redirect('tenants');
        }

        $data['tenant'] = $this->tenant_model->get_tenant($tenant_id);

        if (!$data['tenant']) {
            $this->session->set_flashdata('error', 'Tenant not found');
            redirect('tenants');
        }

        // Obtener datos de uso diario para gráficos
        $data['usage_by_date'] = $this->tenant_model->get_tenant_daily_usage($tenant_id);

        $data['title'] = 'Tenant Details: ' . $tenant_id;

        // Cargar vistas
        $this->load->view('usage/header', $data);
        $this->load->view('tenants/view', $data);
        $this->load->view('usage/footer');
    }

    /**
     * Formulario para crear un nuevo tenant
     */
    public function create()
    {
        $this->load->library('form_validation');

        // Reglas de validación
        $this->form_validation->set_rules('tenant_id', 'Tenant ID', 'required|trim|alpha_dash');
        $this->form_validation->set_rules('user_id', 'User ID', 'required|trim');
        $this->form_validation->set_rules('total_quota', 'Total Quota', 'required|integer|greater_than[0]');

        if ($this->form_validation->run() === FALSE) {
            // Mostrar formulario
            $data['title'] = 'Create New Tenant';
            $data['reset_periods'] = [
                'monthly' => 'Monthly',
                'weekly' => 'Weekly',
                'daily' => 'Daily'
            ];

            $this->load->view('usage/header', $data);
            $this->load->view('tenants/create', $data);
            $this->load->view('usage/footer');
        } else {
            // Procesar formulario
            $tenant_id = $this->input->post('tenant_id');
            $user_id = $this->input->post('user_id');
            $total_quota = $this->input->post('total_quota');
            $reset_period = $this->input->post('reset_period');

            $result = $this->tenant_model->update_user_quota($tenant_id, $user_id, $total_quota, $reset_period);

            if ($result) {
                $this->session->set_flashdata('success', 'Tenant created successfully');
            } else {
                $this->session->set_flashdata('error', 'Error creating tenant');
            }

            redirect('tenants/view/' . $tenant_id);
        }
    }

    /**
     * Añadir un usuario a un tenant existente
     * 
     * @param string $tenant_id ID del tenant
     */
    public function add_user($tenant_id = NULL)
    {
        if (!$tenant_id) {
            $this->session->set_flashdata('error', 'No tenant ID provided');
            redirect('tenants');
        }

        // Verificar si el tenant existe
        $tenant = $this->tenant_model->get_tenant($tenant_id);
        if (!$tenant) {
            $this->session->set_flashdata('error', 'Tenant not found');
            redirect('tenants');
        }

        $this->load->library('form_validation');

        // Reglas de validación
        $this->form_validation->set_rules('user_id', 'User ID', 'required|trim');
        $this->form_validation->set_rules('total_quota', 'Total Quota', 'required|integer|greater_than[0]');

        if ($this->form_validation->run() === FALSE) {
            // Mostrar formulario
            $data['tenant'] = $tenant;
            $data['title'] = 'Add User to Tenant: ' . $tenant_id;
            $data['reset_periods'] = [
                'monthly' => 'Monthly',
                'weekly' => 'Weekly',
                'daily' => 'Daily'
            ];

            $this->load->view('usage/header', $data);
            $this->load->view('tenants/add_user', $data);
            $this->load->view('usage/footer');
        } else {
            // Procesar formulario
            $user_id = $this->input->post('user_id');
            $total_quota = $this->input->post('total_quota');
            $reset_period = $this->input->post('reset_period');

            // Verificar si ya existe el usuario
            $user_exists = false;
            foreach ($tenant->users as $user) {
                if ($user->user_id === $user_id) {
                    $user_exists = true;
                    break;
                }
            }

            $result = $this->tenant_model->update_user_quota($tenant_id, $user_id, $total_quota, $reset_period);

            if ($result) {
                if ($user_exists) {
                    $this->session->set_flashdata('success', 'User quota updated successfully');
                } else {
                    $this->session->set_flashdata('success', 'User added successfully');
                }
            } else {
                $this->session->set_flashdata('error', 'Error adding/updating user');
            }

            redirect('tenants/view/' . $tenant_id);
        }
    }

    /**
     * Editar cuota de un usuario existente
     * 
     * @param string $tenant_id ID del tenant
     * @param string $user_id ID del usuario
     */
    public function edit_user($tenant_id = NULL, $user_id = NULL)
    {
        if (!$tenant_id || !$user_id) {
            $this->session->set_flashdata('error', 'Missing tenant or user ID');
            redirect('tenants');
        }

        // Verificar si el tenant y usuario existen
        $tenant = $this->tenant_model->get_tenant($tenant_id);
        if (!$tenant) {
            $this->session->set_flashdata('error', 'Tenant not found');
            redirect('tenants');
        }

        // Buscar el usuario específico
        $user = NULL;
        foreach ($tenant->users as $u) {
            if ($u->user_id === $user_id) {
                $user = $u;
                break;
            }
        }

        if (!$user) {
            $this->session->set_flashdata('error', 'User not found in this tenant');
            redirect('tenants/view/' . $tenant_id);
        }

        $this->load->library('form_validation');

        // Reglas de validación
        $this->form_validation->set_rules('total_quota', 'Total Quota', 'required|integer|greater_than[0]');

        if ($this->form_validation->run() === FALSE) {
            // Mostrar formulario
            $data['tenant'] = $tenant;
            $data['user'] = $user;
            $data['title'] = 'Edit User Quota: ' . $user_id;
            $data['reset_periods'] = [
                'monthly' => 'Monthly',
                'weekly' => 'Weekly',
                'daily' => 'Daily'
            ];

            $this->load->view('usage/header', $data);
            $this->load->view('tenants/edit_user', $data);
            $this->load->view('usage/footer');
        } else {
            // Procesar formulario
            $total_quota = $this->input->post('total_quota');
            $reset_period = $this->input->post('reset_period');

            $result = $this->tenant_model->update_user_quota($tenant_id, $user_id, $total_quota, $reset_period);

            if ($result) {
                $this->session->set_flashdata('success', 'User quota updated successfully');
            } else {
                $this->session->set_flashdata('error', 'Error updating user quota');
            }

            redirect('tenants/view/' . $tenant_id);
        }
    }

    /**
     * Eliminar un usuario de un tenant
     * 
     * @param string $tenant_id ID del tenant
     * @param string $user_id ID del usuario
     */
    public function delete_user($tenant_id = NULL, $user_id = NULL)
    {
        if (!$tenant_id || !$user_id) {
            $this->session->set_flashdata('error', 'Missing tenant or user ID');
            redirect('tenants');
        }

        // Verificar si es el último usuario del tenant
        $tenant = $this->tenant_model->get_tenant($tenant_id);
        if (count($tenant->users) <= 1) {
            $this->session->set_flashdata('error', 'Cannot delete the last user of a tenant. Delete the entire tenant instead.');
            redirect('tenants/view/' . $tenant_id);
        }

        if ($this->input->post('confirm') === 'yes') {
            // Procesamiento de eliminación
            $result = $this->tenant_model->delete_user($tenant_id, $user_id);

            if ($result) {
                $this->session->set_flashdata('success', 'User removed successfully');
            } else {
                $this->session->set_flashdata('error', 'Error removing user');
            }

            redirect('tenants/view/' . $tenant_id);
        } else {
            // Página de confirmación
            $data['tenant_id'] = $tenant_id;
            $data['user_id'] = $user_id;
            $data['title'] = 'Confirm User Deletion';

            $this->load->view('usage/header', $data);
            $this->load->view('tenants/delete_user', $data);
            $this->load->view('usage/footer');
        }
    }

    /**
     * Eliminar un tenant completo
     * 
     * @param string $tenant_id ID del tenant
     */
    public function delete($tenant_id = NULL)
    {
        if (!$tenant_id) {
            $this->session->set_flashdata('error', 'No tenant ID provided');
            redirect('tenants');
        }

        if ($this->input->post('confirm') === 'yes') {
            // Procesamiento de eliminación
            $result = $this->tenant_model->delete_tenant($tenant_id);

            if ($result) {
                $this->session->set_flashdata('success', 'Tenant deleted successfully');
            } else {
                $this->session->set_flashdata('error', 'Error deleting tenant');
            }

            redirect('tenants');
        } else {
            // Página de confirmación
            $data['tenant'] = $this->tenant_model->get_tenant($tenant_id);

            if (!$data['tenant']) {
                $this->session->set_flashdata('error', 'Tenant not found');
                redirect('tenants');
            }

            $data['title'] = 'Confirm Tenant Deletion';

            $this->load->view('usage/header', $data);
            $this->load->view('tenants/delete', $data);
            $this->load->view('usage/footer');
        }
    }

    /**
     * Ver el historial de uso de un tenant
     * 
     * @param string $tenant_id ID del tenant
     */
    public function usage($tenant_id = NULL)
    {
        if (!$tenant_id) {
            $this->session->set_flashdata('error', 'No tenant ID provided');
            redirect('tenants');
        }

        // Configuración de paginación
        $config['base_url'] = site_url('tenants/usage/' . $tenant_id);
        $config['total_rows'] = $this->db->where('tenant_id', $tenant_id)->count_all_results('usage_logs');
        $config['per_page'] = 20;
        $config['uri_segment'] = 4;

        // Estilo de paginación Bootstrap
        $config['full_tag_open'] = '<ul class="pagination">';
        $config['full_tag_close'] = '</ul>';
        $config['first_link'] = '&laquo;';
        $config['first_tag_open'] = '<li class="page-item">';
        $config['first_tag_close'] = '</li>';
        $config['last_link'] = '&raquo;';
        $config['last_tag_open'] = '<li class="page-item">';
        $config['last_tag_close'] = '</li>';
        $config['next_link'] = '&gt;';
        $config['next_tag_open'] = '<li class="page-item">';
        $config['next_tag_close'] = '</li>';
        $config['prev_link'] = '&lt;';
        $config['prev_tag_open'] = '<li class="page-item">';
        $config['prev_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="page-item active"><a class="page-link" href="#">';
        $config['cur_tag_close'] = '</a></li>';
        $config['num_tag_open'] = '<li class="page-item">';
        $config['num_tag_close'] = '</li>';
        $config['attributes'] = array('class' => 'page-link');

        $this->pagination->initialize($config);

        $page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;

        // Obtener datos con paginación
        $data['tenant'] = $this->tenant_model->get_tenant($tenant_id);

        if (!$data['tenant']) {
            $this->session->set_flashdata('error', 'Tenant not found');
            redirect('tenants');
        }

        $data['usage_logs'] = $this->tenant_model->get_tenant_usage($tenant_id, $config['per_page'], $page);
        $data['pagination'] = $this->pagination->create_links();
        $data['title'] = 'Usage History: ' . $tenant_id;

        // Cargar vistas
        $this->load->view('usage/header', $data);
        $this->load->view('tenants/usage', $data);
        $this->load->view('usage/footer');
    }
}
