<?php
 
    require_once 'db.php';
    try {
        $database = new Database();

        $db = $database->getConnection();
        if ($db) {

            echo " Sucesso: A ponte com o Banco de Dados está de pé!" . "<br>";
        }
    } catch (Exception $e) {
        echo " Erro: Algo deu errado na conexão. Verifique os dados no db.php." . "<br>";
    }

    echo "<h1> Testando a consulta de livros:" . "<br><hr> </h1>";

    $stmt = $db->query("SELECT id_livro, titulo, descricao, autor FROM livros");

    $livros = [];
    
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $livros[] = $row;
        }

    echo json_encode([
                    "id_livro" => $row['id_livro'],
                    "titulo" => $row['titulo'],
                    "descricao" => $row['descricao'],
                    "autor" => $row['autor']
                ]);
?>