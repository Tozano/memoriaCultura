<?php

    function verifMail($email) {
        if(empty($email)) {
            echo 'L\'email est vide';
            return false;
        }
        if(filter_var($email, FILTER_VALIDATE_EMAIL) == false) {
            echo 'L\'email est incorrect';
            return false;
        }
        return true;
    }

    function verifPassword($password, $passwordConf) {
        if (empty($password)) {
            echo 'Le mdp est vide';
            return false;
        }
        if (strlen($password) < 8) {
            echo 'Le mdp fait moins de 8 charactères';
            return false;
        }
        if (!preg_match('#[a-z]+#', $password)) {
            echo 'Il manque une minuscule au mdp';
            return false;
        }
        if (!preg_match('#[A-Z]+#', $password)) {
            echo 'Il manque une majuscule au mdp';
            return false;
        }
        if (!preg_match('#[0-9]+#', $password)) {
            echo 'Il manque un chiffre au mdp';
            return false;
        }
        if (!preg_match('#\W+#', $password)) {
            echo 'Il manque des charactères';
            return false;
        }
        if ($password != $passwordConf) {
            echo 'La confirmation du mdp est erronée';
            return false;
        }
        return true;
    }

    function verifChaine($chaine, $nomChaine) {
        if (empty($chaine)) {
            echo 'Le '.$nomChaine.' est vide';
            return false;
        }
        if (strlen($chaine)>50) {
            echo 'Le '.$nomChaine.' est trop long';
            return false;
        }
        if (preg_match('#[0-9]+#', $chaine)) {
            echo 'Le '.$nomChaine.' comporte au moins un chiffre';
            return false;
        }
        if (!preg_match('/^[a-zA-ZàÀâÂäÄéÉèÈêÊëËïÏîÎôÔöÖùÙûÛüÜÿŸçÇ]([a-zA-ZàÀâÂäÄéÉèÈêÊëËïÏîÎôÔöÖùÙûÛüÜÿŸçÇ]|([ -]|[\'])[a-zA-ZàÀâÂäÄéÉèÈêÊëËïÏîÎôÔöÖùÙûÛüÜÿŸçÇ])*$/', $chaine)) {
            echo 'Le '.$nomChaine.' comporte des caractère non reconnus';
            return false;
        }
        return true;
    }

    function verif($pseudo, $email, $password, $passwordConf, $nom, $prenom, $shortDesc) {
        if (!verifChaine($pseudo, 'pseudo')) {
            return false;
        }
        if (!verifMail($email)) {
            return false;
        }
        if (!verifPassword($password, $passwordConf)) {
            return false;
        }
        if (!verifChaine($nom, 'nom')) {
            return false;
        }
        if (!verifChaine($prenom, 'prénom')) {
            return false;
        }
        if (!verifChaine($shortDesc, 'courte description')) {
            return false;
        }
        return true;
    }


?>