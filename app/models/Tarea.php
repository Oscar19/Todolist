<?php
class Tarea extends Model {
    //protected $tareaJson = "/opt/lampp/htdocs/Todolist/config/Tareas.json";
    protected $tareaJson = TAREAS_JSON_PATH;
    protected array $tareas;

    public function __construct() {
        $this->tareaJson = TAREAS_JSON_PATH;
        if (!file_exists($this->tareaJson)){
            file_put_contents($this->tareaJson, json_encode([]));
        }
        $this->tareas = json_decode(file_get_contents($this->tareaJson), true);
    }

    public function getTareas() {
        return $this->tareas;
    }

    public function addTarea($id, $titulo, $descripcion, $usuario, $status, $fecha, $horaInicio, $horaFin) {
        if (strtotime($horaFin) <= strtotime($horaInicio)) {
            throw new Exception("No puedes acabar antes de empezar.");
        }
        $newTarea = [
            "Id" => $id,
            "Titulo" => $titulo,
            "Descripcion" => $descripcion,
            "Usuario" => $usuario,
            "Status" => $status,
            "Fecha" => $fecha,
            "Hora_inicio" => $horaInicio,
            "Hora_final" => $horaFin,
        ];
        $this->tareas[] = $newTarea;
        file_put_contents($this->tareaJson, json_encode($this->tareas));
        
    }
    
    //foreach ($this->tareas as &$tarea) 
    // manera más rápida de llegar al id del objeto que estoy editando
   public function updateTarea($id, $titulo, $descripcion, $usuario, $status, $fecha, $horaInicio, $horaFin) {
        if (strtotime($horaFin) <= strtotime($horaInicio)) {
            throw new Exception("No puedes acabar antes de empezar.");
        }
        foreach ($this->tareas as &$tarea) {
            if ($tarea['Id'] == $id) {
                $tarea['Titulo'] = $titulo;
                $tarea['Descripcion'] = $descripcion;
                $tarea['Usuario'] = $usuario;
                $tarea['Status'] = $status;
                $tarea['Fecha'] = $fecha;
                $tarea['Hora_inicio'] = $horaInicio;
                $tarea['Hora_final'] = $horaFin;
                file_put_contents($this->tareaJson, json_encode($this->tareas));
                if (file_exists($this->tareaJson)) {
                    error_log("Archivo actualizado correctamente: " . file_get_contents($this->tareaJson));
                } else {
                    error_log("Error: No se pudo escribir en el archivo.");
                }
                return true; 
            }
        }
        return false; 
    }

     public function deleteTarea($id)
    {
        $tareas = $this->getTareas();
        //otra manera de llegar rápido al id del objeto
        $tareas = array_filter($tareas, function($tarea) use ($id) {
            return $tarea['Id'] != $id;
        });
        file_put_contents($this->tareaJson, json_encode(array_values($tareas)));
    }
    
}
