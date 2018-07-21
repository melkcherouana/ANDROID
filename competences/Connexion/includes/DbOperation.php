<?php
 
class DbOperation
{
    //Database connection link
    private $con;
 
    //Class constructor
    function __construct()
    {
        //Getting the DbConnect.php file
        require_once dirname(__FILE__) . '/DbConnect.php';
 
        //Creating a DbConnect object to connect to the database
        $db = new DbConnect();
 
        //Initializing our connection link of this class
        //by calling the method connect of DbConnect class
        $this->con = $db->connect();
    }
	
	/*
	* The create operation
	* When this method is called a new record is created in the database
	*/
	function createHero($name){
		$stmt = $this->con->prepare("INSERT INTO classes (nomclasse) VALUES (?)");
		$stmt->bind_param("s", $name);
		if($stmt->execute())
			return true; 
		return false; 
	}
		function createMatiere($matiere){
		$stmt = $this->con->prepare("INSERT INTO matieres (matiere) VALUES (?)");
		$stmt->bind_param("s", $matiere);
		if($stmt->execute())
			return true; 
		return false; 
	}
	
		function createEleve($nom,$classe){
		$stmt = $this->con->prepare("INSERT INTO eleves (nomeleve,classe) VALUES (?,?)");
		$stmt->bind_param("ss", $nom,$classe);
		if($stmt->execute())
			return true; 
		return false; 
	}
	
		function createPeriodes($date1,$date2,$classeSelect,$periodeSelect){
		$stmt = $this->con->prepare("INSERT INTO periodes (date1,date2,classe,periode) VALUES (?,?,?,?)");
		$stmt->bind_param("ssss", $date1,$date2,$classeSelect,$periodeSelect);
		if($stmt->execute())
			return true; 
		return false; 
	}
	
			function createEval($critere,$eval,$date,$nom,$matiere,$classe){
		$stmt = $this->con->prepare("INSERT INTO eval (critere,eval,date,nom,matiere,classe) VALUES (?,?,?,?,?,?)");
		$stmt->bind_param("ssssss", $critere,$eval,$date,$nom,$matiere,$classe);
		if($stmt->execute())
			return true; 
		return false; 
	}
			function createCritere($matiere,$critere){
		$stmt = $this->con->prepare("INSERT INTO criteres (matiere,critere) VALUES (?,?)");
		$stmt->bind_param("ss", $matiere,$critere);
		if($stmt->execute())
			return true; 
		return false; 
	}
		/*	function createMatiere($matiere){
		$stmt = $this->con->prepare("INSERT INTO matiere (matiere) VALUES (?)");
		$stmt->bind_param("s", $matiere);
		if($stmt->execute())
			return true; 
		return false; 
	}*/

	/*
	* The read operation
	* When this method is called it is returning all the existing record of the database
	*/
	function getClasses(){
		$stmt = $this->con->prepare("SELECT id, nomclasse FROM classes order by nomclasse");
		$stmt->execute();
		$stmt->bind_result($id, $nomclasse);
		$classes = array(); 
		while($stmt->fetch()){
			$classe  = array();
			$classe['id'] = $id; 
			$classe['nomclasse'] = $nomclasse; 
			array_push($classes, $classe); 
		}
		return $classes; 
	}
	
		function getPeriodes(){
		$stmt = $this->con->prepare("SELECT id, date1, date2, classe, periode FROM periodes order by classe");
		$stmt->execute();
		$stmt->bind_result($id, $date1, $date2, $nomclasse,$nomperiode);
		$periodes = array(); 
		while($stmt->fetch()){
			$periode  = array();
			$periode['id'] = $id; 
			$periode['date1'] = $date1; 
			$periode['date2'] = $date2; 
			$periode['classe'] = $nomclasse; 
			$periode['periode'] = $nomperiode; 
			array_push($periodes, $periode); 
		}
		return $periodes; 
	}
	
		function getPeriodeClasse($classe){
		$stmt = $this->con->prepare("SELECT id, date1, date2, classe, periode FROM periodes  WHERE classe = ? ");
			$stmt->bind_param("s", $classe);
			$stmt->execute();
			$stmt->bind_result($id, $date1, $date2, $nomclasse,$nomperiode);
			//$stmt->fetch();
		$periodes = array(); 		
		while($stmt->fetch()){
			$periode  = array();
				$periode['id'] = $id; 
			$periode['date1'] = $date1; 
			$periode['date2'] = $date2; 
			$periode['classe'] = $nomclasse; 
			$periode['periode'] = $nomperiode; 
			array_push($periodes, $periode); 
		}
		return $periodes; 
	}
	
