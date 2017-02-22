<?php

  require_once '../login.php';
  $conn = new mysqli($hn, $un, $pw, $db);
  if ($conn->connect_error) die($conn->connect_error);

  session_start();
  $title = $_SESSION['title'];
  $review = $_SESSION['review'];
  $review_id = $_SESSION['review_id'];
  $movie_id = $_SESSION['movie_id'];

  if(isset($_GET['review_id'])) {
    $review_id = $_GET['review_id'];
    echo $review_id;
    $query = "SELECT * FROM reviews WHERE review_id='$review_id'";
    $result = $conn->query($query);
    if (!$result) die ("Database access failed: " . $conn->error);
    $rows = $result->num_rows;

    for ($j = 0 ; $j < $rows ; ++$j) {
      $result->data_seek($j);
      $row = $result->fetch_array(MYSQLI_ASSOC);
      $review_id = $row['review_id'];
      $movie_id = $row['movie_id'];
      $title = $row['title'];
      $review = $row['review'];
    }

    $result->close();
    $conn->close();
  }
?>
<html>
<head>
  <link rel='stylesheet' href='../materialize/css/materialize.css'>
</head>
<body>
  <div class='center'>
    <h1>Title: <?php echo $title; ?></h1>
    <h4>Review: <?php echo $review; ?></h4>
  </div>


  <div class='center'>
    <form method='get' action='editreview.php'>
      <input type='hidden' name='review_id' value=<?php echo $review_id; ?> />
      <input type='submit' class='btn orange' value='Edit' />
    </form>
    <form method='post' action='deletereview.php'>
      <input type='hidden' name='review_id' value=<?php echo $review_id; ?> />
      <input type='hidden' name='movie_id' value=<?php echo $movie_id; ?> />
      <input type='submit' class='btn red' value='Delete' />
    </form>
    <form method='post' action='reviews.php'>
      <input type='hidden' name='movie_id' value=<?php echo $movie_id; ?> />
      <input type='submit' class='btn' value='Back To Reviews' />
    </form>
  <div>

  <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
  <script type="text/javascript" src="../materialize/js/materialize.min.js"></script>
</body>
</html>
