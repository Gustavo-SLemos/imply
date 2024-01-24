<?php

function calculoMatrizQuadrada($matriz1, $matriz2) {
    $i = ($matriz1[0][0]*$matriz2[0][0]) + ($matriz1[0][1]*$matriz2[1][0]);
    $j = ($matriz1[0][0]*$matriz2[0][1]) + ($matriz1[0][1]*$matriz2[1][1]);
    $k = ($matriz1[1][0]*$matriz2[0][0]) + ($matriz1[1][1]*$matriz2[1][0]);
    $l = ($matriz1[1][0]*$matriz2[0][1]) + ($matriz1[1][1]*$matriz2[1][1]);
    
    $matriz3 = [[$i, $j],
                [$k, $l]];
    
    return $matriz3;
}

function calculoMatrizNaoQuadrada($matriz1, $matriz2) {
    $m = ($matriz1[0][0]*$matriz2[0][0]) + ($matriz1[0][1]*$matriz2[1][0]);
    $n = ($matriz1[0][0]*$matriz2[0][1]) + ($matriz1[0][1]*$matriz2[1][1]);
    $o = ($matriz1[0][0]*$matriz2[0][2]) + ($matriz1[0][1]*$matriz2[1][2]);
    $p = ($matriz1[1][0]*$matriz2[0][0]) + ($matriz1[1][1]*$matriz2[1][0]);
    $q = ($matriz1[1][0]*$matriz2[0][1]) + ($matriz1[1][1]*$matriz2[1][1]);
    $r = ($matriz1[1][0]*$matriz2[0][2]) + ($matriz1[1][1]*$matriz2[1][2]);
    $s = ($matriz1[2][0]*$matriz2[0][0]) + ($matriz1[2][1]*$matriz2[1][0]);
    $t = ($matriz1[2][0]*$matriz2[0][1]) + ($matriz1[2][1]*$matriz2[1][1]);
    $u = ($matriz1[2][0]*$matriz2[0][2]) + ($matriz1[2][1]*$matriz2[1][2]);
    
    $matriz3 = [[$m, $n, $o],
                [$p, $q, $r],
                [$s, $t, $u]];
    
    return $matriz3;
}

while (true) {
    echo "Bem Vindo ao Programa Cálculo de Matriz:\n";
    echo "Menu:\n";
    echo "Opção 1 - Multiplicar 2 Matrizes 2x2\n";
    echo "Opção 2 - Multiplicar Matriz 3x2 e 2x3\n";
    echo "Opção 3 - Sair\n";

    $opcao = readline("Digite a opção escolhida: ");

    if($opcao == 1) {

    $a = readline("Digite o valor na posição 11 para matriz 1: ");
    $b = readline("Digite o valor na posição 12 para matriz 1: ");
    $c = readline("Digite o valor na posição 21 para matriz 1: ");
    $d = readline("Digite o valor na posição 22 para matriz 1: ");

    $matriz1 = [[$a, $b],
                [$c, $d]];

    $e = readline("Digite o valor na posição 11 para matriz 2: ");
    $f = readline("Digite o valor na posição 12 para matriz 2: ");
    $g = readline("Digite o valor na posição 21 para matriz 2: ");
    $h = readline("Digite o valor na posição 22 para matriz 2: ");

    $matriz2 = [[$e, $f],
                [$g, $h]];
    echo "--------------------\n";
    echo "Resultado da Matriz:\n";
    echo "--------------------\n";
    $resultado = calculoMatrizQuadrada($matriz1, $matriz2);

    for ($i = 0; $i < 2; $i++) {
        for ($j = 0; $j < 2; $j++) {
            echo $resultado[$i][$j] . " ";
        }
        echo "\n";
    }
    echo "--------------------\n";
    $novoCalculo = readline("Você gostaria de fazer um novo cálculo? (s/n)\n");
        if ($novoCalculo == "s") {
            continue;
        } else {
            break;
        }

    }
    elseif($opcao == 2) {

        $a = readline("Digite o valor na posição 11 para matriz 1: ");
        $b = readline("Digite o valor na posição 12 para matriz 1: ");
        $c = readline("Digite o valor na posição 21 para matriz 1: ");
        $d = readline("Digite o valor na posição 22 para matriz 1: ");
        $e = readline("Digite o valor na posição 31 para matriz 1: ");
        $f = readline("Digite o valor na posição 32 para matriz 1: ");
    
        $matriz1 = [[$a, $b],
                    [$c, $d],
                    [$e, $f]];
    
        $g = readline("Digite o valor na posição 11 para matriz 2: ");
        $h = readline("Digite o valor na posição 12 para matriz 2: ");
        $i = readline("Digite o valor na posição 13 para matriz 2: ");
        $j = readline("Digite o valor na posição 21 para matriz 2: ");
        $k = readline("Digite o valor na posição 22 para matriz 2: ");
        $l = readline("Digite o valor na posição 23 para matriz 2: ");
    
        $matriz2 = [[$g, $h, $i],
                    [$j, $k, $l]];
        
        echo "--------------------\n";
        echo "Resultado da Matriz:\n";
        echo "--------------------\n";

        $resultado = calculoMatrizNaoQuadrada($matriz1, $matriz2);
    
        for ($i = 0; $i < 3; $i++) {
            for ($j = 0; $j < 3; $j++) {
                echo $resultado[$i][$j] . " ";
            }
            echo "\n";
        }

        echo "--------------------\n";

        $novoCalculo = readline("Você gostaria de fazer um novo cálculo? (s/n)\n");
        if ($novoCalculo == "s") {
            continue;
        } else {
            break;
        }
    }
    elseif ($opcao == 3) {
        exit;
    } else {
        echo "Valor inválido, tente novamente!\n";
    }
}