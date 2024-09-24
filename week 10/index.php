<?php
    // Database connection
    $dbhost = "localhost";  // Database host
    $dbuser = "root";       // Database username
    $dbpass = "";           // Database password
    $dbname = "sampledb";   // Database name

    $con = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

    // Check the connection
    if($con->connect_error){
        exit('Could not connect to the database.');
    }

    // Get the CGPA from the AJAX request
    $cgpa = $_GET['q'];

    // SQL query to select students based on CGPA
    $sql = "SELECT * FROM collegedb WHERE cgpa = '$cgpa'";

    $query = mysqli_query($con, $sql);

    // Check if query failed
    if (!$query) {
        echo ("Error: " . mysqli_error($con));
        exit;
    }

    // Generate HTML table if results are found
    if (mysqli_num_rows($query) > 0) {
        echo "<table>
                <tr>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Roll No</th>
                    <th>CGPA</th>
                </tr>";

        // Loop through the query results and output rows
        while ($result = mysqli_fetch_assoc($query)) {
            echo "<tr>
                    <td>" . $result['firstname'] . "</td>
                    <td>" . $result['lastname'] . "</td>
                    <td>" . $result['rollno'] . "</td>
                    <td>" . $result['cgpa'] . "</td>
                  </tr>";
        }
        echo "</table>";
    } else {
        echo "No results found for CGPA " . $cgpa;
    }

    // Close the database connection
    mysqli_close($con);
?>
