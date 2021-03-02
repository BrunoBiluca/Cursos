# Elasticsearch

- Introdução
  - O que é?
  - Para que serve?
- Infraestrutura do elasticsearch
  - Docker single-node
  - Docker cluster
  - Shards e Replicas
    - Routing
  - Exemplo AWS
- Mapeamento
  - Campos indexados e não indexados (vantagens)
- Queries
  - Filtros (cache)
  - Consultas simples
  - Consultas de agregação
  - Multiqueries
  - Multiqueries com agregações
- Pipelines
- Testes funcionais utilizando elasticsearch

# Introdução

# Infraestrutura

Existem duas formas de utilizar o Elasticsearch:

- Single-node
- Cluster

## Criação do Elasticsearch local para desenvolvimento

Para a criação do Elasticsearch local focado em desenvolvimento pode ser facilmente feito utilizando a versão **single-node**. 

Nessa versão todas as funcionalidades do Elasticsearch estão disponíveis, porém elas estão limitadas a apenas uma máquina sendo utilizada,
também não há comunicação entre os nós.

> Exemplo de configuração do Elasticsearch **single-node** está no arquivo **docker-compose.yml**

## Criação do Elasticsearch local modo cluster

> Exemplo de configuração do Elasticsearch **single-node** está no arquivo **docker-compose.cluster.yml**

# Mapeamento

O Mapeamento é uma configuração que é passada apenas na criação do **Index**, cada tipo de campo no Elasticsearch tem uma forma de armazenagem e de indexação diferente.

Por padrão todo novo campo contido em um documento enviado para um index será indexado de acordo com a política padrão. Para alterar o comportamento padrão é necessário fornecer um arquivo de mapeamento com a configuração desejada.

Principais campos
  - Keyword
  - Text
  - Long
  - Date

No caso de ter uma lista o campo de lista é mapeado como o tipo do primeiro elemento da lista, e não é possível criar uma lista com tipos diferentes de dados. Isso porque cada elemento da lista é indexado individualmente, por esse fato deixar elementos em listas não reduz a performances das consultas feitas ao Elasticsearch.

## Parâmetros do mapeamento

Alguns dos parâmetros mais utilizado para a criação de mapeamento

- coerce: adicionar coerce no mapeamento de um campo é uma tentativa de limpar o dado quando este não vier no tipo mapeado do campo.
  - Strings will be coerced to numbers.
  - Floating points will be truncated for integer values.
- eager_global_ordinals: cada vez que o shard é atualizado esses campos serão carregados antes. Isso pode ajudar muito na performance de queries no formato **Per-Document Basis** como quando utilizamos ```terms``` em campos como ```keyword```. Dessa forma passamos o custo de performance na hora do re-index no lugar de fazer o mesmo processo na hora que a query é requisitada.
- ignore_malformed: garante o formato necessário para o campo no quando o campo está num formato não de acordo com o mapeamento
- enabled: Podemos desativar a indexação de um campo, o campo pode ser recuperado, mas perde a funcionalidade de ser pesquisado
  - Muito útil para diminuir o uso de storage e o uso de RAM consumida

## Links úteis sobre mapeamento

- [Mapeamento explícito](https://www.elastic.co/guide/en/elasticsearch/reference/7.11//explicit-mapping.html)
- [Mapeamento de arrays](https://www.elastic.co/guide/en/elasticsearch/reference/7.11//array.html)
- [Text](https://www.elastic.co/guide/en/elasticsearch/reference/7.11//text.html)


- [Coerce](https://www.elastic.co/guide/en/elasticsearch/reference/7.11//coerce.html)
- [Eager global ordinals](https://www.elastic.co/guide/en/elasticsearch/reference/7.11//eager-global-ordinals.html#eager-global-ordinals)
- [Ignore Malformed](https://www.elastic.co/guide/en/elasticsearch/reference/7.11//ignore-malformed.html)
- [Enabled](https://www.elastic.co/guide/en/elasticsearch/reference/7.11//enabled.html)

> TODO: falar sobre as reduções em armazenamento

> TODO: criar teste de carga para mostrar a influência do mapeamento no storage de dados

> TODO: criar teste para mostrar a diferença entre criação de documentos em bulk e normais

# Queries

## Agregações

> TODO: Explicar agregações per-document basis

> TODO: Explicar global ordinals e seu funcionamento para agregações

https://www.elastic.co/guide/en/elasticsearch/reference/7.11//eager-global-ordinals.html#eager-global-ordinals

## Elasticsearch queries

- /_cat/shards
- /_cat/allocation

# Testes funcionais

