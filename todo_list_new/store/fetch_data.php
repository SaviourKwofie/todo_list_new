<?
include 'connection.php';
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type, Authorization');
header('Content-Type: application/json');
// try {
//     $sql = "SELECT * FROM todos";
//     $result = mysqli_query($GLOBALS[$conn], $sql);

//     if ($result === false) {
//         throw new Exception('Query error: ' . $conn->error);
//     }

//     $tasks = array();

//     if ($result->num_rows > 0) {
//         $tasks = $result->fetch_all(MYSQLI_ASSOC);

//     }




//     echo json_encode($tasks);
// } catch (Exception $e) {
//     echo json_encode(['error' => $e->getMessage()]);
// }

// $conn->close();





function helloWorld()
{
    $message = array('message' => 'Hello World');
    return json_encode($message);
}

// Call the function
echo helloWorld();
