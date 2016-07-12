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
use pocketmine\utils\TextFormat as Colour;

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
          	public function onCommand(CommandSender $sender,Command $cmd,$label,array $args){
		$cmd = strtolower($cmd->getName());
		$count = count($args);
		switch ($cmd){
			case "gmhelp":
				$player = $this->getServer()->getPlayer($sender->getName());
						$sender->sendMessage(Colour::BLACK. "---[".Colour::DARK_PURPLE."BoxTool Indev".Colour::BLACK."]---");
						$sender->sendMessage(Colour::BLACK. "- " .Colour::WHITE."/gmhelp".Colour::GREEN." Shows plugin help");
						$sender->sendMessage(Colour::BLACK. "- " .Colour::WHITE."/gms".Colour::GREEN." Changes gamemode to Survival");
						$sender->sendMessage(Colour::BLACK. "- " .Colour::WHITE."/gmc".Colour::GREEN." Changes gamemode to Creative");
						$sender->sendMessage(Colour::BLACK. "- " .Colour::WHITE."/gma".Colour::GREEN." Changes gamemode to Adventure");
						$sender->sendMessage(Colour::BLACK. "- " .Colour::WHITE."/gmsp".Colour::GREEN." Changes gamemode to Spectator");
						return true;
						
			case "gms":
				if (!($sender instanceof Player)){
				$sender->sendMessage(Colour::DARK_RED."This command can only be executed in-game");
				return true;
				}
					$player = $this->getServer()->getPlayer($sender->getName());
					if ($player->hasPermission("boxtool.gs")){
					if ($player->getGamemode() == 0){
					$player->sendMessage("You are already in Survival");
						} else {
							$player->setGamemode(0);
							$player->sendMessage("You are now in Survival");
							$name = $player->getName();
							$this->getServer()->broadcastPopup(Colour::WHITE."$name".Colour::DARK_GREEN."Changed Gamemode");
							}
							return true;
		
}
