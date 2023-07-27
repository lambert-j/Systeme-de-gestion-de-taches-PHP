
<?php 



function createTable(){

  $mysqlConnection = new PDO(
  'mysql:host=localhost;dbname=acs_todolist;charset=utf8',
  'root',
  ''
);
$dbname = "acs_to_do_list";
$recipesStatement = $mysqlConnection->prepare('SELECT * FROM acs_to_do_list');
$recipesStatement->execute();
$entries = $recipesStatement->fetchAll();
$totalLignes = count($entries);

foreach ($entries as $entry){
for ($i = 0; $i < $totalLignes; $i += 5) {
  echo "<tr><td> {$entry[$i]}</td>" ;
  echo "<td> {$entry[$i + 1]}</td>" ;
  echo "<td>{$entry[$i + 2]}</td>" ;
  echo "<td> {$entry[$i + 3]}</td>" ;
  echo "<td> {$entry[$i + 4]}</td>" ;
  echo "<td><form method='post' action=''>";
  echo "<input type='hidden' name='index' value='{$i}'>";
  echo "<input value='Modifier' type='submit' name='modify{$i}' class='btn btn-primary ms-1'></input>";
  echo "<input value='Supprimer' type='submit' name='delete{$i}' class='btn btn-danger ms-1'></input></form></td></tr>";

}
}

}




//   global $cookie;
//   $totalLignes = count($cookie);


//    for ($i = 0; $i < $totalLignes; $i += 5) {
//     if (isset($cookie[$i]) && isset($cookie[$i + 1]) && isset($cookie[$i + 2]) && isset($cookie[$i + 3]) && isset($cookie[$i + 4])){
//       echo "<tr><td> {$cookie[$i]}</td>";
//       echo "<td> {$cookie[$i + 1]}</td>";
//       echo "<td>{$cookie[$i + 2]}</td>";
//       echo "<td> {$cookie[$i + 3]}</td>";
//       echo "<td><form method='post' action=''>";
//       echo "<input type='hidden' name='index' value='{$i}'>";
//       echo "<input value='Modifier' type='submit' name='modify{$i}' class='btn btn-primary ms-1'></input>";
//       echo "<input value='Supprimer' type='submit' name='delete{$i}' class='btn btn-danger ms-1'></input></form></td></tr>";};
//   } ;
// }

function modify($i){
  $chemin = "data.txt";
  $contenu = file_get_contents($chemin);
  $cookie = explode("|", $contenu);
echo "<form method='POST' class='col-6 mt-5 card bg-dark'>
<label for='fname'>Nom:</label>
<input value='{$cookie[$i]}' type='text' id='' name='modName' class='fs-4'>
<label for='lname'>Description:</label>
<input value='{$cookie[$i + 1]}' type='text' id='' name='modDescription' class='fs-4'>
<label for='fname'>Date limite:</label>
<input value='{$cookie[$i + 2]}' type='date' id='' name='modDate' class='fs-4'>
<label for='lname'>Status:</label>";
if($cookie[$i + 3] ==="Terminé"){
echo "<div><input checked='true' type='radio' name='modStatus' value='Terminé'>
<label for='html'>Terminé</label></div>
<div><input type='radio' name='modStatus' value='En attente'>
<label for='css'>En attente</label></div>
<div><input type='radio' name='modStatus' value='Refusé'>
<label for='css'>Refusé</label></div>";
}elseif($cookie[$i + 3] ==="En attente"){
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
}
// <input if() type='radio' name='modStatus' value='Refusé'>
function modifyDone($i){
  $chemin = "data.txt";
  $contenu = file_get_contents($chemin);
  $cookie = explode("|", $contenu);
 $modName = $_POST['modName'];
 $modDescription = $_POST['modDescription'];
 $modDate = $_POST['modDate'];
 $modStatus = $_POST['modStatus'];
 $modArray = [$modName,$modDescription,$modDate,$modStatus];
array_splice($cookie, $i, 4, $modArray );
$contenu_modifie = implode("|", $cookie);
file_put_contents($chemin, $contenu_modifie);
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
    $chemin = "data.txt";
    $contenu = file_get_contents($chemin);
    $cookie = explode("|", $contenu);
    $deleteIndex = [$i, $i+1, $i+2, $i+3];
    foreach ($deleteIndex as $index) {
      if (isset($cookie[$index])) {
          unset($cookie[$index]);
      }
  }
    $contenu_modifie = implode("|", $cookie);
    file_put_contents($chemin, $contenu_modifie);
}

?>


