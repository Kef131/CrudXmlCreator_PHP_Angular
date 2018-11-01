<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>CRUD XML Creator</title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<style type="text/css">
    body{
    	padding-top: 70px;
    }
</style>
</head>
<body>
<nav id="myNavbar" class="navbar navbar-default navbar-inverse navbar-fixed-top" role="navigation">
	<!-- Brand and toggle get grouped for better mobile display -->
	<div class="container">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbarCollapse">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<a class="navbar-brand" href="#">CrudXmlManager</a>
		</div>
		<!-- Collect the nav links, forms, and other content for toggling -->
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
	<div class="jumbotron">
		<h1>Create CRUD with a XML UML Class</h1>
		<p>Upload an XML previously structured in a UML Class</p>
	</div>
	<div class="row">
		<div class="col-xs-4">
			<h2>XML Class UML File</h2>
      <p>Follow the next structure</p>
      <textarea rows="20" cols="60" style="border:none;">
            <class name="">
              <attributes>
                <atribute id="" type=""></atribute>
                <atribute id="" type="" lenght=""  ></atribute>
                <atribute id="" type="" deafult="" ></atribute>
              </attributes>
              <functions>
                <function id="" type="" description="">
                  <name></name>
                  <parameters>
                    <parameter type=""></parameter>
                    <parameter type=""></parameter>           
                  </parameters>
                  <parameterReturn type="string"></parameterReturn>
                </function>
              </functions>
          </class>
  </textarea>
      </p>
      <form action="CrudManager.php" method="post" enctype="multipart/form-data">  
        <input type="file" name="file" required />
        <br />
        <input class="btn btn-success" name="submit" type="submit" value="Create CRUD" />
      </form>
		</div>

	</div>
	<hr>
	<div class="row">
		<div class="col-xs-12">
			<footer>
				<p>Kevin Gordillo  MDA 2017 BUAP</p>
			</footer>
		</div>
	</div>
</div>
</body>
</html>                            