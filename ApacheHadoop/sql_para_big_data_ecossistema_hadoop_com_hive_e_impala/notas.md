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


## Acessando o hive

Acesso ao banco de dados local
```
!connect jdbc:hive2://
```

Tables

```
create external table veiculos (idveiculo int, dataaquisicao date, ano int, modelo string, placa string, status string, diaria double) row format delimited fields terminated by ',' stored as textfile;

create external table despachantes (iddespachante int, nome string, status string, filial string) row format delimited fields terminated by ',' stored as textfile;

create external table clientes (idcliente int, cnh string, cpf string, validadecnh date, nome string, datacadastro date, datanascimento date, telefone string, status string) row format delimited fields terminated by ',' stored as textfile;

create external table locacao (idlocacao int, idcliente int, iddespachante int, idveiculo int, datalocacao date, dataentrega date, total double) 
row format delimited fields terminated by ',' stored as textfile;
```

Load data

```
load data inpath '<hdfs_path>' into table <table>;
```

### Metadados

```
show tables;
describe <table>;
```

Por default os metadados do Hive são armaezenados no Hcatalog que fica no mysql, representado pela tabela **metastore**.

- TBLS: tabela do mysql que tem as informações das tabelas do Hive.

# HiveQL

Muito parecida com a linguagem MySQL.

- Operações Lógicas
- Funções de agregação
- Operações de conjunto 
   - **IN**
   - **Between**

Quando uma operação é enviada para o Hive que necessite processamento ele instancia um job de **Map Reduce** para fazer o processamento dos dados. Esse motor pode ser alterado para utilizar o **Apache Spark** que é bem mais rápido.

## Joins

Podemos criar Views para já ter os joins pré processados no Hive.

## Funções

Podemos criar funções customizadas (UDF).

# Ingestão de dados

- Carregar dados diretamente do HDFS
- Carregar dados de arquivo local
- Inserir de uma tabela em outra, por meio de um select de uma tabela em outra
- Troca dos dados entre bancos de dados

Para criar uma tabela baseada em uma consulta fazemos por exemplo:

```
create table locacao2 as select * from locacao where iddespachante = 2
```

O Hive é um gerenciador de dados que opera sobre o Hadoop e HDFS, assim podemos utilizá-lo para qualquer fonte de dados, um caso interesante seria utilizar ele com injestão de dados do MySQL.

### SQOOP

Para a ingestão de dados de bancos relacionais, utilizamos a ferramenta SQOOP, essa ferramenta pode fazer a ingestão de dados diretamente para o HDFS, e então utilizar o Hive para fazer a criação das tabelas. 

O Sqoop é executado de forma paralelo e é feita utilizando uma chave primária da fonte de dados sendo ingerida. Essa chave deve ser bem balanceada para garantir o maior paralelismo do Sqoop.

O Spoop trabalha em mode incremental, assim é possível trabalhar adicionando novos registros a tabela, porém não apresenta a opção de trabalhar com LastModified, ou seja, último registro atualizado de uma informação na tabela

```
sqoop list-databases --connect jdbc:mysql://localhost/ --username root --password cloudera
```

Para fazer a ingestão dos dados é necessário ter o banco de dados origem no Hive criado, então podemos importar todas as tabelas do banco de dados MySQL

```
sqoop import-all-tables --connect jdbc:mysql://localhost/retail_db --username root --password cloudera --hive-import --hive-overwrite --hive-database retail_db --create-hive-table --m 1;
```