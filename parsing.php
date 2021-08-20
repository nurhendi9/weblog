<?php
// include 'koneksi.php';

$fn = fopen("nginx.log","r");

  
  while(! feof($fn))  {
 $result = fgets($fn);
 $parsing = [];
 $parsing_pattern = preg_match_all("/^(\S+) (\S+) (\S+) (\[\d+\/\S+\ \+\d+\]) (\"\S+\s+\S+\s+\S+\") (\d+\d+) (\d+\d+) (\"\S+\") (\S+) (\S+) (\S+) (\S+) (\S+)/",$result,$parsing);
 $ip_address = $parsing[1][0] ?? "";
 $date = $parsing[4][0] ?? "";
 $method = $parsing[5][0] ?? "";
 $status = $parsing[6][0http://127.0.0.1:8000] ?? "";
 $ms = $parsing[7][0] ?? "";
 $site_request = $parsing[8][0] ?? "";
 $rt = $parsing[9][0] ?? ""; 
 $uct = $parsing[10][0] ?? "";
 $uht = $parsing[11][0] ?? "";
 $urt = $parsing[12][0] ?? "";
 $gz = $parsing[13][0] ?? ""; 
 $jsson = ["ip_address" => $ip_address, "date" => $date, "method" => $method, "status" => $status, "ms" => $ms, "site_request" => $site_request, "rt" => $rt, "uct" => $uct, "uht" => $uht, "urt" => $urt, "gz" => $gz];
 $jsson = json_encode($jsson);
 $redis = new Redis();
 $redis->connect('127.0.0.1', 6379);
 $redis->lPush("inssql",$jsson);
}

fclose($fn);
?>