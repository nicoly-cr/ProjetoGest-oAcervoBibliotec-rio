<?php

    require_once '../app/model/UsuarioModel.php';
    require_once '../app/view/UsuarioView.php';

    class UsuarioController {
        private $modelUsuario; // Para armazenar "as informações" da classe Controller, em forma de atributo
        private $viewUsuario;

        public function __construct($db) {
            // Manipula as informações da classe e do DB
            $this->modelUsuario = new UsuarioModel($db);

            // Cria os elementos da view para o usuário 
            $this->viewUsuario = new UsuarioView();
        }

        public function loginUsuario() {
            // Recebe os dados da requisição POST e decodifica o JSON para um array associativo 
            $data = json_decode(file_get_contents("php://input") , true);
            
            if (isset($data['email']) && isset($data['senha'])) {
                // Chama a função que faz o login do usuário no Model, passando o email e a senha digitados no formulário 
                $usuario = $this->modelUsuario->loginUser($data['email'], $data['senha']);
                // chama View passando resultado de Model e status 200
                if ($usuario) {
                    $this->viewUsuario->sendResponse($usuario, 200);
                } else {
                    $this->viewUsuario->sendResponse(['message' => 'Login ou senha incorretos.'], 401);
                }
            } else {
                $this->viewUsuario->sendResponse(['message' => 'Dados incompletos.'], 400);
            }
        }
    }

?>
