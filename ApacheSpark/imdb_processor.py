from pyspark import SparkConf, SparkContext

from feature_count_genres import feature_count_genres
from feature_runtime_by_genres_mean import feature_runtime_by_genres_mean

conf = SparkConf().setMaster("local").setAppName("IMDBProcessor")
sc = SparkContext(conf=conf)
sc.setLogLevel("ERROR")

# tconst titleType primaryTitle originalTitle isAdult startYear endYear runtimeMinutes genres
lines = sc.textFile("C:\\Users\\bbdac\\Documents\\Projects\\title.basics.tsv\\data.tsv")

# feature_count_genres(lines)
feature_runtime_by_genres_mean(lines)
