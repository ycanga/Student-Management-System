<?php 
	require_once "fpdf.php";
	require_once "../../ayar.php";
	$url = $_SERVER['REQUEST_URI'];
	$class = explode("id=", $url);
	$data = $db->query("SELECT student_no, student_name FROM students WHERE student_class='$class[1]'")->fetchAll(PDO::FETCH_ASSOC);

	class PDF extends FPDF
	{
		function content($data =[])
		{
			$this->Ln(10);
			foreach ($data as $key => $value) {
				$this->Write(0,str_replace("Ö","O",str_replace("Ü","U",str_replace("Ç","C",str_replace("İ","I",str_replace("Ş","S",str_replace("Ğ","G",$value)))))));
				$this->Write(0,"	");
			}
		}
	}

$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->setFont('Arial', '', 15);
$pdf->AddPage();
foreach ($data as $data) {
	$pdf->content($data);
}
$pdf->Output();
 ?>
