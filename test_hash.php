<?php
$names = [
    'Icelandic_Horse.jpg',
    'Icelandic_horse.jpg',
    'Green_iguana.jpg',
    'Green_iguana_1.jpg',
    'Green_iguana_2.jpg',
    'Iguana_iguana.jpg',
];

foreach ($names as $name) {
    $hash = md5($name);
    $c1 = $hash[0];
    $c2 = substr($hash, 0, 2);
    $url = "https://upload.wikimedia.org/wikipedia/commons/$c1/$c2/$name";
    
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_USERAGENT, 'OstrichMiniZoo/1.0');
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    $data = curl_exec($ch);
    $code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    $size = strlen($data);
    
    echo "$name -> $url -> Code: $code, Size: $size\n";
    curl_close($ch);
}
