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
  
      <div class="container">
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
      </div>
      <script>
         function saveToDatabase(editableObj,column,id) {
           $(editableObj).css("background","#FFF url(loaderIcon.gif) no-repeat right");
           $.ajax({
             url: "editableTable.php",
             type: "POST",
             data:'column='+column+'&editval='+editableObj.innerHTML+'&id='+id,
             success: function(data){
               $(editableObj).css("background","#FDFDFD");
             }        
            });
         }
         
         function deleteDatabase(id) {
           $.ajax({
             url: "editableTable.php",
             type: "POST",
             data:'deleteId='+id,
             success: function(data){
               window.location.reload(false); 
             }        
            });
         }
         
         function insertDb(sql) {
           $.ajax({
             url: "editableTable.php",
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