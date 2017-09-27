<?php

namespace sonic\main;
use pocketmine\plugin\PluginBase;
use pocketmine\event\Listener;
use pocketmine\event\player\PlayerJoinEvent;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\utils\TextFormat;

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
            $p->sendMessage(TextFormat::GREEN."Your nickname has been restored!");
        }
    }

    public function onCommand(CommandSender $sender, Command $cmd, string $list, array $args) : bool{
        switch(strtolower($cmd)){
            case "nick":
                if(count($args) != 1){
                    $sender->sendMessage(TextFormat::RED."Usage: /nick <new-name:off>");
                    return;
                }
            
                $no_underscore = str_replace("_", "", $args[0]);
                if(!ctype_alnum($no_underscore)){
                    $sender->sendMessage(TextFormat::RED."Nickname must consist of only letters, numbers and underscores!");
                    return;
                }
            
                if(strlen($args[0]) > 16){
                    $sender->sendMessage(TextFormat::RED."Nickname must not be longer than 16 characters!");
                    return;
                }

                if(strlen($args[0]) < 3){
                    $sender->sendMessage(TextFormat::RED."Nickname must be longer than 2 characters!");
                    return;
                }

                if(strtolower($args[0]) == "off"){
                    if(!isset($this->nicknames[strtolower($sender->getName())])){
                        $sender->sendMessage(TextFormat::RED."You do not have a set nickname!");
                        return;
                    }

                    unset($this->nicknames[strtolower($sender->getName())]);
                    $sender->setDisplayName("~".$sender->getName());
                    $sender->setNameTag("~".$sender->getName());
                    $sender->sendMessage(TextFormat::GREEN."Your nickname has been unset!");
                    return;
                }

                $this->nicknames[strtolower($sender->getName())] = $args[0];
                $sender->setDisplayName($args[0]);
                $sender->setNameTag($args[0]);
                $sender->sendMessage(TextFormat::GREEN."Your nickname has been set to " . $args[0] . "!");
            break;
       }
    }
  return true;
}
