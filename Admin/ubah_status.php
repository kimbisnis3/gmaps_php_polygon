<!DOCTYPE html>
<?php
include "koneksi.php";
$id = $_GET['id'];
$query = "select * from status where id='$id'";
$result = mysqli_query($sambung, $query) or die("gagal
melakukan query");
$buff = mysqli_fetch_array($result);
mysqli_close($sambung);
?>
<html>
<title>Status Jumlah Penduduk</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="css/w3.css">

<link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.3/css/font-awesome.min.css">
<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">
    <link href="//cdnjs.cloudflare.com/ajax/libs/octicons/3.5.0/octicons.min.css" rel="stylesheet">
    <link href="colorpicker/dist/css/bootstrap-colorpicker.min.css" rel="stylesheet">
    <link href="colorpicker/docs/assets/main.css" rel="stylesheet">

    <script src="//code.jquery.com/jquery-2.2.2.min.js"></script>
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <script src="colorpicker/dist/js/bootstrap-colorpicker.js"></script>
 <!--
<link rel="stylesheet" href="css/bootstrap/css/bootstrap.min.css">
<script src="css/jquery-1.12.2.min.js"></script>
<script src="css/bootstrap/js/bootstrap.min.js"></script>
 -->
<script src="css/bootstrapvalidator.min.js"></script>
<script src="modal/bootstrap.js" type="text/javascript"></script>
<script src="css/jscolor.js"></script>
 <!--
<link rel="stylesheet" href="css/bootstrap/css/bootstrap.min.css">
<script src="css/jquery-1.12.2.min.js"></script>
<script src="css/bootstrap/js/bootstrap.min.js"></script>
 -->
<script src="../css/bootstrapvalidator.min.js"></script>
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
  <a href="tampil_status.php" class="w3-padding w3-green"><i class="glyphicon glyphicon-map-marker"></i>  Status Jumlah Penduduk</a>
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
      <h3>Edit Tabel Status Jumlah Penduduk</h3>
      <form name="form1" method="post" role="form" class="form-horizontal" action="update_status.php" id="contact_form">

<div class="form-group">
    <label for="id" class="control-label col-sm-1">ID:</label>
    <div class="col-sm-2">
  <input type="text" name="id" class="form-control" id="id" value="<?php echo $buff['id']; ?>" >
  </div>
  </div>

<div class="form-group ">
    <label for="id" class="control-label col-sm-1">Nama Status:</label>
    <div class="col-sm-2">
    <input type="text" name="nama_status" class="form-control" id="nama_status" value="<?php echo $buff['nama_status']; ?>">
  </div>
  </div>

<div class="form-group">
      <label for="id" class="control-label col-sm-1">Warna:</label>
    <div class="col-sm-2">
      <div id="cp2" class="input-group colorpicker-component">
      <input type="text" class="form-control " id="warna" value="<?php echo $buff['warna']; ?>" name="warna" placeholder="Warna">
      <span class="input-group-addon"><i></i></span>
            </div></div>
      </div>
      <div class="col-sm-1"></div>
<input type="submit" class="btn btn-success" value="SIMPAN">
<input type="button" value="KEMBALI" class="btn btn-danger"
onClick="self.history.back()">
</form>
    </div>

<div class="col-sm-1"></div>
</div>
<div class="row" >
<div class="col-sm-5"></div>


<!--TAMBAH DATA-->

  <!-- Trigger the modal with a button -->


  <!-- End page content -->
</div>

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
      <script>
          $(function () {
              $('#cp2').colorpicker();
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

            id: {
                validators: {
                        integer: {
                        min: 1,
                    },
                        notEmpty: {
                        message: 'Masukan Id Status'
                    }
                }
            },
            nama_status: {
                validators: {

                     stringLength: {
                        min: 3,
                    },
                    notEmpty: {
                        message: 'Masukan Nama Status'
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
});

</script>
</body>
</html>

