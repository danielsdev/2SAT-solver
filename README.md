# Algoritmo 2SAT

O algoritmo 2SAT determina se um conjunto de cláusulas é satisfazível.

## Entrada
    - Um conjunto C de 2-cláusulas

## Saida
    - verdadeiro se C é satisfazível, ou falso caso contrário

## Algoritmo


## ALGORITMO SIMPLIFICA(C)

O algoritmo para resolver 2SAT utiliza uma função de simplificação conhecida como BCP (boolean constraint propagation).

### Entrada
    - Um conjunto C de cláusulas (quaisquer)

### Saída
    - Um conjunto de cláusula C', C' === C, sem cláusulas unitárias
    
## Como executar

```
    php ./php/solver.php < ./test/example.txt 
```