		function getPeriodeEvaluations($periode, $classe){
		$stmt = $this->con->prepare("SELECT id, date1, date2, classe, periode FROM periodes  WHERE periode =? and classe = ?");
			$stmt->bind_param("ss", $periode, $classe);
			$stmt->execute();
			$stmt->bind_result($id, $date1, $date2, $nomclasse,$nomperiode);
			//$stmt->fetch();
		$periodes = array(); 		
		while($stmt->fetch()){
			$periode  = array();
				$periode['id'] = $id; 
			$periode['date1'] = $date1; 
			$periode['date2'] = $date2; 
			$periode['classe'] = $nomclasse; 
			$periode['periode'] = $nomperiode; 
			array_push($periodes, $periode); 
		}
		return $periodes; 
	}
	

	
		function getCriteres(){
		$stmt = $this->con->prepare("SELECT id, matiere, critere FROM criteres order by matiere, critere");
		$stmt->execute();
		$stmt->bind_result($id, $nommatiere, $nomcritere);		
		$criteres = array(); 		
		while($stmt->fetch()){
			$critere  = array();
			$critere['id'] = $id; 
			$critere['matiere'] = $nommatiere; 
			$critere['critere'] = $nomcritere; 
			array_push($criteres, $critere); 
		}
		return $criteres; 
	}
	
function getMatieres(){
		$stmt = $this->con->prepare("SELECT id, matiere FROM matieres");
		$stmt->execute();
		$stmt->bind_result($id, $nommatiere);
		
		$matieres = array(); 
		
		while($stmt->fetch()){
			$matiere  = array();
			$matiere['id'] = $id; 
			$matiere['matiere'] = $nommatiere; 
			array_push($matieres, $matiere); 
		}
		return $matieres; 
	}
	

	/*
	* The update operation
	* When this method is called the record with the given id is updated with the new given values
	*/
	function updateEvaluation($id, $eval, $date){
	     $eval= intval($eval); 
		$stmt = $this->con->prepare("UPDATE eval SET eval = ?, date = ? WHERE id = ?");
		$stmt->bind_param("ssi", $eval, $date,$id);
		if($stmt->execute())
			return true; 
		return false; 
	}
	
	
	/*
	* The delete operation
	* When this method is called record is deleted for the given id 
	*/
	
	function getEleves($classe){
		$stmt = $this->con->prepare("SELECT nomeleve,classe FROM eleves  WHERE classe = ? order by nomeleve");
			$stmt->bind_param("s", $classe);
			$stmt->execute();
			$stmt->bind_result( $nomeleve,$classe);
			//$stmt->fetch();
		$eleves = array(); 		
		while($stmt->fetch()){
			$eleve  = array();
			$eleve['classe'] = $classe; 
			$eleve['nomeleve'] = $nomeleve; 			
			array_push($eleves, $eleve); 
		}
		return $eleves; 
	}
	
	function getEvaluations($classe, $nomSelect){
			$stmt = $this->con->prepare("SELECT id, critere, eval, date, matiere FROM eval  WHERE classe = ? and nom = ? order by matiere, critere, date");
		$stmt->bind_param("ss", $classe, $nomSelect);
		
			$stmt->execute();
			$stmt->bind_result($id, $critere, $eval, $date, $matiere);
		$evaluations = array(); 		
		while($stmt->fetch()){
			$evaluation  = array();
				$evaluation['id'] = $id;
			$evaluation['critere'] = $critere;
			$evaluation['eval'] = $eval;
			$evaluation['date'] = $date;
			$evaluation['matiere'] = $matiere;
			array_push($evaluations, $evaluation); 
		}
		return $evaluations; 
	}
	
