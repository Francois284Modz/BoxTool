<?php

namespace BoxTool\plugin;

use pocketmine\plugin\PluginBase;
use pocketmine\Player;
use pocketmine\Server;
use pocketmine\event\Listener;
use pocketmine\utils\TextFormat;

class Main extends PluginBase{

          public function onLoad(){
                    $this->getLogger()->info(TextFormat::BLUE."BoxTool is  Loading");
          }
          public function onEnable(){
                    $this->getLogger()->info(TextFormat::GREEN."BoxTool as Enabled");
          }
          public function onDisable(){
                    $this->getLogger()->info(TextFormat:: RED."BoxTool as Disabled");
          }
}
