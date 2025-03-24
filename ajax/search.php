<?php
if (isset($_GET['query'])) {
    $query = urlencode($_GET['query']);
    $apiKey = "7aaa32fe";
    $url = "http://www.omdbapi.com/?s=$query&apikey=$apiKey";
    $response = file_get_contents($url);
    echo $response;
    exit;
}
?>