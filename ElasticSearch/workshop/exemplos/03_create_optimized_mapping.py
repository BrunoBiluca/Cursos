# Exemplo da criação de um index no elasticsearch com mapeamento otimizado para alguns casos

from datetime import timedelta, datetime
from elasticsearch import Elasticsearch, helpers
import json


def mapping(es):
    index = 'test-optimized-mapping'
    es.indices.delete(index=index, ignore=[400, 404])
    res = es.indices.create(
        index=index, 
        body={
            "settings": {
                "number_of_shards": 1,
                "number_of_replicas": 0
            },
            "mappings": {
                "properties": {
                    "title": { 
                        "type": "text", 
                    },  
                    "author": {
                        "type": "keyword",
                        "eager_global_ordinals": True
                    },
                    "categories": {
                        "type": "keyword",
                        "eager_global_ordinals": True
                    },
                    "content": { "type": "text" }, 
                    "createdAt": { "type": "date" },     
                    "comments": { 
                        "type": "object",
                        "enabled": False
                    }
                }
            }
        }
    )
    print(res)


if __name__ == '__main__':
    es = Elasticsearch([{"host": "localhost", "port": 9200}])

    mapping(es)
