<?php

namespace MagmaZ3637\achievement;

use pocketmine\event\Listener;
use pocketmine\item\StringToItemParser;
use pocketmine\plugin\PluginBase;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\utils\Config;
use pocketmine\player\Player;

use pocketmine\event\player\PlayerBedEnterEvent;
use pocketmine\event\player\PlayerEmoteEvent;
use pocketmine\event\player\PlayerItemConsumeEvent;

use muqsit\invmenu\InvMenuHandler;

use MagmaZ3637\achievement\forms\FormAchievements;
use MagmaZ3637\achievement\menus\MenuAchievements;

class Achievement extends PluginBase implements Listener
{
    public $achievement;

    private Config $config;

    public function onEnable(): void
    {
        if (!InvMenuHandler::isRegistered()) {
            InvMenuHandler::register($this);
        }
        $this->getServer()->getPluginManager()->registerEvents($this, $this);
        $this->saveDefaultConfig();
        $this->saveResource("achievement.yml");
        $this->achievement = new Config($this->getDataFolder()."achievement.yml", Config::YAML);

        if ($this->getConfig()->get("menu-type") == "GUI" || $this->getConfig()->get("menu-type") == "FORM"){
            $this->getLogger()->info("Valid type ".$this->getConfig()->get("menu-type").". Enabling Plugin... :)");
        } else {
            $this->getServer()->getPluginManager()->disablePlugin($this);
            $this->getLogger()->info("Invalid type ".$this->getConfig()->get("menu-type").". Disabling Plugin... :(. Please Check config.yml");
        }
    }

    public function onCommand(CommandSender $sender, Command $command, string $label, array $args): bool
    {

        switch ($command->getName()){
            case "achievement":
                if ($sender instanceof Player){
                    if ($this->getConfig()->get("menu-type") == "GUI"){
                        $gui = new MenuAchievements($this);
                        $gui->getMenuAchivements($sender);
                    } else {
                        $form = new FormAchievements($this);
                        $form->getFormAchievements($sender);
                    }
                } else {
                    $sender->sendMessage("Only player not computah");
                }
            break;
            case "achievementreload":
                if ($this->getConfig()->get("menu-type") == "GUI" || $this->getConfig()->get("menu-type") == "FORM"){
                    $this->getConfig()->reload();
                    $this->achievement->reload();
                    $sender->sendMessage("Valid type ".$this->getConfig()->get("menu-type").". :)");
                    $sender->sendMessage("All Config reloaded successfully");
                } else {
                    $this->getServer()->getPluginManager()->disablePlugin($this);
                    $sender->sendMessage("Invalid type ".$this->getConfig()->get("menu-type").". Disabling Plugin... :(. Please Check config.yml");
                    $sender->sendMessage("Configs broken please check config.yml");
                }

            break;
        }
        return true;
    }

    public function getEmote(PlayerEmoteEvent $event)
    {
        $player = $event->getPlayer();
        $emote = $this->achievement->getNested("achievements.".$player->getName().".emote");
        if (!$emote || empty($emote)) {
            $this->getServer()->broadcastMessage($player->getName() . " get an Achievement §a[ I'm Dancing Now ]");
            $player->sendToastNotification("§a[ I'm Dancing Now ]", "You got an achievement");
            $this->achievement->setNested("achievements.".$player->getName().".emote", true);
            $this->achievement->save();
            $this->achievement->reload();
        }
    }

    public function getSleep(PlayerBedEnterEvent $event)
    {
        $player = $event->getPlayer();
        $sleep = $this->achievement->getNested("achievements.".$player->getName().".sleep");
        if (!$sleep || empty($sleep)) {
            $this->getServer()->broadcastMessage($player->getName() . " get an Achievement §a[ Hoaam.. I Need Rest ]");
            $player->sendToastNotification("§a[ Hoaam.. I Need Rest ]", "You got an achievement");
            $this->achievement->setNested("achievements.".$player->getName().".sleep", true);
            $this->achievement->save();
            $this->achievement->reload();
        }
    }

    public function getGapple(PlayerItemConsumeEvent $event)
    {
        $player = $event->getPlayer();
        $getItem = $event->getItem()->getName();
        $gapple = $this->achievement->getNested("achievements.".$player->getName().".gapple");
        if (!$gapple || empty($gapple)) {
            if ($getItem == StringToItemParser::getInstance()->parse("enchanted_golden_apple")) {
                $this->getServer()->broadcastMessage($player->getName() . " get an Achievement §a[ Wow. I'm Very Strong ]");
                $player->sendToastNotification("§a[ Wow. I'm Very Strong ]", "You got an achievement");
                $this->achievement->setNested("achievements." . $player->getName() . ".gapple", true);
                $this->achievement->save();
                $this->achievement->reload();
            }
        }
    }
}