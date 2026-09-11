<?php
require_once(dirname(__FILE__) . "/conexion.php");


if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $stmt = $pdo->prepare(
        "UPDATE estudiante_notas SET
            nombre_est = :nombre_est,
            profesor_est = :profesor_est,
            curso = :curso,
            anio = :anio,
            identificacion = :identificacion
         WHERE id = :id"
    );

    $stmt->execute([
        'nombre_est'     => $_POST['nombre-estudiante'],
        'profesor_est'   => $_POST['profesor-estudiante'],
        'curso'          => $_POST['curso-estudiante'],
        'anio'           => $_POST['ano-estudiante'],
        'identificacion' => $_POST['identificacion-estudiante'],
        'id'             => $_POST['id'],
    ]);

    header('Location: listaestudiantes.php');
    exit();
}

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
<form action="editar.php" method="POST" id="form-editar">
    <input type="hidden" name="id" value="<?php echo htmlspecialchars($estudiante['id']); ?>">

    <label for="nombre">Nombre</label>
    <input type="text" name="nombre-estudiante" id="nombre"
           value="<?php echo htmlspecialchars($estudiante['nombre_est']); ?>" required>

    <label for="profesor">Profesor/a</label>
    <input type="text" name="profesor-estudiante" id="profesor"
           value="<?php echo htmlspecialchars($estudiante['profesor_est']); ?>" required>

    <label for="curso">Curso</label>
    <input type="text" name="curso-estudiante" id="curso"
           value="<?php echo htmlspecialchars($estudiante['curso']); ?>" required>

    <label for="ano">Año</label>
    <input type="number" name="ano-estudiante" id="ano"
           value="<?php echo htmlspecialchars($estudiante['anio']); ?>" required>

    <label for="identificacion">Identificación</label>
    <input type="number" name="identificacion-estudiante" id="identificacion"
           value="<?php echo htmlspecialchars($estudiante['identificacion']); ?>" required>

    <button class="cerrar-modal guardar-cambios" type="submit">Guardar cambios</button>
</form>