from pyspark.sql import SparkSession
from pyspark.sql.types import StructType, StructField, IntegerType, FloatType
from pyspark.sql import functions as func

spark = SparkSession.builder.appName(
    "TotalAmountSpendByCustomer").getOrCreate()

schema = StructType([
    StructField("customer_id", IntegerType(), True),
    StructField("item_id", IntegerType(), True),
    StructField("amount_spend", FloatType(), True)
])

customer_orders_df = spark.read \
    .schema(schema) \
    .csv("files/customer-orders.csv")

result = customer_orders_df \
    .groupBy("customer_id") \
    .agg(func.round(func.sum('amount_spend'), 2).alias("total_amount_spend")) \
    .sort("total_amount_spend", ascending=False) \
    .collect()

for r in result:
    print(r)


# output
# Row(customer_id=68, total_amount_spend=6375.45)
# Row(customer_id=73, total_amount_spend=6206.2)
# Row(customer_id=39, total_amount_spend=6193.11)
# Row(customer_id=54, total_amount_spend=6065.39)
# Row(customer_id=71, total_amount_spend=5995.66)
# Row(customer_id=2, total_amount_spend=5994.59)
# Row(customer_id=97, total_amount_spend=5977.19)
# Row(customer_id=46, total_amount_spend=5963.11)
# Row(customer_id=42, total_amount_spend=5696.84)
# Row(customer_id=59, total_amount_spend=5642.89)
# Row(customer_id=41, total_amount_spend=5637.62)
# Row(customer_id=0, total_amount_spend=5524.95)
# Row(customer_id=8, total_amount_spend=5517.24)
# Row(customer_id=85, total_amount_spend=5503.43)
# Row(customer_id=61, total_amount_spend=5497.48)
# Row(customer_id=32, total_amount_spend=5496.05)
# Row(customer_id=58, total_amount_spend=5437.73)
# Row(customer_id=63, total_amount_spend=5415.15)
# Row(customer_id=15, total_amount_spend=5413.51)
# Row(customer_id=6, total_amount_spend=5397.88)
# Row(customer_id=92, total_amount_spend=5379.28)
# Row(customer_id=43, total_amount_spend=5368.83)
# Row(customer_id=70, total_amount_spend=5368.25)
# Row(customer_id=72, total_amount_spend=5337.44)
# Row(customer_id=34, total_amount_spend=5330.8)
# Row(customer_id=9, total_amount_spend=5322.65)
# Row(customer_id=55, total_amount_spend=5298.09)
# Row(customer_id=90, total_amount_spend=5290.41)
# Row(customer_id=64, total_amount_spend=5288.69)
# Row(customer_id=93, total_amount_spend=5265.75)
# Row(customer_id=24, total_amount_spend=5259.92)
# Row(customer_id=33, total_amount_spend=5254.66)
# Row(customer_id=62, total_amount_spend=5253.32)
# Row(customer_id=26, total_amount_spend=5250.4)
# Row(customer_id=52, total_amount_spend=5245.06)
# Row(customer_id=87, total_amount_spend=5206.4)
# Row(customer_id=40, total_amount_spend=5186.43)
# Row(customer_id=35, total_amount_spend=5155.42)
# Row(customer_id=11, total_amount_spend=5152.29)
# Row(customer_id=65, total_amount_spend=5140.35)
# Row(customer_id=69, total_amount_spend=5123.01)
# Row(customer_id=81, total_amount_spend=5112.71)
# Row(customer_id=19, total_amount_spend=5059.43)
# Row(customer_id=25, total_amount_spend=5057.61)
# Row(customer_id=60, total_amount_spend=5040.71)
# Row(customer_id=17, total_amount_spend=5032.68)
# Row(customer_id=29, total_amount_spend=5032.53)
# Row(customer_id=22, total_amount_spend=5019.45)
# Row(customer_id=28, total_amount_spend=5000.71)
# Row(customer_id=30, total_amount_spend=4990.72)
# Row(customer_id=16, total_amount_spend=4979.06)
# Row(customer_id=51, total_amount_spend=4975.22)
# Row(customer_id=1, total_amount_spend=4958.6)
# Row(customer_id=53, total_amount_spend=4945.3)
# Row(customer_id=18, total_amount_spend=4921.27)
# Row(customer_id=27, total_amount_spend=4915.89)
# Row(customer_id=86, total_amount_spend=4908.81)
# Row(customer_id=76, total_amount_spend=4904.21)
# Row(customer_id=38, total_amount_spend=4898.46)
# Row(customer_id=95, total_amount_spend=4876.84)
# Row(customer_id=89, total_amount_spend=4851.48)
# Row(customer_id=20, total_amount_spend=4836.86)
# Row(customer_id=88, total_amount_spend=4830.55)
# Row(customer_id=10, total_amount_spend=4819.7)
# Row(customer_id=4, total_amount_spend=4815.05)
# Row(customer_id=82, total_amount_spend=4812.49)
# Row(customer_id=31, total_amount_spend=4765.05)
# Row(customer_id=44, total_amount_spend=4756.89)
# Row(customer_id=7, total_amount_spend=4755.07)
# Row(customer_id=37, total_amount_spend=4735.2)
# Row(customer_id=14, total_amount_spend=4735.03)
# Row(customer_id=80, total_amount_spend=4727.86)
# Row(customer_id=21, total_amount_spend=4707.41)
# Row(customer_id=56, total_amount_spend=4701.02)
# Row(customer_id=66, total_amount_spend=4681.92)
# Row(customer_id=12, total_amount_spend=4664.59)
# Row(customer_id=3, total_amount_spend=4659.63)
# Row(customer_id=84, total_amount_spend=4652.94)
# Row(customer_id=74, total_amount_spend=4647.13)
# Row(customer_id=91, total_amount_spend=4642.26)
# Row(customer_id=83, total_amount_spend=4635.8)
# Row(customer_id=57, total_amount_spend=4628.4)
# Row(customer_id=5, total_amount_spend=4561.07)
# Row(customer_id=78, total_amount_spend=4524.51)
# Row(customer_id=50, total_amount_spend=4517.27)
# Row(customer_id=67, total_amount_spend=4505.79)
# Row(customer_id=94, total_amount_spend=4475.57)
# Row(customer_id=49, total_amount_spend=4394.6)
# Row(customer_id=48, total_amount_spend=4384.33)
# Row(customer_id=13, total_amount_spend=4367.62)
# Row(customer_id=77, total_amount_spend=4327.73)
# Row(customer_id=47, total_amount_spend=4316.3)
# Row(customer_id=98, total_amount_spend=4297.26)
# Row(customer_id=36, total_amount_spend=4278.05)
# Row(customer_id=75, total_amount_spend=4178.5)
# Row(customer_id=99, total_amount_spend=4172.29)
# Row(customer_id=23, total_amount_spend=4042.65)
# Row(customer_id=96, total_amount_spend=3924.23)
# Row(customer_id=79, total_amount_spend=3790.57)
# Row(customer_id=45, total_amount_spend=3309.38)