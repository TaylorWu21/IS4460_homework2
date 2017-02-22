<?php
  // DB login
  require_once '../login.php';
  $conn = new mysqli($hn, $un, $pw, $db);
  if ($conn->connect_error) die($conn->connect_error);

  if(isset($_POST['title'])) {
    $title = $_POST['title'];
    $description = $_POST['description'];

    $query = "INSERT INTO movies(title, description) VALUES('$title', '$description')";

    $result = $conn->query($query);
    if(!$result) die($conn->error);

    // $result->close();
    $conn->close();

    $query2 = "SELECT * FROM movies ORDER BY movie_id DESC LIMIT 1";
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
    // $result->close();
    $conn2->close();

    header("Location: movie.php");
    exit();
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

  <form class='container' action='addmovie.php' method='post'>
    <div class="row">
      <div class="input-field col s12">
        <input id="title" type="text" class="validate" name='title' />
        <label for="title">Title</label>
      </div>
    </div>
    <div class="row">
      <div class="input-field col s12">
        <input id="description" type="text" name='description'/>
        <label for="description">Description</label>
      </div>
    </div>
    <div class='center'>
      <input class='btn green submit' type='submit' />
    <div>
  </form>

  <a style='margin-top: 20px;' href='movies.php' class='btn red'>Cancel</a>

  <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
  <script type="text/javascript" src="../materialize/js/materialize.min.js"></script>
  <script>
    var form = document.querySelector('.submit');
    form.addEventListener('click', () => Materialize.toast('Movie Added!', 4000));
  </script>
</body>
</html>
