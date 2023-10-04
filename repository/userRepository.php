<?php

class User {
    private $db;

    public function __construct($db){
        $this->db = $db;
    }

    public function insertUser($pseudo, $email, $password, $nom, $prenom, $shortDesc) {
        $r = true;
        if (self::selectUserByPseudo($pseudo) != null) {
            echo 'Utilisateur déjà créé';
            $r = false;
        } else {
            $insert = $this->db->prepare("insert  into  USER(pseudo, email, mdp,  nom,  prenom, short_desc) values (:pseudo, :email, :password, :nom, :prenom, :shortDesc)");
            $insert->bindValue('pseudo', $pseudo, PDO::PARAM_STR);
            $insert->bindValue('email', $email, PDO::PARAM_STR);
            $insert->bindValue('password', $password, PDO::PARAM_STR);
            $insert->bindValue('nom', $nom, PDO::PARAM_STR);
            $insert->bindValue('prenom', $prenom, PDO::PARAM_STR);
            $insert->bindValue('shortDesc', $shortDesc, PDO::PARAM_STR);
            $insert->execute();

            if ($insert->errorCode()!=0){
                print_r($insert->errorInfo());
                $r=false;
            }
            return $r;
        }        
    }

    public function selectUserByPseudo($pseudo) {
        $selectByPseudo = $this->db->prepare("select * from USER where pseudo= :pseudo");
        $selectByPseudo->bindValue('pseudo', $pseudo, PDO::PARAM_STR);
        $selectByPseudo->execute();

        return $selectByPseudo->fetch();
    }
}



