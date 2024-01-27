<?php

//TRAIT
    namespace Lemos\Comercial\Dominio\Modelo;

    trait AcessoAtributos
    {
        public function __get(string $nomeAtributo)
        {
            $metodo = 'get' . ucfirst($nomeAtributo); //ucfirst = upper case first - primeira letra maiúscula
            return $this->$metodo();
        }
    }