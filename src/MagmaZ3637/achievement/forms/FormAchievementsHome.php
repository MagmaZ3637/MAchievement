<?php

declare(strict_types=1);

namespace MagmaZ3637\achievement\forms;

use MagmaZ3637\achievement\Achievement;
use pocketmine\player\Player;
use jojoe77777\FormAPI\SimpleForm;

class FormAchievementsHome
{
    private Achievement $plugin;

    public function __construct(Achievement $plugin)
    {
        $this->plugin = $plugin;
    }

    public function getFormAchievementsHome(Player $player)
    {
        $form = new SimpleForm(function (Player $player, $data){
            if (is_null($data)){
                return;
            }
            switch($data) {
                case 0:
                    $normalAchievement = new FormAchievements($this->plugin);
                    $normalAchievement->getFormAchievements($player);
                break;
                case 1:
                    $economyAchievement = new FormAchievementsMoney($this->plugin);
                    $economyAchievement->getFormAchievementsMoney($player);
                break;
            }
        });
        $form->setTitle("MAchivements");
        $form->setContent("All of the achievements:");
        $form->addButton("§aNormal Achievement");
        $form->addButton("§aEconomy Achievement");
        $form->addButton("§cClose", 0, "textures/blocks/barrier.png");
        $form->sendToPlayer($player);
    }
}