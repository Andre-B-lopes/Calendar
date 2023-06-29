<?php
	if(isset($_POST['funcao']) ){
    	if ($_POST['funcao'] == 01) {
    		echo "<script>
    				window.location.href = 'principal-gerente.php';
    			</script>";
    	}else{
    		echo "<script>
    				window.location.href = 'principal.php';
    			</script>";
    	}
    } 
?>
