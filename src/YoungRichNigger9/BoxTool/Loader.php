<?php
namespace YoungRichNigger9\BoxTool;

use BoxTool\BaseFiles\BaseAPI;
use BoxTool\BaseFiles\BaseCommand;
use BoxTool\Commands\AFK;
use BoxTool\Commands\GameModeEZ;
use Boxtool\Commands\Kit;
#use Boxtool\Commands\Fly;
#use BoxTool\Commands\Nick;

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
	    $this->getLogger()->info(TextFormat::GREEN . "Loading...");
        $this->registerEvents();
        $this->registerCommands();
        if(count($p = $this->getServer()->getOnlinePlayers()) > 0){
            $this->getAPI()->createSession($p);
        }
        if($this->getAPI()->isUpdaterEnabled()){
            $this->getAPI()->fetchBoxToolUpdate(false);
        }
        $this->getAPI()->scheduleAutoAFKSetter();
    }

    public function onDisable(){
        if(count($l = $this->getServer()->getOnlinePlayers()) > 0){
            $this->getAPI()->removeSession($l);
        }
        $this->getAPI()->__destruct();
    }

    /**
     * Function to register all the Event Handlers that BoxTool provide
     */
    public function registerEvents(){
        $this->getServer()->getPluginManager()->registerEvents(new OtherEvents($this->getAPI()), $this);
        $this->getServer()->getPluginManager()->registerEvents(new PlayerEvents($this->getAPI()), $this);
        $this->getServer()->getPluginManager()->registerEvents(new SignEvents($this->getAPI()), $this);
    }

    /**
     * Function to register all BoxTool's commands...
     * And to override some default ones
     */
    private function registerCommands(){
        $commands = [
            new AFK($this->getAPI()),
            new GameModeEZ($this->getAPI()),
            new Kit($this->getAPI()),
            new Fly($this->getAPI()),
            new Nick($this->getAPI()),
        ];
        $aliased = [];
        foreach($commands as $cmd){
            /** @var BaseCommand $cmd */
            $commands[$cmd->getName()] = $cmd;
            $aliased[$cmd->getName()] = $cmd->getName();
            foreach($cmd->getAliases() as $alias){
                $aliased[$alias] = $cmd->getName();
            }
        }
        $cfg = $this->getConfig()->get("commands", []);
        foreach($cfg as $del){
            if(isset($alias[$del])){
                unset($commands[$alias[$del]]);
            }else{
                $this->getLogger()->debug("\"$del\" command not found inside EssentialsPE, skipping...");
            }
        }
        $this->getServer()->getCommandMap()->registerAll("BoxTool", $commands);
    }

    public function checkConfig(){
        if(!is_dir($this->getDataFolder())){
            mkdir($this->getDataFolder());
        }
        if(!file_exists($this->getDataFolder() . "config.yml")){
            $this->saveDefaultConfig();
        }
       $this->saveResource("Kits.yml");
        $cfg = $this->getConfig();
