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
          <input class="form-control" name="query1" type="text" id="query1" placeholder="Buscar......"/>
          </td>
          <td>
          <input class="form-control" name="query2" type="text" id="query2" placeholder="Buscar......"/>
              </td>
              <td>
          <input class="form-control" name="buscar" type="submit" id="buscar" value="Buscar" />
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
<td width="25%"><strong><center>Modelo</strong></td>
<td width="25%"><strong><center>Serial</strong></td>
<td width="25%"><strong><center>Contador</strong></td>
<td width="25%"><strong><center>Data ult. Auditoria</strong></td>
</tr>
</table>
 


<!-- Codigo que ira vazer a busca no banco de dados -->
 <?php


$query1 = "query1";
$query2 = "query2";

 	if(@$_POST){
      $sql = mysql_query("SELECT * FROM coleta WHERE dt_aud BETWEEN '%".$_POST["query1"]."%' AND '%".$_POST["query2"]."%' ");
	}
/*
  if(@$_POST){
      $sql = mysql_query("SELECT * FROM coleta WHERE nome LIKE '%".$_POST["query"]."%' OR serial LIKE 
                                                               '%".$_POST["query"]."%' OR contador LIKE
                                                               '%".$_POST["query"]."%' ORDER BY dt_aud DESC");
  }

  */ else{
 
		if(empty($_GET["status_chamados"])){
			$sql = mysql_query("SELECT * FROM coleta ORDER BY dt_aud DESC");
		}else{
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
<td width="25%"><center><?php $ln->nome;

if($ln->status == "Ativo")
  echo "<div>$ln->nome</div>";

?>
</td>
    <td width="25%"><center><?php $ln->serial;

if($ln->status == "Ativo")
  echo "<div>$ln->serial</div>";

?>
</td>
        <td width="25%"><center><?php $ln->contador;

if($ln->status == "Ativo")
  echo "<div>$ln->contador</div>";

?>
</td>
            <td width="25%"><center><?php $ln->dt_aud;

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