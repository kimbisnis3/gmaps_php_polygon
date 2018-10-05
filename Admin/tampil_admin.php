<!DOCTYPE html>
<html>
<title>Master Admin</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="css/w3.css">

<link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.3/css/font-awesome.min.css">

<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">
    <link href="//cdnjs.cloudflare.com/ajax/libs/octicons/3.5.0/octicons.min.css" rel="stylesheet">
    <script src="//code.jquery.com/jquery-2.2.2.min.js"></script>
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
 
 <!--
<link rel="stylesheet" href="css/bootstrap/css/bootstrap.min.css">
<script src="css/jquery-1.12.2.min.js"></script>
<script src="css/bootstrap/js/bootstrap.min.js"></script>
 -->
<script src="css/bootstrapvalidator.min.js"></script>
<script src="modal/bootstrap.js" type="text/javascript"></script>
<script src="css/jscolor.js"></script>
  <style>
  .modal-header, h4, .close {
      background-color: #5cb85c;
      color:white !important;
      text-align: center;
      font-size: 30px;
  }
  .modal-footer {
      background-color: #f9f9f9;
  }
  #trtabel {
      background-color: #5cb85c;
      color:white !important;
      text-align: center;
  }
  #modalhapus,{
      background-color: #0099FF;
      color:white !important;
      text-align: center;
      font-size: 30px;
  }
td {
    background: white;
  }
  
  .square {
  position: absolute;
  width: 20px;
  height: 20px;
}
  </style>
<style>
html,body,h1,h2,h3,h4,h5 {font-family: "Raleway", sans-serif}
</style>
<body class="w3-light-grey">

<!-- Top container -->
<div class="w3-container w3-top w3-green w3-large w3-padding" style="z-index:4">
  <button class="w3-btn w3-hide-large w3-padding-0 w3-hover-text-grey" onclick="w3_open();"><i class="fa fa-bars"></i>  Menu</button>
  <span class="w3-Left">Halaman Admin</span>
  <a href="logout.php"><span class="w3-right">Logout</span></a>
</div>

<!-- Sidenav/menu -->
<nav class="w3-sidenav w3-collapse w3-white w3-animate-left" style="z-index:3;width:300px;" id="mySidenav"><br>
  <div class="w3-container w3-row">
    <div class="w3-col s3">
      <img src="css/img_avatar3.png" class="w3-circle w3-margin-right" style="width:46px">
    </div>
    <?php
session_start();
/**
 * Jika Tidak login atau sudah login tapi bukan sebagai admin
 * maka akan dibawa kembali kehalaman login atau menuju halaman yang seharusnya.
 */
if ( !isset($_SESSION['user_login']) || 
    ( isset($_SESSION['user_login']) && $_SESSION['user_login'] != 'admin' ) ) {

  header('location:./login.php');
  exit();
}
?>
    <div class="w3-col s9">
      <span>Admin, <strong><?=$_SESSION['nama'];?></strong></span><br>
      
    </div>
  </div>
  <hr>
  <div class="w3-container" >
  
    <h5>Menu</h5>
  </div>
  <a href="#" class="w3-padding-16 w3-hide-large w3-dark-grey w3-hover-black" onclick="w3_close()" title="close menu"><i class="fa fa-remove fa-fw"></i>  Close Menu</a>
  <a href="#" class="w3-padding "><span class="glyphicon glyphicon-dashboard"></span>  Dashboard</a>
  <a href="" class="w3-padding w3-grey"><i class="glyphicon glyphicon-menu-right"></i>  Data Master</a>
  <a href="tampil_kelurahan.php" class="w3-padding "><i class="glyphicon glyphicon-th-list"></i>  Master Kelurahan</a>
  <a href="tampil_rw.php" class="w3-padding "><i class="glyphicon glyphicon-th-list"></i>  Master RW</a>
  <a href="tampil_kk.php" class="w3-padding"><i class="glyphicon glyphicon-th-list"></i>  Master KK</a>
  <a href="tampil_penduduk.php" class="w3-padding"><i class="glyphicon glyphicon-th-list"></i>  Master Penduduk</a>
  <a href="" class="w3-padding w3-grey"><i class="glyphicon glyphicon-menu-right"></i>  Kategori Warna Pemetaan</a>
  <a href="tampil_status.php" class="w3-padding "><i class="glyphicon glyphicon-map-marker"></i>  Status Jumlah Penduduk</a>
  <a href="tampil_status_jmlkk.php" class="w3-padding "><i class="glyphicon glyphicon-map-marker"></i>  Status Jumlah KK</a>
  <a href="tampil_status_pmiskin.php" class="w3-padding"><i class="glyphicon glyphicon-map-marker"></i>  Status Jumlah Penduduk Miskin</a>
  
