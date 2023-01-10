<?php 
    include 'header.php';
 ?>
  <div class='main-panel'>
    
<style type="text/css">
  .content-wrapper{
    width: 170%;
  }
</style>
          <div class='container-fluid content-wrapper'>
              <div class="col-lg-7 stretch-card">
                <div class="card">
                  <div class="card-body">
                    <form action="../Classes/upload.php" method="post"enctype="multipart/form-data">
                      <div class="form-group">
                        <h2 class="text-center mb-5">Öğrenci Bilgilerini İçe Aktarın</h2>
                        <?php if($_SESSION['active'] == 1){?>
                        <div class="container alert alert-<?php echo $_SESSION['color']; ?> text-center" role="alert" style="font-weight: bold;">
                          <?php echo $_SESSION['message']; ?>
                        </div>
                      <?php 
                        $_SESSION['active'] = 0;
                        ?>
                         <script type="text/javascript">
                          setTimeout(function(){
                           window.location.reload(1);
                          }, 3000);
                          </script>
                        <?php 
                      } 
                      ?>
                        <label for="exampleSelectGender">Dosya Seçin</label>
                        <input type="file" name="excelFile" class="file-upload-default">
                        <div class="input-group col-xs-12">
                          <input type="text" class="form-control file-upload-info" name="excelFile" disabled placeholder="Dosya Yükleyin" required>
                          <span class="input-group-append">
                            <button class="file-upload-browse btn btn-primary" name="upload" type="button">Yükle</button>
                          </span>
                        </div><br>
                          <center><button type="submit" name="upload" class="btn btn-success mr-2">Dosyayı Yükleyin</button></center>
                      </div>
                    </form>
                </div>
              </div>
          </div>
        </div>
      </div>


<?php include 'footer.php'; ?>
