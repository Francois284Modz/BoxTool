<?php

namespace YoungRichNigger9\BoxTool;

use BoxTool\BaseFiles\API;
use BoxTool\BaseFiles\BaceCommand;
use BoxTool\Commands\AFK;
use BoxTool\Commands\GameModeEZ;
use pocketmine\plugin\PluginBase;
use pocketmine\utils\TextFormat;

class Loader extends PluginBase{
    /** @var BaseAPI */
    private $api;

    public function onEnable(){
        // Before anything else...
        $this->checkConfig();

        // Custom API Setup :3
        $this->getServer()->getPluginManager()->callEvent($ev = new CreateAPIEvent($this, BaseAPI::class));
        $class = $ev->getClass();
        $this->api = new $class($this);

        // Other startup code...
        if(!is_dir($this->getDataFolder())){
            mkdir($this->getDataFolder());
        }
	    $this->getLogger()->info(TextFormat::YELLOW. "Loading...");
        $this->registerEvents();
        $this->registerCommands();
        if(count($p = $this->getServer()->getOnlinePlayers()) > 0){
            $this->getAPI()->createSession($p);
        }
        if($this->getAPI()->isUpdaterEnabled()){
            $this->getAPI()->fetchEssentialsPEUpdate(false);
        }
        $this->getAPI()->scheduleAutoAFKSetter();
    }

    public function onDisable(){
        if(count($l = $this->getServer()->getOnlinePlayers()) > 0){
            $this->getAPI()->removeSession($l);
        }
        $this->getAPI()->__destruct();
    }
