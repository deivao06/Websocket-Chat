<?php
namespace MyApp;
use Ratchet\MessageComponentInterface;
use Ratchet\ConnectionInterface;

class Chat implements MessageComponentInterface {
    protected $clients;

    public function __construct(){
        $this->clients = new \SplObjectStorage;
    }

    public function onOpen(ConnectionInterface $conn) {
        $conn->{'color'} = $this->random_color();
        $this->clients->attach($conn);

        $online = [];
        foreach($this->clients as $client){
            $online[] = $client->remoteAddress;
        }

        $users = $this->countUsers();
        $msg = [
            'name' => 'GADOBOT',
            'message' => $conn->remoteAddress." acabou de entrar, seja bem-vindo! ".$users.' Pessoas online.',
            'ip' => 'bot',
            'color' => 'black',
            'backcolor' => "#bbc1c8",
            'position' => 'float-left',
            'online' => $online
        ];
        $this->sendMessage($msg);

        echo "{$conn->remoteAddress} acabou de logar. {$users} online! \n";
    }

    public function onMessage(ConnectionInterface $from, $msg) {
        $decode = json_decode($msg);

        if($this->isImageUrl($decode) == "yt"){
            $decode->{'message'} = "<iframe width='300' height='300' src='".str_replace("watch?v=", "embed/", $decode->message)."'></iframe>";
        }

        if($this->isImageUrl($decode) == "img"){
            $decode->{'message'} = "<img src='{$decode->message}' width='250'>";
        }

        $decode->{'ip'} = $from->remoteAddress;
        $decode->{'color'} = $from->color;

        foreach($this->clients as $client){
            if($from !== $client){
                $decode->{'position'} = 'float-left';
                $decode->{'backcolor'} = "#bbc1c8";
                $encode = json_encode($decode);
                $client->send($encode);
            }else{
                $decode->{'position'} = 'float-right';
                $decode->{'backcolor'} = "#e0e2e4";
                $encode = json_encode($decode);
                $client->send($encode);
            }
        }
    }

    public function onClose(ConnectionInterface $conn) {
        $this->clients->detach($conn);

        $online = [];
        foreach($this->clients as $client){
            $online[] = $client->remoteAddress;
        }

        $users = $this->countUsers();
        $msg = [
            'name' => 'GADOBOT',
            'message' => $conn->remoteAddress." acabou de sair! <br>".$users.' Pessoas online.',
            'ip' => 'bot',
            'color' => 'black',
            'backcolor' => "#bbc1c8",
            'position' => 'float-left',
            'online' => $online
        ];
        $this->sendMessage($msg);

        echo "{$conn->remoteAddress} acabou de sair. {$users} online! \n";
    }   

    public function onError(ConnectionInterface $conn, \Exception $e) {
        echo "An error has occurred: {$e->getMessage()}\n";
        $conn->close();
    }

    public function sendMessage($msg){
        $encode = json_encode($msg);
        foreach($this->clients as $client){
            $client->send($encode);
        }
    }

    private function random_color_part() {
        return str_pad( dechex( mt_rand( 0, 255 ) ), 2, '0', STR_PAD_LEFT);
    }
    
    public function random_color() {
        return '#'.$this->random_color_part() . $this->random_color_part() . $this->random_color_part();
    }

    public function countUsers() {
        return count($this->clients);
    }

    public function isImageUrl($msg){
        $explode = explode('//', $msg->message);

        if($explode[0] == "https:" || $explode[0] == "http:"){
            $searchYoutubeVideo = strpos($msg->message,"watch?");

            if($searchYoutubeVideo !== false){
                return "yt";
            }

            foreach(get_headers($msg->message) as $header){
                $searchContentType = strpos($header,'Content-Type');

                if($searchContentType !== false){
                    $searchImage = strpos($header,'image');
                    if($searchImage === false){
                        return false;
                    }else{
                        return "img";
                    }
                }
            }
            
        }else{
            return false;
        }
    }
}