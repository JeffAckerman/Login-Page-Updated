<?php 

$redis = new Redis(); 
$redis -> connect('localhost', 6379); 

if($redis){ 
    echo "Connected";
}

// Didnt Connect yet
?>