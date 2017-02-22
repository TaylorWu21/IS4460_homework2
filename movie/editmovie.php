<?php
  // DB login
  require_once '../login.php';
  $conn = new mysqli($hn, $un, $pw, $db);
  if ($conn->connect_error) die($conn->connect_error);

  if(isset($_POST['movie_id'])) {
    $id = $_POST['movie_id'];
    $title = $_POST['title'];
    $description = $_POST['description'];
    $query = "UPDATE movies SET title='$title', description='$description' WHERE movie_id='$id'";

    $result = $conn->query($query);
    if(!$result) die($conn->error);

    // $result->close();
    $conn->close();

    $query2 = "SELECT * FROM movies WHERE movie_id='$id'";
    $conn2 = new mysqli($hn, $un, $pw, $db);
    $result2 = $conn2->query($query2);
    if(!$result2) die($conn2->error);
    $rows = $result2->num_rows;

    for ($j = 0 ; $j < $rows ; ++$j) {
      $result2->data_seek($j);
      $row = $result2->fetch_array(MYSQLI_NUM);
      $id = $row[0];
      $title = $row[1];
      $description = $row[2];
      session_start();
      $_SESSION['title']  = $title;
      $_SESSION['description']  = $description;
      $_SESSION['movie_id']  = $id;
    }
    header("Location: movie.php");
    exit();
  }

  if(isset($_GET['movie_id'])) {
    $movie_id = $_GET['movie_id'];
    $query = "SELECT * FROM movies WHERE movie_id='$movie_id'";

    $result = $conn->query($query);
    if(!$result) die($conn->error);

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
    <h1>Movie Form</h1>
  </div>

  <form class='container' action='editmovie.php' method='post'>
    <div class="row">
      <div class="input-field col s12">
        <input id="title" type="text" class="validate" name='title' value=<?php echo $title; ?> />
        <label for="title">Title</label>
      </div>
    </div>
    <div class="row">
      <div class="input-field col s12">
        <input id="description" type="text" name='description' value=<?php echo $description; ?> />
        <label for="description">Description</label>
      </div>
    </div>
    <input type='hidden' name='movie_id' value=<?php echo $movie_id ?> />
    <div class='center'>
      <input class='btn green submit' type='submit' />
    <div>
  </form>

  <form method='get' action='movie.php'>
    <input type='hidden' name='movie_id' value=<?php echo $movie_id; ?> />
    <input style="margin-top: 20px;" class='btn red' type='submit' value='Cancel' />
  </form>

  <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
  <script type="text/javascript" src="../materialize/js/materialize.min.js"></script>
  <script>
    var form = document.querySelector('.submit');
    form.addEventListener('click', () => Materialize.toast('Movie Updated!', 4000));
  </script>
</body>
</html>
