<?php
 include 'connection.php';
$task = $_POST['task'];
$sql = "INSERT INTO todos (task) VALUES ('$task')";

if ($conn->query($sql) === TRUE) {
    echo "New task created successfully";
    return header('Location: index.html');
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

 $conn->close();
 ?>
  
 
 