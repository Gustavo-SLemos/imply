<?php

namespace Lemos\Comercial\Infraestrutura\Repositorio;

use Lemos\Comercial\Dominio\Modelo\Funcionario;
use Lemos\Comercial\Dominio\Repositorio\RepositorioFuncionarios;

use Lemos\Comercial\Dominio\Modelo\Endereco;
use DateTimeImmutable;

use PDO;

class PdoRepositorioFuncionario implements RepositorioFuncionarios
{
    private PDO $conexao;

    private function __construct(PDO $conexao)
    {
        $this->conexao = $conexao;
    }

    public function todosFuncionarios(): array
    {
        $sqlConsulta = "SELECT * FROM funcionario";
        $stmt = $this->conexao->query($sqlConsulta);

        return $this->hidratarListaFuncionarios($stmt);
    }

    public function todosFuncionariosComEndereco(): array
    {
        $sqlConsulta = "SELECT * FROM funcionario JOIN endereco ON id = idFuncionario";
        $stmt = $this->conexao->query($sqlConsulta);
        $resultado = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $listaFuncionario = [];

        foreach($resultado as $linha) {
            if(!array_key_exists($linha['id'], $listaFuncionario)) {
                $listaFuncionario[$linha['id']] = new Funcionario(
                    $linha['id'],
                    $linha['nome'],
                    new DateTimeImmutable($linha['dataNascimento']),
                    new Endereco(NULL, "", "", "", "", "", "", NULL),
                    $linha['cargo'],
                    $linha['salario']);
            }

            $endereco = new Endereco(
                $linha['idEndereco'],
                $linha['uf'],
                $linha['cidade'],
                $linha['nomeLogradouro'],
                $linha['numero'],
                $linha['bairro'],
                $linha['cep'],
                $linha['idFuncionario']);
                
                $listaFuncionario[$linha['id']]->setEndereco($endereco);
        }

        return $listaFuncionario;
    }

    public function salvar(Funcionario $funcionario): bool
    {
        if ($funcionario->getId() === null) {
            return $this->createFuncionario($funcionario);
        }

        return $this->updateFuncionario($funcionario);
    }

    private function createFuncionario(Funcionario $funcionario): bool
    {
        $sqlInsert = "INSERT INTO funcionario (nome, dataNascimento, cargo, salario) VALUES (:nome, :datanasc, :cargo, :salario);";
        $stmt = $this->conexao->prepare($sqlInsert);
        $stmt->bindValue(':nome', $funcionario->getNome(), PDO::PARAM_STR);
        $stmt->bindValue(':datanasc', $funcionario->getDataNascimento()->format('Y-m-d'));
        $stmt->bindValue(':cargo', $funcionario->getCargo(), PDO::PARAM_STR);
        $stmt->bindValue(':salario', $funcionario->getSalario(), PDO::PARAM_STR);
        $sucesso = $stmt->execute();

        if ($sucesso) {
            $funcionario->setId($this->conexao->lastInsertId());
            $this->criaEndereco($funcionario->getEndereco(), $funcionario);
        }

        return $sucesso;
    }

    public function ler(Funcionario $funcionario): array
    {
        $sqlConsulta = "SELECT * FROM funcionario WHERE id = :id;";
        $stmt = $this->conexao->prepare($sqlConsulta);
        $stmt->bindValue(':id', $funcionario->getId(), PDO::PARAM_INT);
        $stmt->execute();

        return $this->hidratarListaFuncionarios($stmt);
    }

    public function updateFuncionario(Funcionario $funcionario): bool
    {
        $sqlUpdate = "UPDATE funcionario SET nome = :nome, dataNascimento = :datanasc, cargo = :cargo, salario = :salario WHERE id = :id;";
        $stmt = $this->conexao->prepare($sqlUpdate);
        $stmt->bindValue(':nome', $funcionario->getNome(), PDO::PARAM_STR);
        $stmt->bindValue(':datanasc', $funcionario->getDataNascimento()->format('Y-m-d'));
        $stmt->bindValue(':cargo', $funcionario->getCargo(), PDO::PARAM_STR);
        $stmt->bindValue(':salario', $funcionario->getSalario(), PDO::PARAM_STR);

        $stmt->bindValue(':id', $funcionario->getId(), PDO::PARAM_INT);

        return $stmt->execute();
    }

