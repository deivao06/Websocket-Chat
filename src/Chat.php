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

        $users = $this->countUsers();
        $msg = [
            'name' => 'GM',
            'message' => $conn->remoteAddress.' acabou de entrar, seja bem-vindo! '.$users.' Pessoas online.',
            'ip' => '666',
            'color' => 'black',
            'position' => 'center'
        ];
        $this->sendMessage($msg);
    }

    public function onMessage(ConnectionInterface $from, $msg) {
        $decode = json_decode($msg);
        $decode->{'ip'} = $from->remoteAddress;
        $decode->{'color'} = $from->color;

        foreach($this->clients as $client){
            if($from !== $client){
                $decode->{'position'} = 'left';
                $encode = json_encode($decode);
                $client->send($encode);
            }else{
                $decode->{'position'} = 'right';
                $encode = json_encode($decode);
                $client->send($encode);
            }
        }
    }

    public function onClose(ConnectionInterface $conn) {
        $this->clients->detach($conn);

        $users = $this->countUsers();
        $msg = [
            'name' => 'GM',
            'message' => $conn->remoteAddress.' acabou de sair, adeus! '.$users.' Pessoas online.',
            'ip' => '666',
            'color' => 'black',
            'position' => 'center'
        ];
        $this->sendMessage($msg);
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
}