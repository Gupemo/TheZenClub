<?php
require_once 'conexion.php';

// CRUD DE USERS
class Users{

    // para buscar/coger el mail
    public static function obtenerEmail($email){
        try{
            $conexion = Conexion::conn();
            if(!$conexion){
                throw new Exception("No se pudo conectar a la base de datos");
            }
            $sentencia = "SELECT * FROM users WHERE user_email = :email LIMIT 1";
            $consulta = $conexion -> prepare($sentencia);
            $consulta -> execute(array(":email" => $email));
            $resultado = $consulta -> fetch(PDO::FETCH_ASSOC);

            $conexion = null;
            $consulta -> closeCursor();
            return $resultado;

        } catch (PDOException $e) {
            error_log("Error al usar obtenerEmail: " . $e->getMessage());
            return null;
        }
    }

    public static function registrarUsuario($usersData, $dataContact, $token){
        try {
            $conexion = Conexion::conn();
            if(!$conexion){
                throw new Exception("No se pudo conectar a la base de datos");
            }

            $conexion->beginTransaction();

            // tabla users
            // le asigno por defecto la cuota 1 (la genérica)
            $sentenciaUserData = "INSERT INTO users 
                                (user_name, user_subname, user_birthdate, user_email, user_sex, user_phone, user_picture, user_deseases, user_password, tos_accepted, fee_id)
                                VALUES
                                (:user_name, :user_subname, :user_birthdate, :user_email, :user_sex, :user_phone, :user_picture, :user_deseases, :user_password, :tos_accepted, 1)";
            
            $consultaUserData = $conexion->prepare($sentenciaUserData);
            $parametrosUserData = [
                "user_name"      => $usersData['user_name'],
                "user_subname"   => $usersData['user_subname'],
                "user_birthdate" => $usersData['user_birthdate'],
                "user_email"     => $usersData['user_email'],
                "user_sex"       => $usersData['user_sex'],
                "user_phone"     => $usersData['user_phone'],
                "user_picture"   => $usersData['user_picture'],
                "user_deseases"  => $usersData['user_deseases'],
                "user_password"  => $usersData['user_password'],
                "tos_accepted"   => $usersData['tos_accepted']
            ];

            $consultaUserData->execute($parametrosUserData);

            // id del usuario insertado
            $userId = $conexion->lastInsertId();

            // solo insertamos contacto de emergencia si tiene algún dato
            if (!empty($dataContact['contact_name']) || !empty($dataContact['contact_phone'])) {
                $sentenciaDataContact = "INSERT INTO emergency_contacts
                                        (contact_name, contact_subname, contact_phone, relationship, user_id)
                                        VALUES
                                        (:contact_name, :contact_subname, :contact_phone, :relationship, :user_id)";

                $consultaDataContact = $conexion->prepare($sentenciaDataContact);
                $parametrosDataContact = [
                    "contact_name"    => $dataContact['contact_name'],
                    "contact_subname" => $dataContact['contact_subname'],
                    "contact_phone"   => $dataContact['contact_phone'],
                    "relationship"    => $dataContact['relationship'],
                    "user_id"         => $userId
                ];

                $consultaDataContact->execute($parametrosDataContact);
            }

            // asignar cinturón blanco por defecto (belt_id = 1)
            $sentenciaBelt = "INSERT INTO user_belt (user_id, belt_id, fecha_obtencion, active)
                            VALUES (:user_id, 1, CURDATE(), TRUE)";
            $consultaBelt = $conexion->prepare($sentenciaBelt);
            $consultaBelt->execute(["user_id" => $userId]);

            // marco el token como usado
            $sentenciaInvitacion = "UPDATE invitations
                                    SET used = 1, user_id = :user_id
                                    WHERE token = :token";
            $consultaInvitacion = $conexion -> prepare($sentenciaInvitacion);
            $consultaInvitacion -> execute([
                ":user_id" => $userId,
                ":token" => $token
            ]);


            // confirmar transacción

            $conexion->commit();
            $conexion = null;

            return $userId; // devuelvo el id para iniciar la sesion automatica

        } catch (Exception $e) {
            if($conexion && $conexion->inTransaction()){
                $conexion->rollback();
            }
            error_log("Error en registrarUsuario: " . $e->getMessage());
            return null;
        }
    }

    
    // perfiles - devuelve objeto con datos de cada persona (según su id)
    public static function userProfile($user_id){
        try {
            $conexion = Conexion::conn();
            if(!$conexion){
                throw new Exception("No se pudo conectar a la base de datos");
            }

            $sentencia = "SELECT 
                            u.*,
                            b.belt_name AS cinturon
                        FROM users u
                        LEFT JOIN user_belt ub 
                            ON u.user_id = ub.user_id AND ub.active = 1
                        LEFT JOIN belts b 
                            ON ub.belt_id = b.belt_id
                        WHERE u.user_id = :idUsuario
                        LIMIT 1";

            $consulta = $conexion->prepare($sentencia);
            $consulta->execute([":idUsuario" => $user_id]);
            $resultado = $consulta->fetch(PDO::FETCH_OBJ);

            $consulta->closeCursor();
            $conexion = null;
            return $resultado;

        } catch (PDOException $e) {
            error_log("Error en userProfile: " . $e->getMessage());
            return null;
        }
    }

// Contactos de emergencia del usuario
    public static function userContacts($user_id){
        try {
            $conexion = Conexion::conn();
            if(!$conexion){
                throw new Exception("No se pudo conectar a la base de datos");
            }

            $sentencia = "SELECT 
                            ec.*,
                            ec.contact_name AS nombre,
                            ec.contact_subname AS apellidos,
                            ec.contact_phone AS telefono,
                            ec.relationship AS relacion
                        FROM emergency_contacts ec
                        WHERE ec.user_id = :idUsuario";

            $consulta = $conexion->prepare($sentencia);
            $consulta->execute([":idUsuario" => $user_id]);
            $resultado = $consulta->fetchAll(PDO::FETCH_OBJ);

            $consulta->closeCursor();
            $conexion = null;
            return $resultado;

        } catch (PDOException $e) {
            error_log("Error en userContacts: " . $e->getMessage());
            return [];
        }
    }




}