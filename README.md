# Movie Recommender – Documentation

## Presentation Video
    https://mediaspace.illinois.edu/media/t/1_hrejpyg0

## **Overview**

The project is a movie recommendation system based on the free topic theme option. This recommender system is meant to recommend movies to each user recorded in the dataset we choose, consisting of movie ratings from 610 users. On the website we constructed, each user will be recommended a maximum of 20 different movies, ranking in descending order of predicted favorability value. Our website allows input of user number, movie genres, and the number of recommended movies needed. The favorability values are predicted through **collaborative filtering** by training the **Root Mean Square Error (RMSE)**, or the distance between the true and the predicted values. 

## **Implementation**

### **Server Connection (`dbh.php`)**

For this project, we constructed a static website to present our recommendation system. We choose to use the MySQL Database server instead of a local database. Therefore, we made a connection to the MySQL server in the `dbh.php` file: 

![pic1](https://github.com/jialen2/CourseProject/blob/main/ReadMe_Pictures/ReadMe_Pic1.png)

### **Frontend Interface (index.php)**

The website generated through index.php allows users to enter three inputs, including **Username** (User number [1, 610]), **Movie Genre** (e.g., Comedy, Drama, Romance, Horror, Sci-Fi, etc. Capitalized), and **Number of Recommended Movies** ([1,20]).

![pic2](https://github.com/jialen2/CourseProject/blob/main/ReadMe_Pictures/ReadMe_Pic2.png)

After putting a group of input (e.g., 10, Comedy, 5), the user will get a result similar to the following picture, which provides five comedy movie recommendations for user #10.

![pic3](https://github.com/jialen2/CourseProject/blob/main/ReadMe_Pictures/ReadMe_Pic3.png)

### **Recommender (`recommender_system.ipynb`)**

The project implements collaborative filtering using the programming language of python in Jupyter Notebook to achieve the goal of recommendation. The implementation of recommender could be divided into the following steps:

**I.** Import the csv dataset of movie ratings from 610 users and transform it into a matrix that contains **9724 rows**, each representing a movie, and **610 columns**, each representing a user. Since each user will not rate every movie, most values in this matrix are presented as N/A. We calculated the **sparsity**, or the percentage of N/A values, of the matrix, being 98.32% and replaced N/A values with zero.

![pic4](https://github.com/jialen2/CourseProject/blob/main/ReadMe_Pictures/ReadMe_Pic4.png)

**II.** Assuming 10 features, we initialize movie parameters and user parameters using the numpy.random.randint function and get the index of non-zero values. We also defined a function named rmse here to calculate the **Root Mean Square Error (RMSE)** using the function attached below.  

![pic5](https://github.com/jialen2/CourseProject/blob/main/ReadMe_Pictures/ReadMe_Pic5.png)
![pic6](https://github.com/jialen2/CourseProject/blob/main/ReadMe_Pictures/ReadMe_Pic6.png)

**III.** Update parameters using the **Gradient Descent Algorithm** to **minimize** the RMSE values. This part of the code updates the predictions 100 times while keeping track of the RMSE values in the list named *rmse_ls*. Drawing out a graph of the changing of RMSE values as the number of epochs increases, we find the training is actually decreasing the RMSE values. 

![pic7](https://github.com/jialen2/CourseProject/blob/main/ReadMe_Pictures/ReadMe_Pic7.png)
![pic8](https://github.com/jialen2/CourseProject/blob/main/ReadMe_Pictures/ReadMe_Pic8.png)

**IV.** Make predictions using the trained parameters and reshape the dataset as each user corresponds to a list of movieIds of recommended movies (the top 20 with the best-predicted ratings). Then reshape the dataset as a matrix of **610 rows (users) 21 columns (20 movieIds of the recommended movie for each user)** as the final output.  

![pic9](https://github.com/jialen2/CourseProject/blob/main/ReadMe_Pictures/ReadMe_Pic9.png)

![pic10](https://github.com/jialen2/CourseProject/blob/main/ReadMe_Pictures/ReadMe_Pic10.png)

## **Usage**

Clone project from GitHub

```bash
git clone https://github.com/jialen2/CourseProject.git
cd CourseProject
```
Run php file in terminal
```bash
php -S 127.0.0.1:8000
```
Open browser and enter
```bash
localhost:8000
```

## **Team Distribution**
- Initial Idea: Li Ju
- Project Proposal & Progress Report: Jiale Ning, Li Ju, Jiawei Pei
- Frontend Interface & Server Connection: Jiale Ning
- Researching on Datasets & Recommender System: Li Ju, Jiawei Pei
- Documentation: Jiawei Pei
- Presentation: Li Ju, Jiawei Pei, Jiale Ning

## **Citation**
    Dataset used: https://files.grouplens.org/datasets/movielens/ml-latest-small.zip