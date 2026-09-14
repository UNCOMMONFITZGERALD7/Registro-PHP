<?php

require_once(dirname(__FILE__) . "/conexion.php");


if ($_SERVER["REQUEST_METHOD"] === "POST") {

    try {

        $stmt = $pdo->prepare(
            "INSERT INTO estudiante_notas (nombre_est, profesor_est, curso, anio, cal_lect, cal_escr, cal_ecom, cal_eora, cal_asis, cal_tare, identificacion)
            VALUES (:nombre_est, :profesor_est, :curso, :anio, :cal_lect, :cal_escr, :cal_ecom, :cal_eora, :cal_asis, :cal_tare, :identificacion)"
        );

        $stmt->execute([
            'nombre_est' => $_POST['nombre-estudiante'],
            'profesor_est' => $_POST['profesor-estudiante'],
            'curso' => $_POST['curso-estudiante'],
            'anio' => $_POST['ano-estudiante'],
            'cal_lect' => $_POST['calificacion-lectura'],
            'cal_escr' => $_POST['calificacion-escritura'],
            'cal_ecom' => $_POST['calificacion-ecomprensiva'],
            'cal_eora' => $_POST['calificacion-eoral'],
            'cal_asis' => $_POST['calificacion-asistencia'],
            'cal_tare' => $_POST['calificacion-tareas'],
            'identificacion' => $_POST['identificacion-estudiante'],
        ]);

        header('Location: index.php?estado=creado');
        exit();

    } catch (PDOException $e) {
        error_log('Error al insertar estudiante: ' . $e->getMessage());

        $mensajeError = interpretarError($e);
        header('Location: index.php?estado=error&mensaje=' . urlencode($mensajeError));
        exit;
    }
}

function interpretarError(PDOException $e): string
{
    $codigoError = $e->getCode();

    switch ($codigoError) {
        case '23505':
            return 'Ya existe un estudiante registrado con esa identificación';
        case '23502':
            return 'Los campos son obligatorios';
        case '22001':
            return 'Uno de los campos es demasiado largo';
        case '08006':
            return 'No se pudo conectar a la base de datos';
        case '42703':
            return error_log('La columna no existe en la base de datos');
        case '42P01':
            return error_log('La tabla no existe');
        default:
            return error_log('Error desconocido');
    }
}

$estado = $_GET['estado'] ?? null;
$mensaje = $_GET['mensaje'] ?? null;

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
    <?php include './plantillas/header.php' ?>
    <section>
        <form id="informacion-estudiante" action="index.php" method="POST">
            <div class="informacion">
                <h2>✨ Boletín de Calificaciones ✨</h2>
                <h3 class="contenedor-alerta">
                    <?php if ($estado === 'creado'): ?>
                        <div class="alerta">Estudiante registrado correctamente.</div>
                    <?php elseif ($estado === 'error'): ?>
                        <div class="alerta alerta-error">
                            <?php echo htmlspecialchars($mensaje ?? 'Ocurrió un error inesperado.'); ?>
                        </div>
                    <?php else: ?>
                        <div class="alerta">
                            <?= $infoconn ?>
                        </div>
                    <?php endif; ?>
                    <div class="contenedor-plantilla">
                        <a class="link-consulta" href="listaestudiantes.php">Consultar Estudiantes</a>
                    </div>
                </h3>
                <div class="card-info">

                    <div class="data datos-estudiante nombrest">
                        <label for="estudiante-nom">Nombre</label>
                        <input required class="input requireds-informacion estudiante" type="text" id="estudiante-nom"
                            name="nombre-estudiante">
                    </div>

                    <div class="data datos-estudiante nombrepro">
                        <label for="profesor-nom">Profesor/a</label>
                        <input required class="input requireds-informacion profesor" type="text" id="profesor-nom"
                            name="profesor-estudiante">
                    </div>

                    <div class="data datos-estudiante identest">
                        <label for="identificacion-estudiante">Identificacion</label>
                        <input required class="input requireds-informacion identificacion" type="number" maxlength="8"
                            min="1000000" max="99999999" id="identificacion-nom" name="identificacion-estudiante">
                    </div>

                    <div class="data datos-curso">

                        <label for="curso">Curso/Nivel</label>
                        <input required class="input requireds-informacion curso" type="text" maxlength="6" id="curso"
                            name="curso-estudiante">

                        <label for="ano">Año</label>
                        <input required class="input requireds-informacion ano" min="1999" max="2030" step="0.0"
                            type="number" id="ano" name="ano-estudiante">

                    </div>
                </div>
            </div>

            <h2 class="titdos">Calificaciones</h2>
            <div class="calificaciones">
                <div class="notas">
                    <ul style="list-style: none;">
                        <li>
                            <label for="lectura">Lectura</label>
                            <input class="notas" min="0" max="100" step="0.1" required type="number" id="lectura"
                                name="calificacion-lectura">
                        </li>
                        <li>
                            <label for="escritura">Escritura</label>
                            <input class="notas" min="0" max="100" step="0.1" required type="number" id="escritura"
                                name="calificacion-escritura">
                        </li>
                        <li>
                            <label for="ecomprensiva">E. Comprensiva</label>
                            <input class="notas" min="0" max="100" step="0.1" required type="number" id="ecomprensiva"
                                name="calificacion-ecomprensiva">
                        </li>
                        <li>
                            <label for="eoral">Expresión Oral</label>
                            <input class="notas" min="0" max="100" step="0.1" min="0" max="100" step="0.1" required
                                type="number" id="eoral" name="calificacion-eoral">
                        </li>
                        <li>
                            <label for="asist">Asistencia</label>
                            <input class="notas" min="0" max="100" step="0.1" required type="number" id="asist"
                                name="calificacion-asistencia">
                        </li>
                        <li>
                            <label for="tareas">Tareas</label>
                            <input class="notas" min="0" max="100" step="0.1" required type="number" id="tareas" name="calificacion-tareas">
                        </li>
                    </ul>
                </div>
                <div class="info">
                    <h2>Sistema de Calificación</h2>
                    <ol style="list-style: none; counter-reset: letras;">
                        <li>90 - 100</li>
                        <li>80 - 89</li>
                        <li>70 - 79</li>
                        <li>60 - 69</li>
                        <li>0 - 59</li>
                    </ol>
                </div>
            </div>
            <div class="comentarios">
                <h2>Comentarios</h2>
                <div class="comentarios-contenedor">
                    <div class="comentarios-hoja"></div>
                </div>
            </div>

            <div class="boton-contenedor">
                <button type="submit" class="submitest">Guardar Estudiante</button>
                <a class="link-consulta" href="listaestudiantes.php">Consultar Estudiantes</a>
            </div>
        </form>
    </section>

    <footer>

    </footer>
    <script src="index.js"></script>
</body>

</html>