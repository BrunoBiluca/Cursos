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
  
# Performance & Optimizing for latency

Todo tipo de otimização deve ser planejada levando em consideração o caso a ser otimizado.

- Latêcia (latency)
- Velocidade (throughput)
  - Quantidade de tarefas finalizadas

Número de trheads pode ser calculado para ser próximo do número de cores do computador,
um código é mais otimizado quando **todos os cores** da máquina estão sendo **executados sem descanso**.

Custo de paralelizar

- Quebrar as tarefas em threads
- Criação das threads e passagem das tarefas para as threads
- Tempo entre thread.start() para ser agendado para executar
- Tempo até todas as threads finalizarem e enviarem os sinais de completude
- Tempo para agregar as threads
- Tempo de combinar as threads em um único resultado

- Tarefas paralelizáveis
- Tarefas que não podem ser quebradas
- Tarefas que podem ser parcialmente quebradas

## Image processing

Nesse caso o processamento da imagem foi dividido verticalmente.

Podemos reparar que quanto mais threads mais rápido o processamento é finalizado, porém 
depois que o número de cores lógicos é alcançado o desempenho não tem nenhuma melhora.

![](docs/image_processing.PNG)

## Thread Pooling

Uma forma de otimizar o código é criar previamente um Pool de Threads e associar cada tarefa as thread
já criadas, dessa forma não precisamos gastar tempo criando threads para cada operação.

![](docs/http_server_throughput_test.PNG)

# Memory Management
 
- Stack region
  - Memória onde os métodos são chamados e as variáveis são armazenadas
    - Variáveis locais
    - Referências locias
  - São espaços de memória que não são compartilhados entre as threads
- Heap memory
  - Objetos criados pelo operador **new** são armazenados na heap
    - Static
    - Instance
  - Gerenciada pelo GC (Garbage Collector)
  - Podem ser compartilhados entre as threads

````java
public class Example {
    private Map<Integer, String>  idToNameMap; // allocated on heap
    
    private static long numberOfInstances = 0; // allocated on heap
    
    public Example() {
        this.idToNameMap = new HashMap<>();
        numberOfInstances++;
    }
    
    public List<String> getAllNames() {
        int count = idToNameMap.size(); // count: allocated on stack
        List<String> allNames = new ArrayList<>(); // allNames: allocated on stack
        
        allNames.addAll(idToNameMap.values()); // idToNameMap.values(): references an object on heap
        
        return allNames;
   }
}  
````










