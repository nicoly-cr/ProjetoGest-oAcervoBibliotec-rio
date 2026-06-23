<?php
require_once '../app/model/EstoqueModel.php';
require_once '../app/view/EstoqueView.php';

class EstoqueController{
    private $modelEstoque;
    private $viewEstoque;

    public function __construct($db){
        $this->modelEstoque = new EstoqueModel($db);
        $this->viewEstoque = new EstoqueView();
    }

    public function atualizarSaldo(){
        $data = json_decode(file_get_contents("php/input"), true);
        if(
            isset($data['id_livro']) && 
            isset($data['id_usuario']) && 
            isset($data['quantidade_atual']) && 
            isset($data['quantidade']) && 
            isset($data['tipo']) &&
            isset($data['data'])
        ){
            $nova_quantidade = $this->calculoQuantidade(
                $data['quantidade'], 
                $data['quantidade_atual'], 
                $data['tipo']
            );

            $this->modelEstoque->updateEstoque($data['id_livro'], $nova_quantidade);
            if($nova_quantidade <= 5){
                $this->viewEstoque->sendResponse([
                    'message' => 'ATENÇÃO: Nova quantidade do estoque menor que o mínimo(5).'
                ], 200);
            }else{
                $this->viewEstoque->sendResponse([
                    'message' => 'Estoque atualizado com sucesso.'
                ], 200);
            }
        }else{
            $this->viewEstoque->sendResponse([
                'message' =>'Erro: Confira se os campos foram preenchidos corretamente.'
            ], 400)
        }
    }
}

?>