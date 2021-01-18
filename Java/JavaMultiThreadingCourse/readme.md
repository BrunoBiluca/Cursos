# Java MultiThreading Concurrency and Optimize Performance

# Vault Example

Exemplo demonstrando múltiplas threads trabalhando em concorrência

![](docs/vault_example_hierarchy.PNG)

# Thread Termination

Why?

- Threads consume resources
- Thread takes too long
- Thread está comportando de forma não esperada
- Quando queremos matar a aplicação, todas as threads devem ser interrompidas

Daemon Threads, threads em background que não importa se estão sendo executadas mesmo se a thread
principal foi interrompida

# Thread Joining

Threads rodam totalmente independentes entre elas.

- Thread coordination
  - Naive Solution: ficar esperando que a thread dependente espere a outra thread terminar
  - Thread.Join Solution: a thread principal é sincronizada com a thread dependente    
