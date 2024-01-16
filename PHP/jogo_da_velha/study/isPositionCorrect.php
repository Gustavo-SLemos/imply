<?php

function isPositionCorrect(int $position, array $board): bool
{
    if(!in_array($position, [0, 1, 2, 3, 4, 5, 6, 7, 8])) {
        echo "\nPosiçao inexistente, digite novamente.\n";
        return false;
    } elseif($board[$position] !== BLANK_ICON) {
        echo "\nPosiçao ocupada, digite novamente.\n";
        return false;
    }

    return true;
}