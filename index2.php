<?php

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
$pagina_inicio = file('./a.sql', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);






foreach ($pagina_inicio as $line){
    $l1=explode('cuenta_contable in ',$line);


    $l2 = explode('as b',$l1[1]);

    $l3 = explode('where a.cuenta_contable',$l2[1]);
//    var_dump($l3);

    $c1 = str_replace("';","",str_replace("= '","",$l3[1]));
    $c2 = str_replace("'","",str_replace(")","",str_replace('(',"",$l2[0])));

    $lis = explode(',',$c2);
    $sql= "";
    $sql .= "insert into banco.store values ";
    foreach ($lis as $l){



        $sql .= "(null,'".trim($c1)."',";
        $sql .= "'".trim($l)."'),";

    }


    $sql = substr_replace($sql ,"", -1);
    echo $sql.";";
    if ($enlace->query($sql) === TRUE) {
        printf("ok \n");
    }
    echo "<br>";

    //echo $l3[1]."->".$l2[0];

}




mysqli_close($enlace);


echo "\nFin\n";



?>