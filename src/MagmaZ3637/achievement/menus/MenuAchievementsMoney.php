<?php

declare(strict_types=1);

namespace MagmaZ3637\achievement\menus;

use pocketmine\player\Player;
use pocketmine\item\{StringToItemParser, LegacyStringToItemParser};
use pocketmine\data\bedrock\EnchantmentIdMap;
use pocketmine\item\enchantment\EnchantmentInstance;

use MagmaZ3637\achievement\Achievement;
use MagmaZ3637\achievement\forms\FormAchievements;

use muqsit\invmenu\InvMenu;
use muqsit\invmenu\transaction\{InvMenuTransaction, InvMenuTransactionResult};

class MenuAchievementsMoney
{
    private Achievement $plugin;

    public function __construct(Achievement $plugin) {
        $this->plugin = $plugin;
    }

    public function getMenuAchivements(Player $player){
        $menu = InvMenu::create(InvMenu::TYPE_DOUBLE_CHEST);
        $menu->readonly();
        $menu->setName("MAchivements");
        $inv = $menu->getInventory();
        $inv->setContents(array_fill(0, 53, LegacyStringToItemParser::getInstance()->parse('160:3')->setCustomName("§l§r")));
        # Start Emote
        if (!$this->plugin->achievement->getNested("achievements.".$player->getName().".emote")) {
            $inv->setItem(10, StringToItemParser::getInstance()->parse('armor_stand')->setCustomName("§a[ I'm Dancing Now ]")->setLore([" ", "§l§fAchievement Detail:", "§7Unlock this achievement by using an emote in the server!", "§cNot Obtained"]));
        } else {
            $inv->setItem(10, StringToItemParser::getInstance()->parse('armor_stand')->setCustomName("§a[ I'm Dancing Now ]")->setLore([" ", "§l§fAchievement Detail:", "§7Unlock this achievement by using an emote in the server!", "§aObtained"]));
        }
        # End Emote
        # Start Sleep
        if (!$this->plugin->achievement->getNested("achievements.".$player->getName().".sleep")) {
            $inv->setItem(11, StringToItemParser::getInstance()->parse('bed')->setCustomName("§a[ Hoaam.. I Need Rest ]")->setLore([" ", "§l§fAchievement Detail:", "§7Unlock this achievement by sleeping in a bed!", "§cNot Obtained"]));
        } else {
            $inv->setItem(11, StringToItemParser::getInstance()->parse('bed')->setCustomName("§a[ Hoaam.. I Need Rest ]")->setLore([" ", "§l§fAchievement Detail:", "§7Unlock this achievement by sleeping in a bed!", "§aObtained"]));
        }
        # End Sleep
        # Start Gapple
        if (!$this->plugin->achievement->getNested("achievements.".$player->getName().".gapple")) {
            $inv->setItem(11, StringToItemParser::getInstance()->parse('enchanted_golden_apple')->setCustomName("§a[ Wow. I'm Very Strong ]")->setLore([" ", "§l§fAchievement Detail:", "§7Unlock this achievement by using an emote in the server!", "§cNot Obtained"]));
        } else {
            $inv->setItem(11, StringToItemParser::getInstance()->parse('enchanted_golden_apple')->setCustomName("§a[ Wow. I'm Very Strong ]")->setLore([" ", "§l§fAchievement Detail:", "§7Unlock this achievement by using an emote in the server!", "§aObtained"]));
        }
        # End Gapple
        $inv->setItem(49, StringToItemParser::getInstance()->parse('barrier')->setCustomName("§cClose"));
        $inv->setItem(4, StringToItemParser::getInstance()->parse('redstone')->setCustomName("§aReload Menu"));

        $menu->setListener(function(InvMenuTransaction $transaction) use ($player) : InvMenuTransactionResult{
            $action = $transaction->getAction();
            $inv = $action->getInventory();
            $slot = $action->getSlot();
            $item = $transaction->getItemClicked();
            switch($slot){
                case 49:
                    $player->removeCurrentWindow();
            }
            return $transaction->discard();
        });
        $menu->send($player);
    }
}