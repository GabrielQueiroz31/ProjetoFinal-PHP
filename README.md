# GaluBikeShop

Sistema web simples para controle de uma loja de produtos para bicicletas.

## Sobre o Projeto

A **GaluBikeShop** é um projeto acadêmico desenvolvido para simular o funcionamento básico de uma loja de produtos para bicicletas.

O sistema foi desenvolvido utilizando **HTML**, **CSS**, **PHP** e **Postgres**, com o objetivo de praticar cadastro, listagem, edição, exclusão e conexão com banco de dados.

## Objetivo

O objetivo do projeto é criar um sistema simples de controle de clientes, produtos e vendas, aplicando os conhecimentos de desenvolvimento web e banco de dados.

## Tecnologias Utilizadas

- HTML
- CSS
- PHP
- Postgres

## Protótipo no Figma

O protótipo de baixa fidelidade das telas do sistema foi desenvolvido no Figma. Você pode acessar no link abaixo:

[Ver protótipo no Figma](https://www.figma.com/proto/ioIFVbsbrJZPoFXoC3igVs/Sem-t%C3%ADtulo?node-id=0-1&t=wFj6Lg8E7tDvhZeN-1)

## Requisitos

### Requisitos Funcionais

- O sistema deve permitir cadastrar clientes.
- O sistema deve permitir listar os clientes.
- O sistema deve permitir editar os dados dos clientes.
- O sistema deve permitir excluir clientes.
- O sistema deve permitir cadastrar produtos.
- O sistema deve permitir listar os produtos.
- O sistema deve permitir editar os dados dos produtos.
- O sistema deve permitir excluir produtos.
- O sistema deve permitir cadastrar vendas.
- O sistema deve permitir listar as vendas.

### Requisitos Não Funcionais

- O sistema deve ter uma interface organizada e profissional.
- O sistema deve utilizar PHP no desenvolvimento do back-end.
- O sistema deve utilizar Postgres como banco de dados.
- O sistema deve possuir um CSS padrão para todas as páginas.
- O código deve ser organizado em arquivos separados.

## Regras de Negócio

- Um cliente deve possuir nome, e-mail e telefone.
- Um produto deve possuir nome, quantidade, categoria e preço.
- Uma venda deve estar relacionada a um cliente e a um produto.
- Não pode ser registrada uma venda sem informar cliente, produto e quantidade.
- Após uma venda, a quantidade do produto deve ser atualizada no estoque.
- Não pode ser realizada uma venda se a quantidade solicitada for maior que o estoque disponível.
- O sistema deve calcular o valor total da venda automaticamente com base no preço unitário e na quantidade.
- O sistema deve exibir mensagens de erro ou sucesso ao realizar operações de cadastro, edição ou exclusão.

## Autor

Gabriel Gomes de Queiroz 
