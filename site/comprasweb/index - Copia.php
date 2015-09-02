<?php

$diretorio = $_SERVER['REQUEST_URI'];

$TempoLimite = 1;
$url = ""; // limpa a saída da array
$ip = $_SERVER['REMOTE_ADDR'];
$Servidor = array(	
					'provedor1' => array(
									'check'=> true,// Verifica estatus do servidor (true ou false)
									'ip'=> '186.219.242.38',// IP ou endereço fisico do site ou servidor
									'port'=> 5658),// Porta de comunidação em que atua o servidor
					'provedor2' =>  array(
									'check'=> true,// Verifica estatus do servidor (true ou false)
									'ip'=> '189.75.108.26',// IP ou endereço fisico do site ou servidor
									'port'=> 5658),// Porta de comunidação em que atua o servidor
				);
 



if ($ip != '186.219.242.38' && $ip != '189.75.108.26') {

    if ($fp = @fsockopen($Servidor['provedor1']['ip'], $Servidor['provedor1']['port'], $errno, $errstr, $TempoLimite)) {
       
        $url = "http://".$Servidor['provedor1']['ip'].":".$Servidor['provedor1']['port']."$diretorio";
       
        fclose($fp);

    } elseif ($fp = @fsockopen($Servidor['provedor2']['ip'], $Servidor['provedor2']['port'], $errno, $errstr, $TempoLimite)) {
      
        $url = "http://".$Servidor['provedor2']['ip'].":".$Servidor['provedor2']['port']."$diretorio";
       
        fclose($fp);

    }/*else{

    	$url = "http://webapp.camponovo.ro.gov.br/index.php?status=offline";
    }*/
} else {

	$url = "http://192.168.0.252:".$Servidor['provedor1']['port']."$diretorio";
}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>Prefeitura de Campo Novo de Rondônia | Portal Transparência</title>
	</head>
<frameset>
	<frame src="<?php echo $url; ?>" scrolling='yes'>
		<noframes>
			<body>Este site utiliza recursos (frame) não suportados pelo seu browser.</body>
		</noframes>
</frameset>
</html>