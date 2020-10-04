from __future__ import print_function

from pyspark.ml.regression import LinearRegression

from pyspark.sql import SparkSession
from pyspark.ml.linalg import Vectors

if __name__ == "__main__":

    # Create a SparkSession (Note, the config section is only for Windows!)
    spark = SparkSession.builder.appName("LinearRegression").getOrCreate()

    # Load up our data and convert it to the format MLLib expects.
    inputLines = spark.sparkContext.textFile("files/regression.txt")
    data = inputLines.map(lambda x: x.split(",")).map(lambda x: (float(x[0]), Vectors.dense(float(x[1]))))

    # Convert this RDD to a DataFrame
    colNames = ["label", "features"]
    df = data.toDF(colNames)

    # Note, there are lots of cases where you can avoid going from an RDD to a DataFrame.
    # Perhaps you're importing data from a real database. Or you are using structured streaming
    # to get your data.

    # Let's split our data into training data and testing data
    trainTest = df.randomSplit([0.5, 0.5])
    trainingDF = trainTest[0]
    testDF = trainTest[1]

    # Now create our linear regression model
    lir = LinearRegression(maxIter=10, regParam=0.3, elasticNetParam=0.8)

    # Train the model using our training data
    model = lir.fit(trainingDF)

    # Now see if we can predict values in our test data.
    # Generate predictions using our linear regression model for all features in our
    # test dataframe:
    fullPredictions = model.transform(testDF).cache()

    # Extract the predictions and the "known" correct labels.
    predictions = fullPredictions.select("prediction").rdd.map(lambda x: x[0])
    labels = fullPredictions.select("label").rdd.map(lambda x: x[0])

    # Zip them together
    predictionAndLabel = predictions.zip(labels).collect()

    # Print out the predicted and actual values for each point
    for prediction in predictionAndLabel:
      print(prediction)


    # Stop the session
    spark.stop()

# output
# prediction, label
# (-1.8745879855733403, -2.58)
# (-1.9179922953673185, -2.36)
# (-1.7154388496620876, -2.29)
# (-1.5996940235448125, -2.27)
# (-1.6430983333387905, -2.26)
# (-1.3899065262072516, -2.12)
# (-1.339268164780944, -1.91)
# (-1.3465022164132736, -1.8)
# (-1.266927648457647, -1.79)
# (-1.216289287031339, -1.77)
# (-1.0716082543847456, -1.67)
# (-1.2018211837666797, -1.66)
# (-1.1945871321343502, -1.6)
# (-1.1873530805020205, -1.59)
# (-1.064374202752416, -1.58)
# (-1.2090552353990094, -1.58)
# (-1.2307573902959985, -1.53)
# (-1.013735841326108, -1.48)
# (-1.0716082543847456, -1.47)
# (-1.035437996223097, -1.36)
# (-0.8401186021501955, -1.3)
# (-0.8690548086795143, -1.3)
# (-1.078842306017075, -1.29)
# (-0.876288860311844, -1.27)
# (-0.8907569635765034, -1.26)
# (-0.8835229119441738, -1.25)
# (-0.97033153153213, -1.25)
# (-0.8835229119441738, -1.22)
# (-0.9052250668411628, -1.11)
# (-0.7967142923562176, -1.1)
# (-0.8690548086795143, -1.09)
# (-0.7605440341945692, -1.07)
# (-0.8618207570471846, -1.04)
# (-0.6737354146066129, -0.97)