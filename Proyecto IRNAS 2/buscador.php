<?php 
mysql_connect("host","usuario","password"); 
if ($busqueda<>''){ 
   $cadbusca="SELECT Nombre, FormulaQuimica FROM Recursos WHERE VISIBLE =1 AND FormulaQuimica LIKE '%$busqueda%' OR Nombre LIKE '%$busqueda%' LIMIT 50"; 
  }
$result=mysql("teleformacion", $cadbusca); 
While($row=mysql_fetch_object($result)) 
{ 
 
  $referencia=$row->REFERENCIA; 
   $titulo=$row->TITULO; 
   echo $referencia." - ".$titulo."<br>";; 
} 
?>

<?php	
	include_once("pie.php");
?>	

</body>
</html>