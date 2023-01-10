<?php
  session_start();
  include  "../../ayar.php";
  $_SESSION['active'] = 0;

  $btnAdd = $_POST['btnAdd'];
  $btnUpdate = $_POST['btnUpdate'];
  $btnDelete = $_POST['btnDelete'];
  $id = $_POST['id'];
  $no = $_POST['no'];
  $updNo = $_POST['updNo'];
  $name = $_POST['name'];
  $class = $_POST['class'];
  $lesson = $_POST['lesson'];
  $updClass = $_POST['updClass'];

  if(isset($btnAdd))
  {
    $count = 0;
    $student_check = $db->query("SELECT * FROM students WHERE student_no='$no'");
    $count = $student_check->fetchColumn();
    if($count < 1)
    {
      $add_student = $db->query("INSERT INTO students(student_no, student_name, student_class, student_lesson) VALUES ('$no','$name','$class','$lesson')");
      if ($add_student){
        $_SESSION['active'] = 1;$_SESSION['color']="success";$_SESSION['message']="Öğrenci başarıyla eklendi. !";
      }
      else{
        $_SESSION['active'] = 1;$_SESSION['color']="danger";$_SESSION['message']="Öğrenci eklenirken bir sorun oluştu. !";
      }
    }
    else
    {
      $_SESSION['active'] = 1;
      $_SESSION['color'] = "danger";
      $_SESSION['message'] = "Bu no ya sahip bir öğrenci bulunuyor. !";
    }
  }

  if (isset($btnUpdate)) {
    $new_class = $db->query("SELECT classes_count FROM classes WHERE classes_name='$class'")->fetch(PDO::FETCH_ASSOC);
    $clas_count = $new_class["classes_count"];

    if($updClass == $class || $clas_count > 0){
      if ($updNo == $no) {
        $upd_std = $db->query("UPDATE students SET student_name='$name',student_class='$class',student_lesson='$lesson' WHERE student_id='$id'");
        if ($upd_std) {
          $_SESSION['active'] = 1;$_SESSION['color']="success";$_SESSION['message']="İşlem başarı ile tamamlandı. !";
        }
        else{
          $_SESSION['active'] = 1;$_SESSION['color']="danger";$_SESSION['message']="İşlem tamamlanırken bir sorun oluştu. !";
        }
      }
      else if(!ctype_space($no) && !strstr($no, " ")){
        $count = 0;
        $no_check = $db->query("SELECT * FROM students WHERE student_no='$no'");
        $count = $no_check->fetchColumn();
        echo $count;
        if($count < 1)
        {
          $upd_std = $db->query("UPDATE students SET student_no='$no',student_name='$name',student_class='$class',student_lesson='$lesson' WHERE student_id='$id'");
          if ($upd_std) {
          $_SESSION['active'] = 1;$_SESSION['color']="success";$_SESSION['message']="İşlem başarı ile tamamlandı. !";
        }
        else{
          $_SESSION['active'] = 1;$_SESSION['color']="danger";$_SESSION['message']="İşlem tamamlanırken bir sorun oluştu. !";
        }
        }
        else{
          $_SESSION['active'] = 1;$_SESSION['color']="danger";$_SESSION['message']="Girilen No ya sahip bir öğrenci bulunuyor. !";
        }
      }
      else{
           $_SESSION['active'] = 1;$_SESSION['color']="danger";$_SESSION['message']="Girilen No Hatalı Lütfen tekrar deneyin. !";
      }
      if($updClass != $class){
        $last_class = $db->query("SELECT classes_count FROM classes WHERE classes_name='$updClass'")->fetch(PDO::FETCH_ASSOC);
        $last_max = $last_class["classes_count"] + 1;
        $last_class = $db->query("UPDATE classes SET classes_count='$last_max' WHERE classes_name='$updClass'");
        $new_max = $new_class["classes_count"] - 1;
        $new_class = $db->query("UPDATE classes SET classes_count='$new_max' WHERE classes_name='$class'");
      }
    }
    else
    {
         $_SESSION['active'] = 1;$_SESSION['color']="danger";$_SESSION['message']="Güncellenmek istenen sınıfın kontenjanı dolmuştur. !";
    }
  }

  if (isset($btnDelete)) {
    $dlt_std = $db->query("DELETE FROM students WHERE student_id='$id'");
    if ($dlt_std) {
      $_SESSION['active'] = 1;$_SESSION['color']="success";$_SESSION['message']="Öğrenci Bilgisi Başarı İle Silindi. !";
      $max_std = $db->query("SELECT classes_count FROM classes WHERE classes_name='$class'")->fetch(PDO::FETCH_ASSOC);
      $upd_count = $max_std["classes_count"] + 1;
      $update_class = $db->query("UPDATE classes SET classes_count='$upd_count' WHERE classes_name='$class'");
    }
    else{
      $_SESSION['active'] = 1;$_SESSION['color']="danger";$_SESSION['message']="Öğrenci Bilgisi Silinirken Bir Sorun Oluştu. !";
    }
  }

  header("Refresh: 0; url=students.php");
?>
