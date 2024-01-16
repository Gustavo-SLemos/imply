<?php

// requisições de arquivos para o correto funcionamento do index.
require_once __DIR__. '/constants.php';
require_once __DIR__. '/variables.php';
require_once __DIR__. '/getPlayersName.php';
require_once __DIR__. '/buildBoard.php';
require_once __DIR__. '/showBoard.php';
require_once __DIR__. '/isPositionCorrect.php';
require_once __DIR__. '/validate.php';
require_once __DIR__. '/isBoardFull.php';
require_once __DIR__. '/swapPlayer.php';
require_once __DIR__. '/showWinner.php';
require_once __DIR__. '/playAgain.php';


do {
    // Solitica os nomes dos jogadores.
    $players = getPlayersName();

    // Inicia com o primeiro jogador sendo o player one.
    $player = PLAYER_ONE_ICON;

    // retorna o board construíudo com suas posições.
    $board = buildBoard();

    // Inicia a variável winner como null.
    $winner = null;

// Laço while para repetição enquanto não houver um vencedor ou empate.
    while ($winner === null) {
        echo showBoard($board);

        //  Solicita ao jogador que indique a posição que irá jogar.
        $position = (int) readline("Player {$player}, digite a sua posiçao: ");

        // Chama a função com retorno true ou false para a posição indicada pelo jogador. Se for falsa, retorna ao inicio do laço para uma nova tentativa.
        if (!isPositionCorrect($position, $board)) {
            continue;
        }

        //Insere na posição indicada no board o ícone do player atual.
        $board[$position] = $player;

        //valida se no board o player one ou two preencheu 3 espaços em linha para vencer, caso contrário, ele segue null e o jogo prossegue.
        if (validate($board, PLAYER_ONE_ICON)) {
            $winner = PLAYER_ONE_ICON;
            break;
        } elseif (validate($board, PLAYER_TWO_ICON)) {
            $winner = PLAYER_TWO_ICON;
            break;
        } else {
            $winner = null;
        }

        // Verificar se o board está cheio, caso esteja, encerra o jogo.
        if (isBoardFull($board)) {
            break;
        }

        // Altera o player para iniciar a próxima jogada.
        $player = swapPlayer($player);

    }

    // Ao finalizar o laço, imprime as posições e o tabuleiro preenchido.
    echo showBoard($board);

    // Ao finalizar o laço, imprime o nome do player vencedor.
    echo showWinner($winner, $players);

    // Ao finalizar o laço, a função pergunta aos jogadores se eles querem jogar novamente.
    $playAgain = playAgain();

    echo "\n";

// Enquanto o retorno da playAgain for true, o jogo recomeça.
} while ($playAgain === true);