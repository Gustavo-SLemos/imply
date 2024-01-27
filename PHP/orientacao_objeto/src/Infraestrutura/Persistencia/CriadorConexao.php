<?php

namespace Lemos\Comercial\Infraestrutura\Persistencia;

use PDO;

    class CriadorConexao
    {
        public static function criarConexao(): PDO
        {
            try {
                $pdo = new PDO('mysql:host=127.0.0.1;dbname=bd_comercial', 'root', 'sua_senha');
                $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                return $pdo;
            } catch(PDOException $excecao) {
                echo 'ERRO: ' . $excecao->getMessage();
            }
        }
    }