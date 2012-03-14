<!--<meta http-equiv="refresh" content="30">-->
<html>
<head>
<title> Web-nalog</title>
<style>
	.nikto{
		color: #D00606;
		}
	.audit{
		display: block;
		overflow: auto;
		position: absolute;
		color: #D00606;
		background-color: #160F0F;
		border-color: #D00606;
		width: 600;
		height: 200;
		top: 220;
		left: 650;
		filter:alpha(opacity=85);
		-moz-opacity:.85;
		opacity:.85;
	}
</style>
</head>
<body>
<center><h1>WEB - NaLog</h1></center>
<table width="1024" border="1" align="center">
<tr align="center"><td><h2>Data</h2></td><td><h2>GET</h2></td><td><h2>Browser</h2></td></tr>
<?php
	function auditar_ip($ip) {
		$out_audit = exec("nmap -sT -sV -F ".$ip,$out_audit2);
		echo "<div class='audit'>";
		echo "<h3>[+] Auditando Intruso<br>";
		echo "[+]IP: ".$ip."<h3><br>";
		foreach($out_audit2 as $log){
			echo $log."<br />";
		}
		echo "</div>";
	}
	$ipv = 0;
	$x = 0;
	$file_log = file("access.log");
	$file_reverse = array_reverse($file_log);
	foreach($file_reverse as $v){
		list($data,$get,$msg,$b,$b2,$browser) = explode('"',$v);
		list($ip,$nada,$fecha)=explode("-",$data);
		echo "<tr><td>".htmlentities($data)."</td>";
		echo "<td>".htmlentities($get)."</td>";
		echo "<td>";
		if(preg_match('/Nikto+/',$browser)){
			echo preg_replace('/Nikto+/',"<span class='nikto'>".htmlentities($browser)."</span>",$browser);
			if($ipv != $ip){
				$ipv = $ip;
				auditar_ip($ip);
			}
		}else{
			echo htmlentities($browser);
		}
		echo "</td></tr>";
	}

?>
</table>
</body>
</html>
