<?php
/*
define('HOST', 'localhost');
define('USUARIO', 'u917801973_intensiva');
define('SENHA', '@Davi2212');
define('DB', 'u917801973_intensiva');
*/

//variavel conexão produção
$host = "localhost";
$usuario = "root";
$senha = "";
$banco = "coleta";

//descomentar para trabalhar interno
#$host = "sql221.main-hosting.eu";


$conexao = mysqli_connect($host, $usuario, $senha, $banco) or die ('Não foi possível conectar');


//porte do codigo que habilita o login
//depois refatorar em apenas um

header('Content-Type: text/html; charset=UTF-8');

#$servidor = "sql221.main-hosting.eu";
$servidor = "localhost";
$usuario = "root";
$senha = "";
$banco = "coleta";

$conn = mysqli_connect($servidor, $usuario, $senha) or die ("Erro de comunicaçäo!");

$bd = mysqli_select_db($conn, $banco) or die ("Näo foi possível se comunicar com o banco de dados!");

		mysqli_query($conn, "SET NAMES 'utf8'");
        mysqli_query($conn, 'SET character_set_connection=utf8');
        mysqli_query($conn, 'SET character_set_client=utf8');
        mysqli_query($conn, 'SET character_set_results=utf8');

 ?>