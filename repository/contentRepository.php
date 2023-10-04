<?php

class Content {
    private $db;

    public function __construct($db){
        $this->db = $db;
    }

    public function insertContent($title, $contentDesc, $userId) {
        $r = true;
        
            $insert = $this->db->prepare("insert  into  CONTENT(created_datetime, title, content_desc, user_id) values (:createdDatetime, :title, :contentDesc, :userId)");
            $insert->bindValue('createdDatetime', new DateTime("now"), PDO::PARAM_STR);
            $insert->bindValue('title', $title, PDO::PARAM_STR);
            $insert->bindValue('contentDesc', $contentDesc, PDO::PARAM_STR);
            $insert->bindValue('userId', $userId, PDO::PARAM_INT);
            $insert->execute();

            if ($insert->errorCode()!=0){
                print_r($insert->errorInfo());
                $r=false;
            }
            return $r;      
    }

    public function selectAllContent() {
        $selectByPseudo = $this->db->prepare("select * from CONTENT");
        $selectByPseudo->execute();

        return $selectByPseudo->fetchAll();
    }

    public function selectContentById($idContent) {
        $selectByPseudo = $this->db->prepare("select * from CONTENT where content_id= :idContent");
        $selectByPseudo->bindValue('idContent', $idContent, PDO::PARAM_INT);
        $selectByPseudo->execute();

        return $selectByPseudo->fetch();
    }

    public function deleteContentById($idContent) {
        $selectByPseudo = $this->db->prepare("delete from CONTENT where content_id= :idContent");
        $selectByPseudo->bindValue('idContent', $idContent, PDO::PARAM_INT);
        $selectByPseudo->execute();

        return $selectByPseudo->fetch();
    }
}



