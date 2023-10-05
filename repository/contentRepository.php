<?php

class Content {
    private $db;

    public function __construct($db){
        $this->db = $db;
    }

    public function insertContent($title, $contentDesc, $contentAddress, $startYear, $userId) {
        $r = true;
        
            $insert = $this->db->prepare("insert  into  CONTENT(created_datetime, title, content_desc, content_address, start_year, user_id) values (NOW(), :title, :contentDesc, :contentAddress, :startYear, :userId)");
            $insert->bindValue('title', $title, PDO::PARAM_STR);
            $insert->bindValue('contentDesc', $contentDesc, PDO::PARAM_STR);
            $insert->bindValue('contentAddress', $contentAddress, PDO::PARAM_STR);
            $insert->bindValue('startYear', $startYear, PDO::PARAM_STR);
            $insert->bindValue('userId', $userId, PDO::PARAM_INT);
            $insert->execute();

            if ($insert->errorCode()!=0){
                print_r($insert->errorInfo());
                $r=false;
            }
            return $r;      
    }

    public function selectAllContent() {
        $selectAll = $this->db->prepare("select * from CONTENT");
        $selectAll->execute();

        return $selectAll->fetchAll();
    }

    public function selectContentById($idContent) {
        $selectByPseudo = $this->db->prepare("select * from CONTENT where content_id= :idContent");
        $selectByPseudo->bindValue('idContent', $idContent, PDO::PARAM_INT);
        $selectByPseudo->execute();

        return $selectByPseudo->fetch();
    }

    public function selectAllContentsByYear($startYear) {
        $selectAllContentsByYear = $this->db->prepare("select * from CONTENT where start_year= :startYear");
        $selectAllContentsByYear->bindValue('startYear', $startYear, PDO::PARAM_STR);
        $selectAllContentsByYear->execute();

        return $selectAllContentsByYear->fetchAll();
    }

    public function selectAllContentsByCreator($userId) {
        $selectAllContentsByCreator = $this->db->prepare("select * from CONTENT where user_id= :userId");
        $selectAllContentsByCreator->bindValue('userId', $userId, PDO::PARAM_INT);
        $selectAllContentsByCreator->execute();

        return $selectAllContentsByCreator->fetchAll();
    }

    public function deleteContentById($idContent) {
        $selectByPseudo = $this->db->prepare("delete from CONTENT where content_id= :idContent");
        $selectByPseudo->bindValue('idContent', $idContent, PDO::PARAM_INT);
        $selectByPseudo->execute();

        return $selectByPseudo->fetch();
    }
}



