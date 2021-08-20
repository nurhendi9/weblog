<?php
// include 'koneksi.php';
use Elasticsearch\ClientBuilder;

$fn = fopen("uwsgi.log","r");
 
 while(! feof($fn)) {
$result = fgets($fn);
$data = [];
$parsing = preg_match_all("/^(\S+\ \S+\ \S+\ \d+\ \w+\/\d+\w+\}) (\D+\w+ \w+\/\w+\}) (\S+ \w+\|\w+\: +\d+\S+\ \w+\/\w+\])/",$result,$data);
$address_space_usage = $data[1][0] ?? "";
$rss_usage = $data[2][0] ?? "";
$pid = $data[3][0] ?? "";
// $jsonuwsgi = ["address_space_usage" => $address_space_usage, "rss_usage" => $rss_usage, "pid" => $pid,];
// $jsonuwsgi = json_encode($jsonuwsgi);
// $redis = new Redis();
// $redis->connect('127.0.0.1', 6379);
// $redis->lPush("uwsgi",$jsonuwsgi);

   $hosts = [
    'https://localhost:9200' 
];

 $client = Elasticsearch\ClientBuilder::create()
                    ->setHosts($hosts)
                    ->build();
 $params = [
    'index' => 'my_index',
    'id'    => '3',
    'body'  => ['address_space_usage' => $address_space_usage]
];
  
 // $response = $client->index($params);
 print_r($params);
}
   fclose($fn);


?>