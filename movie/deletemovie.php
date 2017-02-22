<?php

  require_once '../login.php';
  $conn = new mysqli($hn, $un, $pw, $db);
  if ($conn->connect_error) die($conn->connect_error);
  
  if(isset($_POST['movie_id'])) {
    $id = $_POST['movie_id'];
    echo $id;
    $query = "DELETE FROM movies WHERE movie_id='$id'";
    $result = $conn->query($query);
    if(!$result) die($conn->error);

    // $result->close();
    $conn->close();
    header("Location: movies.php");
  }

?>
