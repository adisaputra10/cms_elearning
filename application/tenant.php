<?php 
if ($_GET[act]==''){
  

  ?> 

<script>  
   
$.ajax({
    url: '<?php echo $host ?>/index.php/tenant',
    type: "get",
    dataType: "json",
    success: function(data) {
      var dataArray =  data;
      var x=1;
      for (var i = 0; i < data.length; i++) {
      console.log(data[i].id_tenant + " "  +  data[i].tenant_code );

        var id_tenant=data[i].id_tenant ;
      $('#mytable').append("<tr><td>" +  x + "</td><td>" 
      +  data[i].tenant_code + "</td> <td>" 
      +  data[i].tenant_name + "</td> <td>" 
      +  data[i].address + "</td> <td>" 
      +  data[i].city + "</td> <td>" 
      +  data[i].province + "</td> <td>" 
      +  data[i].postal_code + "</td> <td>" 
      +  data[i].contact_person + "</td> <td>" 
      +  data[i].phone + "</td> <td>" 
      +  data[i].email + "</td> <td>" 
      +  data[i].aktif_date + "</td> <td>  <button type='button'    value=" + data[i].id_tenant  + " onClick='deletedata(this.value)' class='btn btn-danger btn-xs' title='Disable '><span class='glyphicon glyphicon-remove'></button> "
      + "    <a class='btn btn-success btn-xs' title='Edit' href='index.php?view=tenant&act=edit&id=" + id_tenant + "'> <span class='glyphicon glyphicon-edit'></span></a>  </td>    </tr>");
	
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
                    url: '<?php echo $host ?>/index.php/tenant/delete/'+clicked_id,
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
                  <h3 class="box-title"> List Tenant   </h3>
                  <a class='pull-right btn btn-primary btn-sm' href='index.php?view=tenant&act=tambah'>Add  Tenant</a>
                  
               
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
                        <th>Tenant Name</th>
                        <th>Address</th>
                        <th>City</th>
                        <th>Province</th>
                        <th>Postal Code</th>
                        <th>Contact Person</th>
                        <th>Mobile</th>
                        <th>Email</th>
                        <th>Active Date</th>
                    
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
                              <td>$r[nama]</td>    
                              <td>$r[nama]</td>
                              <td>$r[nama]</td> 
                              <td>$r[nama]</td>   ";
                          
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

  ?> 

<script>  
   
$.ajax({
    url: '<?php echo $host ?>/index.php/tenant/detail/<?php echo "$_GET[id]" ?>',
    type: "get",
    dataType: "json",
    success: function(data) {
    
     // console.log(data );
   //console.log(data[0].username );
   document.getElementById("tenant_code").value=data[0].tenant_code;
   document.getElementById("tenant_name").value=data[0].tenant_name;
   document.getElementById("address").value=data[0].address;

   

   document.getElementById("city").value=data[0].city;
   document.getElementById("province").value=data[0].province;
   document.getElementById("postal").value=data[0].postal;


   document.getElementById("contact_person").value=data[0].contact_person;
   document.getElementById("phone").value=data[0].phone;
 

   document.getElementById("email").value=data[0].email;


      var x=1;
    
    }
});
 </script> 

<?php

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
                    <input type='hidden' name='id' value='$_GET[id]'>
                
                    <tr><th width='120px' scope='row'>Tenant Code</th> <td><input type='text' class='form-control' id='tenant_code'> </td></tr>
                    <tr><th width='120px' scope='row'>Tenant Name</th> <td><input type='text' class='form-control' id='tenant_name'> </td></tr>
                    <tr><th width='120px' scope='row'>Address</th> <td><input type='text' class='form-control' id='address'> </td></tr>
                    <tr><th width='120px' scope='row'>City</th> <td><input type='text' class='form-control' id='city'> </td></tr>
                    <tr><th width='120px' scope='row'>Province</th> <td><input type='text' class='form-control' id='province'> </td></tr>
                    <tr><th width='120px' scope='row'>Postal Code</th> <td><input type='text' class='form-control' id='postal'> </td></tr>
                    <tr><th width='120px' scope='row'>Contact Person</th> <td><input type='text' class='form-control' id='contact_person'> </td></tr>
                    <tr><th width='120px' scope='row'> Phone </th> <td><input type='text' class='form-control' id='phone'> </td></tr>
      
                    <tr><th width='120px' scope='row'> Email </th> <td><input type='text' class='form-control' id='email'> </td></tr>
   


            
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
                    <tr><th width='120px' scope='row'>Tenant Code</th> <td><input type='text' class='form-control' id='tenant_code'> </td></tr>
                    <tr><th width='120px' scope='row'>Tenant Name</th> <td><input type='text' class='form-control' id='tenant_name'> </td></tr>
                    <tr><th width='120px' scope='row'>Address</th> <td><input type='text' class='form-control' id='address'> </td></tr>
                    <tr><th width='120px' scope='row'>City</th> <td><input type='text' class='form-control' id='city'> </td></tr>
                    <tr><th width='120px' scope='row'>Province</th> <td><input type='text' class='form-control' id='province'> </td></tr>
                    <tr><th width='120px' scope='row'>Postal Code</th> <td><input type='text' class='form-control' id='postal'> </td></tr>
                    <tr><th width='120px' scope='row'>Contact Person</th> <td><input type='text' class='form-control' id='contact_person'> </td></tr>
                    <tr><th width='120px' scope='row'> Phone </th> <td><input type='text' class='form-control' id='phone'> </td></tr>
                    <tr><th width='120px' scope='row'> Mobile </th> <td><input type='text' class='form-control' id='mobile'> </td></tr>
                    <tr><th width='120px' scope='row'> Email </th> <td><input type='text' class='form-control' id='email'> </td></tr>
   
                  </tbody>
                  </table>
                </div>
              </div>
              <div class='box-footer'>
              <button type='button' name='tambah'  onclick='simpan()' class='btn btn-info'>Tambahkan</button>
                    <a href='index.php?view=data'><button class='btn btn-default pull-right'>Cancel</button></a>
                    
                  </div>
              </form>
            </div>";
?>

<script type="text/javascript">

function simpan() {

 
  var tenant_code = document.getElementById("tenant_code").value;
  var tenant_name = document.getElementById("tenant_name").value;
  var address = document.getElementById("address").value;
  var city = document.getElementById("city").value;
  var province = document.getElementById("province").value;

  var postal_code = document.getElementById("postal").value;
  var contact_person = document.getElementById("contact_person").value;

  var phone = document.getElementById("phone").value;
  var mobile = document.getElementById("mobile").value;
  var email = document.getElementById("email").value;
  //alert("msg");

  $.ajax({
                    type: "POST",
                    dataType: "json",
                    url: '<?php echo $host ?>/index.php/tenant/create',
                    data: {tenant_code: tenant_code , tenant_name: tenant_name ,address: address, city: city, province: province, postal_code: postal_code,postal_code: postal_code,contact_person: contact_person,phone: phone, mobile:mobile,email: email},
                    success: function (msg) {
                        if (msg == '') {
                        } else {
                          // alert(msg);
                        }
                      
                    }
                });

                alert('Data berhasil di simpan');
                        window.location = "index.php?view=tenant";
 
}
</script>




<?php



}
?>