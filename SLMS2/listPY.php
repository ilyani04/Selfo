<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="images/icon.png"/>
    <title>Past Year</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <header>
        <img src="images/selfo.jpg" alt="Company Logo" style="width: 70px; height: auto;">
        <nav>
			<a href=" /SLMS2/basicMainPage.php">Home</a>
			<a href=" /SLMS2/listSM.php">Study Material</a>
			<a href=" /SLMS2/listPY.php">Past Year</a>
        </nav>
    </header>
    <main>
    <div class="container my-5">
        <h2>List of Past Year</h2>
        <br>
        <table class="table">
            <thead>
                <tr>
                    <th>PAPER ID</th>
                    <th>COURSE CODE</th>
                    <th>PAST YEAR PAPER</th>
                    <th>ANSWER PAPER</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $servername = "localhost";
                $username = "root";
                $password = "";
                $database = "selfodb";

                //create connection
                $connection = new mysqli($servername, $username, $password, $database);

                //check connection
                if ($connection->connect_error){
                    die("Connection failed: ". $connection->connect_error);
                }

                //read all row from database table
                $sql = "SELECT * FROM past_year_paper";
                $result = $connection->query($sql);

                if (!$result){
                    die("Invalid query: ". $connection->error);
                }

                //read data of each row
                while($row = $result->fetch_assoc()){
                    echo "<tr>
                    <td>$row[paper_id]</td>
                    <td>$row[course_code]</td>
                    <td>$row[paper]</td>
                    <td>$row[answer]</td>
                </tr>
                ";
                }
                ?>
            </tbody>
        </table>
    </div>
    </main>
</body>
</html>