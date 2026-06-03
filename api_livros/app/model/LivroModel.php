<?php

class LivroModel {
    private $db;
        
    public function __construct($db) {
        $this->db = $db;
    }

    public function buscarLivros() {
        $stmt = $this->db->query(
            "SELECT 
                Livros.id_livro,
                Livros.titulo,
                Livros.descricao,
                Livros.autor,
                Estoque.quantidade_atual AS estoque
            FROM Livros
            INNER JOIN Estoque ON Livros.id_livro = Estoque.id_livro;"
        );
      
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getLivrosPeloTitulo($titulo){
        $stmt = $this->db->prepare("
            SELECT * 
            FROM Livros
            JOIN Estoque ON Estoque.id_livro = Livros.id_livro
            WHERE Livros.titulo LIKE :titulo
        ");

        $stmt->bindValue(':titulo', '%' . $titulo . '%');
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function createLivro($titulo, $autor, $descricao){
        $stmt = $this->db->prepare("
            INSERT INTO Livros (TITULO, AUTOR, DESCRICAO) 
            VALUES (:titulo, :autor, :descricao)
        ");
        $stmt->bindValue(':titulo', $titulo);
        $stmt->bindValue(':autor', $autor);
        $stmt->bindValue(':descricao', $descricao);
        if ($stmt->execute()){
            return $this->db->lastInsertId();
        };
        return false;
    }
}

?>
