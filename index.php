<?php
	if ($_SERVER['REQUEST_METHOD'] === "POST") {
		//Ajouter en SQL
		if (isset($_POST['tache']) && isset($_POST['add'])) {
			$bdd = new PDO("mysql:host=localhost;dbname=todolist;charset=utf8", 'root', 'root');
			$tache = $_POST['tache'];
			//Requêtes
			$req = $bdd->prepare('
				INSERT INTO todos
					(tache)
				VALUES
				    (?)
			');
			$req->execute([
				$tache,
			]);	
			header('location:index.php');
		}
	}
	if(isset($_POST['delete']) && isset($_POST['fait'])){
		$bdd = new PDO("mysql:host=localhost;dbname=todolist;charset=utf8", 'root', 'root');
		foreach ($_POST['fait'] as $val) {
			var_dump($val);
			$req = $bdd->prepare("
				DELETE FROM todos 
				WHERE 
					tache = ?
			");
			$req->execute([
				$val,
			]);
		}
		header('location:index.php');
	}

 ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="refresh">
	<title>To Do List</title>
	<link rel="icon" href="assets/img/favicon.ico" />
	<!-- Bootstrap -->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css">
	<meta name="description" content="Exercices PHP">
	<meta name="keywords" content="HTML,CSS,PHP, Bootstrap">
	<meta name="author" content="[MafiaGirl || Angry Creative]">
	<link rel="stylesheet" href="assets/style.css">
	<!-- Fonts -->	
	<link href="https://fonts.googleapis.com/css?family=Indie+Flower" rel="stylesheet">
</head>
<body>
	<nav class="navbar navbar-expand-sm bg-dark navbar-dark">
		<a href="index.html" class="navbar-brand">
			<img src="assets/img/logo.jpg" alt="logo TDL" width="40"> To Do List
		</a>
	</nav>		
	<div class="container">
		<form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
			<h1>Task To Do</h1><hr>
				//<?php
					//Importer les données
					$bdd = new PDO("mysql:host=localhost;dbname=todolist;charset=utf8", 'root', 'root');
						$query = $bdd->prepare('SELECT * FROM todos');
						$query->execute();
						foreach ($query as $value) {	
				?>
				<div class="form-check">
				 	<input type="checkbox" name="fait[]" value="<?= $value['tache'];?>" class="form-check-input">
				 	<?=$value['tache'] ."<br>"; ?>
				</div>		
				<?php 
				}
				?>
				<br>
  				<button class="btn btn-warning" name="delete" type="submit" value="delete">Fait!</button><br><br>
				<div class="input-group">
  					<input type="text" class="form-control" placeholder="Tâches à faire" name="tache">
  					<div class="input-group-append">
    					<button class="btn btn-outline-secondary" type="submit" name="add" value="add">Ajouter</button>
 					</div>
				</div>
				<br>	
		</form>
	</div>
	<footer class="page-footer font-small cyan bg-dark text-center">
    <div class="container-fluid creative">
      <p>Angry Creative!</p>
    </div> 
  </footer>
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>	
</body>
</html>