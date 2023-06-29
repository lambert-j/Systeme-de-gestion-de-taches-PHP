
<?php 
function createTable(){
  global $cookie;
  $totalLignes = count($cookie);

   for ($i = 0; $i < $totalLignes; $i += 4) {
    if (isset($cookie[$i]) && isset($cookie[$i + 1]) && isset($cookie[$i + 2]) && isset($cookie[$i + 3])){
      echo "<tr><td> {$cookie[$i]}</td>";
      echo "<td> {$cookie[$i + 1]}</td>";
      echo "<td>{$cookie[$i + 2]}</td>";
      echo "<td> {$cookie[$i + 3]}</td>";
      echo "<td><form method='get' action=''>";
      echo "<input type='hidden' name='index' value='{$i}'>";
      echo "<input value='Modifier' type='submit' name='modify{$i}' class='btn btn-primary ms-1'></input>";
      echo "<input value='Supprimer' type='submit' name='delete{$i}' class='btn btn-danger ms-1'></input></form></td></tr>";};
  } ;
}

function modify($i){

}

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    if (isset($_GET['index'])) {
        $i = $_GET['index'];
        if (isset($_GET["modify{$i}"])) {
            modify($i);
        } elseif (isset($_GET["delete{$i}"])) {
            delete($i);
            
        }
    }
}

function delete($i){
  $chemin = "data.txt";
  $contenu = file_get_contents($chemin);
    $cookie = explode("|", $contenu);
    echo gettype($cookie);
    $cookie = array_diff($cookie, [$i, $i+1, $i+2, $i+3]);
    $contenu_modifie = implode("|", $cookie);
    file_put_contents($chemin, $contenu_modifie);
}





?>


