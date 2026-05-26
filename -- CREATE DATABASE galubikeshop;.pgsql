-- CREATE DATABASE galubikeshop;

CREATE TABLE clientes (
    id SERIAL PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    telefone VARCHAR(20),
    senha VARCHAR(255) NOT NULL
);

CREATE TABLE produtos (
    id SERIAL PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    categoria VARCHAR(100) NOT NULL,
    preco DECIMAL(10,2) NOT NULL,
    quantidade INT NOT NULL
);

CREATE TABLE vendas (
    id SERIAL PRIMARY KEY,
    cliente_id INT NOT NULL,
    produto_id INT NOT NULL,
    quantidade INT NOT NULL,
    valor_total DECIMAL(10,2) NOT NULL,
    data_venda TIMESTAMP DEFAULT CURRENT_TIMESTAMP,

    FOREIGN KEY (cliente_id) REFERENCES clientes(id),
    FOREIGN KEY (produto_id) REFERENCES produtos(id)
);

INSERT INTO clientes (nome, email, telefone, senha)
VALUES
('João Silva', 'joao@email.com', '19999999999', '123456'),
('Ana Souza', 'ana@email.com', '19888888888', '123456');

INSERT INTO produtos (nome, categoria, preco, quantidade)
VALUES
('Bicicleta Aro 29', 'Bicicleta', 1500.00, 5),
('Capacete', 'Acessório', 120.00, 10),
('Luva', 'Acessório', 60.00, 15);

select * from clientes;

select * from produtos;