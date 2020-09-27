from pyspark.sql import SparkSession
from pyspark.sql import functions as func
from pyspark.sql.types import StructType, StructField, IntegerType, StringType

spark = SparkSession.builder.appName("MostObscureSuperhero").getOrCreate()

schema = StructType([
    StructField("id", IntegerType(), True),
    StructField("name", StringType(), True)
])

names = spark.read \
    .schema(schema) \
    .option("sep", " ") \
    .csv("files/Marvel_Names")

connections_graph = spark.read.text("files/Marvel_Graph")

connections = connections_graph \
    .withColumn("id", func.split(func.col("value"), " ")[0]) \
    .withColumn("connections", func.size(func.split(func.col("value"), " ")) - 1) \
    .groupBy("id") \
    .agg(func.sum("connections").alias("connections"))

result = names.join(connections, 'id').sort(["connections", "name"]) \
    
print("Most Obscure Superheroe")
print(result.first())

print("Top 10 most obscure SuperHeroes")
for r in result.take(10):
    print(r)

# output
# Row(id=5408, name='STEEL SERPENT', min(connections)=38)
