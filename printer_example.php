<?
include "conexao.php";
?>

<html>
    <head>
        <meta charset="UTF-8" />
        <title>Coleta de Contadores</title>
        <link rel="stylesheet" type="text/css" href="css/bootstrap/css/bootstrap.css">
    </head>
    <body>
        <table>
            <tr>
                <td>
        <button type="button" class="btn btn-lg btn-primary" disabled="disabled">Gerar PDF</button>
        <button type="button" class="btn btn-default btn-lg" disabled="disabled">Enviar dados</button>
                </td>
            </tr>
        </table><br>
        <form action="" method="post">
        <table class="form-group has-success has-feedback">
            <tr>
            <td><input type="text" value="" name="ip" placeholder="informe o IP" class="form-control" id="inputSuccess2" aria-describedby="inputSuccess2Status"></td>
                <td><input type="submit" value="Coletar" name="coletar" id="coletar" class="btn btn-default"></td>
            </tr>
            </table>
        </form>
        
<?php

error_reporting(E_ALL);
ini_set('display_errors', '1');

// Add "library" folder to include path
set_include_path(get_include_path() . PATH_SEPARATOR . 'library');

require_once 'Kohut/SNMP/Printer.php';

// IP address of printer in network
$ip = $_POST["ip"];
        
$data = date("d/m/y");

try {
    $printer = new Kohut_SNMP_Printer($ip);
?>
        
       
        
        
       
        <form action="" method="post">
        <table class="table table-condensed">
            <tr class="tr_lista">
                <td width="20%">Modelo</td>
                <td width="10%">Tipo</td>
                <td width="10%">IP</td>
                <td width="15%">Hostname</td>
                <td width="20%">Serial</td>
                <td width="10%">Contador</td>
                <td width="15%">Cartucho</td>
                <td width="15%">Dt Auditoria</td>
                <td width="15%">Status</td>
            </tr>
            <tr class="tr_listar">
                <td width="20%"><input value="<?php echo $printer->getFactoryId(); ?>" type="text" name="nome"></td>
                <td width="10%"><?php if ($printer->isColorPrinter()) echo 'color printer'; elseif ($printer->isMonoPrinter()) echo 'mono printer'; ?></td>
                <td width="10%"><a href="http://<?php echo $printer; ?>"><?php echo $printer; ?></a></td>                
                <td width="15%"><?php echo $printer->getNameId(); ?></td>
                <td width="20%"><input value="<?php echo $printer->getSerialNumber(); ?>" name="serial" type="text"></td>
                <td width="10%"><input value="<?php echo $printer->getNumberOfPrintedPapers(); ?>" name="contador" type="text"></td>
                <td width="15%"><?php echo $printer->getTonerlevel(); ?> %</td>
                <td width="15%"><?php echo $data; ?></td>
                <td width="15%"></td>
            </tr>
            <tr>
                <td><input type="submit" name="enviar" value="Enviar" id="enviar"></td>
            </tr>
            </table>
        </form>
        
        <?php 

if(@$_POST["enviar"]){
  
  $nome = $_POST["nome"];
  $serial = $_POST["serial"];
  $contador = $_POST["contador"];
  $dt_aud = $_POST["dt_aud"];

  // se o usuario digitou o modelo ele verifica
  // se esta disponivel
  $consulta = mysql_query("select * from coleta where serial = '$seial'");
  $linha = mysql_num_rows($consulta);
  if($linha != 0) {
    echo '<script type="text/javascript">alert("Nao foi possivel cadastrar esse MODELO, ele ja existe no banco de dados.");</script>';
    exit;
  }


  @mysql_query("INSERT INTO coleta (nome, serial, contador, dt_aud) VALUES ('$nome', '$serial', '$contador', '$dt_aud')");

  
  echo '<script type="text/javascript">alert("MODELO cadastrado com sucesso.");</script>';
  echo '<script type="text/javascript">window.close();</script>';

}

?>
       
          <!--
        <span style="background: black; color: white;">Black Toner:</span> <?php echo round($printer->getBlackTonerLevel(), 2); ?> %<br />
      
        <?php if ($printer->isColorPrinter()): ?>
            <span style="background: cyan; color: black;">Cyan Toner:</span> <?php echo round($printer->getCyanTonerLevel(), 2); ?> %<br />
            <span style="background: magenta; color: white;">Magenta Toner:</span> <?php echo round($printer->getMagentaTonerLevel(), 2); ?> %<br />
            <span style="background: yellow; color: black;">Yellow Toner:</span> <?php echo round($printer->getYellowTonerLevel(), 2); ?> %<br />
        <?php endif; ?>
        
        
        <h3>Cartridges:</h3>

        <span><?php echo $printer->getBlackCatridgeType(); ?></span><br />
        <span><?php echo $printer->getCyanCatridgeType(); ?></span><br />
        <span><?php echo $printer->getMagentaCatridgeType(); ?></span><br />
        <span><?php echo $printer->getYellowCatridgeType(); ?></span><br />
=========================================================================================================================================== -->
        
        
<?php
} catch(Kohut_SNMP_Exception $e) {
    echo 'SNMP Error: ' . $e->getMessage();
}
?>


    </body>
 
</html>