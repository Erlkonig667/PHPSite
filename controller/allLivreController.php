<?php
class allLivreController
{

    public function __construct()
    {      
        session_start();
        error_reporting(0);
        include_once "controller/Controller.php";
        include_once "vue/vueListeLivres.php";
        require_once "metier/Livre.php";
        require_once "PDO/LivreDB.php";
        require_once "PDO/connectionPDO.php";
        require_once "Constantes.php";


        if(Controller::auth()) {
            try {
                
                $livreBDD = new LivreDB($pdo);
                $res = $livreBDD->selectAll();

                //Encodage au format json
            }catch(Exception $e){
                throw new exception(Constantes::EXCEPTION_DB_LIVRE);
            }
            
            $v=new vueListeLivres();
            $v->affiche(json_encode($res));
        }

        else
        {
            header('Location: index.php?error=login');
        }

    }
}
        
