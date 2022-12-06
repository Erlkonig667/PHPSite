<?php
use TheSeer\Tokenizer\Exception;
class validLivreController
{

    public function __construct()
    {    
        session_start();
        error_reporting(0);
        require_once "controller/controller.php";
        require_once "vue/vueValidCompte.php";
        require_once "metier/Livre.php";
        require_once "PDO/LivreDB.php";
        require_once "PDO/connectionPDO.php";
        require_once "Constantes.php";

        $nom = $_POST['nom'] ?? null;
        $auteur = $_POST['auteur'] ?? null;
        $edition = $_POST['edition'] ?? null;
        $info = $_POST['info'] ?? null;

        $operation = $_GET['operation'] ?? null;

        if (Controller::auth()){
            if($operation=="insert") {
                try {
                    $accesLivreBDD = new LivreDB($pdo);
                    $livre = new Livre($nom, $edition, $info, $auteur);
                    $accesLivreBDD->ajout($livre);
                    echo "Votre livre a bien été ajouté.";
                }catch(Exception $e){
                    throw new Exception(Constantes::EXCEPTION_DB_LIVR_INSERT);
                }
            }
            else {
                //erreur on renvoit à la page d'accueil
                header('Location: accueil.php?id='.$_SESSION["token"]);
            }
        }
    }
    
}