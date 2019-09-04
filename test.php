<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>JSON Demo</title>
</head>
<body>
  <ul id="users"></ul>
  <script>
    let request = new XMLHttpRequest();
    request.open('GET', 'http://localhost:82/web/bakend-elearning/index.php/schoolist', true);
      request.onload = function () {
      // Convert JSON data to an object
      let users = JSON.parse(this.response);

      obj = JSON.parse(this.response);


      console.log(users.school_name);


      let output = '';
      for (var i = 0; i < users.length; i++) {
        output += '<li>' + users[i].tenant_name + ' is ' + users[i].tenant_name + ' years old.'; '</li>'
      } 
      document.getElementById('users').innerHTML = output;
    }
    request.send();
  </script>
</body>
</html>

<!DOCTYPE html>
<html>
<body>

<h2>Create Object from JSON String</h2>

<p id="demo"></p>

<script>
var text = '{"0":[' +
'{"firstName":"John","lastName":"Doe" },' +
'{"firstName":"Anna","lastName":"Smith" },' +
'{"firstName":"Peter","lastName":"Jones" }]}';


console.log(text[0])

obj = JSON.parse(text);
document.getElementById("demo").innerHTML =
obj.0[1].firstName + " " + obj.0[1].lastName;
</script>

</body>
</html>
