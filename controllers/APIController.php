<?php

namespace Controllers;

use Model\Cita;
use Model\CitaServicio;
use Model\Servicios;

class APIController{
    public static function index(){
        $servicios = Servicios::all();
        echo json_encode($servicios);
    }

    public static function guardar(){
        //almacen al cita y devuleve el ID
        $cita = new Cita($_POST);
        $resultado = $cita->guardar();

        $id = $resultado['id'];

        //almacena las citas y el servicio
        //almace los servicios con el ID de la cita
        $idServicios = explode(",", $_POST['servicios']);
        foreach($idServicios as $idServicio){
            $args = [
                'citaId' => $id,
                'servicioId' => $idServicio
            ];
            
            $citaServicio = new CitaServicio($args);
            $citaServicio->guardar();
        }

        //retornamos una respuesta
        echo json_encode(['resultado' => $resultado]);
    }

    public static function eliminar(){
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $id = $_POST['id'];

            if(filter_var($id, FILTER_VALIDATE_INT)){
                $cita = Cita::find($id);
            }
            if($cita){
                $cita->eliminar();
            }

            header('Location:' . $_SERVER['HTTP_REFERER']);
        }
    }
}