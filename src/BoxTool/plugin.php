<?php

//BoxTool plugin for Your MCPE server.
//Copyright © 2016 YoungRichNigger & HuaYoyu
//This program is free software: you allow recode it,
//Hope that it will be useful for u server,
     
namespace BoxTool\plugin;

use pocketmine\plugin\PluginBase;
use pocketmine\Player;
use pocketmine\Server;
use pocketmine\event\Listener;
use pocketmine\utils\TextFormat;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\permission\Permission;
use pocketmine\Player;
use pocketmine\Server;
use pocketmine\event\Listener;
use pocketmine\event\player\PlayerGameModeChangeEvent;

class plugin extends PluginBase{

          public function onLoad(){
                    $this->getLogger()->info(TextFormat::BLUE."BoxTool is  Loading");
          }
          public function onEnable(){
                    $this->getLogger()->info(TextFormat::GREEN."BoxTool as Enabled");
          }
          public function onDisable(){
                    $this->getLogger()->info(TextFormat:: RED."BoxTool as Disabled");
          }
          public function onGameModeChange(PlayerGameModeChangeEvent $event){
		$player = $event->getPlayer();
		$name = $player->getName();
		$this->getServer()->broadcastPopup(Colour::White."$name".Colour::DARK_GREEN."Changed Gamemode")
}
