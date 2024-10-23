<?php

/**
 * Módelo de persiste de usuarios
 * Class DbUsersModel
 * Modelo para interactuar con la base de datos y gestionar los datos de los usuarios
 */
class DbUsersModel extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    /**
     * Guardar usuario
     *
     * @param string $name
     * @param string $email
     * @param string $address
     * @param string $phone
     * @param string $password
     * @return int ID del usuario insertado
     */
    public function saveUser($name, $email, $address, $phone, $password) {
        $data = [
            'name' => $name,
            'email' => $email,
            'address' => $address,
            'phone' => $phone,
            'password' => $password
        ];
        $this->db->insert('usuarios', $data);
        
        // Control try-catch 
        return $this->db->insert_id();
    }

    /**
     * Obtener todos los usuarios de la base de datos
     *
     * @return array Lista de usuarios
     */
    public function getUsers() {
        $query = $this->db->get('usuarios');
        return $query->result();
    }

    /**
     * Eliminar un usuario por ID
     *
     * @param int $id ID del usuario
     * @return int Filas afectadas
     */
    public function deleteUser($id) {
        $this->db
            ->where('id', $id)
            ->delete('usuarios');
        return $this->db->affected_rows();
    }

    /**
     * Actualizar la información de un usuario
     *
     * @param int $id ID del usuario
     * @param string $name
     * @param string $email
     * @param string $address
     * @param string $phone
     * @param string $password
     * @return int Filas afectadas
     */
    public function updateUser($id, $name, $email, $address, $phone, $password) {
        $data = [
            'name' => $name,
            'email' => $email,
            'address' => $address,
            'phone' => $phone,
            'password' => $password
        ];
        $this->db->where('id', $id);
        $this->db->update('usuarios', $data);
        return $this->db->affected_rows();
    }
}
