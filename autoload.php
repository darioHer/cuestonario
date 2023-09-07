<?php
require 'vendor/autoload.php'; // Carga la biblioteca PhpSpreadsheet

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    
    // Crear una instancia de PhpSpreadsheet
    $spreadsheet = new Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();
    
    // Agregar encabezados al archivo Excel
    $sheet->setCellValue('A1', 'Nombre');
    $sheet->setCellValue('B1', 'Apellido');
    
    // Agregar respuestas de usuario
    $sheet->setCellValue('A2', $nombre);
    $sheet->setCellValue('B2', $apellido);
    
    // Definir el nombre del archivo Excel
    $archivo = 'respuestas.xlsx';
    
    // Crear el escritor para Excel
    $writer = new Xlsx($spreadsheet);
    
    // Guardar el archivo Excel en el servidor
    $writer->save($archivo);
    
    // Proporcionar un enlace para descargar el archivo
    echo '<p>Las respuestas se han guardado correctamente en <a href="' . $archivo . '" download>Descargar respuestas</a></p>';
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cuestionario</title>
</head>
<body>
    <h1>Cuestionario</h1>

    <form method="post">
        <label for="nombre">Nombre:</label>
        <input type="text" id="nombre" name="nombre" required><br><br>

        <label for="apellido">Apellido:</label>
        <input type="text" id="apellido" name="apellido" required><br><br>
        
        <fieldset>
            <legend>Pregunta 1: ¿Qué es un IDE en el desarrollo de software?</legend>
            <input type="radio" id="pregunta1_a" name="pregunta1" value="A">
            <label for="pregunta1_a">A) Un lenguaje de programación.</label><br>
            <input type="radio" id="pregunta1_b" name="pregunta1" value="B">
            <label for="pregunta1_b">B) Un entorno de desarrollo integrado.</label><br>
            <input type="radio" id="pregunta1_c" name="pregunta1" value="C">
            <label for="pregunta1_c">C) Una metodología de desarrollo ágil.</label><br><br>
        </fieldset>
        <!-- Agrega aquí las preguntas adicionales del cuestionario -->

        <button type="submit">Enviar respuestas</button>
    </form>
</body>
</html>
