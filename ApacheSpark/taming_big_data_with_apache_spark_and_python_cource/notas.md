# Apache Spark 3

- Deprecated biblioteca MLLib, utilizada para deep learning, não está mais sendo utilizada para os cálculos utilizando RDD
- Deprecated Python 2
- Permite adicionar mais plugins principalmente para utilizar GPUs
- Mais rápido que Spark 2, em alguns benchmarks até 17x mais rápido
- SparkGraph, possibilitando utilizar a linguagem Cypher
- ACID suporte utilizando DeltaLake


# Exercicies

### RDDs
- Total de gastos por customer
  - leitura de csv
  - parse das linhas do csv
  - reduceByKey, para fazer a soma por customer
  - ordenar os resultados


### SparkSQL

- Média de amigos por idade
  - Leitura do csv com schema pelo header
  - GroupBy Age
  - Usar método avg para calcular a média da coluna friends
- Total gasto por cliente
  - Leitura do csv
  - Declarar o schema
  - Agrupar por cliente
  - Somar os valores gastos

### Advanded Examples

- Achar o super herói mais obscuro
  - Criar um Dataframe de conexão entre os super heróis
  - Join do dataframe com os nomes do super heróis
  - Ver quantas conexões cada super herói tem
  - Ordenar do que tem menos para o que tem mais conexões

# Spark SQL

Dataframe é uma base de dados. O melhor é que o Dataframe pode utilizar SQL para fazer qualquer tipo de operação.

É interessante ter um schema em relação ao Dataframe isso permite uma melhor persistência (storage).

SparkSQL está dentro de SparkSession, então é ncessário ter acesso ao SparkSession para executar comandos SQL dentro do Dataframe. É necessário montar uma View com os dados estruturados para executar SQL queries.

> SparkContext é a api para utilizar RDDs, enquanto SparkSession é a api para utilizar SparkSQL.

Dataframe são as estruturas utilizadas para passar informações entre os módulos de Machine Learning e outros módulos dentro do Spark, assim utilizar DataFrame permite uma maior interobilidade entre os módulos e maior performance.

Utilizando SparkSQL podemos montar um ambiente de acesso aos dados distribuídos no Hive por meio do Beeline, isso pode ser interessante para fazer consultas em múltiplos dados, já que todos os dataframes estão distribuídos no cluster.

Podemos referenciar UDF em SQL Queries.

Se o csv já tem o header configurado no início do arquivo o SparkSQL já consegue inferir o schema utilizado no Dataframe.

Nem todos os problemas são melhor resolvidos utilizando SparkSQL, RDDs são melhor utilizados para dados não estruturados. Algumas vezes faz sentido ler os dados em RDD e converter em Dataframe.

Podemos utilizar as funções do SparkSQL como funções independentes
` form pyspark.sql import functions as func`, dessa forma podemos utilizar de forma mais flexível essas funções.

Podemos utilizar `WithColumn` para adicionar outras colunas ao nosso Dataframe.

# Spark on Cluster

Quando rodamos no cluster é necessário preocupar com como os dados serão particionados no cluster.

> Uma das coisas que Spark não faz é distribuir a carga de trabalho pelo cluster, isso é algo que é necessário fazer de forma manual

Sempre que utilizar alguma operação sobre o RDD como, `join(), cogroup(), groupWith(), groupByKey(), reduceByKey(), combineByKey() and lookup()` é melhor utilizado utilizando `.partitionBy()`.

Podemos deixar a configuração do Spark para a linha de comando, dessa forma o mesmo script pode ser executado localmente ou no cluster do EMR.

EMR roda sobre o **Yarn por default**.

Podemos utilizar o Spark Console como fonte de informações sobre os jobs que estão sendo executados no Spark, assim temos acesso aos logs, tempo de execução, DAG criada pelo Spark para executar nosso script.

O gerenciamento de dependencia é melhor feito no Bootstrap do cluster, assim nesse momento é possível instalar todas as depedencias para garantir que o script seja executado com todas as suas dependencias instaladas.

# Spark.ML - Machine Learning

A biblioteca ML do Spark utiliza Dataframes.

## Using para propor recomendações de filmes

Uma necessidade da biblioteca ML é construir o Dataframe manualmente antes de utilizá-lo no processamento dos dados.

Podemos utilizar vários algoritmos de Machine Learn que já estão implementados no Spark.

Uma dica que ele dá no curso é não confiar muito nesses algoritmos e fazer a validação dos dados sempre.