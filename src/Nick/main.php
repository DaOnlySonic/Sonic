<?php

namespace sonic\main;

use pocketmine\utils\TextFormat as TF;
use pocketmine\event\player\PlayerJoinEvent;
use pocketmine\event\listener;
use pocketmine\command\CommandSender;
use pocketmine\command\Command;
use pocketmine\plugin\PluginBase;
use pocketmine\event\server\remoteservercommandevent;

class Main extends PluginBase implements Listener{
  
  public $nicknames = [];
  
  public function onEnable(){
    $this->getServer()->getPluginManager()->registerEvents($this,$this);
    
  }
  
  public function onJoin(PlayerJoinEvent $e){
    $p = $e->getPlayer();
    if(isset($this->nicknames[strtolower($p->getName())])){
      $name = $this->nicknames[strtolower($p->getName())];
      $p->setDisplayName("~".$name);
      $p->setNameTag("~".$name);
      $p->sendMessage(TF::GREEN . "Don't worry!" . TF::ORANGE . "We got your nickname back!" . TF::YELLOW . "No need to run the command again!");
    }
  }
  
  public function onCommand(CommandSender $sender, Command $cmd, string $list, array $args) : bool{
    switch(strtolower($cmd)){
        case "nick":
            if(count($args) != 1){
              $sender->sendMessage(TF::RED . "Don't use it like that!" . TF::GREEN . "Use it like this: /nick <new-nickname:off>");
              return;
            }
  
($sender instanceof Console){
  $sender->sendMessage(TF::RED . "This command is for players only! Please join the server and run again!");
