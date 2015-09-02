<?php
/*
	Autor: 	Geraldo de Souza Marink Filho
			gmarink@gmail.com
	
	Objetivo:
		Verificar o servidor online;
		Identificar o acesso local;
		Tornar a URL amigável.
*/
	
$diretorio = $_SERVER['REQUEST_URI'];
$url = "";
$ip = $_SERVER['REMOTE_ADDR'];
$Servidor = array(	
					'provedor1' => array(
									'ip'=> '186.219.242.38',// IP ou endereço fisico do site ou servidor
									'port'=> 5659),// Porta de comunidação em que atua o servidor
					'provedor2' =>  array(
									'ip'=> '189.75.108.26',// IP ou endereço fisico do site ou servidor
									'port'=> 5659),// Porta de comunidação em que atua o servidor
				);
 

function curl_info($url){
		$ch = curl_init();
		curl_setopt( $ch, CURLOPT_URL, $url );
		curl_setopt( $ch, CURLOPT_HEADER, 1);
		curl_setopt( $ch, CURLOPT_RETURNTRANSFER, 1 );
		curl_setopt( $ch, CURLOPT_CONNECTTIMEOUT, $timeout );
		curl_setopt( $ch, CURLOPT_FOLLOWLOCATION, 1 );
        
		$content = curl_exec( $ch );
		$info = curl_getinfo( $ch );
 
		return $info;
	}

   	 $info = curl_info("http://186.219.242.38");
   	 $info2 = curl_info( "http://189.75.108.26");

if ($ip != '186.219.242.38' && $ip != '189.75.108.26') {

    if ($info['http_code']==200) {
          
           $url = "http://".$Servidor['provedor1']['ip'].":".$Servidor['provedor1']['port']."$diretorio";     

    } elseif ($info2['http_code']==200) {
           
           $url = "http://".$Servidor['provedor2']['ip'].":".$Servidor['provedor2']['port']."$diretorio";  

    }else{

    		$url = "http://camponovo.ro.gov.br/2014/servicos";
    }
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