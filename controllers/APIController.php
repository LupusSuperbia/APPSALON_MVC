<?php 

namespace Controllers;

use Model\AdminCita;
use Model\Cita;
use Model\CitaServicio;
use Model\Servicio;

class APIController {
    public static function index() {
        $servicios = Servicio::all();

        echo json_encode($servicios, JSON_UNESCAPED_UNICODE);
    }

    public static function guardar(){
        // Almacena la cita y devuelve el ID
        $cita = new Cita($_POST);
        $resultado = $cita->guardar();
        
        // Cmo resultado devuelve un array con la id podemos extraer el id de ahí 
        $id = $resultado['id'];
        // Almacena la cita y el servicio
        // Acá con el metodo explode tomamos el separador y podemos separarlo y crear un nuevo array porque $_POST['servicios'] contiene un array con un solo string
        $idServicios = explode("," , $_POST['servicios']);

        // Como $idServicios es un arreglo podemos usar un foreach
        foreach($idServicios as $idServicio){
            // Acá creamos un arrelgo asociativo asi podemos agregar el id de la cita y el id del servicio
            $args = [
                'citaId' => $id,
                'servicioId' => $idServicio
            ];  
            // Acá creamos el citaServicio ya que tenemos el id de la cita y el id del servicio
            $citaServicio = new CitaServicio($args);
            // Acá ya lo guardamos
            $citaServicio->guardar();
        };

        echo json_encode(['resultado' => $resultado]);
    }

    public static function eliminar(){
        if($_SERVER['REQUEST_METHOD' === "POST"]){
            $id = $_POST['id'];

            $cita = Cita::find($id);
            $cita->eliminar();
            header('Location:'. $_SERVER['HTTP_REFERER']);
        }

    }
}