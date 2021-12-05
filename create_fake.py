import random
import numpy as np
with open("fake.csv", "w") as f:
    f.write("user_id,")
    for i in range(1,6):
        f.write("movie_id" + str(i) + ",")
    f.write("\n")
    for i in range(1000):
        f.write(str(i)+",")
        for num in list(random.sample(list(range(1,11)),5)):
            f.write(str(num) + ",")
        f.write("\n")