<?php
/**
 * Created by PhpStorm.
 * User: vmadmin
 * Date: 05.06.2019
 * Time: 15:46
 */
 require_once '../lib/Repository.php';
class BlogRepository
{
    protected $tableName ="blog";

    public function createBloGEntry($title, $text, $uid){
        $query = "INSERT INTO {$this->tableName} (title, text, uid) VALUES ( ?, ?, ?);";
        //Statement vorbereiten
        $statement = ConnectionHandler::getConnection()->prepare($query);
        //Parameter anbinden
        $statement->bind_param("ssi",$title, $text, $uid);
        //Ausführung und überprüfung ob es Funktioniert hat
        if (!$statement->execute()) {
            throw new Exception($statement->error);
        }

        return $statement->insert_id;
    }
    public function getBlogByUID($uid){
        $query = "SELECT * FROM {$this->tableName} WHERE uid = ? ";
        //Statement vorbereiten
        $statement = ConnectionHandler::getConnection()->prepare($query);
        //Parameter andbinden
        $statement->bind_param('s',$uid);
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
}