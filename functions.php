
<?php 



function createTable(){

  $mysqlConnection = new PDO(
  'mysql:host=localhost;dbname=acs_todolist;charset=utf8',
  'root',
  ''
);
$recipesStatement = $mysqlConnection->prepare('SELECT * FROM acs_to_do_list ORDER BY id ASC');
$recipesStatement->execute();
$entries = $recipesStatement->fetchAll();

foreach ($entries as $entry){
  echo "<tr><td> {$entry[0]}</td>" ;
  echo "<td> {$entry[1]}</td>" ;
  echo "<td>{$entry[2]}</td>" ;
  echo "<td> {$entry[3]}</td>" ;
  echo "<td> {$entry[4]}</td>" ;
  echo "<td><form method='post' action=''>";
  echo "<input type='hidden' name='index' value='{$entry[0]}'>";
  echo "<input value='Modifier' type='submit' name='modify{$entry[0]}' class='btn btn-primary ms-1'></input>";
  echo "<input value='Supprimer' type='submit' name='delete{$entry[0]}' class='btn btn-danger ms-1'></input></form></td></tr>";
}

}

function modify($i){

  $mysqlConnection = new PDO(
    'mysql:host=localhost;dbname=acs_todolist;charset=utf8',
    'root',
    ''
  );

  $recipesStatement = $mysqlConnection->prepare("SELECT * FROM acs_to_do_list WHERE id='$i'");
  $recipesStatement->execute();
  $entries = $recipesStatement->fetchAll();


foreach ($entries as $entry){
echo "<form method='POST' class='col-6 mt-5 card bg-dark'>
<label for='fname'>Nom:</label>
<input value='{$entry[1]}' type='text' id='' name='modName' class='fs-4'>
<label for='lname'>Description:</label>
<input value='{$entry[2]}' type='text' id='' name='modDescription' class='fs-4'>
<label for='fname'>Date limite:</label>
<input value='{$entry[3]}' type='date' id='' name='modDate' class='fs-4'>
<label for='lname'>Status:</label>";
if($entry[4] ==="Terminé"){
echo "<div><input checked='true' type='radio' name='modStatus' value='Terminé'>
<label for='html'>Terminé</label></div>
<div><input type='radio' name='modStatus' value='En attente'>
<label for='css'>En attente</label></div>
<div><input type='radio' name='modStatus' value='Refusé'>
<label for='css'>Refusé</label></div>";
}elseif($entry[4] ==="En attente"){
  echo "<div><input  type='radio' name='modStatus' value='Terminé'>
  <label for='html'>Terminé</label></div>
  <div><input checked='true' type='radio' name='modStatus' value='En attente'>
  <label for='css'>En attente</label></div>
  <div><input type='radio' name='modStatus' value='Refusé'>
  <label for='css'>Refusé</label></div>";
}else{
  echo "<div><input  type='radio' name='modStatus' value='Terminé'>
  <label for='html'>Terminé</label></div>
  <div><input type='radio' name='modStatus' value='En attente'>
  <label for='css'>En attente</label></div>
  <div><input checked='true' type='radio' name='modStatus' value='Refusé'>
  <label for='css'>Refusé</label></div>";
};
echo "<input type='hidden' name='index' value='{$i}'>";
echo "<input value='Modifier' type='submit' name='modifyDone{$i}' class='btn btn-primary mb-1'></input>";
echo "</form>";
}}
// <input if() type='radio' name='modStatus' value='Refusé'>



function modifyDone($i){

 $modName = $_POST['modName'];
 $modDescription = $_POST['modDescription'];
 $modDate = $_POST['modDate'];
 $modStatus = $_POST['modStatus'];

 $mysqlConnection = new PDO(
  'mysql:host=localhost;dbname=acs_todolist;charset=utf8',
  'root',
  ''
);
$recipesStatement = $mysqlConnection->prepare("UPDATE acs_to_do_list SET nom = '$modName', description = '$modDescription', date_limite='$modDate', status='$modStatus'  WHERE id ='$i'");
$recipesStatement->execute();

}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['index'])) {
        $i = $_POST['index'];
        if (isset($_POST["modify{$i}"])) {
            modify($i);
        } elseif (isset($_POST["delete{$i}"])) {
            delete($i);
        }elseif(isset($_POST["modifyDone{$i}"])){
            modifyDone($i);
        }
    }
}

function delete($i){
  $mysqlConnection = new PDO(
    'mysql:host=localhost;dbname=acs_todolist;charset=utf8',
    'root',
    ''
  );
  $recipesStatement = $mysqlConnection->prepare("DELETE FROM acs_to_do_list WHERE id ='$i' ");
  $recipesStatement->execute();

}

?>


