<?php

require_once "../app/model/LivroModel.php";
require_once "../app/view/LivroView.php";
require_once "../app/model/EstoqueModel.php";

class LivroController {
    private $modelLivro;
    private $viewLivro;
    private $modelEstoque;
    private $db;

    public function __construct($db) {
        $this->db = $db;
        //Conectar no DB e instanciar o model e consultar os livros
        $this->modelLivro = new LivroModel($db);
        //Instanciar a view
        $this->viewLivro = new LivroView();
        //Implementar criar livro
        $this->modelEstoque = new EstoqueModel($db);
    }

    public function getLivros() {
        $livros = $this->modelLivro->buscarLivros();
        $this->viewLivro->sendResponse($livros, 200);
    }

    public function getLivrosPeloTitulo() {
        $titulo = $_GET['titulo'];
        if(isset($titulo)){
            $data = $this->modelLivro->getLivrosPeloTitulo($titulo);
            $this->viewLivro->sendResponse($data, 200);
        } else {
            $this->viewLivro->sendResponse([
                'message' => 'Título inválido.'
            ], 400);
        }
    }

    public function getLivrosPeloId() {
        $id = $_GET['id'];
        if (isset($id)){
            $livro = $this->modelLivro->getLivrosPeloId($id);
            $this->viewLivro->sendResponse($livro, 200);
        } else {
            $this->viewLivro->sendResponse(
                ['message' => 'Id inválido.'],
                400
            );
        }
    }

    public function createLivro() {
        $data = json_decode(file_get_contents("php://input"), true);

        if ( isset($data['titulo']) && 
            isset($data['descricao']) && 
            isset($data['autor']) ) {
            
            try {
                $this->db->beginTransaction();
                $idLivro = $this->modelLivro->createLivro(
                    $data['titulo'],
                    $data['autor'],
                    $data['descricao']
                );

                if (!$idLivro){
                    throw new Exception('Nao foi possivel inserir o Livro');
                }
                
                $estoqueCriado = $this->modelEstoque->createEstoque($idLivro, 0);

                if (!$estoqueCriado){
                    throw new Exception('Nao foi possivel inserir o Estoque inicial do Calori!');
                }

                $this->db->commit();

                //[Sprint8] inserido codigo HTTP_RESPONSE 201 - Registro criado com sucesso
                $this->viewLivro->sendResponse([
                    'message' => 'Livro criado com sucesso!',
                    'id_livro' => $idLivro
                ], 201);
                
            } catch(Throwable $e){
                if ($this->db->inTransaction()){
                    $this->db->rollback();
                }

                $this->viewLivro->sendResponse([
                    'message' => 'Erro ao cadastrar Novo Livro',
                    'detalhe' => $e->getMessage()
                ], 400);
            }
        } else {
            $this->viewLivro->sendResponse(
                ['message' => 'Dados invalidos!'],
                400
            );
        } 
    }

}
?>