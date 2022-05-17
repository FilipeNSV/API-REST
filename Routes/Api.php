<?php

namespace Routes;

use Exception;

class Api
{
    public function __construct()
    {
        header('Content-Type: application/json');

        if ($_GET['url']) {
            $url = $this->url();

            if ($url[0] === 'api') {
                array_shift($url);

                $controller = 'App\Controllers\\'.ucfirst($url[0]).'Controller';
                array_shift($url);
                
                $methodRes = strtolower($_SERVER['REQUEST_METHOD']);
                $method = $methodRes === 'patch' ? 'update' : $methodRes;

                try {
                    $response = call_user_func_array(array(new $controller, $method), $url);

                    http_response_code(200);
                    echo json_encode(array('status' => 'success', 'data' => $response));
                    exit;
                } catch (Exception $er) {
                    echo "Erro: " . $er->getMessage();
                }
            }
        }
    }

    public function url()
    {
        $url = explode('/', $_GET['url']);
        return $url;
    }
}
