# Exemplo da criação de um index no elasticsearch com mapeamento otimizado para alguns casos

from random import randrange
from datetime import timedelta, datetime
import time
from elasticsearch import Elasticsearch, helpers
from helpers.randomizer import random_object


if __name__ == '__main__':
    es = Elasticsearch([{"host": "localhost", "port": 9200}])

    index = "test-insert-simple"
    es.indices.delete(index=index, ignore=[400, 404])

    start = time.time()
    for i in range(10000):
        res = es.index(index, body=random_object())

    end = time.time()
    print(f"Total time: {int(end - start)}")
    # Total time: 589
        
