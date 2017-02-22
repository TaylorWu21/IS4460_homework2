<?php

  require_once '../login.php';
  $conn = new mysqli($hn, $un, $pw, $db);
  if ($conn->connect_error) die($conn->connect_error);

  if(isset($_POST['review_id'])) {
    $id = $_POST['review_id'];
    $movie_id = $_POST['movie_id'];
    $query = "DELETE FROM reviews WHERE review_id='$id'";
    $result = $conn->query($query);
    if(!$result) die($conn->error);

    // $result->close();
    $conn->close();
    session_start();
    $_SESSION['review_id'] = $id;
    $_SESSION['review_movie_id'] = $movie_id;
    header("Location: reviews.php");
  }

?>
