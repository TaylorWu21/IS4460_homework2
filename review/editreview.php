<?php
  // DB login
  require_once '../login.php';
  $conn = new mysqli($hn, $un, $pw, $db);
  if ($conn->connect_error) die($conn->connect_error);

  if(isset($_POST['review_id'])) {
    $id = $_POST['review_id'];
    echo $id;
    $title = $_POST['title'];
    $review = $_POST['review'];
    $query = "UPDATE reviews SET title='$title', review='$review' WHERE review_id='$id'";
    $result = $conn->query($query);
    if(!$result) die($conn->error);

    // $result->close();
    $conn->close();

    $query2 = "SELECT * FROM reviews WHERE review_id='$id'";
    $conn2 = new mysqli($hn, $un, $pw, $db);
    $result2 = $conn2->query($query2);
    if(!$result2) die($conn2->error);
    $rows = $result2->num_rows;

    for ($j = 0 ; $j < $rows ; ++$j) {
      $result2->data_seek($j);
      $row = $result2->fetch_array(MYSQLI_ASSOC);
      $id = $row['review_id'];
      $title = $row['title'];
      $review = $row['review'];
      session_start();
      $_SESSION['title']  = $title;
      $_SESSION['review']  = $review;
      $_SESSION['review_id']  = $id;
    }
    header("Location: review.php");
    exit();
  }

  if(isset($_GET['review_id'])) {
    $review_id = $_GET['review_id'];
    $query = "SELECT * FROM reviews WHERE review_id='$review_id'";

    $result = $conn->query($query);
    if(!$result) die($conn->error);

    $rows = $result->num_rows;
    for ($j = 0 ; $j < $rows ; ++$j) {
      $result->data_seek($j);
      $row = $result->fetch_array(MYSQLI_ASSOC);
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
    <h1>Review Form</h1>
  </div>

  <form class='container' action='editreview.php' method='post'>
    <div class="row">
      <div class="input-field col s12">
        <input id="title" type="text" class="validate" name='title' value=<?php echo $title; ?> />
        <label for="title">Title</label>
      </div>
    </div>
    <div class="row">
      <div class="input-field col s12">
        <input id="review" type="text" name='review' value=<?php echo $review; ?> />
        <label for="review">Review</label>
      </div>
    </div>
    <input type='hidden' name='review_id' value=<?php echo $review_id ?> />
    <div class='center'>
      <input class='btn green submit' type='submit' />
    <div>
  </form>

  <form method='get' action='review.php'>
    <input type='hidden' name='review_id' value=<?php echo $review_id; ?> />
    <input style="margin-top: 20px;" class='btn red' type='submit' value='Cancel' />
  </form>

  <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
  <script type="text/javascript" src="../materialize/js/materialize.min.js"></script>
  <script>
    var form = document.querySelector('.submit');
    form.addEventListener('click', () => Materialize.toast('Review Updated!', 4000));
  </script>
</body>
</html>
