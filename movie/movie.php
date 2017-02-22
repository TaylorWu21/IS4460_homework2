<?php

  require_once '../login.php';
  $conn = new mysqli($hn, $un, $pw, $db);
  if ($conn->connect_error) die($conn->connect_error);

  session_start();
  if(isset($_SESSION['title'])) {
    $title   = $_SESSION['title'];
    $description  = $_SESSION['description'];
    $movie_id = $_SESSION['movie_id'];

  }
  if(isset($_GET['movie_id'])) {
    $movie_id = $_GET['movie_id'];
    $query = "SELECT * FROM movies WHERE movie_id='$movie_id'";
    $result = $conn->query($query);
    if (!$result) die ("Database access failed: " . $conn->error);
    $rows = $result->num_rows;

    for ($j = 0 ; $j < $rows ; ++$j) {
      $result->data_seek($j);
      $row = $result->fetch_array(MYSQLI_NUM);
      $title = $row[1];
      $description = $row[2];
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
    <h4>Description: <?php echo $description; ?></h4>
  </div>

  <div class='center'>
    <form method='get' action='editmovie.php'>
      <input type='hidden' name='movie_id' value=<?php echo $movie_id; ?> />
      <input type='submit' class='btn orange' value='Edit' />
    </form>
    <form method='post' action='deletemovie.php'>
      <input type='hidden' name='movie_id' value=<?php echo $movie_id; ?> />
      <input type='submit' class='btn red' value='Delete' />
    </form>
    <form method='post' action='../review/reviews.php'>
      <input type='hidden' name='movie_id' value=<?php echo $movie_id; ?> />
      <input type='submit' class='btn' value='See Reviews' />
    </form>
  <div>

  <a href='movies.php' class='btn blue'>Back to Movies</a>
  <!-- <form method='post' action='reviews.php'>
    <input type='hidden' name='movie_id' value=<?php echo $movie_id; ?> />
    <input style="margin-top: 20px;" class='btn red' type='submit' value='Cancel' />
  </form> -->

  <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
  <script type="text/javascript" src="../materialize/js/materialize.min.js"></script>
</body>
</html>
