<?php 
  session_start();
  include  "../../ayar.php";
  $_SESSION['active'] = 0;

  $btnAdd = $_POST['btnAdd'];
  $btnUpdate = $_POST['btnUpdate'];
  $btnDelete = $_POST['btnDelete'];
  $id = $_POST['id'];
  $name = $_POST['name'];
  $updName = $_POST['updName'];
  $count = $_POST['count'];

  if(isset($btnAdd))
  {
    $counter = 0;
    $name_check = $db->query("SELECT * FROM classes WHERE classes_name = '$name'");
    $counter = $name_check->fetchColumn();
    if($counter < 1)
    {
        $add_class = $db->query("INSERT INTO classes(classes_name, classes_count) VALUES ('$name','$count')");
        if($add_class)
        {
            $_SESSION['active'] = 1;$_SESSION['color']="success";$_SESSION['message']="Sınıf Başarıyla Eklendi. !";
        }
        else
        {
            $_SESSION['active'] = 1;$_SESSION['color']="danger";$_SESSION['message']="Sınıf Eklenirken Bir Sorun Oluştu. !";
        }
    }
  }
  if (isset($btnDelete)) {
        $delete_class = $db->query("DELETE FROM classes WHERE classes_id = '$id'");
        if($delete_class)
        {
            $_SESSION['active'] = 1;$_SESSION['color']="success";$_SESSION['message']="Sınıf Başarıyla Silindi. !";
        }
        else
        {
            $_SESSION['active'] = 1;$_SESSION['color']="danger";$_SESSION['message']="Sınıf Silinirken Bir Sorun Oluştu. !";
        }
  }
  if (isset($btnUpdate)) {
      if($updName == $name)
      {
        $upd_class = $db->query("UPDATE classes SET classes_count='$count' WHERE classes_id='$id'");
        if($upd_class)
        {
            $_SESSION['active'] = 1;$_SESSION['color']="success";$_SESSION['message']="Sınıf Bilgisi Başarı İle Güncellendi. !";
        }
        else
        {
            $_SESSION['active'] = 1;$_SESSION['color']="danger";$_SESSION['message']="Sınıf Bilgisi Güncellenirken Bir Sorun Oluştu. !";
        }
      }
      else if($updName != $name)
      {
        $counter = 0;
        $name_cntrl = $db->query("SELECT * FROM classes WHERE classes_name = '$name'");
        $counter = $name_cntrl->fetchColumn();
        if($counter < 1)
        {
            $upd_class = $db->query("UPDATE classes SET classes_name='$name',classes_count='$count' WHERE classes_id = '$id'");
            if($upd_class)
            {
                $_SESSION['active'] = 1;$_SESSION['color']="success";$_SESSION['message']="Sınıf Bilgisi Başarı İle Güncellendi. !";
            }
            else
            {
                $_SESSION['active'] = 1;$_SESSION['color']="danger";$_SESSION['message']="Sınıf Bilgisi Güncellenirken Bir Sorun Oluştu. !";
            }
        }
        else
        {
            $_SESSION['active'] = 1;$_SESSION['color']="danger";$_SESSION['message']="Bu Şubeye Sahip Bir Sınıf Bulunuyor. !";
        }
      }
  }
  header("Refresh: 0; url=classes.php");
 ?>
