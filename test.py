with open("recommendation_result1.csv", "r") as input, open("result.csv", "w") as output:
    for row in input:
        output.write(row.split(",", 1)[1])