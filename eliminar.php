<?php
require_once(dirname(__FILE__) . "/conexion.php");

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['id'])) {
    $stmt = $pdo->prepare("DELETE FROM estudiante_notas WHERE id = :id");
    $stmt->execute(['id' => $_POST['id']]);
}

header('Location: listaestudiantes.php');
exit();