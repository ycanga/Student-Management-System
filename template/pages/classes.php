<?php
  include 'header.php'; 
  $classes = $db->query("SELECT * FROM classes")->fetchAll(PDO::FETCH_ASSOC);
?>
        <div class='main-panel'>
          <div class='content-wrapper text-center'>
            <h2 class="p-3 " style="font-weight: bold;">Sınıflar</h2>
          <div class="row">
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
            <div class="col-12">
              <div class="card">
                <div class="container text-center mt-3">
                  <button type="button" class="btn btn-outline-success" data-toggle="modal" data-target="#modalinsert">Yeni Sınıf Ekle</button>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="zero_config" class="table table-striped table-bordered no-wrap">
                            <thead>
                                <tr>
                                    <th>Sınıf Şubesi</th>
                                    <th>Sınıf Mevcudu (Max)</th>
                                    <th>İşlem</th>
                                </tr>
                            </thead>
                            <tbody>
                              <?php foreach ($classes as $classes){?>
                                <tr>
                                    <td><?php echo $classes["classes_name"]; ?></td>
                                    <td><?php echo $classes["classes_count"]; ?></td>
                                    <td>
                                        <button type="button" class="btn btn-outline-success editclass p-2" data-toggle="modal" data-name="<?php echo $classes["classes_name"]; ?>"  data-count="<?php echo $classes["classes_count"]; ?>" data-id="<?php echo $classes["classes_id"]; ?>" data-target="#exampleModal"> 
                                          <i class="mdi mdi-table-edit"></i>Düzenle
                                        </button>
                                        <button type="button" class="btn btn-outline-danger deleteclass p-2" data-name="<?php echo $classes["classes_name"]; ?>" data-toggle="modal" data-id="<?php echo $classes["classes_id"]; ?>" data-target="#myModal"> 
                                          <i class="mdi mdi-delete-forever"></i>Sil
                                        </button>
                                        <a name="excell" href="../Classes/excel.php?id=<?php echo $classes["classes_name"]; ?>" class="btn btn-outline-primary p-2"><i class="mdi mdi-file-excel"></i> Excel Aktar</a>
                                        <a name="pdf" target="_blank" href="../fpdf/pdf.php?id=<?php echo $classes["classes_name"]; ?>" class="btn btn-outline-secondary p-2"><i class="mdi mdi-file-pdf"></i> PDF Aktar</a>
                                    </td>
                                </tr>
                              <?php } ?>
                            </tbody>
                        </table>
                      </div>
                    </div>
                  </div>
                </div>
          </div>
          </div>
        </div>

        <!-- Modal UPDATE-->
          <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel"> Sınıf Bilgilerini Güncelle</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                  <div class="modal-body">
                    <div class="card">
                      <div class="card-body">
                        <form class="forms-sample" action="class_process.php" method="POST"enctype="multipart/form-data">
                          <input type="hidden" id="id" name="id" id="value">
                          <input type="hidden" id="updName" name="updName">
                          <div class="form-group row">
                            <label for="exampleInputEmail2" class="col-sm-3 col-form-label">Sınıf Şubesi</label>
                            <div class="col-sm-9">
                              <input id="class" type="text" class="form-control" name="name"  placeholder="Sınıf Şubesi" required>
                            </div>
                          </div>
                          <div class="form-group row">
                            <label for="exampleInputEmail2" class="col-sm-3 col-form-label">Sınıf Mevcudu</label>
                            <div class="col-sm-9">
                              <input type="text" class="form-control" id="count" name="count" placeholder="Sınıf Mevcudu" required>
                            </div>
                          </div>
                            <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Kapat</button>
                            <button type="submit" class="btn btn-outline-primary" name="btnUpdate" id="btnUpdateSubmit">Değişiklikleri Kaydet</button>
                        </form>
                      </div>
                    </div>
                    </div>
                  </div>
                </div>
              </div>
              <!-- modal UPDATE -->

            <!-- modal INSERT -->
            <div class="modal fade" id="modalinsert" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"> Yeni Sınıf Ekle</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                    <div class="modal-body">
                      <div class="card">
                        <div class="card-body">
                          <form class="forms-sample" action="class_process.php" method="POST"enctype="multipart/form-data">
                            <input type="hidden" id="id" name="id" id="value">
                            <div class="form-group row">
                              <label for="exampleInputEmail2" class="col-sm-3 col-form-label">Sınıf Şubesi</label>
                              <div class="col-sm-9">
                                <input id="name" type="text" class="form-control" name="name"  placeholder="Sınıf Şubesi" required>
                              </div>
                            </div>
                            <div class="form-group row">
                              <label for="exampleInputEmail2" class="col-sm-3 col-form-label">Sınıf Mevcudu</label>
                              <div class="col-sm-9">
                                <input type="text" class="form-control" id="count" name="count" placeholder="Sınıf Mevcudu" required>
                              </div>
                            </div>
                              <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Kapat</button>
                              <button type="submit" class="btn btn-outline-success" name="btnAdd" id="btnUpdateSubmit">Sınıf Ekle</button>
                          </form>
                        </div>
                      </div>
                      </div>
                    </div>
                  </div>
                </div>
              <!-- modal INSERT -->

              <!-- Modal DELETE-->
              <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                  <div class="modal-dialog" role="document">
                      <div class="modal-content">
                          <div class="modal-header">
                              <h4  style="text-transform:uppercase;" class="modal-title" id="myModalLabel"></h4>
                          </div>
                          <div class="modal-body" style="height:120px">
                              <form class="form-control" method="POST" action="class_process.php">
                                  <input type="hidden" id="deleteid" name="id">
                                  <p>
                                    Bu Sınıfı Silmek İstediğinize Emin Misiniz ?

                                  </p>
                                  <br>
                                      <button type="button" class="btn btn-outline-primary" data-dismiss="modal">Kapat</button>
                                      <button type="submit" name="btnDelete" class="btn btn-outline-danger">SİL</button>
                              </form>
                          </div>
                      </div>
                      <!-- /.modal-content -->
                  </div>
                  <!-- /.modal-dialog -->
              </div>
              <!-- /.modal -->
              <!-- Modal LIST-->
              <div class="modal fade" id="listClass" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                  <div class="modal-dialog" role="document">
                      <div class="modal-content">
                          <div class="modal-header">
                              <h4  style="text-transform:uppercase;" class="modal-title" id="myModalLabel"></h4>
                          </div>
                          <div class="modal-body">
                             <div class="card-body">
                    <div class="table-responsive">
                        <table id="zero_config" class="table table-striped table-bordered no-wrap">
                            <thead>
                                <tr>
                                    <th>Öğrenci Adı</th>
                                    <th>Öğrenci Numarası</th>
                                </tr>
                            </thead>
                            <tbody>
                              <?php foreach ($classes as $classes){?>
                                <tr>
                                    <td><?php echo $classes["classes_name"]; ?></td>
                                    <td><?php echo $classes["classes_count"]; ?></td>
                                </tr>
                              <?php } ?>
                            </tbody>
                        </table>
                      </div>
                    </div>
                  </div> 
                          </div>
                      </div>
                      <!-- /.modal-content -->
                  </div>
                  <!-- /.modal-dialog -->
              </div>
              <!-- /.modal -->          

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script type="text/javascript">
$('.editclass').click(function (event) {
    var name = $(this).attr("data-name");
    var count = $(this).attr("data-count");
    var id = $(this).attr("data-id");

    $("#class").val(name);
    $("#count").val(count);
    $("#updName").val(name)
    $("#id").val(id);
    })

$('.deleteclass').click(function (event) {
    var id = $(this).attr("data-id");
    var name = $(this).attr("data-name");
    $("#deleteid").val(id);
    $("#myModalLabel").html(name);
    })

</script>
          <!-- content-wrapper ends -->
          <!-- Footer -->
      <?php include 'footer.php'; ?>
