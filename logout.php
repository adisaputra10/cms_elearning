<script type="text/javascript">
  if(localStorage.getItem("username").length > 0){
    alert(' Anda Berhasil  logout ');
    localStorage.removeItem("username");
     window.location = "login.php";
  }
  </script>