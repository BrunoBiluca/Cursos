# Storage approach in Azure

Notas referentes ao módulo de Storage da Azure, pode ser acessado pelo [link](https://docs.microsoft.com/en-us/learn/modules/choose-storage-approach-in-azure/2-classify-data)

# Classify your data

- Structured Data
  - Perfeita para sistemas de CRM, sistemas de reservas ou gerenciamento de invetário
  - **Desvantagem** que a evolução do formato é mais difícil já que cada record na base tem que ser atualizado para o novo formato.

- Semi-Structured Data
  - Mais desorganizada do que os dados estruturados
  - A expressividade e formato são definidos por uma linguagem de serialização: XML, JSON, YAML
  - A comunicação entre os sistemas é feito baseado nessas linguagens de forma a um sistema envia para outro, que então faz o parse e lê os dados sem saber de detalhes do que está sendo enviado
  - YAML (YAML Ain't Markup Language) sendo muito difundida por causa da facilidade de leitura.

- Unstructured data
  - Key-Pairs
  - Graphs
  - Document Database

## Exemplos de uso de cada tipo de persistência de dados

### Product catalog data

Product catalog data for an online retail business is fairly structured in nature, as each product has a product SKU, a description, a quantity, a price, size options, color options, a photo, and possibly a video. So, this data appears relational to start with, as it all has the same structure. However, as you introduce new products or different kinds of products, you may want to add different fields as time goes on. For example, new tennis shoes you're carrying are Bluetooth-enabled, to relay sensor data from the shoe to a fitness app on the user’s phone. This appears to be a growing trend, and you want to enable customers to filter on "Bluetooth-enabled" shoes in the future. You don't want to go back and update all your existing shoe data with a Bluetooth-enabled property, you simply want to add it to new shoes.

With the addition of the Bluetooth-enabled property, your shoe data is no longer homogenous, as you've introduced differences in the schema. If this is the only exception you expect to encounter, you can go back and normalize the existing data so that all products included a "Bluetooth-enabled" field to maintain a structured, relational organization. However, if this is just one of many specialty fields that you envision supporting in the future, then the classification of the data is semi-structured. The data is organized by tags, but each product in the catalog can contain unique fields.

**Data classification:** Semi-structured

### Photos and videos
The photos and videos displayed on product pages are unstructured data. Although the media file may contain metadata, the body of the media file is unstructured.

**Data classification:** Unstructured

### Business data
Business analysts want to implement business intelligence to perform inventory pipeline evaluations and sales data reviews. In order to perform these operations, data from multiple months needs to be aggregated together, and then queried. Because of the need to aggregate similar data, this data must be structured, so that one month can be compared against the next.

**Data classification:** Structured

## Determine operational needs

