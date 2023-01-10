<?php
  $_SESSION['active'] = 0;
  session_start();
  include 'header.php'; 
  $students = $db->query("SELECT * FROM students")->fetchAll(PDO::FETCH_ASSOC);
?>
        <div class='main-panel'>
          <div class='content-wrapper text-center'>
            <h2 class="p-3 " style="font-weight: bold;">Yaka Kartı</h2>
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
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="zero_config" class="table table-striped table-bordered no-wrap">
                            <thead>
                                <tr>
                                    <th>Öğrenci Adı</th>
                                    <th>Öğrenci No</th>
                                    <th>Öğrenci Şubesi</th>
                                    <th>Öğrenci Dersi</th>
                                    <th>İşlem</th>
                                </tr>
                            </thead>
                            <tbody>
                              <?php foreach ($students as $students){?>
                                <tr>
                                    <td><?php echo $students["student_no"]; ?></td>
                                    <td><?php echo $students["student_name"]; ?></td>
                                    <td><?php echo $students["student_class"]; ?></td>
                                    <td><?php echo $students["student_lesson"]; ?></td>
                                    <td><?php echo $students["student_exam"]; ?></td>

                                    <td>
                                        <a class="btn btn-outline-secondary p-2"target="_blank" href="png.php?id=<?php echo $students["student_id"]; ?>"><i class="mdi mdi-contact-mail"></i> Yaka Kartı Hazırla</a>
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
                  <h5 class="modal-title" id="exampleModalLabel"> Öğrenci Bilgilerini Güncelle</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                  <div class="modal-body">
                    <div class="card">
                      <div class="card-body">
                        <form class="forms-sample" action="process.php" method="POST"enctype="multipart/form-data">
                          <input type="hidden" id="id" name="id" id="value">
                          <input type="hidden" id="updNo" name="updNo">
                          <div class="form-group row">
                            <label for="exampleInputEmail2" class="col-sm-3 col-form-label">Öğrenci Adı</label>
                            <div class="col-sm-9">
                              <input id="name" type="text" class="form-control" name="name"  placeholder="Öğrenci Adı" required>
                            </div>
                          </div>
                          <div class="form-group row">
                            <label for="exampleInputEmail2" class="col-sm-3 col-form-label">Öğrenci No</label>
                            <div class="col-sm-9">
                              <input type="text" class="form-control" id="no" name="no" placeholder="Öğrenci No" required>
                            </div>
                          </div>
                          <div class="form-group row">
                            <label for="exampleInputEmail2" class="col-sm-3 col-form-label">Öğrenci Şubesi</label>
                            <div class="col-sm-9">
                              <input type="text" class="form-control" id="class" name="class" placeholder="Öğrenci Şubesi" required>
                            </div>
                          </div>
                          <div class="form-group row">
                            <label for="exampleInputEmail2" class="col-sm-3 col-form-label">Öğrenci Dersi</label>
                            <div class="col-sm-9">
                              <input type="text" class="form-control" id="lesson" name="lesson" placeholder="Öğrenci Dersi" required>
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
                    <h5 class="modal-title" id="exampleModalLabel"> Yeni Öğrenci Ekle</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                    <div class="modal-body">
                      <div class="card">
                        <div class="card-body">
                          <form class="forms-sample" action="process.php" method="POST"enctype="multipart/form-data">
                            <input type="hidden" id="id" name="id" id="value">
                            <div class="form-group row">
                              <label for="exampleInputEmail2" class="col-sm-3 col-form-label">Öğrenci Adı</label>
                              <div class="col-sm-9">
                                <input id="name" type="text" class="form-control" name="name"  placeholder="Öğrenci Adı" required>
                              </div>
                            </div>
                            <div class="form-group row">
                              <label for="exampleInputEmail2" class="col-sm-3 col-form-label">Öğrenci No</label>
                              <div class="col-sm-9">
                                <input type="text" class="form-control" id="no" name="no" placeholder="Öğrenci No" required>
                              </div>
                            </div>
                            <div class="form-group row">
                              <label for="exampleInputEmail2" class="col-sm-3 col-form-label">Öğrenci Şubesi</label>
                              <div class="col-sm-9">
                                <input type="text" class="form-control" id="class" name="class" placeholder="Öğrenci Şubesi" required>
                              </div>
                            </div>
                            <div class="form-group row">
                              <label for="exampleInputEmail2" class="col-sm-3 col-form-label">Öğrenci Dersi</label>
                              <div class="col-sm-9">
                                <input type="text" class="form-control" id="lesson" name="lesson" placeholder="Öğrenci Dersi" required>
                              </div>
                            </div>
                              <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Kapat</button>
                              <button type="submit" class="btn btn-outline-success" name="btnAdd" id="btnUpdateSubmit">Öğrenci Ekle</button>
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
                              <h4  style="text-transform:uppercase;" class="modal-title" id="myModalLabel">asd</h4>
                          </div>
                          <div class="modal-body" style="height:120px">
                              <form class="form-control" method="POST" action="process.php">
                                  <input type="hidden" id="deleteid" name="id">
                                  <p>
                                    Bu Öğrenciyi Silmek İstediğinize Emin Misiniz ?

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

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script type="text/javascript">
$('.editstudent').click(function (event) {
    var name = $(this).attr("data-name");
    var no = $(this).attr("data-no");
    var classes = $(this).attr("data-class");
    var lesson = $(this).attr("data-lesson");
    var id = $(this).attr("data-id");

    $("#updNo").val(no);
    $("#name").val(name);
    $("#no").val(no);
    $("#class").val(classes);
    $("#lesson").val(lesson);
    $("#value").val(id);
    $("#id").val(id);
    })

$('.deletestudent').click(function (event) {
    var id = $(this).attr("data-id");
    var name = $(this).attr("data-name");
    $("#deleteid").val(id);
    $("#myModalLabel").html(name);
    })

</script>
          <!-- content-wrapper ends -->
          <!-- Footer -->
      <?php include 'footer.php'; ?>
