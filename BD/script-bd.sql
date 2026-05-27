	CREATE DATABASE livro_db;
    
    USE livro_db;
    
    CREATE TABLE Usuarios(
		id_usuario INT PRIMARY KEY AUTO_INCREMENT,
        nome VARCHAR(100) NOT NULL,
        sobrenome VARCHAR(100) NOT NULL,
        email VARCHAR(150) NOT NULL UNIQUE,
        senha VARCHAR(255) NOT NULL
    );
    
-- Atividade prática 1

	CREATE TABLE Livros (
		id_livro INT PRIMARY KEY AUTO_INCREMENT,
        titulo VARCHAR(100) NOT NULL,
        descricao VARCHAR(500) NOT NULL,
        autor VARCHAR(100) NOT NULL
    );
    
    CREATE TABLE Estoque (
		id_estoque INT PRIMARY KEY AUTO_INCREMENT,
		id_livro INT,
        id_usuario INT,
        CONSTRAINT fk_estoque_livro
			FOREIGN KEY (id_livro) REFERENCES Livros(id_livro)
            ON DELETE CASCADE,
        quantidade_atual INT
	);
    
    CREATE TABLE Log_movimentacao_estoque (
		id_usuario INT,
        id_livro INT,
        data_movimentacao DATE NOT NULL,
        quantidade INT,
        tipo VARCHAR(100) NOT NULL,
        CONSTRAINT fk_id_livro 
			FOREIGN KEY (id_livro) REFERENCES Livros(id_livro)
            ON DELETE CASCADE,
		CONSTRAINT fk_log_usuario
			FOREIGN KEY (id_usuario) REFERENCES Usuarios(id_usuario)
            ON DELETE RESTRICT
    );
    
-- Atividade prática 2

	INSERT INTO Usuarios (nome, sobrenome, email, senha) VALUES
	('Nicoly', 'Roviero', 'nicoly.roviero@email.com', '12345678'),
	('Sávio', 'Almeida', 'savio.almeida@email.com', '33445566'),
	('Ayumi', 'Roviero', 'ayumi.roviero@email.com', '02468102'),
	('Aleandra', 'Roviero', 'aleandra.roviero@email.com', '13579113'),
	('Jefferson', 'Roviero', 'jefferson.roviero@email.com', '36912153'),
	('Beatriz', 'Mozaner', 'beatriz.mozaner@email.com', '65379842'),
	('Hannah', 'Wegermann', 'hannah.wegermann@email.com', '11223344'),
	('Isabelly', 'Ribeiro', 'isabelly.ribeiro@email.com', '22334455'),
	('Fabiana', 'Almeida', 'ju.mendes@email.com', '44556677'),
	('Lucas', 'Silva', 'lucas.s@email.com', '55667788'),
	('Patrícia', 'Gomes', 'patri.g@email.com', '66778899'),
	('Gabriel', 'Souza', 'gabriel.s@email.com', '77889900'),
	('Camila', 'Ribeiro', 'camila.r@email.com', '88990011'),
	('Bruno', 'Ferreira', 'bruno.f@email.com', '99001122'),
	('Letícia', 'Dias', 'leticia.d@email.com', '00112233');

    INSERT INTO Livros (titulo, descricao, autor) VALUES
	('Dom Casmurro', 'Um clássico sobre a dúvida de Bentinho.', 'Machado de Assis'),
	('O Pequeno Príncipe', 'Uma fábula sobre amizade e valores.', 'Antoine de Saint-Exupéry'),
	('1984', 'Uma distopia sobre vigilância e controle.', 'George Orwell'),
	('O Alquimista', 'A jornada de um jovem em busca de seu destino.', 'Paulo Coelho'),
	('Harry Potter', 'O início da jornada do jovem bruxo em Hogwarts.', 'J.K. Rowling'),
	('A Hora da Estrela', 'A história de Macabéa no Rio de Janeiro.', 'Clarice Lispector'),
	('Memórias Póstumas', 'Um defunto autor conta sua vida.', 'Machado de Assis'),
	('Ensaio sobre a Cegueira', 'Uma epidemia de cegueira branca.', 'José Saramago'),
	('Capitães da Areia', 'A vida de meninos de rua em Salvador.', 'Jorge Amado'),
	('O Cortiço', 'A vida em uma habitação coletiva.', 'Aluísio Azevedo'),
	('Vidas Secas', 'A luta de uma família contra a seca.', 'Graciliano Ramos'),
	('Sagarana', 'Contos regionalistas de Minas Gerais.', 'Guimarães Rosa'),
	('Fahrenheit 451', 'Um futuro onde livros são proibidos.', 'Ray Bradbury'),
	('A Metamorfose', 'Gregor Samsa acorda transformado em inseto.', 'Franz Kafka'),
	('O Processo', 'Um homem processado sem saber o motivo.', 'Franz Kafka');
    
    INSERT INTO Estoque (id_livro, id_usuario, quantidade_atual) VALUES
	(1,1,10),
	(2,2,5),
	(3,3,8),
	(4,4,12),
	(5,5,7),
	(6,6,15),
	(7,7,9),
	(8,8,6),
	(9,9,11),
	(10,10,4);
    
    INSERT INTO Log_movimentacao_estoque (id_usuario, id_livro, data_movimentacao, quantidade, tipo) VALUES
	(1,1,'2026-02-01',5,'ENTRADA'),
	(2,2,'2026-02-02',2,'SAIDA'),
	(3,3,'2026-02-03',3,'ENTRADA'),
	(4,4,'2026-02-04',1,'SAIDA'),
	(5,5,'2026-02-05',4,'ENTRADA'),
	(6,6,'2026-02-06',2,'SAIDA'),
	(7,7,'2026-02-07',3,'ENTRADA'),
	(8,8,'2026-02-08',1,'SAIDA'),
	(9,9,'2026-02-09',6,'ENTRADA'),
	(10,10,'2026-02-10',2,'SAIDA');
    
