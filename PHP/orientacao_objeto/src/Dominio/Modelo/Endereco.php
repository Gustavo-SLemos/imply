<?php
namespace Lemos\Comercial\Dominio\Modelo;
require_once 'autoload.php';

class Endereco
{
    use AcessoAtributos;
    private ?int $idEndereco;
    private string $uf;
    private string $cidade;
    private string $nomeLogradouro;
    private string $numero;
    private string $bairro;
    private string $cep;
    private ?int $idCliente;

    public function __construct(?int $idEndereco, string $uf, string $cidade, string $nomeLogradouro, string $numero, string $bairro, string $cep, ?int $idCliente)
    {
        $this->idEndereco = $idEndereco;
        $this->uf = $uf;
        $this->cidade = $cidade;
        $this->nomeLogradouro = $nomeLogradouro;
        $this->numero = $numero;
        $this->bairro = $bairro;
        $this->cep = $cep;
        $this->idCliente = $idCliente;
    }

    //Métodos GET
    public function getUf(): string
    {
        return $this->uf;
    }

    public function getCidade(): string
    {
        return $this->cidade;
    }

    public function getNomeLogradouro(): string
    {
        return $this->nomeLogradouro;
    }

    public function getNumero(): string
    {
        return $this->numero;
    }

    public function getBairro(): string
    {
        return $this->bairro;
    }

    public function getCep(): string
    {
        return $this->cep;
    }

    //Métodos SET
    public function setUf(string $uf): void
    {
        $this->uf = $uf;
    }

    public function setCidade(string $cidade): void
    {
        $this->cidade = $cidade;
    }

    public function setNomeLogradouro(string $nomeLogradouro): void
    {
        $this->nomeLogradouro = $nomeLogradouro;
    }

    public function setNumero(int $numero): void
    {
        $this->numero = $numero;
    }

    public function setBairro(string $bairro): void
    {
        $this->bairro = $bairro;
    }

    public function setCep(int $cep): void
    {
        $this->cep = $cep;
    }


}