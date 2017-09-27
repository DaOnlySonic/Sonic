<?php

namespace sonic\nick;

use pocketmine\utils\TextFormat as TF;
use pocketmine\player;
use pocketmine\event\listener;
use pocketmine\command\CommandSender;
use pocketmine\command\Command;
use pocketmine\plugin\PluginBase;
use pocketmine\event\server\remoteservercommandevent;

if ($sender instanceof Console){
  $sender->sendMessage(TF::RED . "This command is for players only! Please join the server and run again!");

/*
* $sender->sendMessage($this->prefix.TF::DARK_GRAY . "You are now" . TF::RED . "nicked!");
* Reminder for later.
/*
