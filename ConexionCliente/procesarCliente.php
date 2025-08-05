<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

require_once("Cliente.php");
require_once("ClienteDAL.php");
require_once("Telefono.php");
require_once("TelefonoDAL.php");
require_once("Direccion.php");
require_once("DireccionDAL.php");

$nombre = trim($_POST["nombre"]);
$apellido = trim($_POST["apellido"]);
$cuil = trim($_POST["cuil"]);
$email = trim($_POST["email"]);

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    exit("❌ Email inválido.");
}

$conexion = new mysqli("localhost", "root", "00001", "cliente");
$conexion->set_charset("utf8");

$check = $conexion->query("SELECT idCliente FROM clientes WHERE cuil = '" . $conexion->real_escape_string($cuil) . "'");
if ($check->num_rows > 0) {
    exit("❌ CUIL duplicado.");
}

$queryCliente = sprintf(
    "INSERT INTO clientes (nombre, apellido, cuil, email) VALUES ('%s', '%s', '%s', '%s')",
    $conexion->real_escape_string($nombre),
    $conexion->real_escape_string($apellido),
    $conexion->real_escape_string($cuil),
    $conexion->real_escape_string($email)
);
$conexion->query($queryCliente);
$idCliente = $conexion->insert_id;

$telDAL = new TelefonoDAL();
$dirDAL = new DireccionDAL();

// Teléfonos
foreach ($_POST["telefono"] as $i => $tel) {
    $tipo = $_POST["tipoTelefono"][$i] ?? 'celular';
    if (!empty($tel)) {
        $telefonoObj = new Telefono($idCliente, $tel, $tipo);
        $telDAL->insertarTelefono($telefonoObj);
    }
}

// Direcciones
foreach ($_POST["calle"] as $i => $calle) {
    $direccionObj = new Direccion(
        $idCliente,
        $calle,
        $_POST["numero"][$i],
        $_POST["piso"][$i],
        $_POST["dpto"][$i],
        $_POST["ciudad"][$i],
        $_POST["provincia"][$i],
        $_POST["cp"][$i],
        $_POST["tipoDireccion"][$i]
    );
    $dirDAL->insertarDireccion($direccionObj);
}

echo "✅ Cliente y datos registrados.<br>";
echo "<a href='formulario.html'>Volver</a> | <a href='verClientes.php'>Ver Clientes</a>";

$conexion->close();
?>
