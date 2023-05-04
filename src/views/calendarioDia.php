<?php
session_start();
require_once $_SERVER['DOCUMENT_ROOT'] . '/config/database.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/php/initUser.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/models/Acto.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/controllers/ActoCo.php';

$acto = new ActoCo($conn);

    // Obtener el array de actos del día seleccionado de la sesión
    $actosDelDia = $_SESSION['actos'] ?? [];

    if (count($actosDelDia) > 0) {
        echo "<table class='table table-hover' style='width: 70%;'>
                <thead style='background-color: #E9ECEF;'>
                    <tr>
                        <th scope='col'>Fecha</th>
                        <th scope='col'>Hora</th>
                        <th scope='col'>Titulo</th>
                        <th scope='col'>Descripción</th>
                        <th scope='col'>Nº asistentes</th>
                    </tr>
                </thead>
                <tbody>";
        foreach ($actosDelDia as $reg) {
            echo "<tr>
                    <td>". $reg['Fecha'] . "</td>
                    <td>". $reg['Hora'] . "</td>
                    <td align='left'>". $reg['Titulo'] . "</td>
                    <td align='left'>". $reg['Descripcion_corta'] . "</td>
                    <td>". $reg['Num_asistentes'] . "</td>
                </tr>";
        }
        echo "</tbody></table>";
    } else {
        echo "<p>No existen actos para el día seleccionado.</p>";
    }
?>
