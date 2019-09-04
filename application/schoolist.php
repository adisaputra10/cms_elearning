<?php 
if ($_GET[act]==''){
  
  ?> 

<script>  
   
$.ajax({
    url: '<?php echo $host ?>/index.php/schoolist',
    type: "get",
    dataType: "json",
    success: function(data) {
      console.log(data.length);
      var x=1;
      for (var i = 0; i < data.length; i++) {
       
        var id_schoolist=data[i].id_schoolist ;
      $('#mytable').append("<tr><td>" +  x + "</td><td>" 
      +  data[i].school_name + "</td> <td>" 
      +  data[i].address_sch + "</td> <td>" 
      +  data[i].city_sch + "</td> <td>" 
      +  data[i].headmaster + "</td> <td>" 
      +  data[i].type + "</td> <td>" 
      +  data[i].tenant_name + "</td> <td>" 
      +  data[i].aktif_date_sch + "</td> <td>  <button type='button'    value=" + data[i].id_schoolist  + " onClick='deletedata(this.value)' class='btn btn-danger btn-xs' title='Disable '><span class='glyphicon glyphicon-remove'></button> "
      + "    <a class='btn btn-success btn-xs' title='Edit' href='index.php?view=schoolist&act=edit&id=" + id_schoolist + "'> <span class='glyphicon glyphicon-edit'></span></a>  </td>    </tr>");
	
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
                    url: '<?php echo $host ?>/index.php/schoolist/delete/'+clicked_id,
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
                  <h3 class="box-title">School List  </h3>
       
                  <a class='pull-right btn btn-primary btn-sm' href='index.php?view=schoolist&act=tambah'>Add School</a>
                  
                
                </div><!-- /.box-header -->
                <div class="box-body">
              
                  <table id="mytable" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th style='width:40px'>No</th>
                        <th>School Name </th>
                        <th>Address</th>
                        <th>City</th>
                        <th>Headmaster</th>
                        <th>School Type</th>
                        <th>Tenant Name</th>
                       
                        <th>Active Date</th>
                    
                        <th style='width:70px'>Action</th>
             
                      </tr>
                    </thead>
                 
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
      url: '<?php echo $host ?>/index.php/schoolist/detail/<?php echo "$_GET[id]" ?>',
      type: "get",
      dataType: "json",
      success: function(data) {
      
       // console.log(data );
     //console.log(data[0].username );
     document.getElementById("tenant_code").value=data[0].tenant_code;
     document.getElementById("school_name").value=data[0].school_name;
     document.getElementById("headmaster").value=data[0].headmaster;
  
     document.getElementById("city").value=data[0].city_sch;
     document.getElementById("typesch").value=data[0].type;
     document.getElementById("address").value=data[0].address_sch;
     document.getElementById("province").value=data[0].province_sch;
     document.getElementById("postal").value=data[0].postal_code_sch;
  
  
     document.getElementById("contact_person").value=data[0].contact_person;
     document.getElementById("phone").value=data[0].phone_sch;
   
  
     document.getElementById("email").value=data[0].email_sch;
     document.getElementById("aktif_date").value=data[0].aktif_date_sch;

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
                  <tr><th width='120px' scope='row'>Tenant Code</th> <td><input type='text' class='form-control' id='tenant_code'> </td></tr>
                  <tr><th width='120px' scope='row'>School Name</th> <td><input type='text' class='form-control' id='school_name'> </td></tr>
                  <tr><th width='120px' scope='row'>Headmaster</th> <td><input type='text' class='form-control'  id='headmaster'> </td></tr>
                  <tr><th width='120px' scope='row'>School Type</th> <td><input type='text' class='form-control' id='typesch'> </td></tr>
                  <tr><th width='120px' scope='row'>Address</th> <td><input type='text' class='form-control' id='address'> </td></tr>
                  <tr><th width='120px' scope='row'>City</th> <td><input type='text' class='form-control' id='city'> </td></tr>
                  <tr><th width='120px' scope='row'>Province</th> <td><input type='text' class='form-control' id='province'> </td></tr>
                  <tr><th width='120px' scope='row'>Postal Code</th> <td><input type='text' class='form-control' id='postal'> </td></tr>
                  <tr><th width='120px' scope='row'>Contact Person</th> <td><input type='text' class='form-control' id='contact_person'> </td></tr>
                  <tr><th width='120px' scope='row'> Phone </th> <td><input type='text' class='form-control' id='phone'> </td></tr>
 
                  <tr><th width='120px' scope='row'> Email </th> <td><input type='text' class='form-control' id='email'> </td></tr>
               
                  <tr><th width='120px' scope='row'> Aktif Date </th> <td><input type='text' readonly='true' class='form-control' id='aktif_date'> </td></tr>
               
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
                    <tr><th width='120px' scope='row'>School Name</th> <td><input type='text' class='form-control' id='school_name'> </td></tr>
                    <tr><th width='120px' scope='row'>Headmaster</th> <td><input type='text' class='form-control'  id='headmaster'> </td></tr>
                    <tr><th width='120px' scope='row'>School Type</th> <td><input type='text' class='form-control' id='typesch'> </td></tr>
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
              var school_name = document.getElementById("school_name").value;
              

              var headmaster = document.getElementById("headmaster").value;
              var typesch = document.getElementById("typesch").value;
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
                                url: '<?php echo $host ?>/index.php/schoolist/create',
                                data: {tenant_code: tenant_code , school_name: school_name, headmaster: headmaster , typesch: typesch  ,address: address, city: city, province: province, postal_code: postal_code,postal_code: postal_code,contact_person: contact_person,phone: phone, mobile:mobile,email: email},
                                success: function (msg) {
                                    if (msg == '') {
                                    } else {
                                      // alert(msg);
                                    }
                                  
                                }
                            });
            
                            alert('Data berhasil di simpan');
                                    window.location = "index.php?view=schoolist";
             
            }
            </script>
            
            
            
            
            <?php


}
?>