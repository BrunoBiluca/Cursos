# Descrição

Hive e Impala são ferramentas que abstraem a complexidade por traz do ambiente Hadoop, permitindo o armazenamento e a execução de consultas sobre o ambiente utilizando consultas SQL ao invés de programação em Java. Além de tornar o uso do ambiente mais amigável, as ferramentas aproveitam todo o poder de processamento do MapReduce e do armazenamento distribuído do HDFS. Neste curso você vai aprender elementos importantes como :

Arquitetura do Hive e do Impala

HiveQL: a linguagem SQL totalmente compatível com MySQL\
Ingestão de dados estruturados em ambiente Hadoop

Técnicas de otimização, como particionamento, vetorização e CBO

Uso do Hive com engine de processamento do Spark

Consultas interativas e em tempo real com Impala

O curso mescla teoria e pratica, em um ambiente configurado para processamento Big Data.

# Introdução

Hadoop é formado por:
 - HDFS
 - Map Reduce

Uma rede de computadores trabalhando em conjuntos.

- Programação imperativa: define as etapas para atingir o objetivo.
- Programação declarativa: especificação dos objetivos.

**Hive** foi criado para deixar o hadoop mais acessivel e que utilize uma linguagem declarativas para consulta ao HDFS.

Hive é um armazem de dados para um grande volume para utilizar em sistemas analíticos e não transacionias.

**Apache Impala** mais uma ferramenta para utilizar SQL em Hadoop para ser mais performático que o Hive.

# Arquitetura

- MetaStore
- HiveServer2
- MySQL Server: armazenamento de metadados, Hcatalog
- Hive Client
 
Os metadados do Hive não estão armazenados no HDFS

Execution Engine:
 - Map Reduce (padrão)
 - Tez
 - Spark

 Schema on Read, definição dos metadados podem ser feitos na leitura dos dados.

 **Tabelas** são metadas que apontam para arquivos.
  - Não permitem inserir mais dados, depois que a refirencia já foi feita
  - orc.compress: algoritmo de compressão formato orc.

 **Banco de dados** são um conjunto de tabelas definidos em um schema. 

 No shell do Beeline(Hive Client) podemos alterar algumas configuração do Hive.

 Configurações:
- Configuration Variables
- Metastore Configuration VAriables
- Configuration Variables do Hadoop
- Run Time Information

