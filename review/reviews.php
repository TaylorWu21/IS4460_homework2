<?php

  require_once '../login.php';
  $conn = new mysqli($hn, $un, $pw, $db);
  if ($conn->connect_error) die($conn->connect_error);

  if(isset($_POST['movie_id'])) {
    $movie_id = $_POST['movie_id'];
    $query = "SELECT * FROM reviews WHERE movie_id='$movie_id'";
    $result = $conn->query($query);
    if (!$result) die ("Database access failed: " . $conn->error);
    $rows = $result->num_rows;

    $reviews = '';

    for ($j = 0 ; $j < $rows ; ++$j) {
      $result->data_seek($j);
      $row = $result->fetch_array(MYSQLI_NUM);
      $id = $row[0];
      $title = $row[2];
      $review = $row[3];
      $reviews = $reviews ."
      <div class='row'>
      <div class='col s12 m6 offset-m3'>
      <div class='card blue-grey darken-1'>
      <div class='card-content white-text'>
      <span class='card-title'>$title</span>
      <p>$review</p>
      </div>
      <div class='card-action'>
      <form method='get' action='review.php'>
      <input type='hidden' name='review_id' value='$id' />
      <input class='btn' type='submit' value='View Review' />
      </form>
      </div>
      </div>
      </div>
      </div>
      ";
    }
    $result->close();
    $conn->close();
  }
  session_start();
  if($_SESSION['review_movie_id']) {
    $movie_id = $_SESSION['review_movie_id'];
    $conn2 = new mysqli($hn, $un, $pw, $db);
    if ($conn2->connect_error) die($conn->connect_error);
    $query2 = "SELECT * FROM reviews WHERE movie_id='$movie_id'";
    $result2 = $conn2->query($query2);
    if (!$result2) die ("Database access failed: " . $conn2->error);
    $rows = $result2->num_rows;

    $reviews = '';

    for ($j = 0 ; $j < $rows ; ++$j) {
      $result2->data_seek($j);
      $row = $result2->fetch_array(MYSQLI_NUM);
      $id = $row[0];
      $title = $row[2];
      $review = $row[3];
      $reviews = $reviews ."
        <div class='row'>
          <div class='col s12 m6 offset-m3'>
            <div class='card blue-grey darken-1'>
              <div class='card-content white-text'>
                <span class='card-title'>$title</span>
                <p>$review</p>
              </div>
              <div class='card-action'>
                <form method='get' action='review.php'>
                  <input type='hidden' name='review_id' value='$id' />
                  <input class='btn' type='submit' value='View Review' />
                </form>
              </div>
            </div>
          </div>
        </div>
      ";
    }
    $result2->close();
    $conn2->close();
  }
?>

<html>
<head>
  <link rel='stylesheet' href='../materialize/css/materialize.css'>
</head>
<body>
  <div class='center'>
    <h1>Reviews</h1>
  </div>

  <?php echo $reviews ?>

  <div class='center'>
    <form method='get' action='addreview.php'>
      <input type='hidden' name='movie_id' value=<?php echo $movie_id; ?> />
      <input class='btn green' type='submit' value='Add Review' />
    </form>
    <form method='get' action='../movie/movie.php'>
      <input type='hidden' name='movie_id' value=<?php echo $movie_id; ?> />
      <input class='btn' type='submit' value='Back to Movie' />
    </form>
  <div>
  <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
  <script type="text/javascript" src="../materialize/js/materialize.min.js"></script>
</body>
</html>
