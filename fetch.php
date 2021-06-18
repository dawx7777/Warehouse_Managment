<?php

require_once "connect.php";
mysqli_report(MYSQLI_REPORT_STRICT);


    $polaczenie = new mysqli($host, $db_user, $db_password, $db_name);
    $polaczenie->connect_errno!=0;
    
$output = '';
$query = "SELECT * FROM produkty_klient ORDER BY idProdukty_klient DESC limit 5";
$result = mysqli_query($polaczenie, $query);
$output = '
<br />
<h3 align="center">Ostatnio dodane produkty</h3>
<table class="table table-bordered table-striped">
 <tr>
  <th width="45%">Nazwa produktu</th>
  <th width="30%">Identyfikator</th>
  <th width="20%">Ilość</th>
  
 </tr>
';
while($row = mysqli_fetch_array($result))
{
 $output .= '
 <tr>
  <td>'.$row["Nazwa_produktu"].'</td>
  <td>'.$row["identyfikator"].'</td>
  <td>'.$row["Ilosc"].'</td>
 </tr>
 ';
}
$output .= '</table>';
echo $output;
?>