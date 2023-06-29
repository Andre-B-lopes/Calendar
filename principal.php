<?php
require_once("conn/conn.php");
?>

<?php

  // função que permite montar o calendário
  function montar_calendario($mes, $ano, $conn){
    // um vetor para guardar os meses
    $meses = array(1 => 'Janeiro', 2 => 'Fevereiro', 
      3 => 'Março', 4 => 'Abril', 5 => 'Maio', 
      6 => 'Junho', 7 => 'Julho', 8 => 'Agosto', 
      9 => 'Setembro', 10 => 'Outubro', 11 => 'Novembro',
      12 => 'Dezembro');
   
    // um vetor com os dias da semana
    $dias_semana = array('Dom', 'Seg', 'Ter', 'Qua',
      'Qui', 'Sex', 'Sáb');
   
    // vamos obter o primeiro dia do calendário
    $primeiro_dia = mktime(0, 0, 0, $mes, 1, $ano);
    // obtém a quantidade de dias no mês  
    $dias_mes = date('t', $primeiro_dia);  
    // dia da semana que o calendário inicia (começa em 0)
    $dia_inicio = date('w', $primeiro_dia);
     
    // cria a tabela HTML para o calendário
    echo '<table class="texto" border="1" cellspacing="0" cellpadding="4">
      <tr><th colspan="7">'. $meses[$mes] . ' - ' . 
       $ano . '</th>
      </tr>
      <tr><td align="center">';
       echo implode('</td><td align="center">', $dias_semana);
    echo '</td></tr>';
    
    // precisamos de células vazias até encontrarmos
    // o dia inicial da semana
    if($dia_inicio > 0){ 
      for($i = 0; $i < $dia_inicio; $i++){ 
        echo '<td class="vazio">&nbsp;</td>'; 
      }
    }
    
    // agora já podemos começar a preencher o
    // calendário
    for($dia = 1; $dia <= $dias_mes; $dia++ ){

    	$data= $dia.'/'.$mes.'/'.$ano;
      	//echo $data ."<br>";
      	$estilo = "";
        $sql = "SELECT * FROM marcacao WHERE data = '".$data."'";
        $result = mysqli_query($conn, $sql);
		    while($row=mysqli_fetch_assoc($result)){
          if ($row['marcado'] == 2) {
            $estilo = 'class="vago"';
          }else{
          //echo $row['data'];
       	    $estilo = 'class="ocupado"';
          }
		    }
        
		//echo $data." ";
		
      /*if($dia_inicio == 0){
        // vamos colorir o domingo de vermelho
        $estilo = ' class="domingo"';
      }elseif ($dia_inicio == 6) {
        $estilo = ' class="domingo"';
      } 
      else{
        $estilo = 'class="semana"';
      } */    
 
      // vamos colocar a data de hoje sublinhada
      if ($estilo != "") {
        if ( $estilo == 'class="vago"' ) {
          echo '<td ' . $estilo . ' align="center"><a href=marcacao-usuario.php?data='.$dia.'/'.$mes.'/'.$ano.'>'.$dia.'</a></td>';
        }
        if ( $estilo == 'class="ocupado"' ) {
          echo '<td ' . $estilo . ' align="center"><a href=marcacao-usuario.php?data='.$dia.'/'.$mes.'/'.$ano.'&marcacao="ocupado">'.$dia.'</a></td>'; 
        }
      }else{
        echo '<td ' . $estilo . ' align="center">'.$dia.'</td>';
      }
      
      // vamos incrementar o dia de referência 
      $dia_inicio++;
      
      // já precisamos adicionar uma nova linha na tabela?
      if($dia_inicio == 7){
        $dia_inicio = 0;
        echo "</tr>";
 
        if($dia < $dias_mes){
          echo '<tr>';
        }
      }
    } // fim do laço for
    
    // agora preenchemos as células restantes
    if($dia_inicio > 0){
      for($i = $dia_inicio; $i < 7; $i++){
        echo '<td class="vazio">&nbsp;</td>'; 
      }
    
      echo '</tr>';
    }
  
    echo '</table>';
  }

?>
<!DOCTYPE html>
<html>
<head>
	<title>Calendário</title>
	<link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/responsivo.css" rel="stylesheet">
</head>
<body>
	<p>Escolha o mês para disponibilizar marcação:</p>
	<form action="principal.php" method="post">
		<button name="m" value="1" class="btn btn-primary">JAN</button>
		<button name="m" value="2" class="btn btn-primary">FEV</button>
		<button name="m" value="3" class="btn btn-primary">MAR</button>
		<button name="m" value="4" class="btn btn-primary">ABR</button>
		<button name="m" value="5" class="btn btn-primary">MAI</button>
		<button name="m" value="6" class="btn btn-primary">JUN</button>
		<button name="m" value="7" class="btn btn-primary">JUL</button>
		<button name="m" value="8" class="btn btn-primary">AGO</button>
		<button name="m" value="9" class="btn btn-primary">SET</button>
		<button name="m" value="10" class="btn btn-primary">OUT</button>
		<button name="m" value="11" class="btn btn-primary">NOV</button>
		<button name="m" value="12" class="btn btn-primary">DEZ</button>
	</form>
</body>
</html>
<?php
  if(isset($_POST['m']) ){
  	montar_calendario($_POST['m'], date('Y'), $conn);
  }
?>
