<?php
    function utilisateurModifControleur($twig, $db){
        $form = array();
        if(isset($_GET['id'])){
            $utilisateur = new Utilisateur($db);
            $unUtilisateur = $utilisateur->selectById($_GET['id']);
            if ($unUtilisateur!=null){
                $form['utilisateur'] = $unUtilisateur;
            } else{
                $form['message'] = 'Utilisateur incorrect';
            }
        } else{
            if(isset($_POST['btModifier'])){
                $utilisateur = new Utilisateur($db);
                $nom = $_POST['nom'];
                $prenom = $_POST['prenom'];
                $prenom = $_POST['service'];
                $prenom = $_POST['disponibilite'];
                $id = $_POST['id'];
                $exec=$utilisateur->update($id, $nom, $prenom, $service, $disponibilite);
                if(!$exec){
                    $form['valide'] = false;
                    $form['message'] = 'Echec de la modification';
                } else {
                    $form['valide'] = true;
                    $form['message'] = 'Modification réussie';
                }
            } else {
                $form['message'] = 'Utilisateur non précisé';
            }
        }
        echo $twig->render('medecin.html.twig', array('form'=>$form));
    }