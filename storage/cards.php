<?php
$database = file_get_contents("database.json");
$cards = json_decode($database);

foreach($cards[0] as $card){
    if(!file_exists("misc/images/big/{$card->id}.jpg")){
        file_put_contents("misc/images/big/{$card->id}.jpg", file_get_contents($card->image_url));
    }
    if(!file_exists("misc/images/small/{$card->id}.jpg")){
        file_put_contents("misc/images/small/{$card->id}.jpg", file_get_contents($card->image_url_small));
    }
}