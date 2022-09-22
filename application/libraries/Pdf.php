<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
    require_once APPPATH."third_party/FPDF/fpdf.php";

	class Pdf extends FPDF {
		public function __construct() {
			parent::__construct();
		}
		public function Header()
		{
			$this->Image(base_url().'assets/img/logo_segey.png' , 10 ,7, 65 , 15,'PNG');
			$this->Ln(8);
		}

		public function Footer()
		{
			$fecha = (isset($_POST['fecha'])) ? $_POST['fecha'] : '';
			$this->AddFont('Panton-Bold','B', 'Panton-Bold.php');
			$this->AliasNbPages();
			$this->SetY(-15);
			$this->SetFont('Panton-Bold','B',13);
			$this->Cell(0,5,utf8_decode('AÑO DE EMISIÓN: '.$fecha),0,0,'C');
			$this->SetFont('Panton-Bold','B',8);
			$this->Cell(-15,5,utf8_decode('Página ') . $this->PageNo().'/{nb}',0,0,'C');
		}
		function RoundedRect($x, $y, $w, $h, $r, $corners = '1234', $style = ''){
			$k = $this->k;
			$hp = $this->h;
			if($style=='F')
				$op='f';
			elseif($style=='FD' || $style=='DF')
				$op='B';
			else
				$op='S';
			$MyArc = 4/3 * (sqrt(2) - 1);
			$this->_out(sprintf('%.2F %.2F m',($x+$r)*$k,($hp-$y)*$k ));

			$xc = $x+$w-$r;
			$yc = $y+$r;
			$this->_out(sprintf('%.2F %.2F l', $xc*$k,($hp-$y)*$k ));
			if (strpos($corners, '2')===false)
				$this->_out(sprintf('%.2F %.2F l', ($x+$w)*$k,($hp-$y)*$k ));
			else
				$this->_Arc($xc + $r*$MyArc, $yc - $r, $xc + $r, $yc - $r*$MyArc, $xc + $r, $yc);

			$xc = $x+$w-$r;
			$yc = $y+$h-$r;
			$this->_out(sprintf('%.2F %.2F l',($x+$w)*$k,($hp-$yc)*$k));
			if (strpos($corners, '3')===false)
			{
				$this->_out(sprintf('%.2F %.2F l',($x+$w)*$k,($hp-($y+$h))*$k));
			}
			else
			{
				$this->_Arc($xc + $r, $yc + $r*$MyArc, $xc + $r*$MyArc, $yc + $r, $xc, $yc + $r);
			}

			$xc = $x+$r;
			$yc = $y+$h-$r;
			$this->_out(sprintf('%.2F %.2F l',$xc*$k,($hp-($y+$h))*$k));
			if (strpos($corners, '4')===false)
			{
				$this->_out(sprintf('%.2F %.2F l',($x)*$k,($hp-($y+$h))*$k));
			}
			else
			{
				$this->_Arc($xc - $r*$MyArc, $yc + $r, $xc - $r, $yc + $r*$MyArc, $xc - $r, $yc);
			}

			$xc = $x+$r ;
			$yc = $y+$r;
			$this->_out(sprintf('%.2F %.2F l',($x)*$k,($hp-$yc)*$k ));
			if (strpos($corners, '1')===false)
			{
				$this->_out(sprintf('%.2F %.2F l',($x)*$k,($hp-$y)*$k ));
				$this->_out(sprintf('%.2F %.2F l',($x+$r)*$k,($hp-$y)*$k ));
			}
			else
				$this->_Arc($xc - $r, $yc - $r*$MyArc, $xc - $r*$MyArc, $yc - $r, $xc, $yc - $r);
			$this->_out($op);
		}

		function _Arc($x1, $y1, $x2, $y2, $x3, $y3)
		{
			$h = $this->h;
			$this->_out(sprintf('%.2F %.2F %.2F %.2F %.2F %.2F c ', $x1*$this->k, ($h-$y1)*$this->k,
				$x2*$this->k, ($h-$y2)*$this->k, $x3*$this->k, ($h-$y3)*$this->k));
		}
		function SetWidths($w)
		{
			$this->widths=$w;
		}
		function Row($data)
		{
			$nb=0;
			for($i=0;$i<count($data);$i++)
				$nb=max($nb,$this->NbLines($this->widths[$i],$data[$i]));
			$h=4*$nb;
			$this->CheckPageBreak($h);
			for($i=0;$i<count($data);$i++)
			{
				$w=$this->widths[$i];
				$a=isset($this->aligns[$i]) ? $this->aligns[$i] : 'L';
				$x=$this->GetX();
				$y=$this->GetY();

				$this->Rect($x,$y,$w,$h);
				$this->MultiCell($w,4,$data[$i],0,$a);
				$this->SetXY($x+$w,$y);
			}
			$this->Ln($h);
		}
		function CheckPageBreak($h)
		{
			if($this->GetY()+$h>$this->PageBreakTrigger)
			{
				$this->AddPage($this->CurOrientation);
				$this->SetXY(35,168);
			}
		}
		function NbLines($w,$txt)
		{
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
