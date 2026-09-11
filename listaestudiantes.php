<?php
require_once(dirname(__FILE__) . "/conexion.php");

$stmt = $pdo->prepare("SELECT * FROM estudiante_notas ORDER BY id DESC");
$stmt->execute();
$estudiantes = $stmt->fetchAll();


?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Fredoka:wght@300..700&family=Nunito:ital,wght@0,200..1000;1,200..1000&family=Rokkitt:ital,wght@0,100..900;1,100..900&display=swap"
        rel="stylesheet">
    <title>Boletin de Calificaciones - BEI</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="icon" type="image/png" href="img/favicon/favicon.png">
</head>

<body>
    <?php include './plantillas/header.php'?>
    <section>
        <div class="informacion informacion-lista">
            <h2>ESTUDIANTES <span>MATRICULADOS</span></h2>
            <h3><?php echo $infoconn ?></h3>
            <div class="card-info card-info-estudiantes">
                <div class="tabla-scroll">
                    <?php include './plantillas/tablalistaest.php' ?>
                </div>
            </div>
        </div>
        <div>
            <button type="button" class="boton-plantilla" onclick="window.location.href='index.php'">Volver a ingresar estudiante</button>
        </div>

        <div id="modal" class="modal-overlay oculto">
            <div class="modal-content">
                <div class="boton-cerrar-modal">
                    <button class="cerrar-modal" id="cerrar-modal" type="button">&times;</button>
                </div>
                <div id="modal-body"></div>
            </div>
        </div>
    </section>
    <script src="script.js"></script>
    <script src="index.js"></script>
</body>

</html>