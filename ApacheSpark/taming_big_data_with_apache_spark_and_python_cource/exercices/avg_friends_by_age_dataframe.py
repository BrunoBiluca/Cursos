from pyspark.sql import SparkSession
from pyspark.sql import functions as func

spark = SparkSession.builder.appName("SparkSQL").getOrCreate()

people = spark.read \
    .option("header", "true") \
    .option("inferSchema", "true") \
    .csv("files/fakefriends-header.csv")

result = people \
    .groupBy('age') \
    .agg(func.round(func.avg('friends'), 2).alias("friends_avg")) \
    .select('age', 'friends_avg') \
    .sort('age')\
    .collect()

for r in result:
    print(r)


# output
# Row(age=18, friends_avg=343.38)
# Row(age=19, friends_avg=213.27)
# Row(age=20, friends_avg=165.0)
# Row(age=21, friends_avg=350.88)
# Row(age=22, friends_avg=206.43)
# Row(age=23, friends_avg=246.3)
# Row(age=24, friends_avg=233.8)
# Row(age=25, friends_avg=197.45)
# Row(age=26, friends_avg=242.06)
# Row(age=27, friends_avg=228.13)
# Row(age=28, friends_avg=209.1)
# Row(age=29, friends_avg=215.92)
# Row(age=30, friends_avg=235.82)
# Row(age=31, friends_avg=267.25)
# Row(age=32, friends_avg=207.91)
# Row(age=33, friends_avg=325.33)
# Row(age=34, friends_avg=245.5)
# Row(age=35, friends_avg=211.63)
# Row(age=36, friends_avg=246.6)
# Row(age=37, friends_avg=249.33)
# Row(age=38, friends_avg=193.53)
# Row(age=39, friends_avg=169.29)
# Row(age=40, friends_avg=250.82)
# Row(age=41, friends_avg=268.56)
# Row(age=42, friends_avg=303.5)
# Row(age=43, friends_avg=230.57)
# Row(age=44, friends_avg=282.17)
# Row(age=45, friends_avg=309.54)
# Row(age=46, friends_avg=223.69)
# Row(age=47, friends_avg=233.22)
# Row(age=48, friends_avg=281.4)
# Row(age=49, friends_avg=184.67)
# Row(age=50, friends_avg=254.6)
# Row(age=51, friends_avg=302.14)
# Row(age=52, friends_avg=340.64)
# Row(age=53, friends_avg=222.86)
# Row(age=54, friends_avg=278.08)
# Row(age=55, friends_avg=295.54)
# Row(age=56, friends_avg=306.67)
# Row(age=57, friends_avg=258.83)
# Row(age=58, friends_avg=116.55)
# Row(age=59, friends_avg=220.0)
# Row(age=60, friends_avg=202.71)
# Row(age=61, friends_avg=256.22)
# Row(age=62, friends_avg=220.77)
# Row(age=63, friends_avg=384.0)
# Row(age=64, friends_avg=281.33)
# Row(age=65, friends_avg=298.2)
# Row(age=66, friends_avg=276.44)
# Row(age=67, friends_avg=214.63)
# Row(age=68, friends_avg=269.6)
# Row(age=69, friends_avg=235.2)