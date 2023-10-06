<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "Student"; // Replace with your actual database name

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve student information from the form
if(isset($_POST["submit"])){
 $name = $_POST["name"];
 $id = $_POST["id"]; 

// Initialize a variable to store the total marks
$totalMarks = 0;

// Loop through each question and part to calculate the total marks
for ($question = 1; $question <= 9; $question++) {
    for ($part = 'a'; $part <= 'd'; $part++) {
        $inputName = "q${question}_${part}"; // Create input name

        $marks = $_POST[$inputName];
       if (is_numeric($marks)) {
                $totalMarks += $marks;
            }
    }
}

// Insert the student's data into the database, including the total marks
$sql = "INSERT INTO marks (name, id, total) VALUES ('$name', '$id', $totalMarks)";

if ($conn->query($sql) === TRUE) {
    echo "<script> alert('Marks stored successfully. Total Marks: $totalMarks')</script>";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
}
$conn->close();
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Marksheet</title>
    <style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f4f4f4;
        margin: 0;
        padding: 0;
        text-align: center;
    }

    h1 {
        background-color: #8A2BE2;
        color: #fff;
        text-align: center;
        padding: 20px;
    }

    form {
        background-color: #FAEBD7;
        padding: 20px;
        border-radius: 5px;
        box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        width: 80%;
        margin: 0 auto;
    }

    label {
        font-weight: bold;
    }

    input[type="text"],
    input[type="number"] {
        width: 50%;
        padding: 10px;
        margin-bottom: 10px;
        border: 1px solid #ccc;
        border-radius: 3px;
        font-size: 16px;
    }

    h2 {
        margin-top: 20px;
    }

    h3 {
        margin-top: 10px;
    }

    input[type="submit"] {
        background-color: #8A2BE2;
        color: #fff;
        padding: 10px 20px;
        border: none;
        border-radius: 3px;
        cursor: pointer;
        font-size: 18px;
    }

    input[type="submit"]:hover {
        background-color: #8A2BE2;
    }
</style>

</head>
<body>
    <div class="txtContainer" class="text-align: center">
        <h1>Noakhali Science and Technology University</h1>
        <h2>Elaborate Mark Sheet</h2>
        <h2> Year: 3 &nbsp;       Term: 1  &nbsp;      FInal Examination-2023</h2>
        <h2>Course Code: CSE3103     &nbsp;       Course Title: Web Technology</h2>
        <h2><font color="MediumOrchid">Institute of Information and Technology(B.Sc. in Software Engineering)</font></h2>
        <h2>Examiner : Rafid Mostafiz</h2>
    </div>
    <form action="marksheet.php" method="post">
        <label for="name">Student Name: </label>
        <input type="text" id="name" name="name" required><br><br>

        <label for="id">Student ID: </label>
        <input type="text" id="id" name="id" required><br><br>
        

        <h2>Enter Marks for Each Question (a, b, c, d)</h2>
        
        <?php
        for ($question = 1; $question <= 9; $question++) {
            echo "<h3>Question $question</h3>";
            for ($part = 'a'; $part <= 'd'; $part++) {
                $inputName = "q${question}_${part}"; // Create unique input names
                echo "<label for='$inputName'>$part: </label>";
                echo "<input type='number' id='$inputName' name='$inputName' min='0' max='10' value='' autocomplete='off'><br>";
            }
        }
        ?>
        <br>
        <input type="submit" name="submit" value="Submit Marks">
    </form>
    <p>Want to see the marks data? <a href="view_marks.php">Click Here!</a></p>
</body>
</html>
