create database pokemon;

\c pokemon

create table pokemon_tb(
    id serial not null PRIMARY KEY,
    name varchar(100) not null,
    height float NOT NULL,
    weight float NOT NULL,
    avatar varchar(255) NOT NULL,
    createdAt timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
);