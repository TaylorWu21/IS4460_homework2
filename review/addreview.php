<?php

  require_once '../login.php';
  $conn = new mysqli($hn, $un, $pw, $db);
  if ($conn->connect_error) die($conn->connect_error);

  if(isset($_POST['title'])) {
    $movie_id = $_POST['movie_id'];
    $title = $_POST['title'];
    $review = $_POST['review'];
    $query = "INSERT INTO reviews(movie_id, title, review) VALUES($movie_id, '$title', '$review')";

    $result = $conn->query($query);
    if(!$result) die($conn->error);

    // $result->close();
    $conn->close();

    $query2 = "SELECT * FROM reviews ORDER BY review_id DESC LIMIT 1";
    $conn2 = new mysqli($hn, $un, $pw, $db);
    $result2 = $conn2->query($query2);
    if(!$result2) die($conn2->error);
    $rows = $result2->num_rows;
    for ($j = 0 ; $j < $rows ; ++$j) {
      $result2->data_seek($j);
      $row = $result2->fetch_array(MYSQLI_ASSOC);
      $review_id = $row['review_id'];
      $movie_id = $row['movie_id'];
      $title = $row['title'];
      $review = $row['review'];
      echo 'review id:' .$review_id . '<br>';
      echo 'movie_id:' .$movie_id . '<br>';
      echo 'title:' .$title . '<br>';
      echo 'review:' .$review . '<br>';
      session_start();
      $_SESSION['review_id'] = $review_id;
      $_SESSION['movie_id']  = $movie_id;
      $_SESSION['title']  = $title;
      $_SESSION['review']  = $review;
    }
    // $result->close();
    $conn2->close();

    header("Location: review.php");
    exit();
  }

  if(isset($_GET['movie_id'])) {
    $movie_id = $_GET['movie_id'];
  }

?>

<html>
<head>
  <link rel='stylesheet' href='../materialize/css/materialize.css'>
</head>
<body>
  <div class='center'>
    <h1>Review Form</h1>
  </div>

  <form class='container' action='addreview.php' method='post'>
    <div class="row">
      <div class="input-field col s12">
        <input id="title" type="text" class="validate" name='title' />
        <label for="title">Title</label>
      </div>
    </div>
    <div class="row">
      <div class="input-field col s12">
        <input id="review" type="text" name='review' />
        </textarea>
        <label for="review">Review</label>
      </div>
    </div>
    <input type='hidden' name='movie_id' value=<?php echo $movie_id; ?> />
    <div class='center'>
      <input class='btn green submit' type='submit' />
    <div>
  </form>
  
  <form method='post' action='reviews.php'>
    <input type='hidden' name='movie_id' value=<?php echo $movie_id; ?> />
    <input style="margin-top: 20px;" class='btn red' type='submit' value='Cancel' />
  </form>


  <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
  <script type="text/javascript" src="../materialize/js/materialize.min.js"></script>

  <script>
    var form = document.querySelector('.submit');
    form.addEventListener('click', () => Materialize.toast('Review Added!', 4000));
  </script>
</body>
</html>
