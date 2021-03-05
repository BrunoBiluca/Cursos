from elasticsearch import Elasticsearch
from elasticsearch.client import IngestClient
from helpers.randomizer import random_object

es = Elasticsearch([{"host": "localhost", "port": 9200}])

if __name__ == '__main__':
    index = 'test-pipeline'
    es.indices.delete(index=index, ignore=[400, 404])
    res = es.indices.create(
        index="test-pipeline",
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
                    "releaseYear": { "type": "keyword" },     
                    "createdAt": { "type": "date" },     
                    "comments": { 
                        "type": "object",
                        "enabled": False
                    }
                }
            }
        }
    )

    IngestClient(es).put_pipeline("routing_processor", body={
        "description": "Pipeline responsável por garantir o campo de rotas do indexes baseados em livros",
        "processors": [
            {
                "set": {
                    "field": "_routing",
                    "value": "{{author}}_{{releaseYear}}"
                }
            },
            {
                "script": {
                    "source": """
                        ctx.comment_count = ctx.comments.length
                    """
                }
            }
        ]
    })
    
    res = es.index(index, body=random_object(), pipeline="routing_processor")
    print(res)