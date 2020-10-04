from pyspark.ml.regression import DecisionTreeRegressor
from pyspark.ml.feature import VectorAssembler

from pyspark.sql import SparkSession
from pyspark.ml.linalg import Vectors

# Predict the price per unit area
# based on:
#  - house age
#  - distance to MRT (public transportation)
#  - Number of nearby convenience stores

# Usar Decision Tree Regressor
# Utilizar o header do csv
# Usar um VectorAssembler


if __name__ == "__main__":

    spark = SparkSession.builder.appName("LinearRegression").getOrCreate()

    df = spark.read \
        .option("header", "true") \
        .option("inferSchema", "true") \
        .csv("files/realestate.csv")

    assembler = VectorAssembler() \
        .setOutputCol("features") \
        .setInputCols(["HouseAge", "DistanceToMRT", "NumberConvenienceStores"])
    df = assembler.transform(df).select("PriceOfUnitArea", "features")

    trainTest = df.randomSplit([0.5, 0.5])
    trainingDF = trainTest[0]
    testDF = trainTest[1]

    lir = DecisionTreeRegressor() \
        .setLabelCol("PriceOfUnitArea")

    model = lir.fit(trainingDF)

    fullPredictions = model.transform(testDF).cache()

    predictions = fullPredictions.select("prediction").rdd.map(lambda x: x[0])
    labels = fullPredictions.select("PriceOfUnitArea").rdd.map(lambda x: x[0])

    # Zip them together
    predictionAndLabel = predictions.zip(labels).collect()

    print()
    for prediction in predictionAndLabel:
      print(prediction)

    spark.stop()

# output
# prediction (valor predito), label (valor real)
# (41.690909090909095, 42.2)
# (49.69523809523809, 43.1)
# (35.30000000000001, 40.3)
# (41.690909090909095, 46.7)
# (36.824999999999996, 41.4)
# (54.91111111111112, 58.1)
# (25.45, 23.8)
# (30.264999999999997, 34.3)
# (40.220000000000006, 42.3)
# (49.69523809523809, 47.7)
# (25.45, 24.6)