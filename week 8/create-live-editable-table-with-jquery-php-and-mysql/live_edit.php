<?php
include_once("db_connect.php");

// Set headers to return JSON response
header('Content-Type: application/json');

// Capture input from POST
$input = filter_input_array(INPUT_POST);

$response = ['status' => 'error', 'message' => 'No action performed']; // Default response

if ($input['action'] == 'edit') {
    $update_field = '';

    // Collect updated fields
    if (isset($input['name'])) {
        $update_field .= "name='" . mysqli_real_escape_string($conn, $input['name']) . "'";
    } else if (isset($input['gender'])) {
        $update_field .= "gender='" . mysqli_real_escape_string($conn, $input['gender']) . "'";
    } else if (isset($input['address'])) {
        $update_field .= "address='" . mysqli_real_escape_string($conn, $input['address']) . "'";
    } else if (isset($input['age'])) {
        $update_field .= "age='" . mysqli_real_escape_string($conn, $input['age']) . "'";
    } else if (isset($input['designation'])) {
        $update_field .= "designation='" . mysqli_real_escape_string($conn, $input['designation']) . "'";
    }

    // Perform the update if valid input is provided
    if ($update_field && isset($input['id'])) {
        $sql_query = "UPDATE developers SET $update_field WHERE id='" . mysqli_real_escape_string($conn, $input['id']) . "'";
        
        // Execute the query
        if (mysqli_query($conn, $sql_query)) {
            $response = ['status' => 'success', 'message' => 'Record updated successfully'];
        } else {
            $response = ['status' => 'error', 'message' => 'Database error: ' . mysqli_error($conn)];
        }
    }
}

// Fetch the data to return to DataTables
$query = "SELECT id, name, gender, address, age, designation FROM developers";
$result = mysqli_query($conn, $query);

// Create an array to store the result
$data = [];
while ($row = mysqli_fetch_assoc($result)) {
    $data[] = $row;
}

// Prepare the final response for DataTables
$datatables_response = [
    "draw" => isset($input['draw']) ? intval($input['draw']) : 1,
    "recordsTotal" => count($data),
    "recordsFiltered" => count($data),
    "data" => $data
];

// Return the JSON response expected by DataTables
echo json_encode($datatables_response);
exit();
?>
