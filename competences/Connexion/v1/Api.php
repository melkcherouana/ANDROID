<?php
require_once '../includes/DbOperation.php';

function isTheseParametersAvailable($params)
	{
	$available = true;
	$missingparams = "";
	foreach($params as $param)
		{
		if (!isset($_POST[$param]) || strlen($_POST[$param]) <= 0)
			{
			$available = false;
			$missingparams = $missingparams . ", " . $param;
			}
		}

	if (!$available)
		{
		$response = array();
		$response['error'] = true;
		$response['message'] = 'Parameters ' . substr($missingparams, 1, strlen($missingparams)) . ' missing';
		echo json_encode($response);
		die();
		}
	}

$response = array();

if (isset($_GET['apicall']))
	{
	switch ($_GET['apicall'])
		{
	case 'createnom':
		isTheseParametersAvailable(array(
			'nom',
			'classe'
		));

		$db = new DbOperation();
		$result = $db->createEleve($_POST['nom'], $_POST['classe']);
		if ($result)
			{
			$response['error'] = false;
			$response['message'] = 'Elève ' . $_POST['nom'] . ' classe ' . $_POST['classe'] . ' ajouté';
			$response['heroes'] = $db->getClasses();
			}
		  else
			{
			$response['error'] = true;
			$response['message'] = 'Erreur de création d un élève';
		
			}
		break;
		
			case 'createdate':
		isTheseParametersAvailable(array(
			'date1',
			'date2',
			'classeSelect',
			'periodeSelect'
		));

		$db = new DbOperation();
		$result = $db->createPeriodes($_POST['date1'], $_POST['date2'], $_POST['classeSelect'], $_POST['periodeSelect']);
		if ($result)
			{
			$response['error'] = false;
			$response['message'] = 'Dates ' . $_POST['date1'] . ' et ' . $_POST['date2'] . ' ajoutées';
			}
		  else
			{
			$response['error'] = true;
			$response['message'] = 'Erreur de création des dates';
		
			}
		break;


	case 'createeval':
		isTheseParametersAvailable(array(
			'critere',
			'eval',
			'date',
			'nom',
			'matiere',
			'classe'
		));

		// creating a new dboperation object

		$db = new DbOperation();

		// creating a new record in the database

		$result = $db->createEval($_POST['critere'], $_POST['eval'], $_POST['date'], $_POST['nom'], $_POST['matiere'], $_POST['classe']);
		break;

	case 'createcritere':
		isTheseParametersAvailable(array(
			'matiere',
			'critere'
		));
		$db = new DbOperation();
		$result = $db->createCritere($_POST['matiere'], $_POST['critere']);
		if ($result)
			{
			$response['error'] = false;
			$response['message'] = 'Critère ' . $_POST['critere'] . ' matière ' . $_POST['matiere'] . ' ajouté';
			$response['heroes'] = $db->getMatieres();
			}
		  else
			{
			$response['error'] = true;
			$response['message'] = 'Erreur de création du critère';
			}

		break;

	case 'creatematiere':
		isTheseParametersAvailable(array(
			'matiere'
		));
		$db = new DbOperation();
		$result = $db->createMatiere($_POST['matiere']);

		// if the record is created adding success to response

		if ($result)
			{
			$response['error'] = false;
			$response['message'] = 'Matière ' . $_POST['matiere'] . ' ajoutée';
			$response['heroes'] = $db->getMatieres();
			}
		  else
			{
			$response['error'] = true;
			$response['message'] = 'Erreur de création de la matière';
			}

		break;

	case 'createhero':
		isTheseParametersAvailable(array(
			'name'
		));
		$db = new DbOperation();
		$result = $db->createHero($_POST['name']);

		// if the record is created adding success to response

		if ($result)
			{
			$response['error'] = false;
			$response['message'] = 'Classe ' . $_POST['name'] . ' ajoutèe';
			$response['heroes'] = $db->getClasses();
			}
		  else
			{
			$response['error'] = true;
			$response['message'] = 'Erreur création classe';
			}

		break;
		
		
		case 'deleteuneevaluation':
		$db = new DbOperation();
		$result = $db->deleteEvaluationParId($_POST['id']);
		if ($result)
			{
			$response['error'] = false;
			$response['message'] = 'Enregristrement ' . $_POST['id'] . ' supprimé';
			}
		  else
			{
			$response['error'] = true;
			$response['message'] = 'Echec de la suppression';
			}
		break;
		
		case 'deleteperiode':
		$db = new DbOperation();
		$result = $db->deletePeriode($_POST['periode'], $_POST['classe']   );
		if ($result)
			{
			$response['error'] = false;
			$response['message'] = 'Période '. $_POST['periode'].' de la classe '.$_POST['classe'].' supprimée';
			}
		  else
			{
			$response['error'] = true;
			$response['message'] = 'Echec de la suppression';
			}
		break;
		
		case 'deletecritere':
		$db = new DbOperation();
		$result = $db->deleteCritere($_POST['choix']);
		break;
		
		case 'deletecriterematiere':
		$db = new DbOperation();
		$result = $db->deleteCritereMatiere($_POST['choix']);
		break;
		case 'deletecritereevaluation':
		$db = new DbOperation();
		$result = $db->deleteCritereEvaluation($_POST['choix']);
		break;
		
		case 'deletematiere':
		$db = new DbOperation();
		$result = $db->deleteMatiere($_POST['choix']);
		break;
		
		case 'deletematierecritere':
		$db = new DbOperation();
		$result = $db->deleteMatiereCritere($_POST['choix']);
		break;
		case 'deletematiereevaluation':
		$db = new DbOperation();
		$result = $db->deleteMatiereEvaluation($_POST['choix']);
		break;
		
		case 'deleteeleveclasse':
		$db = new DbOperation();
		$result = $db->deleteEleveClasse($_POST['nomSuppr']);
		$response['error'] = false;
		$response['message'] = 'Classe ' . $_POST['nomSuppr'] .' retirée des bases';
	
		break;
		
		case 'deleteevaluationclasse':
		$db = new DbOperation();
		$result = $db->deleteEvaluationClasse($_POST['nomSuppr']);
		$response['error'] = false;
		$response['message'] = 'Classe ' . $_POST['nomSuppr'] .' retirée des bases';
	
		break;
		
		case 'deleteclasse':
		$db = new DbOperation();
		$result = $db->deleteClasse($_POST['nomSuppr']);
		$response['error'] = false;
		$response['message'] = 'Classe ' . $_POST['nomSuppr'] .' retirée des bases';
	
		break;
		
		case 'deleteeleve':
		$db = new DbOperation();
		$result = $db->deleteEleve($_POST['nomSuppr']);
		$response['error'] = false;
		$response['message'] = 'Elève ' . $_POST['nomSuppr'] .' retiré des bases';
	
		break;
		
		case 'deleteevaluation':
		$db = new DbOperation();
		$result = $db->deleteEvaluation($_POST['nomSuppr']);
		$response['error'] = false;
		$response['message'] = 'Evaluations' . $_POST['nomSuppr'] .' retirées des bases';
	
		break;

	case 'getclasses':
		$db = new DbOperation();
		$response['error'] = false;
		$response['message'] = 'Lecture table classes';
		$response['heroes'] = $db->getClasses();
		break;
		
	case 'getperiodes':
		$db = new DbOperation();
		$response['error'] = false;
		$response['message'] = 'Lecture table périodes';
		$response['heroes'] = $db->getPeriodes();
		break;
		
	case 'getperiodeclasse':
		$db = new DbOperation();
		$response['error'] = false;
		$response['message'] = 'Lecture table périodes';
		$response['heroes'] = $db->getPeriodeClasse($_POST['classe']);
		break;

	case 'getmatieres':
		$db = new DbOperation();
		$response['error'] = false;
		$response['message'] = 'Lecture table matières';
		$response['heroes'] = $db->getMatieres();
		break;

	case 'updateuneevaluation':
		isTheseParametersAvailable(array(
			'id',
			'eval',
			'date'
		));
		$db = new DbOperation();
		$result = $db->updateEvaluation($_POST['id'], $_POST['eval'], $_POST['date']);
		if ($result)
			{
			$response['error'] = false;
			$response['message'] = 'Mise à jour réussie';
			$response['heroes'] = $db->getMatieres();
			}
		  else
			{
			$response['error'] = true;
			$response['message'] = 'Une erreur est survenue';
			}

		break;
		case 'geteleves':
				isTheseParametersAvailable(array('classe'));	
				$db = new DbOperation();
				$response['error'] = false; 
				$response['message'] = 'Lecture table eleves';
				$response['heroes'] = $db->getEleves($_POST['classe']);
				
				break;
		
		case 'getevaluations':
		isTheseParametersAvailable(array(
			'classe','eleveName'
		));
		$db = new DbOperation();
		$response['error'] = false;
		$response['message'] = 'Lecture table évaluations';
		$response['heroes'] = $db->getEvaluations($_POST['classe'],$_POST['eleveName']);
		break;
		
		case 'getperiodeevaluations':
		isTheseParametersAvailable(array(
			'periode','classe'
		));
		$db = new DbOperation();
		$response['error'] = false;
		$response['message'] = 'Lecture table évaluations';
		$response['heroes'] = $db->getPeriodeEvaluations($_POST['periode'],$_POST['classe']);
		break;
		
		
		case 'gettoutesevaluations':
		isTheseParametersAvailable(array(
			'classe'
		));
		$db = new DbOperation();
		$response['error'] = false;
		$response['message'] = 'Lecture table évaluations';
		$response['heroes'] = $db->getToutesEvaluations($_POST['classe']);
		break;
		
				case 'getperiodeevaluations':
		isTheseParametersAvailable(array('periode',
			'classe' 
		));
		$db = new DbOperation();
		$response['error'] = false;
		$response['message'] = 'Lecture table évaluations';
		$response['heroes'] = $db->getPeriodeEvaluations($_POST['classe']);
		break;
		
		
		
		
		case 'getuneevaluation':
		isTheseParametersAvailable(array(
			'id'
		));
		$db = new DbOperation();
		$response['error'] = false;
		$response['message'] = 'Lecture table évaluations';
		$response['heroes'] = $db->getUneEvaluation($_POST['id']);
		break;

	case 'getcriteres':
		$db = new DbOperation();
		$response['error'] = false;
		$response['message'] = 'Lecture table critères';
		$response['heroes'] = $db->getCriteres();
		break;

		// the delete operation

	case 'deletehero':

		// for the delete operation we are getting a GET parameter from the url having the id of the record to be deleted

		if (isset($_GET['id']))
			{
			$db = new DbOperation();
			if ($db->deleteHero($_GET['id']))
				{
				$response['error'] = false;
				$response['message'] = 'Hero deleted successfully';
				$response['heroes'] = $db->getHeroes();
				}
			  else
				{
				$response['error'] = true;
				$response['message'] = 'Some error occurred please try again';
				}
			}
		  else
			{
			$response['error'] = true;
			$response['message'] = 'Nothing to delete, provide an id please';
			}

		break;
		}
	}
  else
	{

	// if it is not api call
	// pushing appropriate values to response array

	$response['error'] = true;
	$response['message'] = 'Erreur appel API';
	}

// displaying the response in json structure

echo json_encode($response);