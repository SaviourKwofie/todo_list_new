<?php
include("todoService.php");
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS');
header('Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token');
// header('Access-Control-Allow-Credentials: true');

$conn = new mysqli("localhost", "root", "", "todo_list_db");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

switch ($_SERVER['REQUEST_METHOD']) {
    case 'GET':
        if (isset($_GET['id'])) {
            getTodoById($_GET['id']);
        } else {
            getTodos();
        }
        break;
    case 'POST':
        addTodo();
        break;
    case 'DELETE':
        if (isset($_GET['id'])) {
            deleteTodo($_GET['id']);
        } else {
            echo json_encode(array("message" => "No id provided"));
        }
        break;
    case 'PUT':
        if (isset($_GET['id'])) {
            updateTodo($_GET['id']);
        } else {
            echo json_encode(array("message" => "No id provided"));
        }
        break;
    default:
        echo json_encode(array("message" => "Invalid request method"));
        break;
}

$conn->close();
