<?php
class Coba extends Fpdf {

    public function Footer()
    {
           $this->SetY(-40);
           $this->SetLeftMargin(20);
           $this->Ln(1);
           $this->SetLineWidth(1,5);
           $this->Line(20,555,820,555);
		   $this->SetFont('Arial','I',6);
		   $this->Cell(400,10,'Print at '.date('d/m/Y').' | &copy;  CBN Internship',0,0,'L');
		   $this->Cell(400,10,'Page '.$this->PageNo().' from {nb}',0,0,'R'); 
    }
}

	$pdf = new Coba('L', 'pt', 'A4'); 
	$pdf->SetTitle($title);
	$pdf->AliasNbPages();
	$pdf->SetTopMargin(30);
	$pdf->SetLeftMargin(20);
	$pdf->SetRightMargin(20);
	$pdf->SetAutoPageBreak(true, 50);

	$pdf->AddPage();
	$pdf->Image('./logo/cbn-logo.png',32,25,35);
	$pdf->SetFont('Times','B',16);
	$pdf->Cell(70);
	$pdf->Cell(500,10,'PT. CYBERINDO ADITAMA',0,0,'L');
	$pdf->Ln(14);
	$pdf->SetFont('Times','',14);
	$pdf->Cell(70);
	$pdf->Cell(500,10,'C B N  I N T E R N S H I P',0,0,'L');
	$pdf->Ln(14);
	$pdf->Cell(70);
	$pdf->SetFont('Times','I',9);
	$pdf->Cell(500,10,'Jalan H.R Rasuna Said Blok X5 No. 13 Jakarta Selatan - 12950',0,0,'L');
	$pdf->SetLineWidth(1);
	$pdf->Line(20,72,820,72);
	$pdf->SetLineWidth(1,5);
	$pdf->Line(20,74,820,74);

	

	$pdf->SetY(120);
	$pdf->SetFont('Times', 'BU', 13);
	$pdf->Cell(0,10,$title,0,0,'C');
	$pdf->Ln(25);


	$pdf->SetFont('Times','B',10);
	$pdf->SetLineWidth(1,5);
	$pdf->SetFillColor(252,255,189);
	$pdf->Cell(20 ,50, "No",1, "LR", "C", true);
	$pdf->Cell(100 ,15, "User ID" ,1 ,"LR", "C", true);
	$pdf->Cell(100 ,15, "Email" ,1 ,"LR", "C", true);
	$pdf->Cell(100 ,15, "Nama Lengkap" ,1 ,"LR", "C", true);
	$pdf->Cell(100 ,15, "Kontak" ,1 ,"LR", "C", true);
	$pdf->Cell(100 ,15, "Departemen" ,1 ,"LR", "C", true);
	$pdf->Cell(100, 15, "Hak Akses", 1, "LR", "C", true);
	if (!empty($dMaster)) {
		$pdf->SetLeftMargin(20);
		$pdf->Ln();
		$no = 0;
		$curY=$pdf->GetY();
		$curN = 0;
		//$akhir = 0;
		foreach ($dMaster as $key) {
			$no++;
			$yAwal = $pdf->GetY();
			$xAwal = $pdf->GetX();
			$pdf->SetFont('Times','',8);
			$pdf->SetXY($pdf->GetX(), $curY);
			$pdf->Cell(20  ,15, $no.".",'LRT', 0, "C");
			$pdf->SetXY($pdf->GetX(), $curY);
			$pdf->MultiCell(100,15,$key->adminID,'LRT', 'C');
			$pdf->SetXY($pdf->GetX()+120, $curY);
			$pdf->MultiCell(100,15,$key->emaiL,'LRT', 'C');
			$pdf->SetXY($pdf->GetX()+220, $curY);
			$pdf->MultiCell(100,15,$key->fullName,'LRT', 'C');
			$pdf->SetXY($pdf->GetX()+320, $curY);
			$pdf->MultiCell(100,15,$key->telePhone,'LRT', 'C');
			$curA=$pdf->GetY();
			$pdf->SetXY($pdf->GetX()+420, $curY);
			$pdf->MultiCell(100,15,name_dept($key->deptID),'LRT', 'C');
			$curB=$pdf->GetY();
			$pdf->SetXY($pdf->GetX()+520, $curY);
			$pdf->MultiCell(100,15,what_role($key->roleID),'LRT', 'C');

			$curC=$pdf->GetY();
			$pdf->SetXY($pdf->GetX()+770, $curY);

			if (($curA >= $curB) && ($curA >= $curC)){
				$curN = $curA;
			}else if (($curB >= $curA) && ($curB >= $curC)){
				$curN = $curB;
			}else if (($curC >= $curA) && ($curC >= $curB)){
				$curN = $curC;
			}else{
				$curN = $curA;
			}

			$pdf->SetLeftMargin(20);
			$pdf->SetLineWidth(1);
			$pdf->Line($xAwal,$yAwal,$xAwal,$curN);
			$pdf->Line($xAwal+20,$yAwal,$xAwal+20,$curN);
			$pdf->Line($xAwal+120,$yAwal,$xAwal+120,$curN);
			$pdf->Line($xAwal+220,$yAwal,$xAwal+220,$curN);
			$pdf->Line($xAwal+320,$yAwal,$xAwal+320,$curN);
			$pdf->Line($xAwal+420,$yAwal,$xAwal+420,$curN);
			$pdf->Line($xAwal+520,$yAwal,$xAwal+520,$curN);
			$pdf->Line($xAwal+620,$yAwal,$xAwal+620,$curN);
			$pdf->Line($xAwal,$curN,$xAwal+620,$curN);
			if ($curN >= 500){
				$pdf->AddPage();
				$pdf->SetLeftMargin(20);
				$pdf->SetRightMargin(20);
				$curY = 40;
				$yAwal = 40;
			}else{
				$curY = $curN;
			}
			$pdf->Ln();
		}
	}else{
		$pdf->Ln();
		$pdf->MultiCell(620,20,"Maaf Data Masih Kosong !",1, 'C');
	}

	$pdf->Output($title.date('dFY').'.pdf','I');


?>