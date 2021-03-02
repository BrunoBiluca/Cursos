# Exemplo da criação de um index no elasticsearch com mapeamento

from datetime import datetime
from elasticsearch import Elasticsearch, helpers
import json
import requests

es = Elasticsearch([{"host": "localhost", "port": 9200}])

if __name__ == '__main__':
    es.indices.delete(index='test-mapping', ignore=[400, 404])
    res = es.indices.create(
        index="test-mapping", 
        body={
            "settings": {
                "number_of_shards": 1,
                "number_of_replicas": 0
            },
            "mappings": {
                "properties": {
                "string": { "type": "keyword" },  
                "text": { "type": "text" }, 
                "long": { "type": "long" },     
                "object": { "type": "object" },
                "object_stringfied": { "type": "keyword" },
                "list": { "type": "long" }
                }
            }
        }
    )
    print(res)

    res = es.index(
        "test-mapping", 
        body={
            "string": "Bruno Bernardes da Costa",
            "text": "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec sapien eros, consectetur at laoreet sit amet, pellentesque sit amet ante. In fermentum felis nec condimentum faucibus. Aliquam bibendum eleifend aliquam. Aenean imperdiet magna in fermentum cursus. Nunc consequat dolor ut lorem auctor ornare. Proin blandit felis sit amet velit dictum imperdiet eu ac velit. Etiam volutpat velit nec ipsum placerat euismod. Nunc rhoncus mattis ligula, ut aliquam libero varius ut. Donec ut vulputate diam. Maecenas feugiat, elit eget cursus efficitur, lorem quam porttitor ligula, eu sodales augue odio sit amet elit. Praesent rutrum magna justo.",
            "long": 123,
            "date": datetime.now(),
            "object": {
                "campo_1": "value",
                "campo_2": 321
            },
            "object_stringfied": json.dumps({
                "campo_1": "value",
                "campo_2": 321
            }),
            "list": [1, 2, 3, 4]
        }
    )
    print(res)