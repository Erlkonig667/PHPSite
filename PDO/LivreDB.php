<?php
require_once "Constantes.php";
require_once "metier/Livre.php";
require_once "MediathequeDB.php";

class LivreDB extends MediathequeDB
{
	private $db; // Instance de PDO
	public $lastId;

	public function __construct($db)
	{
		$this->db = $db;
	}
	/**
	 * 
	 * fonction d'Insertion de l'objet Livre en base de donnee
	 * @param Livre $l
	 */
	public function ajout(Livre $l)
	{
		$q = $this->db->prepare('INSERT INTO livre(titre,edition,information,auteur) values(:titre,:edition,:information,:auteur)');


		$q->bindValue(':titre', $l->getTitre());
		$q->bindValue(':edition', $l->getEdition());
		$q->bindValue(':information', $l->getInformation());
		$q->bindValue(':auteur', $l->getAuteur());

		$q->execute();
		$q->closeCursor();
		$q = NULL;
	}
	/**
	 * 
	 * fonction d'update de l'objet Livre en base de donnee
	 * @param Livre $l
	 */
	public function update(Livre $l)
	{
		try {
			$q = $this->db->prepare('UPDATE livre set titre=:t,edition=:e,information=:i,auteur=:a where id=:id');
			$q->bindValue(':t', $l->getTitre());
			$q->bindValue(':e', $l->getEdition());
			$q->bindValue(':i', $l->getInformation());
			$q->bindValue(':a', $l->getAuteur());
			$q->bindValue(':id', $l->getId());
			$q->execute();
			$q->closeCursor();
			$q = NULL;
		} catch (Exception $e) {
			throw new Exception(Constantes::EXCEPTION_DB_LIV_SELECT);
		}
	}
	/**
	 * 
	 * fonction de Suppression de l'objet Livre
	 * @param Livre $l
	 */
	public function suppression($id)
	{
		$q = $this->db->prepare('delete from livre where id=:ident');
		$q->bindValue(':ident', $id);
		$res = $q->execute();
		$q->closeCursor();
		$q = NULL;
		return $res;
	}
	/**
	 * 
	 * Fonction qui retourne toutes les livres
	 * @throws Exception
	 */
	public function selectAll()
	{
		$query = 'SELECT  id,titre,edition,information,auteur FROM livre';
		$q = $this->db->prepare($query);
		$q->execute();

		$arrAll = $q->fetchAll(PDO::FETCH_ASSOC);

		//si pas de livre
		if (empty($arrAll)) {
			throw new Exception(Constantes::EXCEPTION_DB_LIV_SELECT);
		}

		$result = $arrAll;
		$q->closeCursor();
		$q = NULL;
		return $result;
	}
	public function selectLivre($id)
	{
		$query = 'SELECT id,titre,edition,information,auteur FROM livre  WHERE id= :id ';
		$q = $this->db->prepare($query);
		$q->bindValue(':id', $id);
		$q->execute();
		$arrAll = $q->fetch(PDO::FETCH_ASSOC);
		if (empty($arrAll)) {
			throw new Exception(Constantes::EXCEPTION_DB_LIV_SELECT);
		}
		$result = $arrAll;
		$q->closeCursor();
		$q = NULL;
		$res = $this->convertPdoLiv($result);
		return $res;
	}
	/**
	 * 
	 * Fonction qui convertie un PDO Livre en objet Livre
	 * @param $pdoLivr
	 * @throws Exception
	 */
	public function convertPdoLiv($pdoLivr)
	{
		if(empty($pdoLivr)){
			throw new Exception(Constantes::EXCEPTION_DB_CONVERT_LIVR);
		}
		try {
		$obj=(object)$pdoLivr;
		$id= (int)$obj->id;
		$t= (int)$obj->titre;
		$e= (int) $obj->edition;
		$info=$obj->information;
		$a = $obj->auteur;
		$livr=new Livre($t,$e,$info,$a);
		//affectation de l'id pers
		$livr->setId($id);
		return $livr;	 
		}catch(Exception $e){
			throw new Exception(Constantes::EXCEPTION_DB_CONVERT_LIVR); 
		}
	}
}
