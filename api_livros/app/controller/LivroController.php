<?php

    require_once "../app/model/LivroModel.php";
    require_once "../app/view/LivroView.php";

   class LivroController {
        private $modelLivro;
        private $viewLivro;

        public function __construct($db) {
            //Conectar no DB e instanciar o model e consultar os livros
            $this->modelLivro = new LivroModel($db);

            //Instanciar a view
            $this->viewLivro = new LivroView();
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
   } 

?>