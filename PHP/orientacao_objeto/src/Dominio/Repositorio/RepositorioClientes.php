<?php

namespace Lemos\Comercial\Dominio\Repositorio;

use Lemos\Comercial\Dominio\Modelo\Cliente;

interface RepositorioClientes
{
    public function todosClientes(): array;
    public function salvar(Cliente $cliente): bool;
    public function ler(Cliente $cliente): array;
    public function delete(Cliente $cliente): bool;
}