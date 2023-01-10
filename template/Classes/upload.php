<?php 
	require_once "../../ayar.php";
	require_once "PHPExcel.php";
	session_start();
	$_SESSION['active'] = 0;
	
	$upload = $_POST["upload"];

	if(isset($upload)){
		$name = $_FILES['excelFile']['name'];
		$tmp_name = $_FILES['excelFile']['tmp_name'];
		$type = $_FILES['excelFile']['type'];

		if($name && $tmp_name && $type){
			$extensions = array(
				'application/xls',
				'application/xlsx',
				'application/vnd.ms-excel',
				'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'
			);
			if(in_array($type, $extensions)){
				$myexcell = PHPExcel_IOFactory::load($tmp_name);

				foreach ($myexcell->getWorksheetIterator() as $row) {
					$variable = $row->getHighestRow();
					$student_lesson = $row->getCellByColumnAndRow(6,1)->getValue();
					$student_exam = $row->getCellByColumnAndRow(6,3)->getValue();
					strval($student_date = $row->getCellByColumnAndRow(6,4)->getValue());
					strval($student_time = $row->getCellByColumnAndRow(6,5)->getValue());

					for ($i=2; $i <= $variable; $i++) {

						$student_name = $row->getCellByColumnAndRow(2,$i)->getValue();
						strval($student_no = $row->getCellByColumnAndRow(1,$i)->getValue());
						$student_check = $db->query("SELECT * FROM students WHERE student_no='$student_no'");
						if($student_check->fetchColumn() < 1){
							$add = $db->query("INSERT INTO students SET
									student_name ='$student_name',
									student_no	 ='$student_no',
									student_lesson = '$student_lesson',
									student_exam='$student_exam',
									student_date='13.01.2023',
									student_time='10:00'
							");
							$_SESSION['active']=1;$_SESSION['color']="success";$_SESSION['message']="Öğrenciler Başarı ile Sisteme Yüklendi. !";
							header("Refresh: 0; url=../pages/upload_student.php");
						}else{
							header("Refresh: 0; url=../pages/upload_student.php");
						}
					}
				}
				if($add->rowCount()){
					$_SESSION['active']=1;$_SESSION['color']="success";$_SESSION['message']="Öğrenciler Başarı ile Sisteme Yüklendi. !";
				}
				else{
					$_SESSION['active']=1;$_SESSION['color']="danger";$_SESSION['message']="Öğrenciler Sisteme Yüklenirken Bir Sorun Oluştu. !";
				}
				
			}else{
				$_SESSION['active']=1;$_SESSION['color']="danger";$_SESSION['message']="Yüklenen Dosya Uzantısı Desteklenen Tipde Değil. !";
			}
		}
		else{
				$_SESSION['active']=1;$_SESSION['color']="danger";$_SESSION['message']="Yüklenen Dosya Uzantısı Desteklenen Tipde Değil. !";
			}
	}
	header("Refresh: 0; url=../pages/upload_student.php");
 ?>
