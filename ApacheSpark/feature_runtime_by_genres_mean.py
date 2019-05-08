import collections
from operator import itemgetter

from pyspark import rdd


def parse_line(line):
    fields = line.split('\t')
    try:
        runtime_minutes = int(fields[7])
    except ValueError:
        runtime_minutes = 0
    genres = fields[8]
    return genres, runtime_minutes


def feature_runtime_by_genres_mean(lines: rdd):
    result = lines\
        .map(parse_line)\
        .mapValues(lambda x: (x, 1))\
        .reduceByKey(lambda x, y: (x[0] + y[0], x[1] + y[1]))\
        .mapValues(lambda x: x[0] / x[1]) \
        .collect()

    with open("files/runtime_by_genres_mean.txt", "w+") as f:
        ordered_result = collections.OrderedDict(sorted(result, key=itemgetter(1), reverse=True))
        for key, value in ordered_result.items():
            f.write(f"{key}: \t\t\t{value}\n")
