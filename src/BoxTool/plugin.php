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
			case "bthelp":
				$player = $this->getServer()->getPlayer($sender->getName());
						$sender->sendMessage(Colour::BLACK. "---[".Colour::DARK_PURPLE."BoxTool Help".Colour::BLACK."]---");
						$sender->sendMessage(Colour::BLACK. "- " .Colour::WHITE."/bthelp".Colour::GREEN." Shows plugin help");
						$sender->sendMessage(Colour::BLACK. "- " .Colour::WHITE."/gs".Colour::GREEN." Changes gamemode to Survival");
						$sender->sendMessage(Colour::BLACK. "- " .Colour::WHITE."/gc".Colour::GREEN." Changes gamemode to Creative");
						$sender->sendMessage(Colour::BLACK. "- " .Colour::WHITE."/ga".Colour::GREEN." Changes gamemode to Adventure");
						$sender->sendMessage(Colour::BLACK. "- " .Colour::WHITE."/gsp".Colour::GREEN." Changes gamemode to Spectator");
						return true;
						
			case "gs":
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
							break;
			case "gc":
				if (!($sender instanceof Player)){
				$sender->sendMessage(Colour::DARK_RED."This command can only be executed in-game");
				return true;
				}
					$player = $this->getServer()->getPlayer($sender->getName());
					if ($player->hasPermission("boxtool.gc")){
					if ($player->getGamemode() == 1){
					$player->sendMessage(Colour::DARK_RED."You are already in Creative");
						} else {
							$player->setGamemode(1);
							$player->sendMessage("You are now in Creative");
							$name = $player->getName();
							$this->getServer()->broadcastPopup(Colour::WHITE."$name".Colour::DARK_GREEN." Changed Gamemode");
							}
							return true;
								} else {
									$player->sendMessage(Colour::DARK_RED."You do not have permission to run this command!");
									return true;
									}
									break;
			case "ga":
				if (!($sender instanceof Player)){
				$sender->sendMessage(Colour::DARK_RED."This command can only be executed in-game");
				return true;
				}
					$player = $this->getServer()->getPlayer($sender->getName());
					if ($player->hasPermission("boxtool.ga")){
					if ($player->getGamemode() == 2){
					$player->sendMessage(Colour::DARK_RED."You are already in Adventure mode");
						} else {
							$player->setGamemode(2);
							$player->sendMessage("You are now in Adventure mode");
							$name = $player->getName();
							$this->getServer()->broadcastPopup(Colour::WHITE."$name".Colour::DARK_GREEN." Just Changed Gamemode");
							}
							return true;
								} else {
									$player->sendMessage(Colour::DARK_RED."You do not have permission to run this command!");
									return true;
									}
									break;
			case "gsp":
				if (!($sender instanceof Player)){
				$sender->sendMessage(Colour::DARK_RED."This command can only be executed in-game");
				return true;
				}
					$player = $this->getServer()->getPlayer($sender->getName());
					if ($player->hasPermission("boxtool.gsp")){
					if ($player->getGamemode() == 3){
					$player->sendMessage(Colour::DARK_RED."You are already in Spectator mode");
						} else {
							$player->setGamemode(3);
							$player->sendMessage("You are now in Spectator mode");
							$name = $player->getName();
							$this->getServer()->broadcastPopup(Colour::WHITE."$name".Colour::DARK_GREEN."Changed Gamemode");
							}
							return true;
								} else {
									$player->sendMessage(Colour::DARK_RED."You do not have permission to run this command!");
									return true;
									}
									break;
										}
		return true;
	}
}

		
}
