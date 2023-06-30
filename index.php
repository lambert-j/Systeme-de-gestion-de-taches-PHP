
<link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM"
      crossorigin="anonymous"
    />
<?php require 'functions.php';?>

<body class="container">
<form method="POST" class="mt-5 col-4">
  <label for="fname">Nom:</label><br>
  <input placeholder="Nom" type="text" id="" name="name" class="fs-4"><br>
  <label for="lname">Description:</label><br>
  <input placeholder="Description" type="text" id="" name="description" class="fs-4"><br>
  <label for="fname">Date limite:</label><br>
  <input placeholder="Date limite" type="date" id="" name="date" class="fs-4"><br>
  <label for="lname">Status:</label><br>
  <input type="radio" name="status" value="Terminé">
  <label for="html">Terminé</label><br>
  <input type="radio" name="status" value="En attente">
  <label for="css">En attente</label><br>
  <input type="radio" name="status" value="Refusé">
  <label for="css">Refusé</label><br>
  <input type="submit" value="Enregister">
</form>

<?php


?>


<?php 
if(!empty($_POST['name'])){
  $name = $_POST['name'];
$description = $_POST['description'];
$date = $_POST['date'];
$status = $_POST['status'];
$fp = fopen("data.txt", "a");
fwrite($fp, $name . "|");
fwrite($fp, $description . "|");
fwrite($fp, $date . "|");
fwrite($fp, $status . "|");
fclose($fp);
}
$str = file_get_contents("data.txt");
$cookie = explode("|",$str);
$id = 0;
 ?>

<table class="table table-dark table-striped">
    <thead>
      <tr>
        <th>Nom</th>
        <th>Description</th>
        <th>Date limite</th>
        <th>Status</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
    <?php createTable();?>
    </tbody>
  </table>  
</body>

