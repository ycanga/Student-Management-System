<?php
	session_start();
	include  "../../ayar.php";
	$_SESSION['active'] = 0;

	$id = $_POST['sec'];
	$class_name = $_POST['class'];
	$class = $db->query("SELECT * FROM classes WHERE classes_name='$class_name'")->fetch(PDO::FETCH_ASSOC);
	$max_std = $class["classes_count"];
	$randomAdd = $_POST['randomAdd'];
	$clas = $_POST['class'];
	$tmp = $clas;

	$i = 0;
	while($id[$i])
		$i++;

	$j = 0;
	if(isset($_POST["update"]))
	{
		if($i <= $max_std){
			if($class_name != 0)
			foreach ($id as $id) {
				$ex=$db->query("SELECT student_class FROM students WHERE student_id = '$id'")->fetch(PDO::FETCH_ASSOC);
				if($ex["student_class"] != $class_name){
					$update = $db->query("UPDATE students SET student_class='$class_name' WHERE student_id='$id'");
					$j++;
				}else
					$update = true;
			}
		}
		$max_std = $max_std - $j;
		$update_class = $db->query("UPDATE classes SET classes_count='$max_std' WHERE classes_name='$class_name'");
		if ($update){
	        $_SESSION['active'] = 1;$_SESSION['color']="success";$_SESSION['message']="Öğrenciler başarıyla eklendi. !";
	    }
	    else{
	        $_SESSION['active'] = 1;$_SESSION['color']="danger";$_SESSION['message']="Sınıf Kontenjanı aşıldı. !";
	    }
	}

	if (isset($_POST["delete"])) {
		$j = 0;
		foreach ($id as $id) {
			$std_class = $db->query("SELECT student_class FROM students WHERE student_id='$id'")->fetch(PDO::FETCH_ASSOC);
			$class_std = $std_class["student_class"];
			$count_class = $db->query("SELECT * FROM classes WHERE classes_name='$class_std'")->fetch(PDO::FETCH_ASSOC);
			$new_class_count = $count_class["classes_count"] + 1;
			$upd_class = $db->query("UPDATE classes SET classes_count='$new_class_count' WHERE classes_name = '$class_std'");
			$all_delete = $db->query("DELETE FROM students WHERE student_id='$id'");
			$j++;
		}

		if ($all_delete){
	        $_SESSION['active'] = 1;$_SESSION['color']="success";$_SESSION['message']="Öğrenciler başarıyla silindi. !";
	    }
	    else{
	        $_SESSION['active'] = 1;$_SESSION['color']="danger";$_SESSION['message']="Öğrenciler silinirken bir sorun oluştu. !";
	    }
	}

	if(isset($randomAdd))
	{
		$i = 0;
		$j = 0;

		foreach ($clas as $clas) {
			$i++;
		}
		$len = 0;
		while($id[$len])
			$len++;
		while($id[$j])
		{
			$class = rand(0,$i-1);
			$class = $tmp[$class];
			$sd_class = $db->query("SELECT student_class FROM students WHERE student_id='$id[$j]'")->fetch(PDO::FETCH_ASSOC);
			$last_class = $sd_class["student_class"];
			$last_class_count = $db->query("SELECT classes_count FROM classes WHERE classes_name='$last_class'")->fetch(PDO::FETCH_ASSOC);
			$last_class_count = $last_class_count["classes_count"];
			$max_std = $db->query("SELECT classes_count FROM classes WHERE classes_name='$class'")->fetch(PDO::FETCH_ASSOC);
			$max_std = $max_std["classes_count"];
			if($len <= $max_std)
			{
				$std_update = $db->query("UPDATE students SET student_class='$class' WHERE student_id='$id[$j]'");
				
				if($last_class != $class){
					$max_std = $max_std - 1;
					$std_update = $db->query("UPDATE classes SET classes_count='$max_std' WHERE classes_name='$class'");
					$last_class_count = $last_class_count + 1;
					$last_class_update = $db->query("UPDATE classes SET classes_count = '$last_class_count' WHERE classes_name='$last_class'");
				}
				$len--;
			}else{
		        $_SESSION['active'] = 1;$_SESSION['color']="danger";$_SESSION['message']="Sınıf Kontenjanı Aşıldı. !";
		        header("Refresh: 0; url=students.php");
		    }
			$j++;
		}
		if ($std_update){
		        $_SESSION['active'] = 1;$_SESSION['color']="success";$_SESSION['message']="Öğrenciler Başarıyla Sınıfa Atandı. !";
		    }
		    else{
		        $_SESSION['active'] = 1;$_SESSION['color']="danger";$_SESSION['message']="Öğrenciler Sınıflara Atanırken Bir Sorun Oluştu. !";
		    }
	}
	header("Refresh: 0; url=students.php");
 ?>