		function getToutesEvaluations($classe){
			$stmt = $this->con->prepare("SELECT id, critere, eval, date, nom, matiere, classe  FROM eval WHERE classe = ? order by nom, matiere, critere, date");
		$stmt->bind_param("s", $classe);
		
			$stmt->execute();
			$stmt->bind_result($id, $critere, $eval, $date, $nom, $matiere,$nomclasse);
		$evaluations = array(); 		
		while($stmt->fetch()){
			$evaluation  = array();
				$evaluation['id'] = $id;
			$evaluation['critere'] = $critere;
			$evaluation['eval'] = $eval;
			$evaluation['date'] = $date;
			$evaluation['nom'] = $nom;
			$evaluation['matiere'] = $matiere;
			$evaluation['classe'] = $nomclasse;
			array_push($evaluations, $evaluation); 
		}
		return $evaluations; 
	}
	
	
	
	
		function getUneEvaluation($idchoisi){
		   $idchoix= intval($idchoisi); 
			$stmt = $this->con->prepare("SELECT id, critere, eval, date, matiere,classe, nom FROM eval  WHERE id = ? ");
		$stmt->bind_param("i", $idchoix);
			$stmt->execute();
			$stmt->bind_result($id, $critere, $eval, $date, $matiere, $classe,$nom);
		$evaluations = array(); 		
		while($stmt->fetch()){
			$evaluation  = array();
				$evaluation['id'] = $id;
			$evaluation['critere'] = $critere;
			$evaluation['eval'] = $eval;
			$evaluation['date'] = $date;
			$evaluation['matiere'] = $matiere;
			$evaluation['classe'] = $classe;
			$evaluation['nom'] = $nom;
			array_push($evaluations, $evaluation); 
		}
		return $evaluations; 
	}
	
		function deleteEleve($nomSuppr){
		$stmt = $this->con->prepare("DELETE FROM eleves WHERE nomeleve = ? ");
		$stmt->bind_param("s", $nomSuppr);
		if($stmt->execute())
			return true; 
		
		return false; 
	}
	
		
		function deleteEvaluation($nomSuppr){
		$stmt = $this->con->prepare("DELETE FROM eval WHERE nom = ? ");
		$stmt->bind_param("s", $nomSuppr);
		if($stmt->execute())
			return true; 
		
		return false; 
	}
	
			function deletePeriode($periode, $classe){
		$stmt = $this->con->prepare("DELETE FROM periodes WHERE periode = ?  and classe = ?");
		$stmt->bind_param("ss", $periode,$classe);
		if($stmt->execute())
			return true; 
		
		return false; 
	}
	
			
		function deleteEvaluationParId($id){
		$stmt = $this->con->prepare("DELETE FROM eval WHERE id = ? ");
		$stmt->bind_param("i", $id);
		if($stmt->execute())
			return true; 
		
		return false; 
	}
	
	
		function deleteClasse($nomSuppr){
		$stmt = $this->con->prepare("DELETE FROM classes WHERE nomclasse = ? ");
		$stmt->bind_param("s", $nomSuppr);
		if($stmt->execute())
			return true; 
		
		return false; 
	}
	
		function deleteEvaluationClasse($nomSuppr){
		$stmt = $this->con->prepare("DELETE FROM eval WHERE classe = ? ");
		$stmt->bind_param("s", $nomSuppr);
		if($stmt->execute())
			return true; 
		
		return false; 
	}
	
		function deleteEleveClasse($nomSuppr){
		$stmt = $this->con->prepare("DELETE FROM eleves WHERE classe = ? ");
		$stmt->bind_param("s", $nomSuppr);
		if($stmt->execute())
			return true; 
		
		return false; 
	}
	
		function deleteMatiere($choix){
		$stmt = $this->con->prepare("DELETE FROM matieres WHERE matiere = ? ");
		$stmt->bind_param("s", $choix);
		if($stmt->execute())
			return true; 
		
		return false; 
	}
	
	
		function deleteMatiereCritere($choix){
		$stmt = $this->con->prepare("DELETE FROM criteres WHERE matiere = ? ");
		$stmt->bind_param("s", $choix);
		if($stmt->execute())
			return true; 
		
		return false; 
	}
	
	
		function deleteMatiereEvaluation($choix){
		$stmt = $this->con->prepare("DELETE FROM eval WHERE matiere = ? ");
		$stmt->bind_param("s", $choix);
		if($stmt->execute())
			return true; 
		
		return false; 
	}
	
		function deleteCritere($choix){
		$stmt = $this->con->prepare("DELETE FROM criteres WHERE critere = ? ");
		$stmt->bind_param("s", $choix);
		if($stmt->execute())
			return true; 
		
		return false; 
	}
	
		function deleteCritereEvaluation($choix){
		$stmt = $this->con->prepare("DELETE FROM eval WHERE critere = ? ");
		$stmt->bind_param("s", $choix);
		if($stmt->execute())
			return true; 
		
		return false; 
	}
	
	function deleteHero($id){
		$stmt = $this->con->prepare("DELETE FROM heroes WHERE id = ? ");
		$stmt->bind_param("i", $id);
		if($stmt->execute())
			return true; 
		
		return false; 
	}
}