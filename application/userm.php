<?php 
if ($_GET[act]==''){
  
  $back_sql="";
  $status="";
  

  ?> 


<script>  
   
$.ajax({
    url: '<?php echo $host ?>/index.php/user/userm',
    type: "get",
    dataType: "json",
    success: function(data) {
      var dataArray =  data;
      var x=1;
      for (var i = 0; i < data.length; i++) {
      console.log(data[i].id_user + " "  +  data[i].tenant_code );

        var id_user=data[i].id_user ;
      $('#mytable').append("<tr><td>" +  x + "</td><td>" 
      +  data[i].username + "</td> <td>" 
      +  data[i].email_user + "</td> <td>" 
      +  data[i].handphone_user + "</td> <td>" 
      +  data[i].lastlogin + "</td> <td>  <button type='button'    value=" + data[i].id_user  + " onClick='deletedata(this.value)' class='btn btn-danger btn-xs' title='Disable '><span class='glyphicon glyphicon-remove'></button> "
      + "    <a class='btn btn-success btn-xs' title='Edit' href='index.php?view=user&act=edit&id=" + id_user + "'> <span class='glyphicon glyphicon-edit'></span></a>  </td>    </tr>");
	
    x += 1 ;
    }   
    }
});
 </script>



<script type="text/javascript">
function deletedata(clicked_id)
  {
 
       $.ajax({
                    type: "DELETE",
                    dataType: "json",
                    url: '<?php echo $host ?>/index.php/user/delete/'+clicked_id,
                    data: {id_user: clicked_id},
                    success: function (msg) {
                        if (msg == '') {
                        } else {
                         
                          alert("Data berhasil di hapus");
                        }
                     location.reload();
                    }
                }); 
  }
</script>

            <div class="col-xs-12">  
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Data User</h3>
              
   
                  <a class='pull-right btn btn-primary btn-sm' href='index.php?view=userm&act=tambah'>Add User</a>
                  
         
                </div><!-- /.box-header -->
                <div class="box-body">
                <?php 
                  if (isset($_GET['sukses'])){
                      echo "<div class='alert alert-success alert-dismissible fade in' role='alert'> 
                          <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                          <span aria-hidden='true'>×</span></button> <strong>Sukses!</strong> - Data telah Berhasil Di Proses,..
                          </div>";
                  }elseif(isset($_GET['gagal'])){
                      echo "<div class='alert alert-danger alert-dismissible fade in' role='alert'> 
                          <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                          <span aria-hidden='true'>×</span></button> <strong>Gagal!</strong> - Data tidak Di Proses, terjadi kesalahan dengan data..
                          </div>";
                  }
                ?>
                  <table id="mytable" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th style='width:40px'>No</th>
                
                        <th>Username</th>
                        <th>Email</th>
                        <th>Mobile</th>
                        <th>Last Login</th>
                 
                    
                        <th style='width:70px'>Action</th>
             
                      </tr>
                    </thead>
                    <tbody>
                  <?php 
                    $tampil = mysql_query("SELECT * FROM data $back_sql ORDER BY id_data DESC");
                   // echo $tampil;
                    $no = 1;
                    while($r=mysql_fetch_array($tampil)){
                    echo "<tr><td>$no</td>
                              <td>$r[nama]</td>
                              <td>$r[nik]</td>
                              <td>$r[kec]</td>
                              ";
                          
                        echo "<td><center>
                                <a class='btn btn-success btn-xs' title='Edit Data' href='index.php?view=user&act=edit&id=$r[id_data]'><span class='glyphicon glyphicon-edit'></span></a>
                                <a class='btn btn-danger btn-xs' title='Delete Data' href='index.php?view=user&hapus=$r[id_data]' onclick=\"return confirm('Apa anda yakin untuk hapus Data ini?')\"><span class='glyphicon glyphicon-remove'></span></a>
                              </center></td>";
                        
                            echo "</tr>";
                      $no++;
                      }
                      if (isset($_GET[hapus])){
                          mysql_query("DELETE FROM data where id_data='$_GET[hapus]'");
                          echo "<script>document.location='index.php?view=data';</script>";
                      }

                  ?>
                    </tbody>
                  </table>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div>
<?php 
}

