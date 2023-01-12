<?php
  include 'header.php'; 
  $students = $db->query("SELECT * FROM students")->fetchAll(PDO::FETCH_ASSOC);
  $classes = $db->query("SELECT * FROM classes")->fetchAll(PDO::FETCH_ASSOC);
  $classe = $db->query("SELECT * FROM classes")->fetchAll(PDO::FETCH_ASSOC);
  $clas = $db->query("SELECT * FROM classes")->fetchAll(PDO::FETCH_ASSOC);
?>
        <div class='main-panel'>
          <div class='content-wrapper text-center'>
            <h2 class="p-3 " style="font-weight: bold;">Öğrenciler</h2>
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
                  <button type="button" class="btn btn-outline-success" data-toggle="modal" data-target="#modalinsert">Yeni Öğrenci Ekle</button>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                      <form name="formName" action="checked_student.php" method="POST">
                        <div class="container-fluid text-center mt-3 mb-3" id="editAll" style="display: none;border: 1px solid;">
                          <button type="submit" class="mt-3 col-5 btn btn-outline-danger" data-target="#checkedDelete" data-toggle="modal" name="delete" id="btnAllDelete" >Seçili Öğrencileri Sil</button>
                            <button type="submit" class="col-5 btn btn-outline-primary mt-3" data-target="#checkedUpdate" data-toggle="modal" name="update" id="btnAllAdd">Seçili Öğrencileri Sınıfa ekle</button>
                          <select class="container form-control text-white mt-3 mb-3" name="class" style="width: 250px;">
                            <option value="0">Sınıf Seçiniz.</option>
                            <?php foreach ($classes as $classes) {?>
                            <option value="<?php echo $classes["classes_name"]; ?>"><?php echo "Sınıf: ".$classes["classes_name"]." Mevcut sayısı: ".$classes["classes_count"]; ?></option>
                          <?php } ?>
                          </select>
                          <button type="submit" class="col-12 btn btn-outline-secondary mt-3 mb-3" data-target="#checkedUpdate" data-toggle="modal" name="randomAdd" id="btnAllAdd">Seçili Öğrencileri Rastgele Sınıfa ekle</button>
                          <?php foreach ($clas as $clas) {?>
                          <input type="checkbox" name="class[]" value="<?php echo $clas["classes_name"]; ?>">
                          <label><?php echo $clas["classes_name"]; ?></label>
                        <?php } ?>
                        </div>
                        <table id="zero_config" class="table table-striped table-bordered no-wrap">
                            <thead>
                                <tr>
                                    <th><input type="checkbox" name="all" id="all" value=""  onclick="sec()" /> Tümünü Seç</th>
                                    <th>#</th>
                                    <th>Öğrenci Adı</th>
                                    <th>Öğrenci No</th>
                                    <th>Öğrenci Şubesi</th>
                                    <th>Öğrenci Dersi</th>
                                    <th>İşlem</th>
                                </tr>
                            </thead>
                            <tbody>
                              <?php 
                               ?>
                              <?php 
                              $count = 0;
                              foreach ($students as $students){
                              $count++;
                              $id[$count] = $students["student_id"];

                              ?>
                                <tr>
                                    <td><input type="checkbox" id="std" name="sec[]" value="<?php echo $students["student_id"]; ?>"></td>
                                    <td><?php echo $count; ?></td>
                                    <td><?php echo $students["student_name"]; ?></td>
                                    <td><?php echo $students["student_no"]; ?></td>
                                    <td><?php echo $students["student_class"]; ?></td>
                                    <td><?php echo $students["student_lesson"]; ?></td>
                                    <td>
                                        <button type="button" class="btn btn-outline-success editstudent p-2" data-toggle="modal" data-name="<?php echo $students["student_name"]; ?>" data-no="<?php echo $students["student_no"]; ?>" data-class="<?php echo $students["student_class"]; ?>" data-lesson="<?php echo $students["student_lesson"]; ?>" data-id="<?php echo $students["student_id"]; ?>" data-target="#exampleModal"> 
                                          <i class="mdi mdi-table-edit"></i>Düzenle
                                        </button>
                                        <button type="button" class="btn btn-outline-danger deletestudent p-2" data-class = "<?php echo $students["student_class"]; ?>" data-name="<?php echo $students["student_name"]; ?>" data-toggle="modal" data-id="<?php echo $students["student_id"]; ?>" data-target="#myModal"> 
                                          <i class="mdi mdi-delete-forever"></i>Sil
                                        </button>
                                    </td>
                                </tr>
                              <?php } ?>
                            </tbody>
                        </table>
                        </form>
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
                              <input type="hidden" id="updClass" name="updClass">
                              <select name="class" class="form-control text-white">
                              <?php foreach($classe as $classe){ ?>
                                <option value="<?php echo $classe["classes_name"]; ?>"><?php echo "Sınıf: ".$classe["classes_name"]." Mevcut sayısı: ".$classe["classes_count"]; ?></option>
                              <?php } ?>
                              </select>
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
                              <h4  style="text-transform:uppercase;" class="modal-title" id="myModalLabel"></h4>
                          </div>
                          <div class="modal-body" style="height:120px">
                              <form class="form-control" method="POST" action="process.php">
                                  <input type="hidden" id="deleteid" name="id">
                                  <input type="hidden" id="deleteclass" name="class">
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
    $("#updClass").val(classes);
    $("#lesson").val(lesson);
    $("#value").val(id);
    $("#id").val(id);
    });

$('.deletestudent').click(function (event) {
    var id = $(this).attr("data-id");
    var name = $(this).attr("data-name");
    var clas = $(this).attr("data-class");

    $("#deleteid").val(id);
    $("#deleteclass").val(clas);
    $("#myModalLabel").html(name);
    });

var selectname = document.getElementsByName('sec[]');
var count = selectname.length;

function sec(){
    for (var i = 0; i< count; i++) {
      if(document.getElementById('all').checked){ 
        selectname[i].checked=true;
          document.getElementById("editAll").style.display="";
      }
      else{
          document.getElementById("editAll").style.display="none";
       selectname[i].checked=false;
     }
    }
  }

if (document.getElementById("std").checked) {
  document.getElementById("editAll").style.display="";
}else{
  document.getElementById("editAll").style.display="none";
}


</script>
          <!-- content-wrapper ends -->
          <!-- Footer -->
      <?php include 'footer.php'; ?>
