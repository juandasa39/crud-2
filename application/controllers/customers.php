<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Class Customers
 * Controlador para gestionar las operaciones relacionadas con los usuarios
 */
class Customers extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('business/LogUsers');
    }

    /**
     * Página principal que carga la vista con los datos de los usuarios
     * quien ?
     * cuando ? 
     */
    public function index() {
        $this->load->view('log_view');
    }
    
    /**
     * Cargar todos los usuarios en formato JSON
     * Llama al modelo de bisness para obtener todos los usuarios.
     */
    public function loadData() {
        $users = $this->LogUsers->getAllUsers();
        echo json_encode($users);
    }
    
    /**
     * Guardar un nuevo usuario
     * Recibe los datos del formulario mediante POST, los pasa al modelo de bisness para validar y guardar.
     */
    public function save() {
        $data = $this->input->post();
        $result = $this->LogUsers->saveUser($data);
        echo json_encode($result);
    }

    /**
     * Eliminar un usuario por ID
     * Recibe el ID del usuario mediante POST, lo pasa al modelo de bisness para eliminarlo.
     */
    public function delete() {
        $id = $this->input->post('id');
        $result = $this->LogUsers->deleteUser($id);
        echo json_encode($result);
    }

    /**
     * Actualizar la información de un usuario
     * Recibe los datos del formulario mediante POST, los pasa al modelo de bisness para validar y actualizar.
     */
    public function update() {
        $data = $this->input->post();
        $result = $this->LogUsers->updateUser($data);
        echo json_encode($result);
    }

    

    /**
     * Validación personalizada para la contraseña
     * Verifica que la contraseña contenga al menos una letra mayúscula y un carácter especial.
     * @author Juan Salazar <correo@test.com>
     * @date 22/10/2024
     * @param {string} $password Contraseña asigna por cliente
     * @return boolean Indicador de si la contraseña supera la validación
     */
    public function validate_password($password) {
        if (preg_match('/^(?=.*[A-Z])(?=.*[\W]).+$/', $password)) {
            return TRUE;
        } else {
            $this->form_validation->set_message('validate_password', 'El campo {field} debe contener al menos una letra mayúscula y un carácter especial.');
            return FALSE;
        }
    }
}
