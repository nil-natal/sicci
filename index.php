<?php
$local_serve = "localhost"; 	 // local do servidor
$usuario_serve = "root";		 // nome do usuario
$senha_serve = "";			 	 // senha
$banco_de_dados = "coleta";  // nome do banco de dados

$conn = mysqli_connect($local_serve,$usuario_serve,$senha_serve) or die ("O servidor não responde!");

// conecta-se ao banco de dados
$db = mysqli_select_db($conn, $banco_de_dados) or die ("Não foi possivel conectar-se ao banco de dados!");
?>

<html>
    <head>
        <meta charset="UTF-8" />
        <title>Coleta de Contadores</title>
        <link rel="stylesheet" type="text/css" href="css/bootstrap/css/bootstrap.css">
        <link rel="stylesheet" type="text/css" href="style.css">
    </head>
    <body> 
        
        <script type="text/javascript">
function valida_form(){
		var x = document.forms["coleta"]["nome"].value
    if(x == null || x == ""){
      alert("Não e possivel cadastrar, verifique o Nome.");
      document.coleta.nome.focus();
      return false;
    }    	
}

function valida_form(){
        var x = document.forms["coleta"]["serial"].value
    if(x == null || x == ""){
      alert("Não e possivel cadastrar, verifique o Serial.");
      document.coleta.serial.focus();
      return false;
    }       
}
</script>

<?php 

error_reporting(E_ALL);
ini_set('display_errors', '1');

// Add "library" folder to include path
set_include_path(get_include_path() . PATH_SEPARATOR . 'library');

require_once 'Kohut/SNMP/Printer.php';

// IP address of printer in network
/*$ip = $_POST["ip"];*/
        
        @$ip_inicial = $_POST["ip_inicial"];
        
$data = date("d/m/y");

try {
    $printer = new Kohut_SNMP_Printer($ip_inicial);
?>
        
       
       <table>
            <tr>
                <td>
                    <button type="button" href="monitor.php" class="btn btn-default btn-lg"><a href="monitor.php" url="monitor.php"><img width="30xp" src="imagens/monitor.png" border="0" /></a></button>
                    <button type="button" href="monitoria.php" class="btn btn-default btn-lg"><a href="monitoria.php" url="monitoria.php"><img width="30xp" src="imagens/olho.png" border="0" /></a></button>
                </td>
            </tr>
        </table><br> 
        <form action="" method="post">
        <table class="form-group has-success has-feedback">
            <tr>
                <label for="">Ranger</label>
            <td><input type="text" value="" name="ip_inicial" placeholder="informe o IP inicial" class="form-control" id="inputSuccess2" aria-describedby="inputSuccess2Status"></td>
            <td width="30px"><center>-</td>
            <td><input type="text" value="" name="ip_final" placeholder="informe o IP Final" class="form-control" id="inputSuccess2" aria-describedby="inputSuccess2Status"></td>
                <td><input type="submit" value="Varrer Rede" name="coletar" id="coletar" class="btn btn-default"></td>
            </tr>
            </table>
        </form>
        <form onsubmit="return valida_form();" name="coleta" id="coleta" method="post" action="cadastrar.php" enctype="multipart/form-data">
        <table class="table table-condensed">
            <tr class="tr_lista">
                <td width="25%">Modelo</td>
                <td width="25%">Serial</td>
                <td width="25%">Contador</td>
                <td width="25%">Dt Auditoria</td>
            </tr>

                <tr class="tr_listar">
                <td width="25%"><input type="text" name="nome" readonly="readonly" value="<?php echo $printer->getFactoryId(); ?>"></td>              
                <td width="25%"><input name="serial" type="text" value="<?php echo $printer->getSerialNumber(); ?>"></td>
                <td width="25%"><input name="contador" type="text" value="<?php echo $printer->getTeste(); ?>" ></td>
                <td width="25%"><input name="dt_aud" type="text" readonly="readonly" value="<?php echo $data; ?>"></td>
            </tr>

            <tr>
                <button type="button" class="btn btn-lg btn-primary" disabled="disabled">Gerar PDF</button>
                <button type="submit" name="coletar" class="btn btn-default btn-lg">Enviar dados</button>
            </tr>
            </table>
        </form>                         
<?php
} catch(Kohut_SNMP_Exception $e) {
    echo 'SNMP Error: ' . $e->getMessage();
}

?>

    </body>
 
</html>