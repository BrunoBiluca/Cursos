from pyspark import SparkConf, SparkContext
from operator import add

conf = SparkConf().setMaster("local").setAppName("Total amount spent by customer")
sc = SparkContext(conf=conf)

lines = sc.textFile("files/customer-orders.csv")


def parse_line(row):
    values = row.split(',')
    customer_id = int(values[0])
    amount_spent = float(values[2])
    return customer_id, amount_spent

result = lines.map(parse_line).reduceByKey(add).collect()

for r in result:
    print(r)

# Sample result
# (44, 4756.8899999999985)
# (35, 5155.419999999999)
# (2, 5994.59)
# (47, 4316.299999999999)
# (29, 5032.529999999999)
# (91, 4642.259999999999)
# (70, 5368.249999999999)
# (85, 5503.43)
# (53, 4945.299999999999)
# (14, 4735.030000000001)
# (51, 4975.22)
# (42, 5696.840000000003)
# (79, 3790.570000000001)
# (50, 4517.27)
# (20, 4836.859999999999)
# (15, 5413.510000000001)
# (5, 4561.069999999999)
# (48, 4384.33)
# (31, 4765.05)
# (4, 4815.050000000002)
# (36, 4278.049999999997)
# (57, 4628.4)
# (12, 4664.589999999998)
# (22, 5019.449999999999)
# (54, 6065.389999999999)
# (0, 5524.949999999998)
# (88, 4830.549999999999)
# (86, 4908.81)
# (13, 4367.62)
# (40, 5186.429999999999)
# (98, 4297.260000000001)
# (55, 5298.090000000002)
# (95, 4876.840000000002)
