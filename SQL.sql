CREATE TABLE authors (
    id SERIAL PRIMARY KEY,
    nome VARCHAR(100),
    nacionalidade VARCHAR(50),
    data_nascimento DATE
);

CREATE TABLE genres (
    id SERIAL PRIMARY KEY,
    nome VARCHAR(50)
);

CREATE TABLE books (
    id SERIAL PRIMARY KEY,
    titulo VARCHAR(150),
    ano_publicacao INT,
    num_paginas INT,
    id_autor INT REFERENCES authors(id),
    id_genero INT REFERENCES genres(id)
);

CREATE TABLE readings (
    id SERIAL PRIMARY KEY,
    id_livro INT REFERENCES books(id),
    data_inicial DATE,
    data_final DATE,
    nota INT CHECK (nota >= 1 AND nota <= 10),
    comentario TEXT
);
