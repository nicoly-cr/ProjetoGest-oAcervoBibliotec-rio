# Projeto de Gestão de Acervo Bibliográfico

Este é um sistema completo para a gestão de acervos bibliográficos e controlo de stock de livros. O projeto está estruturado de forma clara, integrando um backend em PHP (com a arquitetura MVC) e um frontend web independente construído em HTML.

---

## 🚀 Funcionalidades

* **Cadastro e Controlo de Utilizadores:** Gestão de acessos e perfis do sistema.
* **Gestão de Livros:** Registo, edição, remoção e listagem de obras literárias.
* **Movimentação de Stock:** Controlo de entrada e saída de exemplares no acervo.
* **API RESTful:** Endpoints estruturados em PHP para comunicação assíncrona com o frontend.

---

## 📂 Estrutura do Projeto

Abaixo encontra-se a representação atualizada da árvore de diretórios do sistema:

```text
PROJETO_RAIZ/
│
├── app/                         # Camada de aplicação (Arquitetura MVC)
│   ├── controller/              # Controladores (Regras de negócio e rotas)
│   │   ├── LivroController.php
│   │   └── UsuarioController.php
│   ├── model/                   # Modelos (Comunicação com a Base de Dados)
│   │   ├── LivroModel.php
│   │   └── UsuarioModel.php
│   └── view/                    # Visualizações (Formatadores de resposta da API)
│       ├── LivroView.php
│       └── UsuarioView.php
│
├── config/                      # Configurações do sistema
│   ├── db.php                   # Conexão oficial com a base de dados
│   ├── testedb.php              # Script de teste de conexão 1
│   └── testedb2.php             # Script de teste de conexão 2
│
├── public/                      # Diretório público de entrada do servidor
│   └── index.php                # Arquivo principal / Router da API
│
├── .htaccess                    # Configurações do Apache (Reescrita de URL para rotas limpas)
│
├── BD/                          # Scripts da Base de Dados
│   └── script-bd.sql            # Estrutura das tabelas e dados iniciais
│
├── front_livros/                # Interface do Utilizador (Frontend)
│   ├── cadastro.html            # Ecrã de cadastro de utilizadores/livros
│   ├── index.html               # Ecrã de login / Entrada principal
│   ├── listaLivros.html         # Painel de visualização do acervo
│   ├── movimentarEstoque.html   # Ecrã de entrada e saída de livros
│   └── principal.html           # Dashboard / Menu principal do sistema
│
└── readme.md                    # Documentação do projeto