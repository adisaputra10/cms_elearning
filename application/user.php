

<?php 
if ($_GET[act]==''){
  
 
  ?> 

<script>  
   
   
$.ajax({
    url: '<?php echo $host ?>/index.php/user',
    type: "get",
    dataType: "json",
    success: function(data) {

      console.log(data[0].id_user)

      console.log("data", data.length);
      var dataArray =  data;
      var x=1;
      for (var i = 0; i < data.length; i++) {
      console.log(data[i].id_user + " "  +  data[i].tenant_code );

        var id_user=data[i].id_user ;
      $('#mytable').append("<tr><td>" +  x + "</td><td>" 
      +  data[i].tenant_code + "</td><td>" 
      +  data[i].tenant_name + "</td> <td>" 
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
            <div class="col-xs-12">  
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">User List Tenant  <?php  echo "$status"; ?> </h3>
                  <?php if($_SESSION[level]!='kepala'){ ?>
                
               
          
                  <a class='pull-right btn btn-primary btn-sm' href='index.php?view=user&act=tambah'>Add User Tenant</a>
                  
                  <?php } ?>
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
                        <th>Tenant Code</th>
                        <th>Name</th>
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
                              <td>$r[desa]</td>  ";
                          
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
                  <h3 class='box-title'>Add User Tenant</h3>
                </div>
              <div class='box-body'>
              <form method='POST' class='form-horizontal' action='' enctype='multipart/form-data'>
                <div class='col-md-12'>
                  <table class='table table-condensed table-bordered'>
                  <tbody>
                    <tr><th width='120px' scope='row'> Tenant Code</th> <td><input type='text' class='form-control' name='nama'> </td></tr>
                    <tr><th width='120px' scope='row'>Username</th> <td><input type='text' class='form-control' name='nik'> </td></tr>

                    <tr><th width='120px' scope='row'>Email</th> <td><input type='text' class='form-control' name='username'> </td></tr>
                    <tr><th width='120px' scope='row'>Mobile</th> <td><input type='text' class='form-control' name='username'> </td></tr>
                    <tr><th width='120px' scope='row'>Password</th> <td><input type='text' class='form-control' name='kec'> </td></tr>
                    <tr><th width='120px' scope='row'>Ulang Password</th> <td><input type='text' class='form-control' name='desa'> </td></tr>
          
                    
                  </tbody>
                  </table>
                </div>
              </div>
              <div class='box-footer'>
                    <button type='submit' name='tambah' class='btn btn-info'>Save</button>
                    <a href='index.php?view=data'><button class='btn btn-default pull-right'>Cancel</button></a>
                    
                  </div>
              </form>
            </div>";
}
?>