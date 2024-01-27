<?php 


    function matrixMultiplication($matrix1, $matrix2) {
        $result = array();
    
        $rowsA = count($matrix1);
        $colsA = count($matrix1[0]);
        $colsB = count($matrix2[0]);
    
        for ($i = 0; $i < $rowsA; $i++) {
            for ($j = 0; $j < $colsB; $j++) {
                $result[$i][$j] = 0;
                for ($k = 0; $k < $colsA; $k++) {
                    $result[$i][$j] += $matrix1[$i][$k] * $matrix2[$k][$j];
                }
            }
        }
    
        return $result;
    }

print_r(matrixMultiplication([[2, 3],[4, 6],[3,1]], [[1, 3], [2, 1]]));