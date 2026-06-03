<?php

//Implementa novo livro
class EstoqueModel{
    private $db;

    public function __construct($db){
        $this->db = $db;
    }

    public function createEstoque($id_livro, $quantidade){
        $stmt = $this->db->prepare("
        INSERT INTO Estoque (id_livro, quantidade_atual)
        VALUE (:id_livro, :quantidade");
        $stmt->bindValue(':id_livro', $id_livro);
        $stmt->bindValue(':quantidade', $quantidade);
        return $stmt->execute();
    }
}

?>