<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * LlmProxy Controller
 * 
 * Controlador que maneja las peticiones al proxy de LLM en CodeIgniter 3
 * 
 * @package     AI Text Enhancer
 * @author      Your Name
 */
class Llmproxy extends CI_Controller
{
    /**
     * Configuración del proxy
     */
    private $api_keys = [];
    private $endpoints = [];

    /**
     * Constructor
     */
    public function __construct()
    {
        parent::__construct();

        // Cargar helpers y libraries necesarios
        $this->load->helper('url');
        $this->load->helper('form');
        $this->load->helper('logger');
        $this->load->library('session');

        // Cargar modelo de proxy
        $this->load->model('llm_proxy_model');

        // Configurar CORS para API
        $this->_configure_cors();

        // Inicializar configuración del proxy
        $this->_initialize_config();

        log_info('PROXY', 'Proxy inicializado', [
            'ip' => $this->input->ip_address(),
            'method' => $this->input->method(),
            'user_agent' => $this->input->user_agent()
        ]);
    }

    /**
     * Endpoint principal para peticiones al proxy
     */
    public function index()
    {
        log_info('PROXY', 'Solicitud al endpoint principal recibida');

        // Verificar que sea una petición POST
        if ($this->input->method() !== 'post') {
            log_error('PROXY', 'Método no permitido', ['method' => $this->input->method()]);
            $this->output
                ->set_content_type('application/json')
                ->set_status_header(405)
                ->set_output(json_encode(['error' => ['message' => 'Method not allowed']]));
            return;
        }

        // Obtener el cuerpo de la petición como JSON
        $json_data = $this->input->raw_input_stream;
        log_debug('PROXY', 'Datos recibidos (raw)', $json_data);

        $request_data = json_decode($json_data, TRUE);

        // Verificar que los datos son válidos
        if (!$request_data || !isset($request_data['provider']) || !isset($request_data['model'])) {
            log_error('PROXY', 'Datos de solicitud inválidos', $request_data);
            $this->output
                ->set_content_type('application/json')
                ->set_status_header(400)
                ->set_output(json_encode(['error' => ['message' => 'Invalid request data']]));
            return;
        }

        log_info('PROXY', 'Solicitud válida recibida', [
            'provider' => $request_data['provider'],
            'model' => $request_data['model'],
            'stream' => isset($request_data['stream']) ? $request_data['stream'] : 'No especificado',
            'has_image' => isset($request_data['hasImage']) ? $request_data['hasImage'] : 'No especificado'
        ]);

        // Extraer datos de la petición
        $provider = $request_data['provider'];
        $model = $request_data['model'];
        $messages = isset($request_data['messages']) ? $request_data['messages'] : [];
        $temperature = isset($request_data['temperature']) ? $request_data['temperature'] : 0.7;
        $stream = isset($request_data['stream']) ? $request_data['stream'] : FALSE;
        $tenant_id = isset($request_data['tenantId']) ? $request_data['tenantId'] : '';
        $user_id = isset($request_data['userId']) ? $request_data['userId'] : '';
        $has_image = isset($request_data['hasImage']) ? $request_data['hasImage'] : FALSE;

        // Verificación de API key
        if (!isset($this->api_keys[$provider]) || empty($this->api_keys[$provider])) {
            log_error('PROXY', 'Proveedor inválido o no soportado', [
                'provider' => $provider,
                'api_key_exists' => isset($this->api_keys[$provider]),
                'api_key_empty' => isset($this->api_keys[$provider]) ? empty($this->api_keys[$provider]) : true
            ]);
            $this->output
                ->set_content_type('application/json')
                ->set_status_header(400)
                ->set_output(json_encode(['error' => ['message' => 'Invalid or unsupported provider']]));
            return;
        }

        log_info('PROXY', 'API key verificada para ' . $provider);

        // Verificar cuota
        $quota = $this->llm_proxy_model->check_quota($tenant_id, $user_id);
        log_info('PROXY', 'Verificación de cuota', $quota);

        if ($quota && $quota['remaining'] <= 0) {
            log_error('PROXY', 'Cuota excedida', [
                'tenant_id' => $tenant_id,
                'user_id' => $user_id,
                'quota' => $quota
            ]);
            $this->output
                ->set_content_type('application/json')
                ->set_status_header(403)
                ->set_output(json_encode(['error' => ['message' => 'Quota exceeded']]));
            return;
        }

        // Preparar payload según el proveedor
        $payload = $this->_prepare_payload($provider, $model, $messages, $temperature, $stream);
        log_debug('PROXY', 'Payload preparado para ' . $provider, $payload);

        // Hacer la petición al proveedor LLM
        try {
            log_info('PROXY', 'Iniciando solicitud a API externa', [
                'provider' => $provider,
                'model' => $model
            ]);

            $this->_make_request($provider, $payload, $stream, $tenant_id, $user_id, $model, $has_image);
        } catch (Exception $e) {
            log_error('PROXY', 'Error al procesar solicitud', [
                'message' => $e->getMessage(),
                'code' => $e->getCode(),
                'trace' => $e->getTraceAsString()
            ]);

            $this->output
                ->set_content_type('application/json')
                ->set_status_header(500)
                ->set_output(json_encode(['error' => ['message' => 'Internal server error: ' . $e->getMessage()]]));
        }
    }

