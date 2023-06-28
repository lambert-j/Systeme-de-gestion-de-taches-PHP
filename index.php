
<link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM"
      crossorigin="anonymous"
    />

    <body class="container">
<form method="get" class="mt-5">
  <label for="fname">Nom:</label><br>
  <input placeholder="Nom" type="text" id="" name="name" class="fs-4"><br>
  <label for="lname">Description:</label><br>
  <input placeholder="Description" type="text" id="" name="description" class="fs-4"><br>
  <label for="fname">Date limite:</label><br>
  <input placeholder="Date limite" type="date" id="" name="date" class="fs-4"><br>
  <label for="lname">Status:</label><br>
  <input type="radio" name="status" value="Terminer">
  <label for="html">Terminer</label><br>
  <input type="radio" name="status" value="En attente">
  <label for="css">En attente</label><br>
  <input type="radio" name="status" value="Refusé">
  <label for="css">Refusé</label><br>
  <input type="submit" value="submit">
</form>
<?php 
if(!empty($_GET['name'])){
  $name = $_GET['name'];
$description = $_GET['description'];
$date = $_GET['date'];
$status = $_GET['status'];
$fp = fopen("data.txt", "a");
fwrite($fp, $name . "|");
fwrite($fp, $description . "|");
fwrite($fp, $date . "|");
fwrite($fp, $status . "|");
fclose($fp);
}
$str = file_get_contents("data.txt");
$cookie = explode("|",$str);
 ?>

<table class="table table-dark table-striped">
    <thead>
      <tr>
        <th>Nom</th>
        <th>Description</th>
        <th>Date limite</th>
        <th>Status</th>
      </tr>
    </thead>
    <tbody>
    <?php if($cookie[0] && $cookie[1] && $cookie[2] && $cookie[3]){
echo "<tr>
<td> $cookie[0]</td>
<td> $cookie[1]</td>
<td> $cookie[2]</td>
<td> $cookie[3]</td>
</tr>";};
 ?>
      <?php if($cookie[4] && $cookie[5] && $cookie[6] && $cookie[7]){
echo "<tr>
<td> $cookie[4]</td>
<td> $cookie[5]</td>
<td> $cookie[6]</td>
<td> $cookie[7]</td>
</tr>";};
 ?>
      <?php if($cookie[8] && $cookie[9] && $cookie[10] && $cookie[11]){
echo "<tr>
<td> $cookie[8]</td>
<td> $cookie[9]</td>
<td> $cookie[10]</td>
<td> $cookie[11]</td>
</tr>";};
 ?>
    </tbody>
  </table>
</body>