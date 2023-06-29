<!DOCTYPE html>
<html>
<head>
	<title>Calendário</title>
	<link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/responsivo.css" rel="stylesheet">
</head>
<body>
	<p>Escolha a função que deseja testar:</p>
	<form action="validar.php" method="post">
		<select name="funcao">
			<option >-</option>
			<option value="01">Gerente</option>
			<option value="02">Usuário</option>
		</select><br><br>
		<input type="submit" value="Entrar"> 
	</form>
</body>
