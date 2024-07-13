<?php
include "conexao.php";

?>

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link rel="shortcut icon" href="icon_maq.png" type="image/x-icon">
    <link rel="stylesheet" type="text/css" href="css/bootstrap/css/bootstrap.css">
<title>Empresa (Maq-Larem)</title>
<script type="text/javascript" language="javascript" src="jquery-1.3.2.js"></script>
</head>

<body>
    <button type="button" href="index.php" class="btn btn-default btn-lg"><a href="index.php" url="index.php"><img width="30xp" src="imagens/voltar.png" border="0" /></a></button>
  <form name="busca" method="post" action="">
      <table>
          <tr>
              <td>
          <input class="form-control" name="query" type="text" id="query" placeholder="Buscar......"/>
              </td>
          </tr>
      </table>
        </form>
  
      <table>     
        <tr>
          <td id="titulo"><strong><center>Lista de Contadores</strong></td>
        <tr>
      </table>
    <table width="100%"  id="itensfixo" class="table table-condensed"> 
<tr>
<td width="20%"><strong><center>Empresa</strong></td>
<td width="20%"><strong><center>Modelo</strong></td>
<td width="20%"><strong><center>Serial</strong></td>
<td width="10%"><strong><center>Contador</strong></td>
<td width="15%"><strong><center>IP</strong></td>
<td width="15%"><strong><center>Data ult. Aud.</strong></td>
</tr>
</table>
 


<!-- Codigo que ira vazer a busca no banco de dados -->
 <?php

 	if(@$_POST){
      $sql = mysql_query("SELECT * FROM coleta WHERE nome LIKE '%".$_POST["query"]."%' OR serial LIKE 
                                                                                  '%".$_POST["query"]."%' OR contador LIKE
                                                                                  '%".$_POST["query"]."%' OR empresa LIKE
                                                                                  '%".$_POST["query"]."%' ORDER BY dt_aud DESC");
	}else{
 
		if(empty($_GET["status_chamados"])){
			$sql = mysql_query("SELECT * FROM coleta ORDER BY dt_aud DESC");
		}
    else{
			$sql = mysql_query("SELECT * FROM coleta WHERE status = 'Inativo' AND status = 'Inativo' ORDER BY dt_aud ASC");
    }
    
	}
	
			if(mysql_num_rows($sql) == false){
				echo '<div align="center" id="echofixo"><br /><img valign="middle" src="imagens/nada.png"><strong> Nenhum EQUIPAMENTO encontrado.</strong><br /></div>';
			}else{
				while($ln = mysql_fetch_object($sql)){
	



  ?>

<table width="100%" id="tabelachamados" class="table table-condensed">
<tr class="ativar">
<td width="20%"><center><?php $ln->empresa;

if($ln->status == "Ativo")
  echo "<div>$ln->empresa</div>";

?>
</td>
<td width="20%"><center><?php $ln->nome;

if($ln->status == "Ativo")
  echo "<div>$ln->nome</div>";

?>
</td>
    <td width="20%"><center><?php $ln->serial;

if($ln->status == "Ativo")
  echo "<div>$ln->serial</div>";

?>
</td>
        <td width="10%"><center><?php $ln->contador;

if($ln->status == "Ativo")
  echo "<div>$ln->contador</div>";

?>
</td>
<td width="15%"><center><?php $ln->ip;

if($ln->status == "Ativo")
  echo "<div>$ln->ip</div>";

?>
</td>

            <td width="15%"><center><?php $ln->dt_aud;

if($ln->status == "Ativo")
  echo "<div>$ln->dt_aud</div>";

?>
</td>
</table>

       <?php 
				}
	   ?>
<?php 
			}

	?>
    </td>
  </tr>
</table>


</body>
</html>