-- Atividade prática 3

	SELECT nome, sobrenome FROM Usuarios;
    
    SELECT 
    Livros.titulo, Estoque.quantidade_atual 
		FROM Livros 
        INNER JOIN Estoque ON Livros.id_livro = Estoque.quantidade_atual;
        
	SELECT 
    Usuarios.nome, Livros.titulo, Log_movimentacao_estoque.quantidade, log_movimentacao_estoque.tipo
		FROM log_movimentacao_estoque
		INNER JOIN Usuarios ON Log_movimentacao_estoque.id_usuario = Usuarios.id_usuario
		INNER JOIN Livros ON Log_movimentacao_estoque.id_livro = Livros.id_livro;
        
	SELECT
    Livros.titulo,
    Estoque.quantidade_atual
		FROM Livros 
		INNER JOIN Estoque  ON Livros.id_livro = Estoque.id_livro WHERE Estoque.quantidade_atual < 5;
        
-- Atividade prática 4

	UPDATE Usuarios 
		SET sobrenome = 'Mendes'
        WHERE id_usuario = 9;
        
	UPDATE Estoque 
		SET quantidade_atual = quantidade_atual + 10
        WHERE id_livro = 5;
        
	UPDATE Usuarios 
		SET senha = '12345678'
        WHERE email = 'nicoly.roviero@email.com';
        
	UPDATE Estoque
		SET quantidade_atual = quantidade_atual + 1
		WHERE quantidade_atual = 0;
        
-- Ajustado com aspas simples e string na senha
	SELECT * FROM Usuarios WHERE email = 'nicoly.roviero@email.com' AND senha = '12345678';

	SELECT 
	l.id_livro, l.titulo, l.descricao, l.autor,
	e.quantidade_atual 
	AS estoque 
	FROM Livros l 
	INNER JOIN Estoque e 
	ON l.id_livro = e.id_livro;

	SELECT * 
    FROM Livros
    JOIN Estoque ON Estoque.id_livro = Livros.id_livro
    WHERE Livros.titulo LIKE "%O%";