from pyspark.sql import SparkSession
from pyspark.sql import functions as func
from pyspark.sql.types import StructType, StructField, StringType, IntegerType, FloatType

spark = SparkSession.builder.appName("MinTemperatures").getOrCreate()

schema = StructType([ \
                     StructField("stationID", StringType(), True), \
                     StructField("date", IntegerType(), True), \
                     StructField("measure_type", StringType(), True), \
                     StructField("temperature", FloatType(), True)])

# // Read the file as dataframe
df = spark.read.schema(schema).csv("files/1800.csv")
df.printSchema()

# Filter out all but TMIN entries
minTemps = df.filter(df.measure_type == "TMIN")

# Select only stationID and temperature
stationTemps = minTemps.select("stationID", "temperature")

# Aggregate to find minimum temperature for every station
minTempsByStation = stationTemps.groupBy("stationID").min("temperature")
minTempsByStation.show()

# Convert temperature to fahrenheit and sort the dataset
minTempsByStationF = minTempsByStation.withColumn(
        "temperature",
        func.round(func.col("min(temperature)") * 0.1 * (9.0 / 5.0) + 32.0, 2)
    )\
    .select("stationID", "temperature").sort("temperature")
                                                  
# Collect, format, and print the results
results = minTempsByStationF.collect()

for result in results:
    print(result[0] + "\t{:.2f}F".format(result[1]))
    
spark.stop()

# output
# root
#  |-- stationID: string (nullable = true)
#  |-- date: integer (nullable = true)
#  |-- measure_type: string (nullable = true)
#  |-- temperature: float (nullable = true)

# +-----------+----------------+
# |  stationID|min(temperature)|
# +-----------+----------------+
# |ITE00100554|          -148.0|
# |EZE00100082|          -135.0|
# +-----------+----------------+

# ITE00100554     5.36F
# EZE00100082     7.70F