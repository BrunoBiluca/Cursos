# Exemplo da criação de um index no elasticsearch com mapeamento otimizado para alguns casos

from random import randrange
import time
from datetime import timedelta, datetime
from elasticsearch import Elasticsearch, helpers
from helpers.randomizer import random_object


if __name__ == '__main__':
    es = Elasticsearch([{"host": "localhost", "port": 9200}])

    index = 'test-optimized-mapping'
    # index = 'test-insert-bulk'
    # es.indices.delete(index=index, ignore=[400, 404])

    start = time.time()

    for _ in range(100):
        body = []
        for i in range(10000):
            body.append({'index': {}})
            body.append(random_object())

        res = es.bulk(body, index=index, doc_type='_doc')
    
    end = time.time()
    print(f"Total time: {int(end - start)}")
    # Total time: 36

