<?php

/** 
*     _    _ _                  ____ 
*    / \  | (_) ___ __ _ _ __  / ___|
*   / _ \ | | |/ __/ _` | '_ \| |    
*  / ___ \| | | (_| (_| | | | | |___ 
* /_/   \_\_|_|\___\__,_|_| |_|\____|
*                                 
*                                  
*  -I'm getting stronger if I'm not dying-
*
* @version 1.0
* @author AlicanCopur
* @copyright HashCube Network © | 2015 - 2018 
* @license Açık yazılım lisansı altındadır. Tüm hakları saklıdır. 
*/                      

namespace AlicanCopur\Lightning;

use pocketmine\level\Level;
use pocketmine\{Player, Server};
use pocketmine\plugin\PluginBase;
use pocketmine\math\Vector3;
use pocketmine\entity\Entity;
use pocketmine\network\mcpe\protocol\AddEntityPacket;
use pocketmine\command\{Command, CommandSender};

class Main extends PluginBase{
	
  public function onEnable(){
  }
  
  public function onCommand(CommandSender $o, Command $cmd, string $label, array $args):bool{
  	if($cmd->getName() == "lightning" && $o->hasPermission("lightning.use")){
  		$x = $o->getX();
  		$y = $o->getY();
  		$z = $o->getZ();
  		$level = $o->getLevel();
  		$this->createLightning($x, $y, $z, $level);
  	}
  	return true;
  }
  
  public function createLightning($x, $y, $z, $level){
    $pk = new AddEntityPacket();
    $pk->type = 93;
    $pk->entityRuntimeId = Entity::$entityCount++;
    $pk->motion = null;
    $pk->position = new \pocketmine\math\Vector3($x, $y, $z);
    foreach($level->getPlayers() as $pl){
      $pl->dataPacket($pk);
    }
  }
}
