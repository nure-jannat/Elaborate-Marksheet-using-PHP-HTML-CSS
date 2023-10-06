
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Marks Data</title>

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

    table {
        width: 80%;
        margin: 20px auto;
        border-collapse: collapse;
        background-color: #FAEBD7;
        box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
    }

    table, th, td {
        border: 1px solid #ccc;
    }

    th, td {
        padding: 10px;
        text-align: left;
    }

    th {
        background-color: #8A2BE2;
        color: #fff;
    }
</style>

</head>
<body>
    <h1>Marksheet Data</h1>
</body>
</html>





<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "Student"; // Replace with your actual database name

// Create a connection to the database
$conn = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch data from the "marks" table
$sql = "SELECT DISTINCT id, name, MAX(total) AS total FROM marks GROUP BY id";
$result = $conn->query($sql);

// Check if there is data to display
if ($result->num_rows > 0) {
    echo "<table border='1'>";
    echo "<tr><th>Name</th><th>ID</th><th>Total Marks</th></tr>";

    // Loop through the rows of data
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row["name"] . "</td>";
        echo "<td>" . $row["id"] . "</td>";
        echo "<td>" . $row["total"] . "</td>";
        echo "</tr>";
    }

    echo "</table>";
} else {
    echo "No data found.";
}

// Close the database connection
$conn->close();
?>

