<?php 
include "conexao.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="style_print.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"
        integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <title>Monitor Impressoras</title>
</head>

<body>
    <h1>Monitor de Impressoras</h1>
    <section class="page-contain">

        <?php 

$sql = "SELECT * FROM impressoras";
$result = mysqli_query($conn, $sql);

while ($ver = mysqli_fetch_assoc($result)) {
# code...

error_reporting(E_ALL);
ini_set('display_errors', '1');

// Add "library" folder to include path
set_include_path(get_include_path() . PATH_SEPARATOR . 'library');

require_once 'Kohut/SNMP/Printer.php';

// IP address of printer in network
/*$ip = $_POST["ip"];*/
        
@$ip_inicial = $ver['ip'];        
$data = date("d/m/y");

try {
    $printer = new Kohut_SNMP_Printer($ip_inicial);
?>

        <!-- criar variavel que define os segundos de varredura dos IPs da impressoras da lista -->
        <a href="#"
            class="data-card--status-cota<?php if( fsockopen( $ver['ip'] , 80 , $errno , $errstr , 0.1 ) ){ } else { echo " status-offline"; } ?>">
            <h4><?php echo substr($printer->getNameId(), 7); ?></h4>
            <h5>https://<?php echo $printer; ?></h5>
            <h3><?php 
    echo $printer->getTeste() . "<span style='font-size: 18px;'> Pgs</span>"; ?>
            </h3>
            <h6>Contador anterior: <?php echo $ver['c_anterior']; ?></h6>
            <h6>Cota: <?php echo $ver['cota']; ?></h6>
            <h6>Impressa (Pgs): <?php echo $printer->getTeste() - $ver['c_anterior']; ?></h6>
            <h6>Restante (Pgs): <?php echo ($ver['cota'] - ($printer->getTeste() - $ver['c_anterior'])); ?></h6>
            <hr>
            <h6>Responsavel: <?php echo $ver['responsavel']." - ".$ver['secao']; ?></h6>
            <h4>Impressões</h4>
            <label for="">Nivel de Toner:</label>
            <div class="progress">
                <div class="progress-bar <?php if(substr($printer->getTonerlevel(), 8) <= 25 ){ echo "bg-danger"; } else if (substr($printer->getTonerlevel(), 8) <= 65 ){ echo "bg-warning"; } else if (substr($printer->getTonerlevel(), 8) >= 66 ){ echo "bg-success"; }?>"
                    role="progressbar" style="width: <?php echo substr($printer->getTonerlevel(), 8); ?>%;"
                    aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">
                    <?php echo substr($printer->getTonerlevel(), 8); ?> %</div>
            </div>
            <p>Tempo Ligado: <?php echo substr($printer->getTempoLigado(), 22); ?></p>
            <span class="link-text">
                Mais Informações
                <svg width="25" height="16" viewBox="0 0 25 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" clip-rule="evenodd"
                        d="M17.8631 0.929124L24.2271 7.29308C24.6176 7.68361 24.6176 8.31677 24.2271 8.7073L17.8631 15.0713C17.4726 15.4618 16.8394 15.4618 16.4489 15.0713C16.0584 14.6807 16.0584 14.0476 16.4489 13.657L21.1058 9.00019H0.47998V7.00019H21.1058L16.4489 2.34334C16.0584 1.95281 16.0584 1.31965 16.4489 0.929124C16.8394 0.538599 17.4726 0.538599 17.8631 0.929124Z"
                        fill="#1e83c7" />
                </svg>
            </span>
        </a>

        <?php
} catch(Kohut_SNMP_Exception $e) {
    echo 'SNMP Error: ' . $e->getMessage();
}

}

?>

    </section>



</body>

</html>