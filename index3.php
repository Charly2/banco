<?php
error_reporting(1);

echo "Inicio\n <br>";

$enlace = mysqli_connect("127.0.0.1", "root", "password", "banco");

if (!$enlace) {
    echo "Error: No se pudo conectar a MySQL." . PHP_EOL;
    echo "errno de depuración: " . mysqli_connect_errno() . PHP_EOL;
    echo "error de depuración: " . mysqli_connect_error() . PHP_EOL;
    exit;
}

echo "Éxito: Se realizó una conexión apropiada a MySQL! La base de datos mi_bd es genial." . PHP_EOL;
echo "Información del host: " . mysqli_get_host_info($enlace) . PHP_EOL;


echo "Inicio\n <br>";

$query = "select * from banco.excel";
$result = $enlace->query($query);

while($row = $result->fetch_assoc())
{

    $query2 = "select * from banco.excel where cuenta_uno = '".$row['cuenta_uno']."' order by cuenta_dos";
    $result2 = $enlace->query($query2);
    //echo $query2;
    $arr2 = array();
    while($row2 = $result2->fetch_array())
    {
        $arr2[] = $row2['cuenta_dos'];
    }
    echo $row['cuenta_uno']."----".implode(',',$arr2);
    echo "<br>";

    $query21 = "select * from banco.store where cuenta_uno = '".$row['cuenta_uno']."' order by cuenta_dos";
    $result21 = $enlace->query($query21);
    //echo $query21;
    $arr21 = array();
    while($row21 = $result21->fetch_array())
    {
        $arr21[] = $row21['cuenta_dos'];
    }
    echo $row['cuenta_uno']."----".implode(',',$arr21);
    //echo "<br>";
    $cad = $row['cuenta_uno']."----".implode(',',$arr21);
    $cad2 = $row['cuenta_uno']."----".implode(',',$arr2);
    if ($cad == $cad2){
        echo "<br><span>OK</span>";
    }else{
        echo "<span style='color:red'>NO</span>";
    }
    echo "-------------------------------------------------------------";
    echo "<br>";
}




mysqli_close($enlace);


echo "\nFin\n";



?>