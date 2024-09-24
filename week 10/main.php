<!DOCTYPE html>
<html>
<head>
    <title>Student CGPA Search</title>
    <style>
        input {
            padding: 0.5rem 2rem;
            margin-top: 10px;
        }
        label {
            font-size: 1rem;
            color: black;
        }
        #result-box {
            margin-top: 20px;
            font-size: 1rem;
            color: green;
        }
        table {
            width: 50%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            padding: 10px;
            border: 1px solid black;
            text-align: center;
        }
    </style>
</head>
<body>

    <h1>Search Student by CGPA</h1>

    <!-- Form to take CGPA input -->
    <form>
        <label for="cgpa_val">Enter CGPA: </label>
        <input type="text" id="cgpa_val" name="cgpa_val">
        <input type="button" onclick="ajax_fun()" value="Submit">
    </form>

    <br>

    <!-- Div to display results -->
    <div id="result-box">Results will be displayed here...</div>

    <!-- JavaScript to handle AJAX requests -->
    <script language="javascript" type="text/javascript">
        function ajax_fun() {
            // Create the AJAX request object
            const ajax_Request = new XMLHttpRequest();

            // Define what should happen when the response is ready
            ajax_Request.onreadystatechange = function() {
                if (ajax_Request.readyState == 4 && ajax_Request.status == 200) {
                    // Update the result-box with the server response
                    document.getElementById("result-box").innerHTML = ajax_Request.responseText;
                }
            };

            // Get the user-entered CGPA value
            var str = document.getElementById('cgpa_val').value;

            // Send the request to the server (index.php) with the CGPA value
            ajax_Request.open("GET", "index.php?q=" + str, true);
            ajax_Request.send();
        }
    </script>

</body>
</html>
