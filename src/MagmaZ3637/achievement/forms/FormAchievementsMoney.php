<?php

declare(strict_types=1);

namespace MagmaZ3637\achievement\forms;

use MagmaZ3637\achievement\Achievement;
use pocketmine\player\Player;
use jojoe77777\FormAPI\SimpleForm;
use onebone\economyapi\EconomyAPI;

class FormAchievementsMoney
{
    private Achievement $plugin;

    public function __construct(Achievement $plugin)
    {
        $this->plugin = $plugin;
    }

    public function getFormAchievementsMoney(Player $player)
    {
        $form = new SimpleForm(function (Player $player, $data){
            if (is_null($data)){
                return;
            }
            switch($data) {
                case 0:
                    $player->sendMessage("§a[MAchievement] §fUnlock this achievement by using an emote in the server!");
                break;
                case 1:
                    $player->sendMessage("§a[MAchievement] §fUnlock this achievement by sleeping in a bed!");
                break;
                case 2:
                    $player->sendMessage("§a[MAchievement] §fUnlock this achievement by using an emote in the game!");
                    break;
            }
        });
        $form->setTitle("MAchivements");
        $form->setContent("All of the achievements:");
        # Start Emote
        if (!$this->plugin->achievement->getNested("achievements.".$player->getName().".emote")) {
            $form->addButton("§a[ I'm Dancing Now ]\n§cNot Obtained", 0, "textures/items/armor_stand.png");
        } else {
            $form->addButton("§a[ I'm Dancing Now ]\n§aObtained", 0, "textures/items/armor_stand.png");
        }
        # End Emote
        # Start Sleep
        if (!$this->plugin->achievement->getNested("achievements.".$player->getName().".sleep")) {
            $form->addButton("§a[ Hoaam.. I Need Rest ]\n§cNot Obtained", 0, "textures/items/bed.png");
        } else {
            $form->addButton("§a[ Hoaam.. I Need Rest ]\n§aObtained", 0, "textures/items/bed.png");
        }
        # End Sleep
        # Start Gapple
        if (!$this->plugin->achievement->getNested("achievements.".$player->getName().".gapple")) {
            $form->addButton("§a[ Wow. I'm Very Strong ]\n§cNot Obtained", 0, "textures/items/enchanted_golden_apple.png");
        } else {
            $form->addButton("§a[ Wow. I'm Very Strong ]\n§aObtained", 0, "textures/items/enchanted_golden_apple.png");
        }
        # End Gapple
        $form->addButton("§cClose", 0, "textures/blocks/barrier.png");
        $form->sendToPlayer($player);
    }
}