</nav>


<!-- Overlay effect when opening sidenav on small screens -->
<div class="w3-overlay w3-hide-large w3-animate-opacity" onclick="w3_close()" style="cursor:pointer" title="close side menu" id="myOverlay"></div>

<!-- !PAGE CONTENT! -->
<div class="w3-main" style="margin-left:300px;margin-top:43px;">
      <?php
       include "koneksi.php";
      ?>
      <div class="row" >
      <div class="col-sm-1"></div>
  
  <div class="col-sm-10" id="konten" style="margin-top:20px;">
      <h3>Master Admin</h3>
      <table border="1" class="table table-striped w3-card-4">
      <tr  id="trtabel">
      <th>ID Admin</th>
      <th>Nama Admin</th>
      <th>Username</th>
      <th>Password</th>
      <th colspan="2" >Opsi</th>
      </tr>
      <?php
      $batas = 10;
            $pg = isset( $_GET['pg'] ) ? $_GET['pg'] : "";
             
            if ( empty( $pg ) ) {
            $posisi = 0;
            $pg = 1;
            } else {
            $posisi = ( $pg - 1 ) * $batas;
            }
      $query = "select * from users limit $posisi, $batas";
      $result = mysqli_query($sambung, $query);
      //$no = 0;
      while ($buff = mysqli_fetch_array($result)){
      //$no++;
      ?>
       <tr>
      <td><?php echo $buff['id_user']; ?></td>
      <td><?php echo $buff['nama']; ?></td>
      <td><?php echo $buff['username']; ?></td>
      <td><?php echo $buff['password']; ?></td>
      <td>
      <div class="button-toolbar">
      <a href="ubah_admin.php?id_user=<?php echo $buff ['id_user']; ?>" class="btn btn-warning glyphicon glyphicon-pencil" role="button" data-toggle="tooltip" title="Edit" data-placement="bottom"></a>

      <a href="hapus_admin.php?id_user=<?php echo $buff['id_user']; ?>" class="btn btn-danger glyphicon glyphicon-trash" role="button" data-toggle="tooltip" title="Hapus" data-placement="bottom"></a></div></td>
        <!-- Trigger the modal with a button -->


      </tr>
      <?php
      };

      //hitung jumlah data
          $jml_data = mysqli_num_rows(mysqli_query($sambung,"select * from users"));
          //Jumlah halaman
          $JmlHalaman = ceil($jml_data/$batas); //ceil digunakan untuk pembulatan keatas
      mysqli_close($sambung);
      ?>

      </table>
    </div>

<div class="col-sm-1"></div>
</div>
<div class="row" >
<div class="col-sm-5"></div>
<div class="col-sm-3">
  <button type="button" class="btn btn-success btn-lg" id="myBtn">Tambah</button></div>
<div class="col-sm-4">
  <?php
//Navigasi ke sebelumnya
          if ( $pg > 1 ) {
          $link = $pg-1;
          $prev = "<a href='?pg=$link'>Sebelumnya </a>";
          } else {
          $prev = "Sebelumnya ";
          }
           
          //Navigasi nomor
          $nmr = '';
          for ( $i = 1; $i<= $JmlHalaman; $i++ ){
           
          if ( $i == $pg ) {
          $nmr .= $i . " ";
          } else {
          $nmr .= "<a href='?pg=$i'>$i</a> ";
          }
          }
           
          //Navigasi ke selanjutnya
          if ( $pg < $JmlHalaman ) {
          $link = $pg + 1;
          $next = " <a href='?pg=$link'>Selanjutnya</a>";
          } else {
          $next = " Selanjutnya";
          }
           
          //Tampilkan navigasi
          echo $prev . $nmr . $next;

?>
</div>
  <!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header" style="padding:35px 50px;">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4><span class="glyphicon glyphicon-lock"></span>Tambah Data Admin</h4>
        </div>
        <div class="modal-body" style="padding:40px 50px;">
          <form role="form" class="form-horizontal" name="form1" action="entry_admin.php" method="POST" id="contact_form">