    // Modificar la función _make_request() para incluir logging
    private function _make_request($provider, $payload, $stream, $tenant_id, $user_id, $model, $has_image)
    {
        log_debug('API_REQUEST', 'Iniciando solicitud', [
            'provider' => $provider,
            'model' => $model,
            'stream' => $stream ? 'true' : 'false'
        ]);

        // Si estamos en desarrollo y queremos usar respuestas simuladas
        if (ENVIRONMENT == 'development' && $this->use_simulated_responses) {
            log_info('API_REQUEST', 'Usando respuesta simulada en entorno de desarrollo');

            // Lógica de simulación existente...
            if ($stream) {
                log_info('API_REQUEST', 'Generando respuesta en streaming');
                $this->_generate_ai_response($payload['messages'], true, $model);
            }

            $aiResponse = $this->_generate_ai_response($payload['messages'], false, $model);
            // Resto del código de simulación...
        }
        // Solicitud real al proveedor de LLM
        else {
            log_info('API_REQUEST', 'Realizando solicitud real al proveedor LLM', [
                'provider' => $provider,
                'model' => $model,
                'stream' => $stream ? 'true' : 'false'
            ]);

            $api_key = $this->api_keys[$provider];
            $endpoint = $this->endpoints[$provider];

            // Configurar opciones de cURL según el proveedor
            $headers = [
                "Content-Type: application/json"
            ];

            switch ($provider) {
                case 'openai':
                    $headers[] = "Authorization: Bearer {$api_key}";
                    break;
                case 'anthropic':
                    $headers[] = "x-api-key: {$api_key}";
                    $headers[] = "anthropic-version: 2023-06-01";
                    break;
                case 'mistral':
                    $headers[] = "Authorization: Bearer {$api_key}";
                    break;
                    // Otros proveedores...
            }

            $curl = curl_init($endpoint);
            curl_setopt($curl, CURLOPT_POST, 1);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
            curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($payload));
            curl_setopt($curl, CURLOPT_TIMEOUT, 120); // 2 minutos de timeout

            // Para streaming
            if ($stream) {
                // Registrar el inicio de streaming
                log_info('API_REQUEST', 'Iniciando streaming real con ' . $provider);

                // Configuración especial para streaming
                curl_setopt($curl, CURLOPT_WRITEFUNCTION, function ($curl, $data) use ($tenant_id, $user_id, $provider, $model, $has_image) {
                    $this->_handle_stream_chunk($data, $tenant_id, $user_id, $provider, $model, $has_image);
                    return strlen($data);
                });
                curl_setopt($curl, CURLOPT_VERBOSE, true);
                $verbose = fopen('php://temp', 'w+');
                curl_setopt($curl, CURLOPT_STDERR, $verbose);

                // Habilitar cabeceras para streaming
                header('Content-Type: text/event-stream');
                header('Cache-Control: no-cache');
                header('Connection: keep-alive');
                header('X-Accel-Buffering: no');

                // Ejecutar la solicitud
                $result = curl_exec($curl);

                rewind($verbose);
                $verboseLog = stream_get_contents($verbose);
                log_debug('CURL', 'Detalles de la solicitud cURL', [
                    'verbose_log' => $verboseLog
                ]);

                if (curl_errno($curl)) {
                    log_error('API_REQUEST', 'Error en solicitud streaming', [
                        'error' => curl_error($curl),
                        'code' => curl_errno($curl)
                    ]);



                    // Enviar error al cliente como evento SSE
                    $error_data = [
                        'error' => [
                            'message' => 'Error connecting to LLM provider: ' . curl_error($curl)
                        ]
                    ];
                    echo "data: " . json_encode($error_data) . "\n\n";
                    echo "data: [DONE]\n\n";
                    flush();
                }

                // Cerrar la conexión cURL
                curl_close($curl);

                // Registrar el uso
                $this->llm_proxy_model->record_usage($tenant_id, $user_id, $provider, $model, $has_image);

                log_info('API_REQUEST', 'Streaming finalizado', [
                    'provider' => $provider,
                    'model' => $model
                ]);

                exit; // Terminar la ejecución después del streaming
            }
            // Para solicitudes sin streaming
            else {
                // Ejecutar la solicitud
                $response = curl_exec($curl);
                $status = curl_getinfo($curl, CURLINFO_HTTP_CODE);

                if (curl_errno($curl)) {
                    log_error('API_REQUEST', 'Error en solicitud', [
                        'error' => curl_error($curl),
                        'code' => curl_errno($curl)
                    ]);

                    throw new Exception('Error connecting to LLM provider: ' . curl_error($curl));
                }

                // Cerrar la conexión cURL
                curl_close($curl);

                // Verificar el código de estado
                if ($status != 200) {
                    log_error('API_REQUEST', 'Error en respuesta de API', [
                        'status' => $status,
                        'response' => $response
                    ]);

                    throw new Exception('Error from LLM provider: ' . $response);
                }

                // Procesar la respuesta según el proveedor
                $response_data = json_decode($response, true);

                // Verificar si hay errores en la respuesta
                if (isset($response_data['error'])) {
                    log_error('API_REQUEST', 'Error reportado por el proveedor', [
                        'error' => $response_data['error']
                    ]);

                    throw new Exception('Provider reported error: ' . $response_data['error']['message']);
                }

                // Extraer el contenido de la respuesta según el proveedor
                $content = '';
                switch ($provider) {
                    case 'openai':
                        $content = $response_data['choices'][0]['message']['content'];
                        break;
                    case 'anthropic':
                        $content = $response_data['content'][0]['text'];
                        break;
                        // Otros proveedores...
                    default:
                        if (isset($response_data['choices'][0]['message']['content'])) {
                            $content = $response_data['choices'][0]['message']['content'];
                        } else {
                            log_error('API_REQUEST', 'Formato de respuesta no reconocido', [
                                'response' => $response_data
                            ]);
                            throw new Exception('Unknown response format from provider');
                        }
                }

                // Registrar el uso
                $this->llm_proxy_model->record_usage($tenant_id, $user_id, $provider, $model, $has_image);

                // Estructurar la respuesta similar a OpenAI para consistencia
                $responseData = [
                    'id' => isset($response_data['id']) ? $response_data['id'] : 'resp-' . uniqid(),
                    'object' => 'chat.completion',
                    'created' => time(),
                    'model' => $model,
                    'choices' => [
                        [
                            'index' => 0,
                            'message' => [
                                'role' => 'assistant',
                                'content' => $content
                            ],
                            'finish_reason' => 'stop'
                        ]
                    ],
                    'usage' => isset($response_data['usage']) ? $response_data['usage'] : [
                        'prompt_tokens' => 0,
                        'completion_tokens' => 0,
                        'total_tokens' => 0
                    ]
                ];

                log_info('API_RESPONSE', 'Enviando respuesta al cliente (no streaming)');

                $this->output
                    ->set_content_type('application/json')
                    ->set_output(json_encode($responseData));

                return;
            }
        }
    }

    /**
     * Procesa y reenvía cada fragmento de datos recibidos en streaming
     */
    private function _handle_stream_chunk($data, $tenant_id, $user_id, $provider, $model, $has_image)
    {
        static $buffer = '';

        log_debug('STREAM_RAW', 'Datos brutos recibidos', [
            'length' => strlen($data),
            'preview' => strlen($data) > 100 ? substr($data, 0, 100) . '...' : $data
        ]);

        $buffer .= $data;
        $lines = explode("\n", $buffer);
        $buffer = array_pop($lines);  // Mantener cualquier parte incompleta para el próximo chunk

        foreach ($lines as $line) {
            $line = trim($line);
            if (empty($line)) continue;

            log_debug('STREAM_LINE', 'Procesando línea', [
                'line' => $line
            ]);

            if (strpos($line, 'data: ') === 0) {
                $content = substr($line, 6);

                // Si es [DONE], pasar tal cual
                if ($content === '[DONE]') {
                    log_info('STREAM_CHUNK', 'Recibido fin de stream [DONE]');
                    echo "data: [DONE]\n\n";
                    flush();
                    continue;
                }

                // Intentar interpretar como JSON
                $json = json_decode($content, true);
                if ($json === null) {
                    log_error('STREAM_CHUNK', 'Error decodificando JSON', [
                        'content' => $content,
                        'json_error' => json_last_error_msg()
                    ]);

                    // Si hay un error con el formato JSON, aún así reenviar al cliente
                    // para no interrumpir el flujo de datos
                    echo "data: " . $content . "\n\n";
                    flush();
                    continue;
                }

                // Logear el chunk para depuración
                log_debug('STREAM_CHUNK', 'Chunk JSON recibido del proveedor', [
                    'size' => strlen($content),
                    'content' => $content,
                    'delta' => isset($json['choices'][0]['delta']) ? $json['choices'][0]['delta'] : 'no-delta'
                ]);

                // Simplemente reenviar el chunk al cliente
                echo "data: " . $content . "\n\n";
                flush();
            } else {
                // Si el proveedor no devuelve formato "data: ", intentamos adaptarlo
                log_warning('STREAM_CHUNK', 'Formato no esperado, adaptando', [
                    'line' => $line
                ]);

                // Intentar determinar si es JSON
                $json = json_decode($line, true);
                if ($json !== null) {
                    // Es json válido, lo enviamos en formato SSE
                    echo "data: " . $line . "\n\n";
                    flush();
                } else {
                    // No es JSON, lo enviamos como texto
                    $textChunk = [
                        'id' => 'chatcmpl-' . uniqid(),
                        'object' => 'chat.completion.chunk',
                        'created' => time(),
                        'model' => $model,
                        'choices' => [
                            [
                                'index' => 0,
                                'delta' => [
                                    'content' => $line
                                ],
                                'finish_reason' => null
                            ]
                        ]
                    ];
                    echo "data: " . json_encode($textChunk) . "\n\n";
                    flush();
                }
            }
        }

        return strlen($data);
    }

    /**
     * Endpoint para verificar cuota
     */
    public function quota()
    {
        // Verificar que sea una petición GET
        if ($this->input->method() !== 'get') {
            $this->output
                ->set_content_type('application/json')
                ->set_status_header(405)
                ->set_output(json_encode(['error' => ['message' => 'Method not allowed']]));
            return;
        }

        // Obtener parámetros
        $tenant_id = $this->input->get('tenantId');
        $user_id = $this->input->get('userId');

        if (empty($tenant_id) || empty($user_id)) {
            $this->output
                ->set_content_type('application/json')
                ->set_status_header(400)
                ->set_output(json_encode(['error' => ['message' => 'Missing tenant or user ID']]));
            return;
        }

        // Obtener cuota
        $quota = $this->llm_proxy_model->check_quota($tenant_id, $user_id);

        // Devolver resultado
        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($quota));
    }

    /**
     * Devuelve información sobre el estado del proxy
     */
    public function status()
    {
        // Verificar si las API keys están configuradas
        $api_keys_status = [];
        foreach ($this->api_keys as $provider => $key) {
            $api_keys_status[$provider] = !empty($key);
        }

        // Verificar si las tablas están creadas
        $tables_status = [
            'user_quotas' => $this->db->table_exists('user_quotas'),
            'usage_logs' => $this->db->table_exists('usage_logs')
        ];

        // Obtener estadísticas de uso si las tablas existen
        $usage_stats = [];
        if ($tables_status['usage_logs']) {
            // Total de peticiones
            $this->db->select('COUNT(*) as total_requests');
            $total_requests = $this->db->get('usage_logs')->row()->total_requests;

            // Peticiones por proveedor
            $this->db->select('provider, COUNT(*) as count');
            $this->db->group_by('provider');
            $provider_stats = $this->db->get('usage_logs')->result_array();

            // Peticiones en las últimas 24 horas
            $this->db->select('COUNT(*) as recent_requests');
            $this->db->where('usage_date >=', date('Y-m-d H:i:s', strtotime('-24 hours')));
            $recent_requests = $this->db->get('usage_logs')->row()->recent_requests;

            $usage_stats = [
                'total_requests' => $total_requests,
                'recent_requests' => $recent_requests,
                'by_provider' => array_column($provider_stats, 'count', 'provider')
            ];
        }

        // Información del sistema
        $system_info = [
            'php_version' => PHP_VERSION,
            'codeigniter_version' => CI_VERSION,
            'server' => isset($_SERVER['SERVER_SOFTWARE']) ? $_SERVER['SERVER_SOFTWARE'] : 'Unknown',
            'database' => $this->db->platform(),
            'max_execution_time' => ini_get('max_execution_time'),
            'memory_limit' => ini_get('memory_limit'),
            'post_max_size' => ini_get('post_max_size'),
            'environment' => ENVIRONMENT
        ];

        // Construir respuesta
        $response = [
            'status' => 'online',
            'api_keys' => $api_keys_status,
            'database' => [
                'connected' => $this->db->initialize(),
                'tables' => $tables_status
            ],
            'usage' => $usage_stats,
            'system' => $system_info,
            'version' => '1.0.0',
            'timestamp' => date('Y-m-d H:i:s')
        ];

        // Devolver información
        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($response));
    }

    /**
     * Método OPTIONS para preflight requests
     */
    public function options()
    {
        // Cabeceras CORS para preflight requests
        header('Access-Control-Allow-Origin: *');
        header('Access-Control-Allow-Methods: GET, POST, OPTIONS');
        header('Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With');
        header('Access-Control-Max-Age: 3600');
        header('Content-Type: text/plain');
        header('Content-Length: 0');
        header('HTTP/1.1 200 OK');
        exit;
    }

    /**
     * Configura los headers CORS para la API
     */
    private function _configure_cors()
    {
        // No establecer los headers aquí para solicitudes OPTIONS
        if ($_SERVER['REQUEST_METHOD'] != 'OPTIONS') {
            header('Access-Control-Allow-Origin: *');
            header('Access-Control-Allow-Methods: GET, POST, OPTIONS');
            header('Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With');
            header('Access-Control-Max-Age: 86400');
        }
    }

    /**
     * Inicializa la configuración del proxy
     */
    private function _initialize_config()
    {
        // Cargar configuración
        $this->config->load('llm_proxy', TRUE);

        // API keys para diferentes proveedores desde la configuración
        $this->api_keys = [
            'openai' => $this->config->item('openai_api_key', 'llm_proxy'),
            'anthropic' => $this->config->item('anthropic_api_key', 'llm_proxy'),
            'deepseek' => $this->config->item('deepseek_api_key', 'llm_proxy'),
            'cohere' => $this->config->item('cohere_api_key', 'llm_proxy'),
            'google' => $this->config->item('google_api_key', 'llm_proxy'),
            'mistral' => $this->config->item('mistral_api_key', 'llm_proxy')
        ];

        // Verificar si hay configuración para simulación
        $this->use_simulated_responses = $this->config->item('use_simulated_responses', 'llm_proxy');

        // Depuración de API keys
        log_debug('CONFIG', 'API Keys cargadas', [
            'openai' => !empty($this->api_keys['openai']) ? 'configurada' : 'vacía',
            'anthropic' => !empty($this->api_keys['anthropic']) ? 'configurada' : 'vacía',
            'deepseek' => !empty($this->api_keys['deepseek']) ? 'configurada' : 'vacía',
            'cohere' => !empty($this->api_keys['cohere']) ? 'configurada' : 'vacía',
            'google' => !empty($this->api_keys['google']) ? 'configurada' : 'vacía',
            'mistral' => !empty($this->api_keys['mistral']) ? 'configurada' : 'vacía'
        ]);

        // Endpoints para diferentes proveedores
        $this->endpoints = [
            'openai' => "https://api.openai.com/v1/chat/completions",
            'deepseek' => "https://api.deepseek.com/v1/chat/completions",
            'anthropic' => "https://api.anthropic.com/v1/messages",
            'cohere' => "https://api.cohere.ai/v1/generate",
            'google' => "https://generativelanguage.googleapis.com/v1/models/gemini-pro:generateText",
            'mistral' => "https://api.mistral.ai/v1/chat/completions"
        ];

        // Cargar también la configuración de CORS
        $this->allowed_origins = $this->config->item('allowed_origins', 'llm_proxy');

        log_debug('CONFIG', 'Configuración inicializada', [
            'simulación' => $this->use_simulated_responses ? 'activa' : 'inactiva',
            'orígenes_permitidos' => is_array($this->allowed_origins) ? implode(', ', $this->allowed_origins) : $this->allowed_origins
        ]);
    }
    /**
     * Prepara el payload según el proveedor
     */
    private function _prepare_payload($provider, $model, $messages, $temperature, $stream)
    {
        // Payload base
        $payload = [
            'model' => $model,
            'messages' => $messages,
            'temperature' => $temperature,
            'stream' => $stream
        ];

        // Adaptaciones específicas por proveedor
        switch ($provider) {
            case 'anthropic':
                // Verificar si hay que adaptar estructura para Anthropic
                break;

            case 'cohere':
                // Adaptación específica para Cohere si es necesario
                break;

            case 'google':
                // Adaptación específica para Google si es necesario
                break;
        }

        return $payload;
    }

    /**
     * Genera una respuesta simulada para desarrollo
     * 
     * @param array $messages Los mensajes del usuario
     * @param bool $stream Si se debe enviar como stream
     * @param string $model El modelo utilizado
     * @return string|void Devuelve texto si !$stream, o nada si envía streaming
     */
    private function _generate_ai_response($messages, $stream = false, $model = 'gpt-4-turbo')
    {
        // Obtener el último mensaje del usuario
        $lastMessage = end($messages);
        $userMessage = is_array($lastMessage['content'])
            ? 'Mensaje multimodal'
            : $lastMessage['content'];

        log_debug('AI_RESPONSE', 'Generando respuesta para', [
            'mensaje' => substr($userMessage, 0, 100) . (strlen($userMessage) > 100 ? '...' : ''),
            'stream' => $stream ? 'true' : 'false'
        ]);

        // Respuestas predefinidas para desarrollo
        $responses = [
            'describe un burro de planchar' =>
            'Un burro de planchar es un mueble plegable diseñado para facilitar el planchado de ropa. Generalmente, consiste en una superficie acolchada montada sobre una estructura metálica ajustable en altura. Cuenta con patas que le dan estabilidad y suele tener una cubierta de tela resistente al calor. Es una herramienta esencial en muchos hogares para mantener la ropa libre de arrugas.',

            'improve' => 'Este producto excepcional, fabricado con materiales de primera calidad, está disponible en diversas tallas para adaptarse a todas sus necesidades. Entre sus características destacan su excepcional durabilidad y su intuitiva facilidad de uso, ofreciendo una excelente relación calidad-precio que garantiza la satisfacción del cliente. Una inversión inteligente para quienes valoran tanto la calidad como la funcionalidad.',

            'default' => 'Gracias por su mensaje. Este producto premium está elaborado con materiales de alta calidad y viene en múltiples tamaños para satisfacer sus necesidades específicas. Sus características principales incluyen extraordinaria durabilidad y facilidad de uso intuitiva. Representa una excelente inversión, ofreciendo un valor excepcional por su precio.'
        ];

        // Elegir respuesta apropiada
        $aiResponse = '';
        $lowerMessage = strtolower(trim($userMessage));

        if (isset($responses[$lowerMessage])) {
            $aiResponse = $responses[$lowerMessage];
        } elseif (strpos($lowerMessage, 'improve') !== false) {
            $aiResponse = $responses['improve'];
        } else {
            $aiResponse = $responses['default'];
        }

        log_debug('AI_RESPONSE', 'Respuesta generada', [
            'longitud' => strlen($aiResponse),
            'primeros_chars' => substr($aiResponse, 0, 50) . '...'
        ]);

        // Si no es streaming, simplemente devolver la respuesta
        if (!$stream) {
            return $aiResponse;
        }

        // Para streaming, configurar cabeceras apropiadas
        header('Content-Type: text/event-stream');
        header('Cache-Control: no-cache');
        header('Connection: keep-alive');
        header('X-Accel-Buffering: no'); // Importante para Nginx

        log_info('STREAM', 'Iniciando streaming de respuesta', [
            'longitud_total' => strlen($aiResponse)
        ]);

        // Dividir la respuesta en fragmentos pequeños (simular streaming)
        $chunks = str_split($aiResponse, 10); // 10 caracteres por fragmento
        $totalChunks = count($chunks);

        // Primero enviar mensaje de inicio de respuesta (similar a OpenAI)
        $startJson = json_encode([
            'id' => 'chatcmpl-' . uniqid(),
            'object' => 'chat.completion.chunk',
            'created' => time(),
            'model' => $model,
            'choices' => [
                [
                    'index' => 0,
                    'delta' => [
                        'role' => 'assistant'
                    ],
                    'finish_reason' => null
                ]
            ]
        ]);
        echo "data: " . $startJson . "\n\n";
        flush();
        usleep(100000); // Pausa de 100ms

        // Enviar cada fragmento como un evento SSE
        foreach ($chunks as $index => $chunk) {
            $isLast = ($index == $totalChunks - 1);

            $data = [
                'id' => 'chatcmpl-' . uniqid(),
                'object' => 'chat.completion.chunk',
                'created' => time(),
                'model' => $model,
                'choices' => [
                    [
                        'index' => 0,
                        'delta' => [
                            'content' => $chunk
                        ],
                        'finish_reason' => $isLast ? 'stop' : null
                    ]
                ]
            ];

            // Enviar evento SSE
            echo "data: " . json_encode($data) . "\n\n";

            log_debug('STREAM', 'Chunk enviado', [
                'indice' => $index + 1,
                'de' => $totalChunks,
                'contenido' => $chunk
            ]);

            // Asegurarse que se envíe inmediatamente
            flush();

            // Pequeña pausa para simular generación progresiva
            usleep(100000); // 100ms
        }

        // Enviar evento final que indica fin de stream
        echo "data: [DONE]\n\n";
        log_info('STREAM', 'Streaming completado', [
            'chunks_enviados' => $totalChunks
        ]);
        flush();
        exit;
    }

    /**
     * Endpoint para probar la conexión con APIs de LLM
     */
    public function test_connection()
    {
        // Solo permitir GET
        if ($this->input->method() !== 'get') {
            $this->output
                ->set_content_type('application/json')
                ->set_status_header(405)
                ->set_output(json_encode(['error' => ['message' => 'Method not allowed']]));
            return;
        }

        // Obtener parámetros
        $provider = $this->input->get('provider') ?: 'openai';

        // Verificar que el proveedor es válido
        if (!isset($this->api_keys[$provider]) || empty($this->api_keys[$provider])) {
            $this->output
                ->set_content_type('application/json')
                ->set_status_header(400)
                ->set_output(json_encode(['error' => ['message' => 'Invalid or unsupported provider']]));
            return;
        }

        // Preparar solicitud simple
        $payload = [
            'model' => $this->input->get('model') ?: ($provider == 'openai' ? 'gpt-3.5-turbo' : ''),
            'messages' => [
                ['role' => 'system', 'content' => 'You are a helpful assistant.'],
                ['role' => 'user', 'content' => 'Say hello world briefly.']
            ],
            'temperature' => 0.7,
            'stream' => false
        ];

        try {
            // Hacer solicitud real al proveedor
            $api_key = $this->api_keys[$provider];
            $endpoint = $this->endpoints[$provider];

            $headers = [
                "Content-Type: application/json",
            ];

            switch ($provider) {
                case 'openai':
                    $headers[] = "Authorization: Bearer {$api_key}";
                    break;
                case 'anthropic':
                    $headers[] = "x-api-key: {$api_key}";
                    $headers[] = "anthropic-version: 2023-06-01";
                    break;
                    // Otros proveedores...
            }

            $curl = curl_init($endpoint);
            curl_setopt($curl, CURLOPT_POST, 1);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
            curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($payload));
            curl_setopt($curl, CURLOPT_TIMEOUT, 30);

            $response = curl_exec($curl);
            $info = curl_getinfo($curl);

            if (curl_errno($curl)) {
                throw new Exception(curl_error($curl));
            }

            curl_close($curl);

            // Devolver resultado completo para diagnóstico
            $result = [
                'success' => true,
                'provider' => $provider,
                'http_code' => $info['http_code'],
                'total_time' => $info['total_time'],
                'raw_response' => $response,
                'parsed_response' => json_decode($response, true)
            ];

            $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode($result));
        } catch (Exception $e) {
            $this->output
                ->set_content_type('application/json')
                ->set_status_header(500)
                ->set_output(json_encode([
                    'success' => false,
                    'error' => $e->getMessage()
                ]));
        }
    }
}
