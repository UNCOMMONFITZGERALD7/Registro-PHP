<?php
require_once(dirname(__FILE__) . "/conexion.php");


if (!isset($_GET['id'])) {
    http_response_code(400);
    exit();
}

$stmt = $pdo->prepare("SELECT * FROM estudiante_notas WHERE id = :id");
$stmt->execute(['id' => $_GET['id']]);
$estudiante = $stmt->fetch();

if (!$estudiante) {
    http_response_code(404);
    exit();
}
?>
<div class="notas-detalle">
    <div>
        <h2>Nombre:</h2>
        <h3><?php echo htmlspecialchars($estudiante['nombre_est']); ?></h3>
    </div>
    <ul>
        <li>Lectura: <?php echo htmlspecialchars($estudiante['cal_lect']); ?></li>
        <li>Escritura: <?php echo htmlspecialchars($estudiante['cal_escr']); ?></li>
        <li>Expresión Comprensiva: <?php echo htmlspecialchars($estudiante['cal_ecom']); ?></li>
        <li>Expresión Oral: <?php echo htmlspecialchars($estudiante['cal_eora']); ?></li>
        <li>Asistencia: <?php echo htmlspecialchars($estudiante['cal_asis']); ?></li>
        <li>Tareas: <?php echo htmlspecialchars($estudiante['cal_tare']); ?></li>
    </ul>
</div>