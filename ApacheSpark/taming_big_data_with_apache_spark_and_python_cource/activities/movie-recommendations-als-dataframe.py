from pyspark.sql import SparkSession
from pyspark.sql.types import StructType, StructField, IntegerType, LongType, FloatType
from pyspark.ml.recommendation import ALS
import sys
import codecs
import re


def loadMovieNames():
    movieNames = {}
    # CHANGE THIS TO THE PATH TO YOUR u.ITEM FILE:
    with codecs.open("files/movies.csv", "r", encoding='UTF-8', errors='ignore') as f:
        next(f)
        regex_pattern = r",(?=(?:[^\"]*\"[^\"]*\")*[^\"]*$)"
        for line in f:
            fields = re.sub(regex_pattern, ";", line).split(';')
            movieNames[int(fields[0])] = fields[1]
    return movieNames


spark = SparkSession.builder.appName("ALSExample").getOrCreate()

moviesSchema = StructType([
    StructField("userID", IntegerType(), True),
    StructField("movieID", IntegerType(), True),
    StructField("rating", FloatType(), True),
    StructField("timestamp", LongType(), True)
])

names = loadMovieNames()

ratings = spark.read \
    .option("sep", ",") \
    .option("header", "true") \
    .schema(moviesSchema) \
    .csv("files/ratings.csv")

ratings.show()

print("Training recommendation model...")

# Alternating Least Square (ALS) 
# is also a matrix factorization algorithm 
# and it runs itself in a parallel fashion. 
# ALS is implemented in Apache Spark ML 
# and built for a larges-scale collaborative filtering problems
als = ALS() \
    .setMaxIter(5) \
    .setRegParam(0.01) \
    .setUserCol("userID") \
    .setItemCol("movieID") \
    .setRatingCol("rating")

model = als.fit(ratings)

# Manually construct a dataframe of the user ID's we want recs for
userID = int(sys.argv[1])
userSchema = StructType([StructField("userID", IntegerType(), True)])
users = spark.createDataFrame([[userID, ]], userSchema)

recommendations = model.recommendForUserSubset(users, 10).collect()

print("Top 10 recommendations for user ID " + str(userID))

for userRecs in recommendations:
    # userRecs is (userID, [Row(movieId, rating), Row(movieID, rating)...])
    myRecs = userRecs[1]
    for rec in myRecs:  # my Recs is just the column of recs for the user
        # For each rec in the list, extract the movie ID and rating
        movie = rec[0]
        rating = rec[1]
        movieName = names[movie]
        print(movieName, str(rating))