elseif($_GET[act]=='edit'){

   if (isset($_POST[update])){

      if(empty($_POST['nama']) || empty($_POST['nik']) || empty($_POST['kec']) || empty($_POST['desa']) || empty($_POST['nohp']) ){
        echo "<script>alert('Harap isi semua data')</script>";
      }else{
        $query = mysql_query("UPDATE data SET nama = '$_POST[nama]',
                                         nik = '$_POST[nik]', kec = '$_POST[kec]', desa = '$_POST[desa]', nohp = '$_POST[nohp]'    where id_data='$_POST[id]'");
        if ($query){
          echo "<script>document.location='index.php?view=data&sukses';</script>";
        }else{
          echo "<script>document.location='index.php?view=data&gagal';</script>";
        } }
    
    
    
      }
    $edit = mysql_query("SELECT * FROM data where id_data='$_GET[id]'");
    $s = mysql_fetch_array($edit);
    echo "<div class='col-md-12'>
              <div class='box box-info'>
                <div class='box-header with-border'>
                  <h3 class='box-title'>Edit Data </h3>
                </div>
              <div class='box-body'>
              <form method='POST' class='form-horizontal' action='' enctype='multipart/form-data'>
                <div class='col-md-12'>
                  <table class='table table-condensed table-bordered'>
                  <tbody>
                    <input type='hidden' name='id' value='$s[id_data]'>
                
                    <tr><th width='120px' scope='row'>Nama</th> <td><input type='text' class='form-control' name='nama'   value='$s[nama]'> </td></tr>
                    <tr><th width='120px' scope='row'>NIK</th> <td><input type='text' class='form-control' name='nik'  value='$s[nik]'> </td></tr>
                    <tr><th width='120px' scope='row'>Kecamatan</th> <td><input type='text' class='form-control' name='kec'  value='$s[kec]'> </td></tr>
                    <tr><th width='120px' scope='row'>Desa</th> <td><input type='text' class='form-control' name='desa'  value='$s[desa]'> </td></tr>
                    <tr><th width='120px' scope='row'>No HP</th> <td><input type='text' class='form-control' name='nohp'  value='$s[nohp]'> </td></tr>
                  


            
                    </tbody>
                  </table>
                </div>
              </div>
              <div class='box-footer'>
                    <button type='submit' name='update' class='btn btn-info'>Update</button>
                    <a href='index.php?view=golongan'><button class='btn btn-default pull-right'>Cancel</button></a>
                    
                  </div>
              </form>
            </div>";
}elseif($_GET[act]=='tambah'){
    if (isset($_POST[tambah])){

      if(empty($_POST['nama']) || empty($_POST['nik']) || empty($_POST['kec']) || empty($_POST['desa']) || empty($_POST['nohp']) ){
        echo "<script>alert('Harap isi semua data')</script>";
      }else{
        $date=date("Y-m-d");
        $query = mysql_query("INSERT INTO data VALUES('','$_POST[nama]','$_POST[nik]','$_POST[kec]','$_POST[desa]','$_POST[nohp]','web','$date','' )");

        if ($query){
          echo "<script>document.location='index.php?view=data&sukses';</script>";
        }else{
          echo "<script>document.location='index.php?view=data&gagal';</script>";
        }

      }
    }

    echo "<div class='col-md-12'>
              <div class='box box-info'>
                <div class='box-header with-border'>
                  <h3 class='box-title'>Add User</h3>
                </div>
              <div class='box-body'>
              <form method='POST' id='my_form' class='form-horizontal' action='' enctype='multipart/form-data'>
                <div class='col-md-12'>
                  <table class='table table-condensed table-bordered'>
                  <tbody>
                   <tr><th width='120px' scope='row'>Username</th> <td><input type='text' class='form-control'  id='username'  > </td></tr>

                  <tr><th width='120px' scope='row'>Email</th> <td><input type='text' class='form-control' id='email' > </td></tr>
                  <tr><th width='120px' scope='row'>Mobile</th> <td><input type='text' class='form-control' id='mobile' > </td></tr>
                  <tr><th width='120px' scope='row'>Password</th> <td><input type='password' class='form-control' id='password'  > </td></tr>
                  <tr><th width='120px' scope='row'>Ulang Password</th> <td><input type='password' class='form-control'  id='upassword' > </td></tr>
        
                    
                  </tbody>
                  </table>
                </div>
              </div>
              <div class='box-footer'>
              <button type='button' name='tambah'  onclick='simpan()' class='btn btn-info'>Tambahkan</button>
                    <a href='index.php?view=userm'><button class='btn btn-default pull-right'>Cancel</button> </a>
                    
                  </div>
              </form>
            </div>";

?>


<script type="text/javascript">

function simpan() {

  var tenant_code = 99;
  var username = document.getElementById("username").value;
  var email = document.getElementById("email").value;
  var mobile = document.getElementById("mobile").value;
  var password = document.getElementById("password").value;
  var upassword = document.getElementById("upassword").value;
 

  $.ajax({
                    type: "POST",
                    dataType: "json",
                    url: '<?php echo $host ?>/index.php/user/create',
                    data: {tenant_code: tenant_code , username: username ,email: email, mobile: mobile, password: password, upassword: upassword},
                    success: function (msg) {
                        if (msg == '') {
                        } else {
                         //   alert(msg);
                        }
                        alert('Data berhasil di simpan');
                        window.location = "index.php?view=userm";
                    }
                });
 
}
</script>




<?php 


}
?>