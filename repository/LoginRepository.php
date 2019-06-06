<?php
/**
 * Created by PhpStorm.
 * User: irisb
 * Date: 24.04.2018
 * Time: 18:02
 */

require_once '../lib/Repository.php';

class LoginRepository extends Repository
{
    protected $tableName = "user";

    //User in DB speichern
    public function create($nickname ,$email,$passwort){
        //Passwort hashen (Sicherheits vorkehrung)
        $password = password_hash($passwort,PASSWORD_DEFAULT);

        //Statement vorbereiten, schütz vor SQL-injections
        $query = "INSERT INTO {$this->tableName} (nickname, mailAdresse, passwort) VALUES ( ?, ?, ?);";
        //Statement vorbereiten
        $statement = ConnectionHandler::getConnection()->prepare($query);
        //Parameter anbinden
        $statement->bind_param("sss",$nickname, $email, $password);
        //Ausführung und überprüfung ob es Funktioniert hat
        if (!$statement->execute()) {
            throw new Exception($statement->error);
        }

        return $statement->insert_id;
    }

    //User anhand seiner Email holen
    public function getUser($nickname){
        //Statement vorbereiten
        $query = "SELECT * FROM {$this->tableName} WHERE nickname = ? ";
        //Statement vorbereiten
        $statement = ConnectionHandler::getConnection()->prepare($query);
        //Parameter andbinden
        $statement->bind_param('s',$nickname);
        //Ausführung und überprüfung ob es klappt
        if(!$statement->execute()){
            throw new Exception($statement->error);
        }
        else{
            //Resultat holen
            $result = $statement->get_result();
            //Resultat fetchen
            $user = $result->fetch_object();
            //gefetchtes resultat zurück geben
            return $user;
        }

    }


    public function getAll()
    {//Statement vorbereiten
        $query = "SELECT * FROM {$this->tableName} ";
        //Statement vorbereiten
        $statement = ConnectionHandler::getConnection()->prepare($query);
        //Ausführung und überprüfung ob es klappt
        if(!$statement->execute()){
            throw new Exception($statement->error);
        }
        else{
            //Resultat holen
            $result = $statement->get_result();


            $rows = array();
            while ($row = $result->fetch_object()) {
                $rows[] = $row;
            }
            return $rows;

        }

    }

    public function countUserByNickname($nickname){
        $query = "SELECT COUNT(id) as total FROM user WHERE nickname = ?";
        //Statement vorbereiten
        $statement = ConnectionHandler::getConnection()->prepare($query);
        //Parameter andbinden
        $statement->bind_param('s',$nickname);
        return $this->executeStatement($statement);
    }

    public function countUserByEmail($email){
        $query = "SELECT COUNT(id) as total FROM user WHERE mailAdresse = ?";
        //Statement vorbereiten
        $statement = ConnectionHandler::getConnection()->prepare($query);
        //Parameter andbinden
        $statement->bind_param('s',$email);
        return $this->executeStatement($statement);
    }

    //User anhand seines Usernamens holen holen
    public function executeStatement($statement){
        //Ausführung und überprüfung ob es klappt
        if(!$statement->execute()){
            throw new Exception($statement->error);
        }
        else{
            //Resultat holen
            $result = $statement->get_result();
            //Resultat fetchen
            $user = $result->fetch_object();
            //gefetchtes resultat zurück geben
            return $user;
        }

    }


}