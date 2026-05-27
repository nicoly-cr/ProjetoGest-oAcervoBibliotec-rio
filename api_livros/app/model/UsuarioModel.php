<?php

    class UsuarioModel {
        // Chave de conexão ao DB
        private $db;

        public function __construct($db){
            // Pega a chave do DB e armazena em $this->db 
            $this->db = $db;
        }

        public function loginUser($email, $senha) {
            // 1. Preparamos a consulta para buscar o usuário pelo email
            $stmt = $this->db->prepare("SELECT * FROM Usuarios WHERE email = :email");
            $stmt->bindValue(":email", $email);
            $stmt->execute();
            $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

            // 2. Verificamos se o usuário existe e se a senha corresponde
            // Nota: O script SQL fornecido insere senhas em texto puro ('123').
            // Para um sistema real, use password_hash() no cadastro e password_verify() aqui.
            if ($usuario && $senha === $usuario['senha']) {
                // Retorna o usuário (sem a senha, por segurança)
                unset($usuario['senha']); 
                return $usuario;
            } else {
                return false; // Login falhou
            }
        }
    }

?>
