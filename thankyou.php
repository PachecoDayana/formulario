<?php

$connect = mysqli_connect('localhost', '', '', '');
$db_consulta = "SELECT * FROM contact ORDER BY id DESC LIMIT 1";

$consulta = mysqli_query($connect, $db_consulta);
?>

<!doctype html>

<html>
    <head>
        <title>Thank You</title>
    </head>
    <body>
    
        <h1>Thank You</h1>
        <?php while ($itr=mysqli_fetch_assoc($consulta)):?>
   

        <p>Buenas tardes, <?php echo $itr['name'];?>
        Gracias por confiar en CONSULTORA SAS. Su Solicitud ha sido recibida y se ha abierto un 
        ticket con id número <?php echo $itr['id'];?> desde el departamento de <?php echo $itr['departamento'];?>  y será atendido 
        por  <?php echo $itr['empleado_departamento'];?>.</p>
        <?php endwhile;?>

    </body>
</html>
