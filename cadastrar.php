<?php 

include "conexao.php";

  $nome = $_POST["nome"];
  $serial = $_POST["serial"];
  $contador = $_POST["contador"];
  $dt_aud = $_POST["dt_aud"];

$conexao = mysql_connect("localhost","root"); //essa linha irá fazer a conexão com o banco de dados.
if (!$conexao) 
die ("Erro de conexão com localhost, o seguinte erro ocorreu -> ".mysql_error());//aqui irei testar se houve falha de conexão 

//conectando com a tabela do banco de dados 
$banco = mysql_select_db("snmp",$conexao); //nome da tabela onde os dados serão armazenados 

//Query que realiza a inserção dos dados no banco de dados na tabela indicada acima 
$query = "INSERT INTO `coleta` ( `nome` , `serial` , `contador` , `dt_aud` , `status` , `id` ) 
VALUES ('$nome', '$serial', '$contador', '$dt_aud', 'Ativo', '')";
mysql_query($query,$conexao); 

//$query = nome da variável que utilizarei para realizar a operação de inserção dos dados 
//clientes = nome da tabela que será salvo os dados do cadastro do cliente 
//nome, email, sexo, ddd, telefone, endereço, cidade, estado, bairro, país, login, senha, news, id. São apenas os nomes dos campos que constam na tabela clientes.

//VALUES = indica que serão inseridos os seguintes valores. 
//$nome, $email, $sexo, $ddd, $telefone, $endereço, $cidade, $estado, $bairro, $país, //$login, $senha, $news, $id.
//São apenas as variaveis a qual eu atribui os valores digitados no formulário. 

echo "Seu cadastro foi realizado com sucesso!Agradecemos a atenção.";
echo "<br>";
echo "<a href='index.php'><img width='40px'src='imagens/voltar.png'/></a>";
?>