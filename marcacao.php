<?php
require_once("conn/conn.php");

if($_GET['data']){$data = $_GET['data'];}else{$data = '0';}
if($_GET['marcacao']){$marcacao = $_GET['marcacao'];}else{$marcacao = 'vago';}
if($_POST['marcar']){$marcar = $_POST['marcar'];}else{$marcar = '0';}
if($_POST['desmarcar']){$desmarcar = $_POST['desmarcar'];}else{$desmarcar = '0';}

if ($data == 0 || $marcar == "-" || $desmarcar == "-") {
	echo "<script>
    		window.location.href = 'principal-gerente.php';
    	</script>";
}

if ($marcar == "sim") {
	$sql = "INSERT INTO marcacao (data,marcado) VALUES ('".$data."','2');";
    $result = mysqli_query($conn, $sql);
	echo "<script>
    		window.location.href = 'principal-gerente.php';
    	</script>";
}
if ($marcar == "nao") {
	$sql = "DELETE FROM marcacao WHERE data = '".$data."'";
	$result = mysqli_query($conn, $sql);
	echo "<script>
    		window.location.href = 'principal-gerente.php';
    	</script>";
}

if($desmarcar == "sim"){
	$sql = "UPDATE marcacao SET nome='', marcado='2', descricao='' WHERE data = '".$data."'";
	$result = mysqli_query($conn, $sql);
	echo "<script>
    		window.location.href = 'principal-gerente.php';
    	</script>";
}

if($desmarcar == "nao"){
	echo "<script>
    		window.location.href = 'principal-gerente.php';
    	</script>";
}

if($marcacao == "vago"){
?>

<!DOCTYPE html>
<html>
<head>
	<title>Calendário</title>
	<link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/responsivo.css" rel="stylesheet">
</head>
<body>
	<p>Deseja disponibilizar esse dia?</p>
	<form action="marcacao.php?data=<?php echo $data; ?>" method="post">
		<select name="marcar">
			<option >-</option>
			<option value="sim">Sim</option>
			<option value="nao">Não</option>
		</select><br><br>
		<input type="submit" value="Entrar"> 
	</form>
</body>
</html>

<?php
	}else{
?>

<!DOCTYPE html>
<html>
<head>
	<title>Calendário</title>
	<link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/responsivo.css" rel="stylesheet">
</head>
<body>
	<p>Deseja excluir esse agendamento?</p>
	<?php
		$sql = "SELECT * FROM marcacao WHERE data = '".$data."'";
        $result = mysqli_query($conn, $sql);
		while($row=mysqli_fetch_assoc($result)){
			echo "<p>".$row['descricao']."</p>";
			echo "<p> Agendado por: ".$row['nome']."</p>";
		}
	?>
	<form action="marcacao.php?data=<?php echo $data; ?>" method="post">
		<select name="desmarcar">
			<option >-</option>
			<option value="sim">Sim</option>
			<option value="nao">Não</option>
		</select><br><br>
		<input type="submit" value="Entrar"> 
	</form>
</body>
</html>

<?php
	}
?>
