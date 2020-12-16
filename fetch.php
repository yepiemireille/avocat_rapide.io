 <?php

//fetch.php;

$connect = new PDO("mysql:host=localhost; dbname=mi_avocat", "root", "");

if(isset($_POST['query']))
{
 $query = "
 SELECT DISTINCT preocupation FROM avocatrapide 
 WHERE preocupation LIKE '%".trim($_POST["query"])."%'
 ";

 $statement = $connect->prepare($query);

 $statement->execute();

 $result = $statement->fetchAll();

 $output = '';

// les sugestions generer par la recherche de l'user
 foreach($result as $row)
 {
  $output .= '
  <li class="list-group-item contsearch">
   <a href="javascript:void(0)" class="gsearch" style="color:#333;text-decoration:none;">'.$row["preocupation"].'</a>
  </li>
  ';
 }

 echo $output;
}
// ******
if(isset($_POST['preocupation']))
{
 $query = "
 SELECT * FROM avocatrapide 
 WHERE preocupation = '".trim($_POST["preocupation"])."' 
 LIMIT 1
 ";

 $statement = $connect->prepare($query);

 $statement->execute();

 $result = $statement->fetchAll();

// affichage des informations
$output = '';
 foreach($result as $row)
 {
  $output .= ' <div class="ex1">
  <h5>
  
   <strong style="color:red"> Tout savoir sur le theme  '.$row["preocupation"].'</strong> : 

<br></h5>
<p><strong style="color:white">'.$row["lois"].'</strong> :</p>

   <button class="btn btn-primary">je suis satisfait</button> 
 
   <a href="rdv_tchat.php"><button  class="btn btn-primary">prendre un RDV </button> </a> </div>
  ' ;
 }
 $output .= '</p>';
 

 echo $output;
 
}

?>

