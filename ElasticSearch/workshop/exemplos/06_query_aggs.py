# Exemplo da criação de um index no elasticsearch com mapeamento otimizado para alguns casos

from random import randrange
import time
from datetime import timedelta, datetime
from elasticsearch import Elasticsearch, helpers
from helpers.randomizer import random_object, all_categories
from helpers.time_metric import time_metric
import json


es = Elasticsearch([{"host": "localhost", "port": 9200}])
index = 'test-optimized-mapping'


@time_metric("Agregação geral")
def aggregation_generic():
    query = {
        "size": 0, 
        "aggs": {
            "categories": {
                "terms": {
                    "field": "categories",
                    "size": 10000
                }
            }
        }
    }
    res = es.search(query, index=index)
    return json.dumps(res, indent=4, sort_keys=True)


@time_metric("Agregação separada")
def aggregation_segregate():
    aggs = {}
    for category in all_categories():
        aggs[f"category_{category}"] = {
            "filter": {
                "bool": {"must": [{"terms": { "categories": [category]}}]}      
            },
            "aggs": {"count": { "value_count": { "field": ""}}}
        }
    query = {
        "size": 0, 
        "aggs": aggs
    }

    res = es.search(query, index=index)
    return json.dumps(res, indent=4, sort_keys=True)
    

@time_metric("Agregação msearch")
def aggregation_msearch():

    body = []
    for category in all_categories():
        body.append({"index": index})
        body.append({
            "size": 0, 
            "aggs": {
                f"category_{category}": {
                    "filter": {
                        "bool": {"must": [{"terms": { "categories": [category]}}]}      
                    },
                    "aggs": {"count": { "value_count": { "field": ""}}}
                }
            }
        })
    
    res = es.msearch(body, index=index)
    return json.dumps(res, indent=4, sort_keys=True)

if __name__ == '__main__':
    # index = 'test-insert-bulk'
    # es.indices.delete(index=index, ignore=[400, 404])

    start = time.time()

    with open("aggregation_generic.out", "w") as f:
        f.write(aggregation_generic())
    
    with open("aggregation_segregate.out", "w") as f:
        f.write(aggregation_segregate())

    with open("aggregation_msearch.out", "w") as f:
        f.write(aggregation_msearch())

    end = time.time()
    print(f"Total time: {int(end - start)}")
    # Total time: 36
