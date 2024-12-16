<?php
require "config.php";

if(!empty($_SESSION["id_auteur"])){
  $id = $_SESSION["id_auteur"];
  $result = mysqli_query($connexion , "SELECT * FROM auteur WHERE id_auteur = $id");
  $row = mysqli_fetch_assoc($result);
}else{
  header("Location:login.php");
}

?>

<!doctype html>
<html>

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="style.css">

</head>

<body>

    <h1>Welcom  <?php echo $row["username"]; ?> </h1>
    <a href="logout.php">Logout</a>
</body>

</html>