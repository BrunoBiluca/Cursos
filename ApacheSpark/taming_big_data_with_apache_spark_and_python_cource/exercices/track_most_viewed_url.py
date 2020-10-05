from pyspark import SparkContext
from pyspark.streaming import StreamingContext
from pyspark.sql import Row, SparkSession

from pyspark.sql.functions import regexp_extract
import pyspark.sql.functions as func


spark = SparkSession.builder.config(
    "spark.sql.warehouse.dir", "file:///C:/tmp").appName("StructuredStreaming").getOrCreate()

accessLines = spark.readStream.text("files/logs")

generalExp = r'\"(\S+)\s(\S+)\s*(\S*)\"'

logsDF = accessLines.select(
    regexp_extract('value', generalExp, 2).alias('endpoint'),
)

# Adicionamos um tempo a cada evento
# Depois agregamos esse evento na janela de tempo escolhida, no caso a gerada
# Em janelas de 30 segundos avaliamos os eventos mais acessados de 10 em 10 segundos

endpoint_window_df = logsDF \
    .withColumn("eventTime", func.current_timestamp()) \
    .groupBy(
        func.window(func.col("eventTime"), "30 seconds", "10 seconds"),
        func.col("endpoint")
    ) \
    .count() \
    .orderBy(func.col("count").desc())

query = (
    endpoint_window_df
        .writeStream
        .outputMode("complete")
        .format("console")
        .queryName("counts")
        .start()
)

query.awaitTermination()

spark.stop()