    public function delete(Funcionario $funcionario): bool
    {
        $stmt = $this->conexao->prepare('DELETE FROM funcionario WHERE id = ?;');
        $stmt->bindValue(1, $funcionario->getId(), PDO::PARAM_INT);

        return $stmt->execute();
    }

    //CRIAR ENDERECO
    public function criaEndereco(Endereco $endereco, Funcionario $funcionario): bool
    {
        $idFuncionario = $funcionario->getId();
        $sqlInsert = "INSERT INTO endereco (uf, cidade, nomeLogradouro, numero, bairro, cep, idFuncionario) VALUES (:uf, :cidade, :nomeLogradouro, :numero, :bairro, :cep, :idFuncionario);";

        $stmt = $this->conexao->prepare($sqlInsert);

        $stmt->bindValue(':uf', $endereco->getUf(), PDO::PARAM_STR);
        $stmt->bindValue(':cidade', $endereco->getCidade(), PDO::PARAM_STR);
        $stmt->bindValue(':nomeLogradouro', $endereco->getNomeLogradouro(), PDO::PARAM_STR);
        $stmt->bindValue(':numero', $endereco->getNumero(), PDO::PARAM_STR);
        $stmt->bindValue(':bairro', $endereco->getBairro(), PDO::PARAM_STR);
        $stmt->bindValue(':cep', $endereco->getCep(), PDO::PARAM_STR);

        $stmt->bindValue(':idFuncionario', $idFuncionario, PDO::PARAM_INT);

        $sucesso = $stmt->execute();

        if ($sucesso) {
            $endereco->setId($this->conexao->lastInsertId());
        }

        return $sucesso;
    }

    public function atualizaEndereco(Endereco $endereco, Funcionario $funcionario): bool
    {
        $idFuncionario = $funcionario->getId();
        $sqlUpdate = "UPDATE endereco SET uf = :uf, cidade = :cidade, nomeLogradouro = :nomeLogradouro, numero = :numero, bairro = :bairro, cep = :cep WHERE idEndereco = :idFuncionario;";
        $stmt = $this->conexao->prepare($sqlInsert);

        $stmt->bindValue(':uf', $endereco->getUf(), PDO::PARAM_STR);
        $stmt->bindValue(':cidade', $endereco->getCidade(), PDO::PARAM_STR);
        $stmt->bindValue(':nomeLogradouro', $endereco->getNomeLogradouro(), PDO::PARAM_STR);
        $stmt->bindValue(':numero', $endereco->getNumero(), PDO::PARAM_STR);
        $stmt->bindValue(':bairro', $endereco->getBairro(), PDO::PARAM_STR);
        $stmt->bindValue(':cep', $endereco->getCep(), PDO::PARAM_STR);

        $stmt->bindValue(':idFuncionario', $idFuncionario, PDO::PARAM_INT);

        $sucesso = $stmt->execute();
    }


    //HIDRATAR OS DADOS
    public function hidratarListaFuncionarios(\PDOStatement $stmt): array
    {
        $listaDadosFuncionarios = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $listaFuncionarios = [];

        foreach ($listaDadosFuncionarios as $dadosFuncionario) {
            $funcionario = new Funcionario (
                $dadosFuncionario['id'],
                $dadosFuncionario['nome'],
                new DataTimeImmutable($dadosFuncionario['dataNascimento']),
                new Endereco(NULL, "", "", "", "", "", "", NULL),
                $dadosFuncionario['cargo'],
                $dadosFuncionario['salario']
            );

            $this->preencheEndereco($funcionario);

            $listaFuncionarios[] = $funcionario;
            
        }

        return $listaFuncionarios;
    }

    private function preencheEndereco(Funcionario $funcionario): void
    {
        $sqlConsulta = "SELECT * FROM endereco WHERE idEndereco = ?;";
        $stmt = $this->conexao->prepare($sqlConsulta);
        $stmt->bindValue(1, $funcionario->getId(), PDO::PARAM_INT);
        $stmt->execute();

        $listaDeEnderecos = $stmt->fetchAll();

        foreach($listaDeEnderecos as $endereco) {
            $endereco = new Endereco(
                $endereco['idEndereco'],
                $endereco['uf'],
                $endereco['cidade'],
                $endereco['nomeLogradouro'],
                $endereco['numero'],
                $endereco['bairro'],
                $endereco['cep'],
                $endereco['idFuncionario']);
        }
    }
}