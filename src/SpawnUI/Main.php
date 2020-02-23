<?php
/*
   _____  .__                .___  __          ____  ________
  /  _  \ |  |   ____ ___  __|   |/  |________/_   |/  _____/
 /  /_\  \|  | _/ __ \\  \/  /   \   __\___   /|   /   __  \ 
/    |    \  |_\  ___/ >    <|   ||  |  /    / |   \  |__\  \
\____|__  /____/\___  >__/\_ \___||__| /_____ \|___|\_____  /
        \/          \/      \/               \/           \/ 
*/
namespace SpawnUI;

//Server
use pocketmine\Server;

//Plugin
use pocketmine\plugin\PluginBase;

//Event
use pocketmine\event\Listener;

/Utils
use pocketmine\utils\TextFormat;

//Level
use pocketmine\level\Location;

//Playee
use pocketmine\Player;

//Command
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\command\CommandExecutor;
use pocketmine\command\ConsoleCommandSender;

class Main extends PluginBase implements Listener {
	
    public function onEnable() {
        $this->getServer()->getPluginManager()->registerEvents($this, $this);    
        $this->getLogger()->info(TextFormat::GREEN . "SpawnCommandUI Enabled");
    }
    public function onDisable() {
        $this->getLogger()->info(TextFormat::RED . "SpawnCommandUI Disabled!");
    }
    public function onCommand(CommandSender $sender, Command $cmd, string $label, array $args) : bool {
        switch($cmd->getName()){                    
            case "spawn":
                if ($sender->hasPermission("spawn.command")){
                     $this->SpawnUI($sender);
                }else{     
                     $sender->sendMessage(TextFormat::RED . "You dont have permission!");
                     return true;
                }     
            break;         
            
         }  
        return true;                         
    }
   
    public function SpawnUI($sender){ 
        $api = $this->getServer()->getPluginManager()->getPlugin("FormAPI");
        $form = $api->createSimpleForm(function (Player $sender, int $data = null) { 
            $result = $data;
            if($result === null){
                return true;
            }             
            switch($result){
                case 0:
        $sender->teleport(Location::fromObject($this->getServer()->getDefaultLevel()->getSpawnLocation(), $this->getServer()->getDefaultLevel()));
        $sender->addTitle(TextFormat::LIGHT_PURPLE . "Teleporting...");
                break;			
            }
            
            
            });
            $form->setTitle("Spawn");
			$form->setContent("Teleport back to Spawn");
            $form->addButton("Teleport");
            $form->addButton("Close");
            $form->sendToPlayer($sender);
            return $form;                                            
    }
 
                                                                                                                                                                                                                                                                                          
}
