<?php
 include 'connection.php';
$id = $_POST['id'];
$task = $_POST['task'];

$sql = "UPDATE tasks SET task='$task' WHERE id=$id";

if ($conn->query($sql) === TRUE) {
    echo "Task updated successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>