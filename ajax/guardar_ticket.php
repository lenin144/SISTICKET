<?php
/* ================= CONFIGURACIÓN LIMPIA ================= */
error_reporting(0);
ini_set('display_errors', 0);
header('Content-Type: application/json; charset=utf-8');

session_start();

/* ===== VALIDAR SESIÓN ===== */
if (!isset($_SESSION['user_id']) && !isset($_SESSION['admin_id'])) {
    echo json_encode(array(
        "ok" => false,
        "error" => "Sesión no válida"
    ));
    exit;
}

/* ===== CONEXIÓN OFICIAL ===== */
require_once("../admin/config/config.php");

/* ===== VALIDAR POST ===== */
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(array(
        "ok" => false,
        "error" => "Método no permitido"
    ));
    exit;
}

/* ===== CATEGORÍAS ===== */
$categoria_id    = isset($_POST['categoria_id']) ? intval($_POST['categoria_id']) : 0;
$subcategoria_id = isset($_POST['subcategoria_id']) ? intval($_POST['subcategoria_id']) : 0;
$tercer_nivel_id = isset($_POST['tercer_nivel_id']) ? intval($_POST['tercer_nivel_id']) : 0;

if ($categoria_id <= 0 || $subcategoria_id <= 0 || $tercer_nivel_id <= 0) {
    echo json_encode(array(
        "ok" => false,
        "error" => "Categorías incompletas"
    ));
    exit;
}

/* ===== CAMPOS ===== */
$empresa_id  = isset($_POST['empresa_id']) ? mysqli_real_escape_string($con, $_POST['empresa_id']) : '';
$titulo      = isset($_POST['titulo']) ? mysqli_real_escape_string($con, $_POST['titulo']) : '';
$descripcion = isset($_POST['descripcion']) ? mysqli_real_escape_string($con, $_POST['descripcion']) : '';
$responsable = isset($_POST['responsable']) ? mysqli_real_escape_string($con, $_POST['responsable']) : '';
$cargo       = isset($_POST['cargo']) ? mysqli_real_escape_string($con, $_POST['cargo']) : '';
$motivo      = isset($_POST['motivo']) ? mysqli_real_escape_string($con, $_POST['motivo']) : '';

if (
    $empresa_id === '' ||
    $titulo === '' ||
    $descripcion === '' ||
    $responsable === '' ||
    $cargo === '' ||
    $motivo === ''
) {
    echo json_encode(array(
        "ok" => false,
        "error" => "Datos incompletos"
    ));
    exit;
}

/* ===== USUARIO ===== */
$user_id = isset($_SESSION['user_id']) ? intval($_SESSION['user_id']) : intval($_SESSION['admin_id']);

/* ===== INSERT ===== */
$sql = "
INSERT INTO tickets (
    categoria_id,
    subcategoria_id,
    tercer_nivel_id,
    empresa_id,
    titulo,
    descripcion,
    responsable,
    cargo,
    motivo,
    user_id,
    created_at
) VALUES (
    '$categoria_id',
    '$subcategoria_id',
    '$tercer_nivel_id',
    '$empresa_id',
    '$titulo',
    '$descripcion',
    '$responsable',
    '$cargo',
    '$motivo',
    '$user_id',
    NOW()
)";

if (mysqli_query($con, $sql)) {
    echo json_encode(array("ok" => true));
} else {
    echo json_encode(array(
        "ok" => false,
        "error" => "Error al crear solicitud"
    ));
}
exit;
