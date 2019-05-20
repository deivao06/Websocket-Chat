<?php
require __DIR__ . '/../vendor/autoload.php';
$database = file_get_contents(__DIR__ . "/../storage/database.json");
$cards = json_decode($database);

$loop = \React\EventLoop\Factory::create();
\Ratchet\Client\connect('ws://192.168.10.209:8080', [], [], $loop)->then(function($conn) use ($loop, $cards) {

    $conn->on('message', function($msg) use ($conn, $cards) {
        $msgObj = json_decode($msg);

        echo $msgObj->name.": ".$msgObj->message."\n";

        if($msgObj->name != "GADOBOT"){
            $msgExplode = explode(" ", $msgObj->message);
    
            if(startsWith("!", $msgExplode[0])){
    
                if(commandSplit($msgExplode[0]) == "card"){
                    if($msgExplode[1] == "name"){

                        $search = searchCardName($msgExplode[2], $cards);
                        $searchObj = [
                            "type" => "card",
                            "name" => "GADOBOT",
                            "message" => $search
                        ];
                        $encodeSearch = json_encode($searchObj);
    
                        $conn->send($encodeSearch);
                    }
                }
    
            }
        }
    });

}, function ($e) {
    echo "Could not connect: {$e->getMessage()}\n";
});
$loop->run();

function startsWith($prefix, $msg){
    $searchPrefix = strpos($msg,$prefix);
    
    if($searchPrefix == 0){
        return true;
    }else{
        return false;
    }
};

function commandSplit($command){
    $commandSplit = str_split($command);
    unset($commandSplit[0]);
    $commandImplode = implode("", $commandSplit);
    
    return $commandImplode;
}

function searchCardName($cardName, $cards = []){
    $encounteredCards = [];
    foreach($cards[0] as $card){
        $searchName = strpos($card->name, $cardName);
        if($searchName !== false){
            $encounteredCards[] = "misc/images/small/{$card->id}.jpg";
        }
    }

    return $encounteredCards;
}

