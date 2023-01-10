<?php

namespace fernanACM\PvPShop\commands;

use fernanACM\PvPShop\Loader;
use fernanACM\PvPShop\utils\PluginUtils;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\player\Player;

class ShopCommand extends Command{

    public function __construct(){
        parent::__construct("pvpshop", "Item shop for PvP use by fernanACM", null, ["pshop"]);
    }

    public function execute(CommandSender $sender, string $commandLabel, array $args){
        if(!$sender->hasPermission("pvpshop.command.acm")){
            $sender->sendMessage(Loader::Prefix(). Loader::getMessage($sender, "Messages.no-permission"));
            PluginUtils::PlaySound($sender, "mob.villager.no", 1, 1);
            return;
        }

        if(!$sender instanceof Player){
            $sender->sendMessage("Use this in game!");
            return;
        }

        if(!isset($args[0])){
            if(!$sender->hasPermission("pvpshop.command.acm")){
                $sender->sendMessage(Loader::Prefix(). Loader::getMessage($sender, "Messages.no-permission"));
                PluginUtils::PlaySound($sender, "mob.villager.no", 1, 1);
                return;
            }

            Loader::getMenu()->getMenuGUI($sender);
            PluginUtils::PlaySound($sender, "random.chestopen");
            return;
        }

        switch($args[0]){
            case "armor":
                if(!$sender->hasPermission("pvpshop.category.armor")){
                    $sender->sendMessage(Loader::Prefix(). Loader::getMessage($sender, "Messages.no-permission"));
                    PluginUtils::PlaySound($sender, "mob.villager.no", 1, 1);
                    return;
                }

                Loader::getArmorMenu()->getArmorMenuGUI($sender);
                PluginUtils::PlaySound($sender, "random.chestopen");
            break;

            case "food":
                if(!$sender->hasPermission("pvpshop.category.food")){
                    $sender->sendMessage(Loader::Prefix(). Loader::getMessage($sender, "Messages.no-permission"));
                    PluginUtils::PlaySound($sender, "mob.villager.no", 1, 1);
                    return;
                }

                Loader::getFoodMenu()->getFoodMenuGUI($sender);
                PluginUtils::PlaySound($sender, "random.chestopen");
            break;

            case "extra":
                if(!$sender->hasPermission("pvpshop.category.extras")){
                    $sender->sendMessage(Loader::Prefix(). Loader::getMessage($sender, "Messages.no-permission"));
                    PluginUtils::PlaySound($sender, "mob.villager.no", 1, 1);
                    return;
                }

                Loader::getExtraMenu()->getExtraMenuGUI($sender);
                PluginUtils::PlaySound($sender, "random.chestopen");
            break;

            case "tools":
                if(!$sender->hasPermission("pvpshop.category.tools")){
                    $sender->sendMessage(Loader::Prefix(). Loader::getMessage($sender, "Messages.no-permission"));
                    PluginUtils::PlaySound($sender, "mob.villager.no", 1, 1);
                    return;
                }

                Loader::getToolsMenu()->getToolsMenuGUI($sender);
                PluginUtils::PlaySound($sender, "random.chestopen");
            break;

            default:
            if(!$sender->hasPermission("pvpshop.category.tools")){
                $sender->sendMessage(Loader::Prefix(). Loader::getMessage($sender, "Messages.no-permission"));
                PluginUtils::PlaySound($sender, "mob.villager.no", 1, 1);
                return;
            }

            $sender->sendMessage(Loader::Prefix(). Loader::getMessage($sender, "Messages.command-error"));
            PluginUtils::PlaySound($sender, "mob.villager.no", 1, 1);
            break;
        }
    }
}