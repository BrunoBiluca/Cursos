import collections

from pyspark import rdd


def parse_line(line):
    fields = line.split('\t')
    genres = fields[8]
    return genres


def feature_count_genres(lines: rdd):
    lines = lines \
        .map(parse_line) \
        .countByValue()

    with open("files/count_genres.txt", "w+") as f:
        for key, value in collections.OrderedDict(sorted(lines.items())).items():
            f.write(f"{key}: \t\t\t{value}\n")
