<?php

if (true === isset($_GET) && true === isset($_GET['action']) && "reload" == trim($_GET['action'])) {
    shell_exec('DISPLAY=:0 sh /usr/share/nginx/www/reload-browser.sh &');
}


if (true === isset($_GET) && true === isset($_GET['action']) && "live" == trim($_GET['action'])) {
	$command = '/usr/bin/ssh -p 202 root@linuxcounter.net /root/bin/monitoring.pi.sh 2>/dev/null';
	$response = exec($command);
	$response = trim($response);
	$resarray = explode(";", $response);
	

	$apt_updates = intval($resarray[3]);
	if ($apt_updates >= 1) { $apt_updates = "<span class=\"error\">".$apt_updates."</span>"; }
	else { $apt_updates = "<span class=\"ok\">".$apt_updates."</span>"; }

	$load1 = sprintf("%.2f",(float)$resarray[4]);
	if ($load1 >= 3) { $load1 = "<span class=\"error\">".$load1."</span>"; }
	else if ($load1 >= 1) { $load1 = "<span class=\"warn\">".$load1."</span>"; }
	else { $load1 = "<span class=\"ok\">".$load1."</span>"; }

	$load5 = sprintf("%.2f",(float)$resarray[5]);
	if ($load5 >= 3) { $load5 = "<span class=\"error\">".$load5."</span>"; }
	else if ($load5 >= 1) { $load5 = "<span class=\"warn\">".$load5."</span>"; }
	else { $load5 = "<span class=\"ok\">".$load5."</span>"; }

	$load15 = sprintf("%.2f",(float)$resarray[6]);
	if ($load15 >= 3) { $load15 = "<span class=\"error\">".$load15."</span>"; }
	else if ($load15 >= 1) { $load15 = "<span class=\"warn\">".$load15."</span>"; }
	else { $load15 = "<span class=\"ok\">".$load15."</span>"; }

	$procs = intval($resarray[7]);
	if ($procs >= 350) { $procs = "<span class=\"error\">".$procs."</span>"; }
	else if ($procs >= 300) { $procs = "<span class=\"warn\">".$procs."</span>"; }
	else { $procs = "<span class=\"ok\">".$procs."</span>"; }

	$procs_running = intval($resarray[8]);
	if ($procs_running >= 6) { $procs_running = "<span class=\"error\">".$procs_running."</span>"; }
	else if ($procs_running >= 3) { $procs_running = "<span class=\"warn\">".$procs_running."</span>"; }
	else { $procs_running = "<span class=\"ok\">".$procs_running."</span>"; }

	$procs_sleeping = intval($resarray[9]);
	if ($procs_sleeping >= 99999) { $procs_sleeping = "<span class=\"error\">".$procs_sleeping."</span>"; }
	else if ($procs_sleeping >= 9999) { $procs_sleeping = "<span class=\"warn\">".$procs_sleeping."</span>"; }
	else { $procs_sleeping = "<span class=\"ok\">".$procs_sleeping."</span>"; }

	$procs_zombies = intval($resarray[10]);
	if ($procs_zombies >= 3) { $procs_zombies = "<span class=\"error\">".$procs_zombies."</span>"; }
	else if ($procs_zombies >= 1) { $procs_zombies = "<span class=\"warn\">".$procs_zombies."</span>"; }
	else { $procs_zombies = "<span class=\"ok\">".$procs_zombies."</span>"; }

	$total_ram = number_format(intval($resarray[11]));
	$used_ram = intval($resarray[12]);
	if ($used_ram >= 47500) { $used_ram = "<span class=\"error\">".number_format($used_ram)."</span>"; }
	else if ($used_ram >= 45000) { $used_ram = "<span class=\"warn\">".number_format($used_ram)."</span>"; }
	else { $used_ram = "<span class=\"ok\">".number_format($used_ram)."</span>"; }

	$total_swap = number_format(intval($resarray[13]));
	$used_swap = intval($resarray[14]);
	if ($used_swap >= 1024) { $used_swap = "<span class=\"error\">".number_format($used_swap)."</span>"; }
	else if ($used_swap >= 512) { $used_swap = "<span class=\"warn\">".number_format($used_swap)."</span>"; }
	else { $used_swap = "<span class=\"ok\">".number_format($used_swap)."</span>"; }

	$diskread = (float)(str_replace(" B/s", "", $resarray[15]));
	if ($diskread >= 1024) { $diskread = "<span class=\"error\">".number_format(sprintf("%.2f",$diskread))."</span> B/s"; }
	else if ($diskread >= 512) { $diskread = "<span class=\"warn\">".number_format(sprintf("%.2f",$diskread))."</span> B/s"; }
	else { $diskread = "<span class=\"ok\">".sprintf("%.2f",$diskread)."</span> B/s"; }

	$diskwrite = (float)(str_replace(" B/s", "", $resarray[16]));
	if ($diskwrite >= 1024) { $diskwrite = "<span class=\"error\">".number_format(sprintf("%.2f",$diskwrite))."</span> B/s"; }
	else if ($diskwrite >= 512) { $diskwrite = "<span class=\"warn\">".number_format(sprintf("%.2f",$diskwrite))."</span> B/s"; }
	else { $diskwrite = "<span class=\"ok\">".sprintf("%.2f",$diskwrite)."</span> B/s"; }

	$usage = "";
	for ($a = 18; $a<(18+$resarray[17]); $a++) {
		if ($usage != "") { $usage .= " "; }
		$cpu = intval(str_replace("%", "", $resarray[$a]));
		if ($cpu >= 50) { $cpu = "<span class=\"error\">".$cpu."%</span>"; }
		else if ($cpu >= 25) { $cpu = "<span class=\"warn\">".$cpu."%</span>"; }
		else { $cpu = "<span class=\"ok\">".$cpu."%</span>"; }
		$usage .= $cpu;
	}

	$sleeps = intval($resarray[$a]);
	if ($sleeps >= 20) { $sleeps = "<span class=\"error\">".number_format($sleeps)."</span>"; }
	else if ($sleeps >= 10) { $sleeps = "<span class=\"warn\">".number_format($sleeps)."</span>"; }
	else { $sleeps = "<span class=\"ok\">".number_format($sleeps)."</span>"; }

	$queries = number_format(intval($resarray[$a+1]));
	
	$qps = intval($resarray[$a+2]);
	if ($qps >= 800) { $qps = "<span class=\"error\">".number_format($qps)."</span>"; }
	else if ($qps >= 500) { $qps = "<span class=\"warn\">".number_format($qps)."</span>"; }
	else { $qps = "<span class=\"ok\">".number_format($qps)."</span>"; }

	$slowqueries = intval($resarray[$a+3]);
	if ($slowqueries >= 200) { $slowqueries = "<span class=\"error\">".number_format($slowqueries)."</span>"; }
	else if ($slowqueries >= 100) { $slowqueries = "<span class=\"warn\">".number_format($slowqueries)."</span>"; }
	else { $slowqueries = "<span class=\"ok\">".number_format($slowqueries)."</span>"; }

	$netin = (float)(str_replace(" kbps", "", $resarray[$a+4]));
	$netin = sprintf("%.2f",(float)$netin);
	if ($netin >= 4000) { $netin = "<span class=\"error\">".$netin."</span> kbps"; }
	else if ($netin >= 500) { $netin = "<span class=\"warn\">".$netin."</span> kbps"; }
	else { $netin = "<span class=\"ok\">".$netin."</span> kbps"; }

	$netout = (float)(str_replace(" kbps", "", $resarray[$a+5]));
	$netout = sprintf("%.2f",(float)$netout);
	if ($netout >= 4000) { $netout = "<span class=\"error\">".$netout."</span> kbps"; }
	else if ($netout >= 500) { $netout = "<span class=\"warn\">".$netout."</span> kbps"; }
	else { $netout = "<span class=\"ok\">".$netout."</span> kbps"; }

	$apps1 = "";
	$apps2 = "";
	$atmp1 = $resarray[$a+6];
	$atmp2 = $resarray[$a+7];
	$tmp = array();
	$tmp = explode(" ", trim($atmp1));
	foreach($tmp AS $key => $val) {
		if ($apps1 != "") { $apps1 .= " &nbsp; "; }
		$temp = array();
		$temp = explode(":", trim($val));
		$app = $temp[0];
		$value = intval($temp[1]);
		if ($value <= 0) { $value = "<span class=\"error\">".$value."</span>"; }
		else { $value = "<span class=\"ok\">".$value."</span>"; }
		$apps1 .= $app.":".$value;
	}
	$tmp = array();
	$tmp = explode(" ", trim($atmp2));
	foreach($tmp AS $key => $val) {
		if ($apps2 != "") { $apps2 .= " &nbsp; "; }
		$temp = array();
		$temp = explode(":", trim($val));
		$app = $temp[0];
		$value = intval($temp[1]);
		if ($value <= 0) { $value = "<span class=\"error\">".$value."</span>"; }
		else { $value = "<span class=\"ok\">".$value."</span>"; }
		$apps2 .= $app.":".$value;
	}
    $systin = sprintf("%.1f",(float)str_replace("+", "", str_replace("°C", "", $resarray[$a+8])));
	if ($systin >= 60) { $systin = "<span class=\"error\">".$systin."</span> &deg;C"; }
	else if ($systin >= 40) { $systin = "<span class=\"warn\">".$systin."</span> &deg;C"; }
	else { $systin = "<span class=\"ok\">".$systin."</span> &deg;C"; }

    $cputin = sprintf("%.1f",(float)str_replace("+", "", str_replace("°C", "", $resarray[$a+9])));
	if ($cputin >= 60) { $cputin = "<span class=\"error\">".$cputin."</span> &deg;C"; }
	else if ($cputin >= 40) { $cputin = "<span class=\"warn\">".$cputin."</span> &deg;C"; }
	else { $cputin = "<span class=\"ok\">".$cputin."</span> &deg;C"; }

    $auxtin = sprintf("%.1f",(float)str_replace("+", "", str_replace("°C", "", $resarray[$a+10])));
	if ($auxtin >= 60) { $auxtin = "<span class=\"error\">".$auxtin."</span> &deg;C"; }
	else if ($auxtin >= 40) { $auxtin = "<span class=\"warn\">".$auxtin."</span> &deg;C"; }
	else { $auxtin = "<span class=\"ok\">".$auxtin."</span> &deg;C"; }

    $out = ''.$resarray[0].'|'.$resarray[1].'|'.$resarray[2].'|'.$apt_updates.'|'.$load1.'|'.$load5.'|'.$load15.'|'.$procs.'|'.$procs_running.'|'.$procs_sleeping.'|'.$procs_zombies.'|'.$total_ram.'|'.$used_ram.'|'.$total_swap.'|'.$used_swap.'|'.$diskread.'|'.$diskwrite.'|'.$netin.'|'.$netout.'|'.$sleeps.'|'.$queries.'|'.$qps.'|'.$slowqueries.'|'.$usage.'|'.$apps1.'|'.$apps2.'|'.$systin.'|'.$cputin.'|'.$auxtin.'';
    
	echo $out;
}



if (true === isset($_GET) && true === isset($_GET['action']) && "procs" == trim($_GET['action'])) {
	$command = '/usr/bin/ssh -p 202 root@linuxcounter.net "top -b -n 1 | grep -A 21 USER" 2>/dev/null';
	$output = array();
	$response = exec($command, $output);
	$out = "";
	foreach($output AS $key => $val) {
		$out .= $val."\n";
	}	
	$out = '<pre>'.$out.'</pre>';
	echo $out;
}
