from pyspark.sql import SparkSession

spark = SparkSession.builder.appName("SparkSQL").getOrCreate()

people = spark.read \
    .option("header", "true") \
    .option("inferSchema", "true") \
    .csv("files/fakefriends-header.csv")

print("Here is our inferred schema:")
people.printSchema()

print("Let's display the name column:")
people.select("name").show()

print("Filter out anyone over 21:")
people.filter(people.age < 21).show()

print("Group by age")
people.groupBy("age").count().show()

print("Make everyone 10 years older:")
people.select(people.name, people.age + 10).show()

spark.stop()

# output
# Here is our inferred schema:
# root
#  |-- userID: integer (nullable = true)
#  |-- name: string (nullable = true)
#  |-- age: integer (nullable = true)
#  |-- frieds: integer (nullable = true)

# Let's display the name column:
# +--------+
# |    name|
# +--------+
# |    Will|
# |Jean-Luc|
# |    Hugh|
# |  Deanna|
# |   Quark|
# |  Weyoun|
# |  Gowron|
# |    Will|
# |  Jadzia|
# |    Hugh|
# |     Odo|
# |     Ben|
# |   Keiko|
# |Jean-Luc|
# |    Hugh|
# |     Rom|
# |  Weyoun|
# |     Odo|
# |Jean-Luc|
# |  Geordi|
# +--------+
# only showing top 20 rows

# Filter out anyone over 21:
# +------+-------+---+------+
# |userID|   name|age|frieds|
# +------+-------+---+------+
# |    21|  Miles| 19|   268|
# |    48|    Nog| 20|     1|
# |    52|Beverly| 19|   269|
# |    54|  Brunt| 19|     5|
# |    60| Geordi| 20|   100|
# |    73|  Brunt| 20|   384|
# |   106|Beverly| 18|   499|
# |   115|  Dukat| 18|   397|
# |   133|  Quark| 19|   265|
# |   136|   Will| 19|   335|
# |   225|   Elim| 19|   106|
# |   304|   Will| 19|   404|
# |   327| Julian| 20|    63|
# |   341|   Data| 18|   326|
# |   349| Kasidy| 20|   277|
# |   366|  Keiko| 19|   119|
# |   373|  Quark| 19|   272|
# |   377|Beverly| 18|   418|
# |   404| Kasidy| 18|    24|
# |   409|    Nog| 19|   267|
# +------+-------+---+------+
# only showing top 20 rows

# Group by age
# +---+-----+
# |age|count|
# +---+-----+
# | 31|    8|
# | 65|    5|
# | 53|    7|
# | 34|    6|
# | 28|   10|
# | 26|   17|
# | 27|    8|
# | 44|   12|
# | 22|    7|
# | 47|    9|
# | 52|   11|
# | 40|   17|
# | 20|    5|
# | 57|   12|
# | 54|   13|
# | 48|   10|
# | 19|   11|
# | 64|   12|
# | 41|    9|
# | 43|    7|
# +---+-----+
# only showing top 20 rows

# Make everyone 10 years older:
# +--------+----------+
# |    name|(age + 10)|
# +--------+----------+
# |    Will|        43|
# |Jean-Luc|        36|
# |    Hugh|        65|
# |  Deanna|        50|
# |   Quark|        78|
# |  Weyoun|        69|
# |  Gowron|        47|
# |    Will|        64|
# |  Jadzia|        48|
# |    Hugh|        37|
# |     Odo|        63|
# |     Ben|        67|
# |   Keiko|        64|
# |Jean-Luc|        66|
# |    Hugh|        53|
# |     Rom|        46|
# |  Weyoun|        32|
# |     Odo|        45|
# |Jean-Luc|        55|
# |  Geordi|        70|
# +--------+----------+
# only showing top 20 rows