<?php
  // DB login
  require_once '../login.php';
  $conn = new mysqli($hn, $un, $pw, $db);
  if ($conn->connect_error) die($conn->connect_error);

  $query = 'SELECT * FROM movies';
  $result = $conn->query($query);
  if (!$result) die ("Database access failed: " . $conn->error);
  $rows = $result->num_rows;

  $movies = "";

  for ($j = 0 ; $j < $rows ; ++$j) {
    $result->data_seek($j);
    $row = $result->fetch_array(MYSQLI_NUM);
    $movies = $movies ."
    <div class='row'>
      <div class='col s12 m6 offset-m3'>
        <div class='card blue-grey darken-1'>
          <div class='card-content white-text'>
            <span class='card-title'>$row[1]</span>
            <p>$row[2]</p>
          </div>
          <div class='card-action'>
            <form method='get' action='movie.php'>
              <input type='hidden' name='movie_id' value='$row[0]' />
              <input class='btn' type='submit' value='View Movie' />
            </form>
          </div>
        </div>
      </div>
    </div>
    ";
  };
?>

<html>
<head>
  <link rel='stylesheet' href='../materialize/css/materialize.css'>
</head>
<body>
  <div class='center'>
    <h1>Movies</h1>
  </div>

  <?php echo $movies; ?>

  <div class='center'>
    <a href='addmovie.php' class='btn green'>Add Movie</a>
  <div>
  <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
  <script type="text/javascript" src="../materialize/js/materialize.min.js"></script>
</body>
</html>
