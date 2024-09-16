<?php

function getTodos() {
    global $conn;
    $sql = "SELECT * FROM todos";
    $result = mysqli_query($conn, $sql);
    $todos = array();
    while ($row = mysqli_fetch_assoc($result)) {
        $todos[] = $row;
    }
    echo json_encode($todos);
}

function addTodo() {
    global $conn;
    $data = json_decode(file_get_contents('php://input'), true);
    $task = mysqli_real_escape_string($conn, $data['task']);
    $sql = "INSERT INTO todos (task) VALUES ('$task')";
    $result = mysqli_query($conn, $sql);
    if ($result) {
        echo json_encode(array("message" => "New task created successfully"));
    } else {
        echo json_encode(array("message" => "Error: " . $sql . "<br>" . $conn->error));
    }
}


function deleteTodo($id) {
    global $conn;
    $id = mysqli_real_escape_string($conn, $id);
    $sql = "DELETE FROM todos WHERE id = $id";
    $result = mysqli_query($conn, $sql);
    if ($result) {
        echo json_encode(array("message" => "Task deleted successfully"));
    } else {
        echo json_encode(array("message" => "Error: " . $sql . "<br>" . $conn->error));
    }
}

function updateTodo($id) {
    global $conn;
    $data = json_decode(file_get_contents('php://input'), true);
    $id = mysqli_real_escape_string($conn, $id);
    $task = mysqli_real_escape_string($conn, $data['task']);
    $sql = "UPDATE todos SET task = '$task' WHERE id = $id";
    $result = mysqli_query($conn, $sql);
    if ($result) {
        echo json_encode(array("message" => "Task updated successfully"));
    } else {
        echo json_encode(array("message" => "Error: " . $sql . "<br>" . $conn->error));
    }
}

function getTodoById($id) {
    global $conn;
    $id = mysqli_real_escape_string($conn, $id);
    $sql = "SELECT * FROM todos WHERE id = $id";
    $result = mysqli_query($conn, $sql);
    if($result->num_rows > 0) {
        echo json_encode($result->fetch_assoc());
    } else {        
        echo json_encode(array("message" => "No task found with that id"));
    }
   
}

?>