<?php

require _DIR_ . '/./vendor/autoload.php';
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->safeload();

$connect = mysqli_connect(
    $_ENV['DB_HOST'],
    $_ENV['DB_USER'],
    $_ENV['DB_PASS'],
    $_ENV['DB_DBNAME'],
);

$empleados_soporteTecnico= array("Jaime Rubiano", "Maria Garcia", "Pedro Sanchez", "Arley Ramirez");
$empleado_escogido_randonomicamente = $empleados_soporteTecnico[array_rand($empleados_soporteTecnico, 1)];

$empleados_atencionCliente= array("Sara perez", "Camilo Lopez", "Alex Perez", "Alejandra Mendez");
$empleado_escogido_randonomicamente = $empleados_atencionCliente[array_rand($empleados_soporteTecnico, 1)];

$empleados_Facturacion= array("Jhon Salamanca", "Rosa mendez", "Edison Rodriguez", "Arley Sambrano");
$empleado_escogido_randonomicamente = $empleados_Facturacion[array_rand($empleados_Facturacion, 1)];



$name = isset( $_POST['name'] ) ? $_POST['name'] : '';
$email = isset( $_POST['email'] ) ? $_POST['email'] : '';
$message = isset( $_POST['message'] ) ? $_POST['message'] : '';
$departamento = isset( $_POST['departamento'] ) ? $_POST['departamento'] : '';

$name_error = '';
$email_error = '';
$message_error = '';
$departamento_error = '';


if (count($_POST))
{ 
    $errors = 0;
     
    if ($_POST['name'] == '' )
    {
        $name_error =  'Please enter a message';
        $errors ++;

    }
    if ($_POST['email'] == '')
    {
        $email_error = 'Please enter an email address';
        $errors ++;
    }

    if ($_POST['message'] == '')
    {
        $message_error = 'Please enter a message';
        $errors ++;
    }
   

    if ($errors == 0)
    {

        $query = 'INSERT INTO contact (
                name,
                email,
                message,
                departamento,
                empleado_departamento
            ) VALUES (
                "'.addslashes($_POST['name']).'",
                "'.addslashes($_POST['email']).'",
                "'.addslashes($_POST['message']).'",
                "'.addslashes($_POST['departamento']).'",
                "'.($empleado_escogido_randonomicamente).'"
            )';
        mysqli_query($connect, $query);

        $message = 'You have received a contact form submission:


            Email: '.$_POST['email'].'
            Message: '.$_POST['email'].'
            name: '.$_POST['name'].'
            Departamento: '.$_POST['departamento'];

        mail( 'poveda.geovanny@hotmail.com', 
            'Contact Form Cubmission',
            $message );

        header('Location: thankyou.php');
        die();

    }
}

?>
<!doctype html>
<html>
    <head>
        <title>PHP Contact Form</title>
    </head>
    <body>
    
        <h1>PHP Contact Form</h1>

        <form method="post" action="">
       
        Name:
                    <br>
                    <input type="text" name="name" value="<?php echo $name;?>"/> 
                    <?php echo $name_error;?>
                    
               <br><br>
        
            
        Email Address:
            <br>
            <input type="text" name="email" value="<?php echo $email; ?>">
            <?php echo $email_error; ?>

            <br><br>

            Message:
            <br>
            <textarea name="message"><?php echo $message; ?></textarea>
            <?php echo $message_error; ?>

            <br><br>

            <label for="lang">Departamento:</label>
                    <br>
                    <!-- <input list="Departamentos" name="Departamento" id="Departamento" placeholder="Ingresa nombre departamento" autocomplete="country" required/>  -->
                    <select name="departamento" id="depar">
                        <option value="atencioncliente">Atencion al Cliente</option>
                        <option value="soportetecnico">Soporte Tecnico</option>
                        <option value="facturacion">Facturacion</option>
                    </select>
                    <br><br>

            <input type="submit" value="Submit">
        
        </form>
    
    </body>
</html>
