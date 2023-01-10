<?php 
	require_once "../../ayar.php";
	require_once "PHPExcel.php";
	session_start();
	$_SESSION['active'] = 0;

	$url = $_SERVER['REQUEST_URI'];
	$class = explode("id=", $url);
	$data = $db->query("SELECT * FROM students WHERE student_class='$class[1]'")->fetchAll(PDO::FETCH_ASSOC);
	$head = $db->query("SELECT * FROM students WHERE student_class='$class[1]'")->fetch(PDO::FETCH_ASSOC);
	if($data){
		$myExcel = new PHPExcel();
		$myExcel->getActiveSheet()->setTitle($head["student_class"]);
		$myExcel->getActiveSheet()->mergeCells("A1:D1");
		$myExcel->getActiveSheet()->setCellValue("A1","Kırklareli Üniversitesi ".$head["student_lesson"]." ".$head["student_exam"]." ".$head["student_date"]." ".$head["student_time"]." Dr. Öğr. Üyesi Bora Aslan ".$head["student_class"]." Numaralı Sınıf");
		$myExcel->getActiveSheet()->setCellValue("A2","Sıra No");
		$myExcel->getActiveSheet()->setCellValue("B2","Öğrenci No");
		$myExcel->getActiveSheet()->setCellValue("C2"," Ad Soyad");
		$myExcel->getActiveSheet()->setCellValue("D2"," İmza");
		$myExcel->getActiveSheet()->getRowDimension('1')->setRowHeight(70);
		$myExcel->getActiveSheet()->getColumnDimension('A')->setAutoSize(true);
		$myExcel->getActiveSheet()->getColumnDimension('B')->setAutoSize(true);
		$myExcel->getActiveSheet()->getColumnDimension('C')->setAutoSize(true);
		$myExcel->getActiveSheet()->getColumnDimension('D')->setWidth(20);
		$myExcel->getActiveSheet()->getStyle("A2:D2")->getFont()->setBold(true);
		$myExcel->getActiveSheet()->getStyle("A1:D1")->getFont()->setBold(true);
		$myExcel->getActiveSheet()->getStyle('A1:D1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$myExcel->getActiveSheet()->getStyle('A2:D2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$myExcel->getActiveSheet()->getStyle('A1:D1')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
		$borderstyle=array(
	     'borders' => array(
	         'allborders' => array(
	            'style'=>PHPExcel_Style_Border::BORDER_THIN
	        	)
	     	)
		 );
		$myExcel->getActiveSheet()->getStyle("A2:D2")->applyFromArray ($borderstyle);
		$myExcel->getActiveSheet()->getStyle("A1:D1")->applyFromArray ($borderstyle);

		$i = 3;
		$count = 1;
		foreach ($data as $data) {
			$myExcel->getActiveSheet()->getStyle("A$i:D$i")->applyFromArray ($borderstyle);
			$myExcel->getActiveSheet()->setCellValue("A$i", $count);
			$myExcel->getActiveSheet()->setCellValue("B$i",$data["student_no"]);
			$myExcel->getActiveSheet()->setCellValue("C$i",$data["student_name"]);
			$i++;
			$count++;
		}

		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header('Content-Disposition: attachment;filename="ogrenci_listesi.xlsx"');
		header('Cache-Control: max-age=0');
		header('Cache-Control: max-age=1');
		header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
		header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT');
		header ('Cache-Control: cache, must-revalidate');
		header ('Pragma: public');

		$Save = PHPExcel_IOFactory::createWriter($myExcel, 'Excel2007');
		$Save->save('php://output');
		exit;
	}else{
		$_SESSION['active'] = 1;$_SESSION['color']="danger";$_SESSION['message']="Bu sınıfa kayıtlı öğrenci bulunmuyor. !";
		header("Refresh: 0; url=../pages/classes.php");
	}
 ?>
