<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
    require_once APPPATH."third_party/FPDF/fpdf.php";


	class PdfI extends FPDF {
		public function __construct() {
			parent::__construct();
		}
		public function Header()
		{
		$unidad = (isset($_POST['unidad'])) ? $_POST['unidad'] : '';
		$generadora = (isset($_POST['generadora'])) ? $_POST['generadora'] : '';
		$this->AddFont('Panton-Bold','B','Panton-Bold.php');
        $this->AddFont('Panton-Regular','', 'Panton-Regular.php');
        $this->SetFont('Panton-Bold','B',8);
        $this->Image(base_url().'assets/img/logo_segey.png' , 10 ,7, 50 , 11,'PNG');
        $this->Cell(90,3,utf8_decode(''),0,0,'C');
        $this->Cell(97,3,utf8_decode('SECRETARÍA DE EDUCACIÓN'),0,0,'L');
        $this->Cell(90,3,utf8_decode(''),0,0,'C');
        $this->Ln(3);
        $this->Cell(90,3,utf8_decode(''),0,0,'C');
        $this->Cell(97,3,utf8_decode('ÁREA COORDINADORA DE ARCHIVOS'),0,0,'L');
        $this->Cell(90,3,utf8_decode(''),0,0,'C');
        $this->Ln(3);
        /*$this->Cell(90,3,utf8_decode(''),0,0,'C');
        $this->Cell(97,3,utf8_decode('FORMATO DE INVENTARIO DOCUMENTAL DE LA SEGEY'),0,0,'L');
        $this->Cell(90,3,utf8_decode(''),0,0,'C');*/
        $this->Ln(5);
        $this->SetFont('Panton-Regular','',8);
        $this->Cell(90,3,utf8_decode('Fondo:'),0,0,'R');
        $this->SetFont('Panton-Bold','B',8);
        $this->Cell(187,3,utf8_decode('Secretaría de Educación'),0,0,'L');
        $this->Ln(3);
        $this->SetFont('Panton-Regular','',8);
        $this->Cell(90,3,utf8_decode('Unidad Administrativa Tramitadora:'),0,0,'R');
        $this->SetFont('Panton-Bold','B',8);
        $this->Cell(187,3,utf8_decode($unidad),0,0,'L');
        $this->Ln(3);
        $this->SetFont('Panton-Regular','',8);
        $this->Cell(90,3,utf8_decode('Área Generadora de la Documentación:'),0,0,'R');
        $this->SetFont('Panton-Bold','B',8);
        $this->Cell(187,3,utf8_decode($generadora),0,0,'L');
        $this->Ln(5);
        $this->SetFont('Panton-Regular','',8);
        $this->Cell(30,3,utf8_decode('FORMATO:'),0,0,'R');
        $this->SetFont('Panton-Bold','B',8);
        $this->Cell(247,3,utf8_decode('INVENTARIO GENERAL'),0,0,'L');
        $this->Ln(5); 
		}

		public function Footer()
		{
		$this->AddFont('Panton-Regular','', 'Panton-Regular.php');
    	$this->AliasNbPages();
        $this->SetY(-15);
        $this->SetFont('Panton-Regular','',8);
        $this->Cell(0,5,utf8_decode('F-PR-EID-01 R00'),0,0,'L');
        $this->Cell(-15,5,utf8_decode('Página ') . $this->PageNo().'/{nb}',0,0,'C');
		}
		
		function SetWidths($w)
    {
    //Set the array of column widths
        $this->widths=$w;
    }

    function SetAligns($a)
    {
    //Set the array of column alignments
        $this->aligns=$a;
    }

    function Row($data)
    {
    //Calculate the height of the row
        $nb=0;
        for($i=0;$i<count($data);$i++)
            $nb=max($nb,$this->NbLines($this->widths[$i],$data[$i]));
        $h=5*$nb;
    //Issue a page break first if needed
        $this->CheckPageBreak($h);
    //Draw the cells of the row
        for($i=0;$i<count($data);$i++)
        {
            $w=$this->widths[$i];
            $a=isset($this->aligns[$i]) ? $this->aligns[$i] : 'L';
        //Save the current position
            $x=$this->GetX();
            $y=$this->GetY();
        //Draw the border
            $this->Rect($x,$y,$w,$h);
        //Print the text
            $this->MultiCell($w,5,$data[$i],0,$a);
        //Put the position to the right of the cell
            $this->SetXY($x+$w,$y);
        }
    //Go to the next line
        $this->Ln($h);
    }

    function CheckPageBreak($h)
    {
    //If the height h would cause an overflow, add a new page immediately
        if($this->GetY()+$h>$this->PageBreakTrigger)
            $this->AddPage($this->CurOrientation);
    }

    function NbLines($w,$txt)
    {
    //Computes the number of lines a MultiCell of width w will take
        $cw=&$this->CurrentFont['cw'];
        if($w==0)
            $w=$this->w-$this->rMargin-$this->x;
        $wmax=($w-2*$this->cMargin)*1000/$this->FontSize;
        $s=str_replace("\r",'',$txt);
        $nb=strlen($s);
        if($nb>0 and $s[$nb-1]=="\n")
            $nb--;
        $sep=-1;
        $i=0;
        $j=0;
        $l=0;
        $nl=1;
        while($i<$nb)
        {
            $c=$s[$i];
            if($c=="\n")
            {
                $i++;
                $sep=-1;
                $j=$i;
                $l=0;
                $nl++;
                continue;
            }
            if($c==' ')
                $sep=$i;
            $l+=$cw[$c];
            if($l>$wmax)
            {
                if($sep==-1)
                {
                    if($i==$j)
                        $i++;
                }
                else
                    $i=$sep+1;
                $sep=-1;
                $j=$i;
                $l=0;
                $nl++;
            }
            else
                $i++;
        }
        return $nl;
    }
	}
