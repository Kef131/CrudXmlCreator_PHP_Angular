<?php
   include("src/config.php");
   
   session_start();
   $servername = DBHOST;
   $username   = DBUSER;
   $password   = DBPWD;
   
   $conn = new mysqli($servername, $username, $password, $_COOKIE['dbname']);
   if ($conn->connect_error) {
       die("<p>Connection failed: " . $conn->connect_error . "</p>");
   }
   ?>
<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <title>CRUD XML Creator</title>
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
      <script src="http://code.jquery.com/jquery-1.10.2.js"></script>
      <link rel='stylesheet prefetch' href='http://ajax.googleapis.com/ajax/libs/jqueryui/1.11.2/themes/smoothness/jquery-ui.css'>
      <link rel='stylesheet prefetch' href='http://netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css'>
      <style type="text/css">
         body{
         padding-top: 70px;
         }
      </style>
   </head>
   <body>
      <nav id="myNavbar" class="navbar navbar-default navbar-inverse navbar-fixed-top" role="navigation">
         <div class="container">
            <div class="navbar-header">
               <a class="navbar-brand" >CrudXmlManager</a>
            </div>
            <div class="collapse navbar-collapse" id="navbarCollapse">
               <ul class="nav navbar-nav">
                  <li class="active"><a href="index.php">Convert XML UML CLASS to CRUD</a></li>
                  <li class="active"><a href="index.php">Convert XML UML CLASS to Login</a></li>
                  <li class="active"><a href="index.php">Convert XML UML CLASS to Contact Form</a></li>
               </ul>
            </div>
         </div>
      </nav>
      <div class="container">
      <div class="container">
         <div class="jumbotron">
            <h1>CRUD UI: <?php
               echo $_COOKIE['dbname'];
               ?></h1>
            <p> Editable values of the current data, just click in the values and deselect </p>
            <ul>
               <li>Delete the elements in real time</li>
               <li>Add base elements and modify it</li>
            </ul>
         </div>
         <hr>
         <button class="btn btn-success" onclick="insertDb('<?php
            echo ($_COOKIE['ins']);
            ?>')"> Add <?php
            echo $_COOKIE['dbname'];
            ?>  </button>
         <table class='table'>
         <tr>
            <?php
               if ($result = mysqli_query($conn, "SELECT * FROM " . $_COOKIE['dbname'])) {
                   $row = mysqli_fetch_assoc($result);
               ?>
            <table id="crud" class="table">
               <thead>
                  <tr>
                     <?php
                        foreach ($row as $k => $v) {
                        ?>
                     <th class="table-header" > <?php
                        echo $k;
                        ?> </th>
                     <?php
                        }
                        ?>
                     <th> Delete</th>
                  </tr>
               </thead>
               <tr>
                  <?php
                     foreach ($row as $k => $v) {
                         if ($k != 'id') {
                     ?>
                  <td contenteditable='true' onClick="showEdit(this)" onBlur="saveToDatabase(this,'<?php
                     echo $k . "','" . $row['id'];
                     ?>')"> <?php
                     echo $v;
                     ?> </td>
                  <?php
                     } else {
                     ?>
                  <td ><?php
                     echo $v;
                     ?></td>
                  <?php
                     }
                     }
                     ?>
                  <td><span  onclick="deleteDatabase('<?php
                     echo $row['id'];
                     ?>')" class='table-remove glyphicon glyphicon-remove'></span></td>
               </tr>
               <?php
                  while ($row = mysqli_fetch_assoc($result)) {
                  ?>
               <tr>
                  <?php
                     foreach ($row as $k => $v) {
                         if ($k != 'id') {
                     ?>
                  <td contenteditable='true' onclick="alerdt('<?php
                     echo $k;
                     ?>')" onBlur="saveToDatabase(this,'<?php
                     echo $k . "','" . $row['id'];
                     ?>')"> <?php
                     echo $v;
                     ?> </td>
                  <?php
                     } else {
                     ?>
                  <td ><?php
                     echo $v;
                     ?></td>
                  <?php
                     }
                     }
                     ?>
                  <td><span class='table-remove glyphicon glyphicon-remove' onclick="deleteDatabase('<?php
                     echo $row['id'];
                     ?>')" ></span></td>
               </tr>
               <?php
                  }
                  ?>
               <?php
                  }
                  
                  ?>
               </tr>
            </table>
            <br /> <br />
            <hr>
            <div class="row">
               <div class="col-xs-12">
                  <footer>
                     <p> Kevin Gordillo dMDA 2017 BUAP</p>
                  </footer>
               </div>
            </div>
      </div>
      <script>
         function saveToDatabase(editableObj,column,id) {
           $(editableObj).css("background","#FFF url(src/loaderIcon.gif) no-repeat right");
           $.ajax({
             url: "src/editableTable.php",
             type: "POST",
             data:'column='+column+'&editval='+editableObj.innerHTML+'&id='+id,
             success: function(data){
               $(editableObj).css("background","#FDFDFD");
             }        
            });
         }
         
         function deleteDatabase(id) {
           $.ajax({
             url: "src/editableTable.php",
             type: "POST",
             data:'deleteId='+id,
             success: function(data){
               window.location.reload(false); 
             }        
            });
         }
         
         function insertDb(sql) {
           $.ajax({
             url: "src/editableTable.php",
             type: "POST",
             data:'sql='+sql,
             success: function(data){
               window.location.reload(false); 
             }        
            });
         }
         
         function showEdit(editableObj) {
         			$(editableObj).css("background","#FFF");
         		} 
         
         function exa(id, id2, id3){
           alert("alert: "+id+id2+id3);
         }
      </script>
   </body>
</html>