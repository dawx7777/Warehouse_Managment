
<?php
session_start();
if(!isset($_SESSION['zalogowany']))
{
    header('Location: index.php');
    
}
?>
<?php
if(isset($_POST["item_name"]))
{
require_once "connect.php";
$polaczenie = new mysqli($host, $db_user, $db_password, $db_name);

 $item_name = $_POST["item_name"];
 $item_code = $_POST["item_code"];
 $item_ilosc = $_POST["item_ilosc"];
 $query = '';
 for($count = 0; $count<count($item_name); $count++)
 {
  $item_name_clean = mysqli_real_escape_string($polaczenie, $item_name[$count]);
  $item_code_clean = mysqli_real_escape_string($polaczenie, $item_code[$count]);
  $item_ilosc_clean = mysqli_real_escape_string($polaczenie, $item_ilosc[$count]);
 
  if($item_name_clean != '' && $item_code_clean != '' && $item_ilosc_clean != '')
  {
   $query .= '
   INSERT INTO produkty_klient VALUES ("","'.$item_name_clean.'","'.$item_ilosc_clean.'","'.$item_code_clean.'","DO WYDANIA",(SELECT idKlient FROM klient ORDER BY idKlient DESC LIMIT 1),(SELECT produkt.idProdukt from produkt where nr_indeksu="'.$item_code_clean.'")) 
   ';

   
  }
 }
 if($query != '')
 {
  if(mysqli_multi_query($polaczenie, $query))
  {
   echo 'Pozytywnie dodano produkt';
  }
  else
  {
   echo 'Bląd';
  }
}
 else
 {
  echo 'Wszystkie pola są wymagane';
 }
}
?>