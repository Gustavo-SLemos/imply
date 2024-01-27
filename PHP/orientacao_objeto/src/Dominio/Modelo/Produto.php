<?php

namespace Lemos\Comercial\Dominio\Modelo;

    class Produto
    {
        private ?int $idProduto;
        private string $nomeProduto;
        private float $precoProduto;

        public function __construct(?int $idProduto, string $nomeProduto, float $precoProduto)
        {
            $this->idProduto = $idProduto;
            $this->nomeProduto = $nomeProduto;
            $this->precoProduto = $precoProduto;
        }

        public function getIdProduto(): ?int
        {
            return $this->idProduto;
        }

        public function getNomeProduto(): string
        {
            return $this->nomeProduto;
        }

        public function getPrecoProduto(): float
        {
            return $this->precoProduto;
        }

        public function setIdProduto(int $id): void
        {
            $this->idProduto = $id;
        }

        public function setProduto(string $nome): void
        {
            $this->nomeProduto = $nome;
        }

        public function setPreco(float $preco): void
        {
            $this->precoProduto = $preco;
        }
    }