<?php include "header.php"; ?>
<head>
    <link rel="stylesheet" href="../assets/vendors/select2/select2.min.css">
    <link rel="stylesheet" href="../assets/vendors/select2-bootstrap-theme/select2-bootstrap.min.css">
  </head>
        <!-- partial -->
        <div class="main-panel">
          <div class="content-wrapper">

            <div class="row">
              <div class="col-xl-3 col-sm-6 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <div class="row">
                      <div class="col-9">
                        <div class="d-flex align-items-center align-self-start">
                          <h3 class="mb-0"><a href="students.php" style="text-decoration:none;">Öğrenciler</a></h3>
                        </div>
                      </div>
                       <div class="col-3">
                        <div class="icon icon-box-success ">
                          <span class="mdi mdi-account"></span>
                        </div>
                      </div>
                    </div>
                    <h6 class="text-muted font-weight-normal">Öğrencileri Görmek İçin Tıklayın.</h6>
                  </div>
                </div>
              </div>
              <div class="col-xl-3 col-sm-6 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <div class="row">
                      <div class="col-9">
                        <div class="d-flex align-items-center align-self-start">
                          <h3 class="mb-0"><a href="students.php" style="text-decoration:none;">Öğrenci Ekle</a></h3>
                        </div>
                      </div>
                       <div class="col-3">
                        <div class="icon icon-box-danger ">
                          <span class="mdi mdi-account-plus"></span>
                        </div>
                      </div>
                    </div>
                    <h6 class="text-muted font-weight-normal">Yeni Öğrenci Eklemek İçin Tıklayınız.</h6>
                  </div>
                </div>
              </div>
              <div class="col-xl-3 col-sm-6 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <div class="row">
                      <div class="col-9">
                        <div class="d-flex align-items-center align-self-start">
                          <h3 class="mb-0"><a href="classes.php" style="text-decoration:none;">Sınıflar</a></h3>
                        </div>
                      </div>
                       <div class="col-3">
                        <div class="icon icon-box-success ">
                          <span class="mdi mdi-book-open-page-variant"></span>
                        </div>
                      </div>
                    </div>
                    <h6 class="text-muted font-weight-normal">Sınıfları Görmek İçin Tıklayınız.</h6>
                  </div>
                </div>
              </div>
              <div class="col-xl-3 col-sm-6 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <div class="row">
                      <div class="col-9">
                        <div class="d-flex align-items-center align-self-start">
                          <h3 class="mb-0"><a href="classes.php" style="text-decoration:none;">Sınıf Ekle</a></h3>
                        </div>
                      </div>
                      <div class="col-3">
                        <div class="icon icon-box-danger ">
                          <span class="mdi mdi-book-open-page-variant"></span>
                        </div>
                      </div>
                    </div>
                    <h6 class="text-muted font-weight-normal">Yeni Sınıf Eklemek İçin Tıklayınız.</h6>
                  </div>
                </div>
              </div>
            </div>
            <div class="row">
                          <div class="col-lg grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Sınıflar</h4>
                    <?php echo $yanit; ?>
                    <p class="card-description"><?php echo $button_ekle; ?></p>
                    <div class="table-responsive">
                      <table class="table">
                        <thead>
                          <tr>
                            <th>#</th>
                            <th> Sınıf Adı </th>
                            <th> Sınıf Kontenjanı </th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php
                          $class = $db->query("SELECT * FROM classes")->fetchAll(PDO::FETCH_ASSOC);
                           foreach ($class as $class) {
                            $counter++;
                            ?>
                          <tr>
                            <td><?php echo $counter; ?></td>
                            <td><?php echo $class['classes_name']; ?></td>
                            <td><?php echo $class['classes_count']; ?></td>
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
          <!-- content-wrapper ends -->
<?php include "footer.php"; ?>
