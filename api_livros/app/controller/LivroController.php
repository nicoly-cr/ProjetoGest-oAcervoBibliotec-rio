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

    public function createLivro(){
        $data = json_decode(file_get_contents("php://input"), true);

        if(isset($data['titulo']) && isset($data['descricao']) && isset($data['autor'])){

            try{
                $this->db->beginTransaction();
                $idLivro = $this->modelLivro->createLivro(
                    $data['titulo'],
                    $data['descricao'],
                    $data['autor']
                );

                if(!$idLivro){
                    throw new Exepition ('Não foi possível inserir o livro.');
                }
                $estoque$this->modelEstoque->createEstoque($idLivro, 0);

                if(!estoqueCriado){
                    throw new Exeption('Não foi possível inserir o estoque inicial.');
                }

                $this->db->commit();
                $this->viewLivro->sendResponse([
                    'message' => 'Livro criado com sucesso.',
                    'id_livro' => $idLivro
                ]);
            }cacth(Throwable $e){
                if($this->db->inTransaction()){
                    $this->db->rollback();
                }

                $this->viewLivro->sendResponse([
                    'message' => 'Erro ao cadastrar novo livro.',
                    'detalhe' => $e->getMessage()
                ], 400);
            }
            
        }else{
            $this->viewLivro->sendResponse(
                ['message' => 'Dados inválidos.'],
                400
            );
        }
    }
} 

?>