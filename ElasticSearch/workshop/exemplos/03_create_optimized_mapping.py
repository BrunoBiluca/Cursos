# Exemplo da criação de um index no elasticsearch com mapeamento otimizado para alguns casos

from random import randrange
from datetime import timedelta, datetime
from elasticsearch import Elasticsearch, helpers
import json
import random
import string

def random_date(start, end):
    """
    This function will return a random datetime between two datetime 
    objects.
    """
    delta = end - start
    int_delta = (delta.days * 24 * 60 * 60) + delta.seconds
    random_second = randrange(int_delta)
    return start + timedelta(seconds=random_second)

def random_string(length):
    return ''.join(random.choice(string.ascii_uppercase + string.digits) for _ in range(length))

def random_object():
    d1 = datetime.strptime('1/1/2020 1:30 PM', '%m/%d/%Y %I:%M %p')
    d2 = datetime.strptime('1/1/2021 4:50 AM', '%m/%d/%Y %I:%M %p')
    return {
        "title": random_string(30),  
        "author": random_string(30),
        "content": random_string(500), 
        "createdAt": random_date(d1, d2),     
        "comments": [random_string(120) for _ in range(random.randint(3, 100))]
    }


if __name__ == '__main__':
    es = Elasticsearch([{"host": "localhost", "port": 9200}])

    es.indices.delete(index='test-optimized-mapping', ignore=[400, 404])
    res = es.indices.create(
        index="test-optimized-mapping", 
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

    for i in range(10000):
        res = es.index("test-optimized-mapping", body=random_object())
        print(i, res)