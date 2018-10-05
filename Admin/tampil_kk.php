<!DOCTYPE html>
<html>
<title>Master KK</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="css/w3.css">
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
  #logout {
    color: white;}
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
   <a href="logout.php"><span id="logout" class="w3-right glyphicon glyphicon-log-out"> Logout</span></a>
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
  <a href="tampil_kk.php" class="w3-padding w3-green" ><i class="glyphicon glyphicon-th-list"></i>  Master KK</a>
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
      <h3>Master KK</h3>
      <table border="1" class="table table-striped w3-card-4">
      <tr  id="trtabel">
      <th>ID KK</th>
      <th>ID RW</th>
      <th>Kepala Keluarga</th>
      <th colspan="2" >Opsi</th>
      </tr>
      <?php
      $batas = 50;
            $pg = isset( $_GET['pg'] ) ? $_GET['pg'] : "";
             
            if ( empty( $pg ) ) {
            $posisi = 0;
            $pg = 1;
            } else {
            $posisi = ( $pg - 1 ) * $batas;
            }
      $query = "select * from tb_kk limit $posisi, $batas";
      $result = mysqli_query($sambung, $query);
      //$no = 0;
      while ($buff = mysqli_fetch_array($result)){
      //$no++;
      ?>
       <tr>
      <td><?php echo $buff['id_kk']; ?></td>
      <td><?php echo $buff['id_rw']; ?></td>
      <td><?php echo $buff['nama_kepalakeluarga']; ?></td>
      <td>
      <div class="button-toolbar">
      <a href="ubah_kk.php?id_kk=<?php echo $buff ['id_kk']; ?>" class="btn btn-warning glyphicon glyphicon-pencil" role="button" data-toggle="tooltip" title="Edit" data-placement="bottom"></a>


      <a href="#" onclick="confirm_modal('hapus_kk.php?id_kk=<?php echo $buff['id_kk']; ?>');" class="btn btn-danger glyphicon glyphicon-trash" data-toggle="tooltip" title="Hapus" data-placement="bottom"></a></div></td>
        <!-- Trigger the modal with a button -->


      </tr>
      <?php
      };
      //hitung jumlah data
          $jml_data = mysqli_num_rows(mysqli_query($sambung,"select * from tb_kk"));
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
 <!-- <button onclick="document.getElementById('id01').style.display='block'" class="w3-btn w3-green w3-large">Tambah</button>div>-->
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
          <h4><span class="glyphicon glyphicon-lock"></span>Tambah Data KK</h4>
        </div>
<?php require('koneksi.php'); ?>
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
$query = $dbh->query('SELECT MAX(id_kk) as kodex  FROM  tb_kk'); 
$data = $query->fetch();
$kode = $data['kodex']; 
$nourut = ($kode); 
$nourut++; ?>
        <div class="modal-body" style="padding:40px 50px;">
          <form role="form" class="form-horizontal" name="form1" action="entry_kk.php" method="POST" id="contact_form">
            <div class="form-group">
              <label for="kk"><span class="glyphicon glyphicon-user"></span> Id KK</label>
              <input type="text" readonly="true" class="form-control" id="id_kk" name="id_kk" placeholder="Masukkan Id KK" value="<?php echo $nourut; ?>">
            </div>
            <!--<div class="form-group">
              <label for="kk"><span class="glyphicon glyphicon-home"></span> id RW</label>
              <input type="text" class="form-control" id="id_rw" name="id_rw" placeholder="Masukkan ID RW">
            </div>-->
            <div class="form-group ">
                <label for="id" ><span class="glyphicon glyphicon-home"></span> Id RW:</label>
                <select name="id_rw" id="id_rw" class="form-control">
                <option value="">--ID RW--</option>
            <?php 
            require('koneksi.php');
            $sql = mysqli_query($sambung,"SELECT tb_rw.id_rw, tb_rw.nama_rw, tb_kelurahan.nama_kelurahan
              FROM tb_kelurahan
              JOIN tb_rw ON tb_kelurahan.id_kelurahan = tb_rw.id_kelurahan
              ORDER BY tb_rw.id_rw");
            while($val = mysqli_fetch_array($sql)) {
            echo '<option value="'.$val['id_rw'].'">'.$val['id_rw'].'  [RW '.$val['nama_rw'].'] Kelurahan ' .$val['nama_kelurahan'].' </option>';
                  }
                  ?>
                   </select>
            </div>
            <div class="form-group">
              <label for="kk"><span class="glyphicon glyphicon-home"></span> Nama Kepala Keluarga</label>
              <input type="text" class="form-control" id="nama_kepalakeluarga" name="nama_kepalakeluarga" placeholder="Masukan Nama Kepala Keluarga">
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


<div id="id01" class="w3-modal">
  <div class="w3-modal-content w3-card-8 w3-animate-zoom" style="max-width:600px">
  
    <div class="w3-center"><br>
      <span onclick="document.getElementById('id01').style.display='none'" class="w3-closebtn w3-hover-red w3-container w3-padding-8 w3-display-topright" title="Close Modal">&times;</span>
 
    </div>

    <form role="form" class="w3-container" name="form1" action="entry_kk.php" method="POST" id="contact_form1">

             <div class="w3-section">
        <label><b>Username</b></label>
        <div class="form-group">
              <label for="kk"><span class="glyphicon glyphicon-user"></span> Id KK</label>
              <input type="text" class="form-control" id="id_kk" name="id_kk" placeholder="Masukkan Id KK" value="<?php echo $nourut; ?>">
            </div>
            <div class="form-group">
              <label for="kk"><span class="glyphicon glyphicon-home"></span> id RW</label>
              <input type="text" class="form-control" id="id_rw" name="id_rw" placeholder="Masukkan ID RW">
            </div>
            <div class="form-group">
              <label for="kk"><span class="glyphicon glyphicon-home"></span> Nama Kepala Keluarga</label>
              <input type="text" class="form-control" id="nama_kepalakeluarga" name="nama_kepalakeluarga" placeholder="Masukan Nama Kepala Keluarga">
            </div>
        <button class="w3-btn-block w3-green w3-section w3-padding" type="submit">Simpan</button>
      </div>
    </form>

    <div class="w3-container w3-border-top w3-padding-16 w3-light-grey">
      <button onclick="document.getElementById('id01').style.display='none'" type="button" class="w3-btn w3-red">Batal</button>
    </div>

  </div>
</div>

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

            id_rw: {
                validators: {
                        integer: {
                        min: 1,
                    },
                        notEmpty: {
                        message: 'Masukan Id RW'
                    }
                }
            },
            nama_kepalakeluarga: {
                validators: {

                     stringLength: {
                        min: 3,
                    },
                    notEmpty: {
                        message: 'Masukan Nama Kepala Keluarga'
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
<script type="text/javascript">
    $(document).ready(function() {
    $('#contact_form1').bootstrapValidator({
        // To use feedback icons, ensure that you use Bootstrap v3.1.0 or later
        feedbackIcons: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields: {

            id_rw: {
                validators: {
                        integer: {
                        min: 1,
                    },
                        notEmpty: {
                        message: 'Masukan Id RW'
                    }
                }
            },
            nama_kepalakeluarga: {
                validators: {

                     stringLength: {
                        min: 3,
                    },
                    notEmpty: {
                        message: 'Masukan Nama Kepala Keluarga'
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

