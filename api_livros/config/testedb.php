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
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        echo "ID: " . $row['id_livro'] . "<br>";
        echo "Título: " . $row['titulo'] . "<br>";
        echo "Descrição: " . $row['descricao'] . "<br>";
        echo "Autor: " . $row['autor'] . "<br><hr>";
        }

    echo "<h1>Testando a consulta de usuários:" . "<br><hr> </h1>";

    $stmt = $db->query("SELECT id_usuario, nome, email FROM usuarios");
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        echo "ID: " . $row['id_usuario'] . "<br>";
        echo "Nome: " . $row['nome'] . "<br>";
        echo "Email: " . $row['email'] . "<br><hr>";
        }

    echo "<h1>Testando a consulta de movimentações:" . "<br><hr> </h1>";
    $stmt = $db->query("SELECT id_usuario, id_livro, tipo, data_movimentacao FROM Log_movimentacao_estoque");
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        echo "ID Usuário: " . $row['id_usuario'] . "<br>";
        echo "ID Livro: " . $row['id_livro'] . "<br>";
        echo "Tipo: " . $row['tipo'] . "<br>";
        echo "Data: " . $row['data_movimentacao'] . "<br><hr>";
        }

?>