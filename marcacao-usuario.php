<?php
require_once("conn/conn.php");

if($_GET['data']){$data = $_GET['data'];}else{$data = '0';}
if($_GET['descricao']){$descricao = $_GET['descricao'];}else{$descricao = '0';}
if($_GET['marcacao']){$marcacao = $_GET['marcacao'];}else{$marcacao = 'vago';}

if ($data == 0) {
	echo "<script>
    		window.location.href = 'principal.php';
    	</script>";
}

if ($descricao != "0") {
	$sql = "UPDATE marcacao SET marcado = '1', nome = 'usuario', descricao = '".$descricao."' WHERE data = '".$data."';";
    $result = mysqli_query($conn, $sql);
	echo "<script>
    		window.location.href = 'principal.php';
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
	<p>Deseja agendar o dia <?php echo $data; ?></p>
	<form action="marcacao-usuario.php" method="get">
		<label>Digite a descrição do agendamento</label><br>
		<input type="hidden" name="data" value="<?php echo $data; ?>">
		<textarea name="descricao" rows="5" cols="50"></textarea>
		<br><br>
		<input type="submit" class="btn btn-success" value="Agendar"> 
	</form>
	<br>
	<center><a href="principal.php"><button class="btn btn-danger">Voltar</button></a></center>
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
	<?php
		$sql = "SELECT * FROM marcacao WHERE data = '".$data."'";
        $result = mysqli_query($conn, $sql);
		while($row=mysqli_fetch_assoc($result)){
			echo "<p>".$row['descricao']."</p>";
			echo "<p> Agendado por: ".$row['nome']."</p>";
		}
	?>
	<center><a href="principal.php"><button class="btn btn-danger">Voltar</button></a></center>
</body>
</html>

<?php
	}
?>
