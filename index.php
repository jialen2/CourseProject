<!DOCTYPE html>
<html lang = "en">
<head>
    <link rel="stylesheet" type="text/css" href="style/index.css">
    <script type="text/javascript" src="style/index.js"></script>
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Sofia">
	<title>CS410 Final Project</title>
	<style>
body {
  background-image: url('10011637471668_.pic.jpg');
}
h1 {font-family: "Sofia", sans-serif;}
</style>
</head>
<body>
  <?php
// define variables and set to empty values
$moviegenre  = "";
$recommendernumber = 0;
$username = -1;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $username = $_POST["username"];
  $moviegenre = $_POST["moviegenre"];
  $recommendernumber = $_POST["recommendernumber"];
}

// function test_input($data) {
//   $data = trim($data);
//   $data = stripslashes($data);
//   $data = htmlspecialchars($data);
//   return $data;
// }
?>
<h1><b>Movie Recommender System</b></h1>

<form id = "form" method = "POST" action= "<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
  <label for="username">UserName:</label>
  <input type="text" required id="username" name="username"><br><br>
  <label for="moviegenre">Movie Genre:</label>
  <input type="text" required id="moviegenre" name="moviegenre"><br><br>
   <label for="recommendernumber">Numbers of recommended movies:</label>
  <input type="number" required id="recommendernumber" name="recommendernumber"><br><br>
  <input type="submit" value="Submit">
</form>


<?php
    if ($username != -1) {
        echo "<div id='wrapper'>";
        echo "<h1>Search Result</h1>";
        echo "<table id='keywords' cellspacing='0' cellpadding='0'>";
        echo "<thead>";
        echo "<tr>";
        echo "<th><span>Title</span></th>";
        echo "<th><span>Genre</span></th>";
        echo "<th><span>More Info</span></th>";
        echo "</tr>";
        echo "</thead>";
        echo "<tbody>";
    }
?>

<?php
include_once 'includes/dbh.php';

if ($username != -1) {
    $user_info_query =  "SELECT * FROM Movie_Info.Recommendation WHERE user = ".$username;
    $user_info_result = $conn->query($user_info_query);
    $user_info_fetch_results = $user_info_result->fetch_all(MYSQLI_ASSOC);
    $num_movie_needed = min(20,$recommendernumber);
    $num_movie_got = 0;
    foreach($user_info_fetch_results as $row) {
        for ($c=1; $c < 21; $c++) {
            if ($num_movie_needed <= $num_movie_got) {
                break;
            }
            $movie_id = $row["movieId{$c}"];
            $movie_info_query =  "SELECT * FROM Movie_Info.Movie WHERE movieid = ".$movie_id;
            $result = $conn->query($movie_info_query);
            if ($result->num_rows == 1) {
                $results = $result->fetch_all(MYSQLI_ASSOC);
                $movie_row = $results[0];
                if (strpos($movie_row["genres"],$moviegenre) !== false) {
                    echo "<tr>";
                    echo "<td class='lalign'>", $movie_row["title"], "</td>";
                    echo "<td>", $movie_row["genres"], "</td>";
                    echo "</tr>";
                    $num_movie_got += 1;
                }
            }
        }
        echo "</br>";
    }
}
// $query =  "INSERT INTO CUSTOMER(ID,NAME) VALUES (2, 'world');";
// $query = "SELECT * FROM CUSTOMER";
// $result = $conn->query($query);
// if ($count = $result->num_rows) {
//     echo '<p>', $count, '</p>';
//     $results = $result->fetch_all(MYSQLI_ASSOC);
//     foreach($results as $row) {
//         echo $row["ID"], $row["NAME"], "</br>";
//     }
// }
// print_r($results);
// $conn->close();

?>
        </tbody>
    </table>
</body>
</html>