<?php

namespace Lemos\Comercial\Dominio\Modelo;

use DateTimeInterface;

class Cliente extends Pessoa
{
    //private string $dataNascimento;
    private float $renda;

    public function __construct(?int $id, string $nome, DateTimeInterface $dataNascimento, Endereco $endereco, float $renda)
    {
        parent::__construct($nome, $dataNascimento, $endereco);
        //$this->dataNascimento = $dataNascimento;
        $this->renda = $renda;
    }

    //GET

    public function getDataNascimento(): string
    {
        return $this->dataNascimento;
    }

    public function getRenda(): float
    {
        return $this->renda;
    }

    //SET
    public function setDataNascimento(string $dataNascimento): void
    {
        $this->dataNascimento = $dataNascimento;
    }

    public function setRenda(float $renda): void
    {
        $this->renda = $renda;
    }

    //IMPLEMENTAÇÃO DO MÉTODO ABSTRATO setDesconto()
    public function setDesconto(): void
    {
        $this->desconto = 0.05;
    }

    public function __toString(): string
    {
        return "<p>Nome: " .$this->nome .
        "<br>Idade: " .$this->idade . "anos" .
        "<br>Nasc.: " .$this->getDataNascimento()->format('d/m/Y') .
        "<br>End.: " . $this->endereco->getNomeLogradouro() . ", " .
        $this->endereco->getNumero() . " - " . $this->endereco->getBairro() .
        "<br>Data Nasc.: " . $this->dataNascimento .
        "<br>Renda R$ " . $this->renda .
        "</p>";
    }
}