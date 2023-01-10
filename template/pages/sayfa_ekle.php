<?php include "header.php"; 
  
  $btnEkle = $_POST['btnEkle'];
  $pagename = $_POST['pagename'];
  $pageicon = $_POST['pageicon'];
  $pageurl = $_POST['pageurl'];
  $pageyetki = $_POST['pageyetki'];

  if (isset($btnEkle)) {
    $sor = $db->query("SELECT * FROM sifa_admin_page WHERE sifa_admin_page_url = '$pageurl' || sifa_admin_page_name = '$pagename'");
    $say = $sor->fetchColumn();
    if ($say > 0) {
      $yanit = "<b style= 'color:red;'> Aynı İSİME ( $pagename ) yada  URL ( $pageurl ) Sahip Bir Sayfa Bulunuyor. !</b>";
    }
    else
    {
        $yeni = explode(".php", $pageurl);
        $olustur = touch($yeni[0].".php");
        $dosya = fopen("$yeni[0].php", 'w+');
        $topla_icerik = "
        <?php include 'header.php'; ?>
        <div class='main-panel'>
          <div class='content-wrapper'>
          $pagename
          </div>
        </div>
          <!-- content-wrapper ends -->
          <!-- Footer -->
      <?php include 'footer.php'; ?>";
        fwrite($dosya, $topla_icerik);
        fclose($dosya);
      $insert_page = $db->query("INSERT INTO sifa_admin_page(sifa_admin_page_name, sifa_admin_page_url, sifa_admin_page_icons, sifa_admin_page_yetki) VALUES ('$pagename','$yeni[0].php','$pageicon','$pageyetki')");
      if ($insert_page)
         $yanit = "<b style= 'color:green;'> Sayfa Başarıyla Eklendi. !</b>";
    }
    ?>
      <script type="text/javascript">
          setTimeout(function(){   
          window.location.assign("sayfa_ekle.php");}, 2500);
      </script>
    <?php
    }
?>

        <!-- partial -->
        <div class="main-panel">
          <div class="content-wrapper">
              <h4><?php echo $yanit; ?></h4>
              <div class="col-md-6 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Admin Panel Sayfa Ekleme</h4>
                    <p class="card-description"><br></p>
                    <form class="forms-sample" action="" method="post">
                      <div class="form-group row">
                        <label for="exampleInputUsername2" class="col-sm-3 col-form-label">Sayfa Adı :</label>
                        <div class="col-sm-9">
                          <input type="text" class="form-control" name="pagename" placeholder="Sayfa Adı" required>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="exampleInputPassword2" class="col-sm-3 col-form-label">Sayfa İcon :</label>
                        <div class="col-sm-9">
                          <input type="text" class="form-control" name="pageicon" placeholder="Sayfa İcon" required>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="exampleInputEmail2" class="col-sm-3 col-form-label">Sayfa Url :</label>
                        <div class="col-sm-9">
                          <input type="text" class="form-control" name="pageurl" placeholder="Sayfa URL" required>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="exampleInputMobile" class="col-sm-3 col-form-label">Sayfa Yetki :</label>
                        <div class="col-sm-9">
                           <select name="pageyetki" class="form-control" required>
                          <?php $yetki_cek = $db->query("SELECT * FROM sifa_yetkiler"); ?>
                            <?php foreach ($yetki_cek as $yetki_cek) {?>

                              <option value="<?php echo $yetki_cek['sifa_yetki_name']; ?>"><?php echo $yetki_cek['sifa_yetki_name']; ?></option>

                          <?php } ?>
                          </select>
                        </div>
                      </div>
                      <br>
                      <button type="submit" name="btnEkle" class="btn btn-success mr-2">Oluştur</button>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- content-wrapper ends -->
          
          <!-- Footer -->
<?php include "footer.php"; ?>