<?php
include "id.php";
try
{
  $dbh = new PDO("mysql:host=$hostname;dbname=$database", $username, $password);
 
}
catch(PDOException $e)
{
  echo $e->getMessage();
}
$query = $dbh->query('SELECT MAX(id_user) as kodex  FROM  users'); 
$data = $query->fetch();
$kode = $data['kodex']; 
$nourut = ($kode); 
$nourut++; ?>
          <div class="form-group">
              <label for="id_user"><span class="glyphicon glyphicon-user"></span> Id Admin</label>
              <input type="text" readonly="true" class="form-control" id="id_user" name="id_user" placeholder="Masukkan Id Admin"value="<?php echo $nourut; ?>" >
            </div>
            <div class="form-group">
              <label for="nama"><span class="glyphicon glyphicon-user"></span> Nama Admin</label>
              <input type="text" class="form-control" id="nama" name="nama" placeholder="Masukkan Nama Admin">
            </div>
            <div class="form-group">
              <label for="username"><span class="glyphicon glyphicon-home"></span> Username</label>
              <input type="text" class="form-control" id="username" name="username" placeholder="Masukan Username">
            </div>
            <div class="form-group">
              <label for="password"><span class="glyphicon glyphicon-home"></span> Password</label>
              <input type="password" class="form-control" id="password" name="password" placeholder="Masukan Password">
            </div>
            <button type="submit" class="btn btn-success btn-block"><span class="glyphicon glyphicon-floppy-disk"></span> SIMPAN</button>
          </form>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-danger btn-default pull-left" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span>BATAL</button>
        </div>
      </div>
      
    </div>
  </div> 
<!-- Modal Popup untuk delete--> 
<div class="modal fade" id="modalhapus">
  <div class="modal-dialog">
    <div class="modal-content" style="margin-top:100px;">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" style="text-align:center;"><span class="glyphicon glyphicon-trash"></span> Apakah Anda Yakin Ingin Menghapus Data Ini ?</h4>
      </div>
                
      <div class="modal-footer" style="margin:0px; border-top:0px; text-align:center;">
        <a href="#" class="btn btn-danger" id="hapus">Hapus</a>
        <button type="button" class="btn btn-success" data-dismiss="modal">Batal</button>
      </div>
    </div>
  </div>
</div>
  <!-- End page content -->
</div>

<!-- Javascript untuk popup modal Hapus--> 
<script type="text/javascript">
    function confirm_modal(delete_url)
    {
      $('#modalhapus').modal('show', {backdrop: 'static'});
      document.getElementById('hapus').setAttribute('href' , delete_url);
    }
</script>
<script>
// Get the Sidenav
var mySidenav = document.getElementById("mySidenav");

// Get the DIV with overlay effect
var overlayBg = document.getElementById("myOverlay");

// Toggle between showing and hiding the sidenav, and add overlay effect
function w3_open() {
    if (mySidenav.style.display === 'block') {
        mySidenav.style.display = 'none';
        overlayBg.style.display = "none";
    } else {
        mySidenav.style.display = 'block';
        overlayBg.style.display = "block";
    }
}

// Close the sidenav with the close button
function w3_close() {
    mySidenav.style.display = "none";
    overlayBg.style.display = "none";
}
</script>
<script>
$(document).ready(function(){
    $("#myBtn").click(function(){
        $("#myModal").modal();
    });
});

</script>
<script>
$(document).ready(function(){
    $("#myBtn2").click(function(){
        $("#myModal2").modal();
    });
});

</script>
<script>
$(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip(); 
});
</script>
<script type="text/javascript">
    $(document).ready(function() {
    $('#contact_form').bootstrapValidator({
        // To use feedback icons, ensure that you use Bootstrap v3.1.0 or later
        feedbackIcons: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields: {
            id_user: {
                validators: {
                        stringLength: {
                        min: 1,
                    },
                        notEmpty: {
                        message: 'Masukan Id'
                    }
                }
            },
            nama: {
                validators: {

                     stringLength: {
                        min: 3,
                    },
                    notEmpty: {
                        message: 'Masukan Nama Anda'
                    }
                }
            },
            username: {
                validators: {

                     stringLength: {
                        min: 5,
                    },
                    notEmpty: {
                        message: 'Masukan Nama Pengguna'
                    }
                }
            }, 
            password: {
                validators: {

                     stringLength: {
                        min: 5,
                    },
                    notEmpty: {
                        message: 'Masukan Kata Sandi'
                    }
                }
            }, 
          
            }
        })
         .on('err.field.fv', function(e, data) {
            // $(e.target)  --> The field element
            // data.fv      --> The FormValidation instance
            // data.field   --> The field name
            // data.element --> The field element

            data.fv.disableSubmitButtons(false);
        })
        .on('success.field.fv', function(e, data) {
            // e, data parameters are the same as in err.field.fv event handler
            // Despite that the field is valid, by default, the submit button will be disabled if all the following conditions meet
            // - The submit button is clicked
            // - The form is invalid
            data.fv.disableSubmitButtons(false);
        });
         /* Login button click handler */
    
});
</script>

</body>
</html>

