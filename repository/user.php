<?php

    function insertUtilisateur($db, $pseudo, $email, $password, $nom, $prenom, $shortDesc) {
        $r = true;
        if (selectByEmail($db, $email) != null) {
            echo 'Utilisateur déjà créé';
            $r = false;
        } else {
            $insert = $db->prepare("insert  into  utilisateur(pseudo, email,  password,  nom,  prenom, shortDesc) values (:pseudo, :email, :mdp, :nom, :prenom, :shortDesc)");
            $insert->bindValue('pseudo', $pseudo, PDO::PARAM_STR);
            $insert->bindValue('email', $email, PDO::PARAM_STR);
            $insert->bindValue('mdp', $password, PDO::PARAM_STR);
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

    function selectUserByPseudo($db, $pseudo) {
        $selectByPseudo = $db->prepare("select * from utilisateur where pseudo= :pseudo");
        $selectByPseudo->bindValue('pseudo', $pseudo, PDO::PARAM_STR);
        $selectByPseudo->execute();
        return $selectByPseudo->fetch();
    }
