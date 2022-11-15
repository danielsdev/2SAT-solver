<?php

$stdin = fopen('php://stdin', 'r');
$contents = stream_get_contents(STDIN);

$data = [];
$qtdAtomos = 0;
$qtdClausulas = 0;

$lines = explode(PHP_EOL, $contents);

foreach ($lines as $key => $line) {
    if (empty($line)) {
        continue;
    }
    $currentLine = explode(' ', $line);

    if ($key === 0) {
        $qtdAtomos = $currentLine[0];
        $qtdClausulas = $currentLine[1];

        continue;
    }

    $data[] = [
        (int) $currentLine[0],
        (int) $currentLine[1],
    ];
}

// $test1 = [
//     [3, 4],
//     [5, 6],
//     [5, 9],
//     [5, 7],
//     [5, -9],
//     [9]
// ];

$test1 = [
    [1],
    [1, -2],
    [-1, 2],
    [-1, -2],
    [3, -4]
];

// $test1 = [
//     [1],
//     [2],
//     [-1, 2],
//     [3, 4]
// ];

function hasUnitaryClause($clauses): bool {
    foreach ($clauses as $clause) {
        if (count($clause) === 1) {
            return true;
        }
    }

    return false;
}

function getUnitaryClauseKey($clauses): int {
    foreach ($clauses as $key => $clause) {
        if (count($clause) === 1) {
            return $key;
        }
    }
}

function hasContradiction($clauses): bool {
    foreach ($clauses as $clause) {
        if (count($clause) === 0) {
            return true;
        }
    }

    return false;
}

// ALGORITMO SIMPLIFICA(C)
// Entrada: Um conjunto C de cláusulas (quaisquer)
// Saída:  Um conjunto de cláusula C', C' === C, sem cláusulas unitárias
function simplifica($clauses): array {
    $Clinha = $clauses;

    while (hasUnitaryClause($Clinha)) {
        $unitaryClauseKey = getUnitaryClauseKey($Clinha);
        $clause = $Clinha[$unitaryClauseKey];
        $literal = current($clause);
        
        //unset($Clinha[$unitaryClauseKey]);

        // remove a clausula que contem o literal
        foreach ($Clinha as $key => $value) {
            if (in_array($literal, $value)) {
                unset($Clinha[$key]);
            }
        }

        // remove o literal negado de cada clausula
        $literalNegado = $literal*-1;
        foreach ($Clinha as $key => $clause) {
            if (!in_array($literalNegado, $clause)) {
                continue;
            }

            foreach ($clause as $elementKey => $elementValue) {
                if ($elementValue === $literalNegado) {
                    unset($Clinha[$key][$elementKey]);
                }
            }
        }
    }

    return $Clinha;
}

//change this function
function selectRandomAtom($clauses): int {
    $clause = current($clauses);

    return current($clause);
}

// ALGORITMO 2SAT
// Entrada: Um conjunto C de 2-clausulas
// Saida: verdadeiro se C é satisfazível, ou falso, caso contrário
function twoSAT($clauses): bool {
    $clauses = simplifica($clauses);

    while (!hasContradiction($clauses) && !empty($clauses)) {
        $p = selectRandomAtom($clauses);
        $Clinha = simplifica(array_merge($clauses, [[$p]]));

        if (hasContradiction($Clinha)) {
            $clauses = simplifica(array_merge($clauses, [[$p*-1]]));
        } else {
            $clauses = $Clinha;
        }
    }

    if (hasContradiction($clauses)) {
        return false;
    } else {
        return true;
    }
}

var_dump(twoSAT($data));
