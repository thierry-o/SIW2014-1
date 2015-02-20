<?php
//chargement de la bibliotheque de conversion
require('F:\LICENCE_INFO\logiciels\xampp\htdocs\SIW2014-1\app\Classes\fpdf17\fpdf.php');
//definition des fonctions
class PDF extends FPDF
{
	// En-tête
	function Header()
	{
		// Police Arial gras 15
		$this->SetFont('Arial','B',15);
		// Décalage à droite
		$this->Cell(45);
		// Titre
		$this->Cell(100,10,'Fichier : '.Input::get('fichier'),1,0,'C');
		// Saut de ligne
		$this->Ln(20);
	}

	// Pied de page
	function Footer()
	{
		// Positionnement à 1,5 cm du bas
		$this->SetY(-15);
		// Police Arial italique 8
		$this->SetFont('Arial','I',8);
		// Numéro de page
		$this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
		
	}
	// Chargement des données
	function LoadData($file)
	{
		// Lecture des lignes du fichier
		$lines = file($file);
		$data = array();
		foreach($lines as $line)
			$data[] = explode(',',trim($line));
		return $data;
	}
	// Tableau coloré
	function FancyTable($header, $data)
	{
		// Couleurs, épaisseur du trait et police grasse
		$this->SetFillColor(128,128,128);
		$this->SetTextColor(255);
		$this->SetDrawColor(128,128,128);
		$this->SetLineWidth(.3);
		$this->SetFont('','B');
		//calcul de la largeur des colonnes
		$nbCol=count($header);
		$largeurTableau=190;
		$w =(int) $largeurTableau/$nbCol;
		// En-tête
		for($i=0;$i<$nbCol;$i++)
			$this->Cell($w,7,$header[$i],1,0,'C',true);
		$this->Ln();
		// Restauration des couleurs et de la police
		$this->SetFillColor(224,235,255);
		$this->SetTextColor(0);
		$this->SetFont('');
		// Données
		$fill = false;
		$numligne=0;
		foreach($data as $row)
		{
			if ($numligne>2)
			{
				for ($i=0; $i<$nbCol;$i++)
				{
					$this->Cell($w,6,$row[$i],'LR',0,'L',$fill);
				}
				$this->Ln();
				$fill = !$fill;
			}
			$numligne++;
		}
		// Trait de terminaison
		$this->Cell($largeurTableau,0,'','T');
	}
}

class CreePdfController extends BaseController {

    public function postCreePdf()
    {
		//initialisation du chemin
		$fichier=Input::get('dossier')."/".Input::get('fichier');
		//creation du fichier
		$pdf = new PDF();
		//pagination
		$pdf->AliasNbPages();
		// Chargement des données
		$data = $pdf->LoadData($fichier);
		// Titres des colonnes
		$header = $data[1];
		$pdf->SetFont('Arial','',14);
		$pdf->AddPage();
		$pdf->FancyTable($header,$data);
		//chemin de création du fichier provisoire
		$chemin="F:/LICENCE_INFO/logiciels/xampp/htdocs/SIW2014-1/app/".Input::get('fichier').".pdf";
		//creation du fichier provisoire
		$pdf->Output($chemin);
		//téléchargement du fichier
		return Response::download($chemin);
		//effacement du fichier provisoire
		unlink($chemin);
    }
}


