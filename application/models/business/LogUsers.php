<?php

/**
 * Class LogUsers
 * Lógica de negocio para gestionar los usuarios
 */
class LogUsers extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->model('persistence/DbUsersModel');
        $this->load->library('form_validation');
    }

    /**
     * Obtener todos los usuarios
     * Llama al modelo de persistencia para recuperar los usuarios de la base de datos
     *
     * @return array Lista de usuarios
     */
    public function getAllUsers() {
        return $this->DbUsersModel->getUsers();
    }

    /**
     * Guardar un nuevo usuario
     * Valida los datos y llama al modelo de persistencia para guardar el usuario
     * ??
     * 
     * @param {array} $data estrucutura de envio del formulario
     *      {string} name Nombre del cliente
     *      {string} email Correo del cliente
     *      {string} address Direccion del cliente
     * @return array Estado de la respuesta y mensaje
     */
    public function saveUser($data) {
        // Validar los datos del formulario
        $this->form_validation->set_data($data);
        $this->form_validation->set_rules('name', 'Nombre', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
        $this->form_validation->set_rules('address', 'Dirección', 'required');
        $this->form_validation->set_rules('phone', 'Teléfono', 'required|numeric|exact_length[10]');
        $this->form_validation->set_rules('password', 'Contraseña', 'required|min_length[8]|callback_validate_password');

        if ($this->form_validation->run() == FALSE) {
            return ["status" => "error", "message" => validation_errors()];
        }

        $success = $this->DbUsersModel->saveUser($data['name'], $data['email'], $data['address'], $data['phone'], $data['password']);

        if ($success) {
            return ["status" => "success", "message" => "Usuario guardado exitosamente."];
        } else {
            return ["status" => "error", "message" => "Error al guardar el usuario."];
        }
    }

    /**
     * Eliminar un usuario
     * Llama al modelo de persistencia para eliminar el usuario de la base de datos
     *
     * @param {int} $id ID del usuario
     * @return array Estado de la respuesta y mensaje
     */
    public function deleteUser($id) {
        $success = $this->DbUsersModel->deleteUser($id);

        if ($success) {
            return ["status" => "success", "message" => "Usuario eliminado exitosamente."];
        } else {
            return ["status" => "error", "message" => "Error al eliminar el usuario."];
        }
    }

    /**
     * Actualizar un usuario existente
     * Valida los datos y llama al modelo de persistencia para actualizar el usuario
     *
     * @param array $data Datos del usuario
     * @return array Estado de la respuesta y mensaje
     */
    public function updateUser($data) {
        $success = $this->DbUsersModel->updateUser($data['id'], $data['name'], $data['email'], $data['address'], $data['phone'], $data['password']);

        if ($success) {
            return ["status" => "success", "message" => "Usuario actualizado exitosamente."];
        } else {
            return ["status" => "error", "message" => "Error al actualizar el usuario."];
        }
    }
}
