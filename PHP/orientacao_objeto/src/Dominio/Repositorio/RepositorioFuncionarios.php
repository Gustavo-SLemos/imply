<?php

namespace Lemos\Comercial\Dominio\Repositorio;

use Lemos\Comercial\Dominio\Modelo\Funcionario;

interface RepositorioFuncionarios
{
    public function todosFuncionarios(): array;
    public function todosFuncionariosComEndereco(): array;
    public function salvar(Funcionario $funcionario): bool;
    public function ler(Funcionario $funcionario): array;
    public function delete(Funcionario $funcionario): bool;
}