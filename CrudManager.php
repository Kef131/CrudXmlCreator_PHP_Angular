<?php
include("src/XmlModelFile.php");
include("src/CrudBaseModel.php");
include("src/CrudDBManager.php");

session_start();
$xmlLoaded = false;
$xmlName = "";
$xlmUploaded = null;

if(file_exists($_FILES['file']['tmp_name']) || is_uploaded_file($_FILES['file']['tmp_name'])) {
	$xlmUploaded = file_get_contents($_FILES["file"]["tmp_name"]);
	$xmlName = $_FILES["file"]["name"];
	$xmlLoaded = true;
	unset($_POST);
}else{
	$xmlLoaded = false;
}

	

?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>CRUD XML Creator</title>
<!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"> -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
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
	<!-- Brand and toggle get grouped for better mobile display -->
	<div class="container">
		<div class="navbar-header">
			
			<a class="navbar-brand" >CrudXmlManager</a>
		</div>
		<!-- Collect the nav links, forms, and other content for toggling -->
		<div class="collapse navbar-collapse" id="navbarCollapse">
			<ul class="nav navbar-nav">
			</ul>
		</div>
	</div>
</nav>

<div class="container">
	<div class="jumbotron">
		<?php if ($xmlLoaded==true){
				echo  "<p>Loading XML</p>";
				
				$xmlModel = new XmlModelFile($xmlName,$xlmUploaded);
				if($xmlLoaded==true){
					$crudModel = new CrudBaseModel( $xmlModel->readXmlString() );
					$crudDB = new CrudDBManager($crudModel);
					$crudDB->createDbCrud();
					$crudDB->createTableCrud();
					$crudDB->insertExample();
					setcookie('dbname', $crudModel->mainEntity);
				}
		}else {
				echo  "<p>Please upload XML</p>"; 
				$xmlLoaded=false;
			}
				?>
	</div>
	<div class="row">
		<div class="col-xs-4">
			<h2>XML Class UML File</h2>
			<?php   if(isset($crudModel))
				echo "<pre>" . print_r($crudModel,1) . "</pre>"; ?>
		</div>
		<div class="col-xs-4"></div>
		<div class="col-xs-4">
			<?php if($xmlLoaded==true)
				echo '<form action="CrudUI.php">
					<input type="submit" class="btn btn-info btn-lg" value="Create UI CRUD" >
				</form>';
			 ?>
			
		</div>
	</div>
	<hr>
	<div class="row">
		<div class="col-xs-12">
			<footer>
				<p> Kevin Gordillo MDA 2017 BUAP</p>
			</footer>
		</div>
	</div>
</div>
</body>
</html>                            