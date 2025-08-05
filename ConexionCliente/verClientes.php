<?php
require_once("ClienteDAL.php");
require_once("TelefonoDAL.php");
require_once("DireccionDAL.php");

$dal = new ClienteDAL();
$telDal = new TelefonoDAL();
$dirDal = new DireccionDAL();
$clientes = $dal->obtenerClientes();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Listado de Clientes</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        table { 
            border-collapse: collapse; 
            width: 100%; 
            margin-bottom: 40px; 
        }
        th, td { 
            border: 1px solid #ccc; 
            padding: 8px; 
            text-align: left;
        }
        th { 
            background-color: #f2f2f2; 
        }
        h3 { 
            margin-top: 50px; 
        }
    </style>
</head>
<body>
    <h2>Clientes Registrados</h2>

    <?php foreach ($clientes as $cli): ?>
        <h3><?= htmlspecialchars($cli->getNombre() . " " . $cli->getApellido()) ?> 
            (CUIL: <?= htmlspecialchars($cli->getCuil()) ?>)
        </h3>
        <p>Email: <?= htmlspecialchars($cli->getEmail()) ?></p>

        <h4>Teléfonos</h4>
        <table>
            <tr><th>Teléfono</th><th>Tipo</th></tr>
            <?php 
                $telefonos = $telDal->obtenerTelefonosPorCliente($cli->getIdCliente());
                if (empty($telefonos)):
            ?>
                <tr><td colspan="2">No tiene teléfonos registrados.</td></tr>
            <?php else: ?>
                <?php foreach ($telefonos as $tel): ?>
                    <tr>
                        <td><?= htmlspecialchars($tel['telefono']) ?></td>
                        <td><?= htmlspecialchars($tel['tipoTelefono']) ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </table>

        <h4>Direcciones</h4>
        <table>
            <tr>
                <th>Calle</th><th>Número</th><th>Piso</th><th>Dpto</th>
                <th>Ciudad</th><th>Provincia</th><th>CP</th><th>Tipo</th>
            </tr>
            <?php 
                $direcciones = $dirDal->obtenerDireccionesPorCliente($cli->getIdCliente());
                if (empty($direcciones)):
            ?>
                <tr><td colspan="8">No tiene direcciones registradas.</td></tr>
            <?php else: ?>
                <?php foreach ($direcciones as $dir): ?>
                    <tr>
                        <td><?= htmlspecialchars($dir['calle']) ?></td>
                        <td><?= htmlspecialchars($dir['numero']) ?></td>
                        <td><?= htmlspecialchars($dir['piso']) ?></td>
                        <td><?= htmlspecialchars($dir['dpto']) ?></td>
                        <td><?= htmlspecialchars($dir['ciudad']) ?></td>
                        <td><?= htmlspecialchars($dir['provincia']) ?></td>
                        <td><?= htmlspecialchars($dir['cp']) ?></td>
                        <td><?= htmlspecialchars($dir['tipoDireccion']) ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </table>
        <hr>
    <?php endforeach; ?>
</body>
</html>
