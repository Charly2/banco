<?php

echo "Inicio\n";

$enlace = mysqli_connect("127.0.0.1", "root", "password", "banco");

if (!$enlace) {
    echo "Error: No se pudo conectar a MySQL." . PHP_EOL;
    echo "errno de depuración: " . mysqli_connect_errno() . PHP_EOL;
    echo "error de depuración: " . mysqli_connect_error() . PHP_EOL;
    exit;
}

echo "Éxito: Se realizó una conexión apropiada a MySQL! La base de datos mi_bd es genial." . PHP_EOL;
echo "Información del host: " . mysqli_get_host_info($enlace) . PHP_EOL;



$pagina_inicio = file('./Libro1.txt', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

?>
<!--<table>-->
<?php

foreach ($pagina_inicio as $line){
    $sql= "";
    $sql .= "insert into excel values ";
    $items=explode("\t",$line);
    $cuentas = explode(',',$items[1]);
    foreach ($cuentas as $cuenta){
        $cuenta = str_replace("'","",$cuenta);
        $sql .= "(null,'".$items[0]."',";
        $sql .= "'".$cuenta."'),";
    }
    $sql = substr_replace($sql ,"", -1);
    echo $sql;
    if ($enlace->query($sql) === TRUE) {
    printf("ok \n");
    }
    echo "<br>";
}




mysqli_close($enlace);
?>
<!--</table>-->


<?php

echo "\nFin\n";



?>