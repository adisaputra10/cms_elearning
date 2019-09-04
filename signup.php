<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Inspeksi</title>
    <meta name="author" content="phpmu.com">
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="plugins/iCheck/square/blue.css">
  </head>
  <body class="hold-transition login-page">
    <div class="login-box">
      <div class="login-logo">
        <a href="../../index2.html"><b>Inspeksi</b> </a>
      </div><!-- /.login-logo -->
      <div class="login-box-body">
        <p class="login-box-msg">Sign Up</p>

        <form action="" method="post">

        <div class="form-group has-feedback">
            <input type="text" class="form-control"   id='names' placeholder="Name" required>
            <span class="glyphicon glyphicon-user form-control-feedback"></span>
          </div>


          <div class="form-group has-feedback">
            <input type="text" class="form-control" id='group' placeholder="Group" required>
            <span class="glyphicon glyphicon-user form-control-feedback"></span>
          </div>

          <div class="form-group has-feedback">
            <input type="text" class="form-control" id='cost' placeholder="Cost Center" required>
            <span class="glyphicon glyphicon-user form-control-feedback"></span>
          </div>

          <div class="form-group has-feedback">
            <input type="text" class="form-control" id='departement'  placeholder="Departement" required>
            <span class="glyphicon glyphicon-user form-control-feedback"></span>
          </div>

          <div class="form-group has-feedback">
            <input type="text" class="form-control" id='company' placeholder="Company" required>
            <span class="glyphicon glyphicon-user form-control-feedback"></span>
          </div>



          <div class="form-group has-feedback">
            <input type="text" class="form-control" id='issuedate' placeholder="Issue Date" required>
            <span class="glyphicon glyphicon-user form-control-feedback"></span>
          </div>

          <div class="form-group has-feedback">
            <input type="text" class="form-control" id='email'  placeholder="Email" required>
            <span class="glyphicon glyphicon-user form-control-feedback"></span>
          </div>

          <div class="form-group has-feedback">
            <input type="text" class="form-control" id='userid'  placeholder="User ID" required>
            <span class="glyphicon glyphicon-user form-control-feedback"></span>
          </div>


          <div class="form-group has-feedback">
            <input type="text" class="form-control" id='username'  placeholder="Username" required>
            <span class="glyphicon glyphicon-user form-control-feedback"></span>
          </div>
          <div class="form-group has-feedback">
            <input type="password" class="form-control" id='password'  placeholder="Password" required>
            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
          </div>


          <div class="form-group has-feedback">
            <input type="password" class="form-control" id='upassword'  placeholder="Ulang Password" required>
            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
          </div>
          <div class="row">
            <div class="col-xs-8">
             
            </div><!-- /.col -->
            <div class="col-xs-4">
              <button   type="submit" onclick='simpan()' class="btn btn-primary btn-block btn-flat">Sign Up</button>
            </div><!-- /.col -->
          </div>
        </form>

      </div><!-- /.login-box-body -->
    </div><!-- /.login-box -->




    <script type="text/javascript">

function simpan() {

  var name = document.getElementById("names").value;
  var group = document.getElementById("group").value;
  var cost = document.getElementById("cost").value;
  var departement = document.getElementById("departement").value;
  var company = document.getElementById("company").value;
  var issuedate = document.getElementById("issuedate").value;
  var email = document.getElementById("email").value;
  var userid = document.getElementById("userid").value;

  $.ajax({
                    type: "POST",
                    dataType: "json",
                    url: "http://localhost:2000/users/add",
                    data: {name: name , group: group ,cost_center: cost, departement: departement, company: company, issue_date: issuedate, email: email,userid: userid,username: 'password',password: 'password'},
                    success: function (msg) {
                        if (msg == '') {
                        } else {
                            //alert(msg);
                        }
                       alert(msg + ' data ');
                    }
                });
 
}


</script>




    <!-- jQuery 2.1.4 -->
    <script src="plugins/jQuery/jQuery-2.1.4.min.js"></script>
    <!-- Bootstrap 3.3.5 -->
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <!-- iCheck -->
    <script src="plugins/iCheck/icheck.min.js"></script>
    <script>
      $(function () {
        $('input').iCheck({
          checkboxClass: 'icheckbox_square-blue',
          radioClass: 'iradio_square-blue',
          increaseArea: '20%' // optional
        });
      });
    </script>




  </body>
</html>



          
