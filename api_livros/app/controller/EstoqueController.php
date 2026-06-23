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
}

?>