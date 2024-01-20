<?php

namespace Controllers;

use Model\AdminCita;
use MVC\Router;

class AdminController{
    public static function index(Router $router){

        isAdmin();

        $fecha = Date('Y-m-d');

        if(isset($_GET['fecha'])){
            $fechaSeleccionada = s($_GET['fecha']) ?? '';
            $fechaCheck = explode('-', $fechaSeleccionada);
            $fechaCheck = checkdate($fechaCheck[1], $fechaCheck[2], $fechaCheck[0]);
            if(isset($fechaSeleccionada) && $fechaCheck){
                $fecha = $fechaSeleccionada;
            }else{
                header('Location: /404');
            }
        }


        //Consultar la base de datos
        $consulta = "SELECT citas.id, citas.hora, CONCAT( usuarios.nombre, ' ', usuarios.apellido) as cliente, ";
        $consulta .= " usuarios.email, usuarios.telefono, servicios.nombre as servicio, servicios.precio  ";
        $consulta .= " FROM citas  ";
        $consulta .= " LEFT OUTER JOIN usuarios ";
        $consulta .= " ON citas.usuarioId=usuarios.id  ";
        $consulta .= " LEFT OUTER JOIN citasServicios ";
        $consulta .= " ON citasServicios.citaId=citas.id ";
        $consulta .= " LEFT OUTER JOIN servicios ";
        $consulta .= " ON servicios.id=citasServicios.servicioId ";
        $consulta .= " WHERE fecha =  '{$fecha}' ";

        $citas = AdminCita::SQL($consulta);

        $router->render('admin/index', [
            'nombre' => $_SESSION['nombre'],
            'citas' => $citas,
            'fecha' => $fecha
        ]);
    }
}