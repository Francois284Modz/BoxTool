<?php

//BoxTool plugin for Your MCPE server.
//Copyright © 2016 YoungRichNigger & HuaYoyu
//This program is free software: you allow recode it,
//Hope that it will be useful for u server,
     
namespace YoungRichNigger9\BoxTool;

use pocketmine\plugin\PluginBase;
use pocketmine\utils\TextFormat as Colour;
use pocketmine\event\player\PlayerJoinEvent;
use pocketmine\event\player\PlayerQuitEvent;
use pocketmine\event\player\PlayerGameModeChangeEvent;
use pocketmine\event\player\PlayerDeathEvent;
use pocketmine\event\player\PlayerCreationEvent;
use pocketmine\event\player\PlayerKickEvent;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\command\CommandExecutor;
use pocketmine\command\PluginCommand;
use pocketmine\permission\Permission;
use pocketmine\Player;
use pocketmine\Server;
use pocketmine\event\Listener;

class Main extends PluginBase implements Listener{

	public function onEnable(){
		$this->getServer()->getPluginManager()->registerEvents($this, $this);
		$this->getLogger()->info(Colour::GREEN."BoxTool Enabled!");
		return;
	}
	public function onDisable(){
		$this->getLogger()->info(Colour::DARK_RED."BoxTool Disabled!");
	}

//Events
	public function onJoin(PlayerJoinEvent $event){
		$player = $event->getPlayer();
		$name = $player->getName();
		$player->sendTip(Colour::AQUA."Welcome,".Colour::WHITE." $name");
		$this->getServer()->broadcastPopup(Colour::WHITE."$name".Colour::AQUA." Joined the Server");
	}
	public function onQuit(PlayerQuitEvent $event){
		$player = $event->getPlayer();
		$name = $player->getName();
		$this->getServer()->broadcastPopup(Colour::WHITE."$name".Colour::DARK_RED." Left the Server");
	}
	public function onKick(PlayerKickEvent $event){
		$player = $event->getPlayer();
		$name = $player->getName();
		$this->getServer()->broadcastPopup(Colour::WHITE."$name".Colour::DARK_RED." Got Kicked");
	}
	public function onGameModeChange(PlayerGameModeChangeEvent $event){
		$player = $event->getPlayer();
		$name = $player->getName();
		$this->getServer()->broadcastPopup(Colour::WHITE."$name".Colour::DARK_GREEN." ChangedGamemode");
	}
	public function onDeath(PlayerDeathEvent $event){
		$player = $event->getEntity();
		$name = $player->getName();
		$this->getServer()->broadcastPopup(Colour::WHITE."$name".Colour::DARK_RED." Died so Sad");
	}
//Commands
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
						break;
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
							$this->getServer()->broadcastPopup(Colour::WHITE."$name".Colour::DARK_GREEN."  Changed Gamemode");
							}
							return true;
								} else {
									$player->sendMessage(Colour::DARK_RED."You do not have permission to run this command!");
									return true;
									}
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
							$this->getServer()->broadcastPopup(Colour::WHITE."$name".Colour::DARK_GREEN." Changed Gamemode");
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
