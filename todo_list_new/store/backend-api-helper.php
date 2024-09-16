<?php
include ('connection.php');
// Set headers to indicate that the response is JSON
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *'); // Allows requests from any origin

// Create an associative array with the message
function helloWorld()
{
    $message = array('message' => 'Hello World');
    echo json_encode($message);
}

// helloWorld();

// Encode the array into a JSON string and output it

function getAllTasks()
{
    $sql = "SELECT * FROM todos";
    // $result = mysqli_query($GLOBALS[$conn], $sql);
    $result = mysqli_query($GLOBALS['conn'], $sql);

    if ($result === false) {
        throw new Exception('Query error: ' . $GLOBALS['conn']->error);
    }

    $tasks = array();

    if ($result->num_rows > 0) {
        $tasks = $result->fetch_all(MYSQLI_ASSOC);

    }

    echo json_encode($tasks);
}

getAllTasks();


?>