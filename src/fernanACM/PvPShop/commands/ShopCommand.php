<?php

#      _       ____   __  __ 
#     / \     / ___| |  \/  |
#    / _ \   | |     | |\/| |
#   / ___ \  | |___  | |  | |
#  /_/   \_\  \____| |_|  |_|
# The creator of this plugin was fernanACM.
# https://github.com/fernanACM

namespace fernanACM\PvPShop\commands;

use pocketmine\player\Player;

use pocketmine\command\CommandSender;

use CortexPE\Commando\BaseCommand;
use CortexPE\Commando\args\RawStringArgument;

use fernanACM\PvPShop\Loader;
use fernanACM\PvPShop\utils\PluginUtils;

class ShopCommand extends BaseCommand{

    protected function prepare(): void{
        $this->setPermission("pvpshop.command.acm");
        $this->registerArgument(0, new RawStringArgument("type", true));
    }

    public function onRun(CommandSender $sender, string $aliasUsed, array $args): void{
        if(!$sender->hasPermission("pvpshop.command.acm")){
            $sender->sendMessage(Loader::Prefix(). Loader::getMessage($sender, "Messages.no-permission"));
            PluginUtils::PlaySound($sender, "mob.villager.no", 1, 1);
            return;
        }

        if(!$sender instanceof Player){
            $sender->sendMessage("Use this in game!");
            return;
        }

        if(!isset($args["type"])){
            if(!$sender->hasPermission("pvpshop.command.acm")){
                $sender->sendMessage(Loader::Prefix(). Loader::getMessage($sender, "Messages.no-permission"));
                PluginUtils::PlaySound($sender, "mob.villager.no", 1, 1);
                return;
            }

            Loader::getMenu()->getMenuGUI($sender);
            PluginUtils::PlaySound($sender, "random.chestopen");
            return;
        }
        switch($args["type"]){
            case "help":
            case "?":
                $sender->sendMessage("§l§e=====( PVPSHOP )=====");
                $sender->sendMessage("§7/pvpshop help - Command list");
                $sender->sendMessage("§7/pvpshop amor - Open the armor category");
                $sender->sendMessage("§7/pvpshop tools - Open the tools category");
                $sender->sendMessage("§7/pvpshop food - Open the food category");
                $sender->sendMessage("§7/pvpshop extra - Open the extra category");
                PluginUtils::PlaySound($sender, "random.pop", 1, 1);
            break;
                
            case "armor":
                if(!$sender->hasPermission("pvpshop.category.armor")){
                    $sender->sendMessage(Loader::Prefix(). Loader::getMessage($sender, "Messages.no-permission"));
                    PluginUtils::PlaySound($sender, "mob.villager.no", 1, 1);
                    return;
                }

                Loader::getArmorMenu()->getArmorMenuGUI($sender);
                PluginUtils::PlaySound($sender, "random.chestopen", 1, 1);
            break;

            case "food":
                if(!$sender->hasPermission("pvpshop.category.food")){
                    $sender->sendMessage(Loader::Prefix(). Loader::getMessage($sender, "Messages.no-permission"));
                    PluginUtils::PlaySound($sender, "mob.villager.no", 1, 1);
                    return;
                }

                Loader::getFoodMenu()->getFoodMenuGUI($sender);
                PluginUtils::PlaySound($sender, "random.chestopen", 1, 1);
            break;

            case "extra":
                if(!$sender->hasPermission("pvpshop.category.extras")){
                    $sender->sendMessage(Loader::Prefix(). Loader::getMessage($sender, "Messages.no-permission"));
                    PluginUtils::PlaySound($sender, "mob.villager.no", 1, 1);
                    return;
                }

                Loader::getExtraMenu()->getExtraMenuGUI($sender);
                PluginUtils::PlaySound($sender, "random.chestopen", 1, 1);
            break;

            case "tools":
                if(!$sender->hasPermission("pvpshop.category.tools")){
                    $sender->sendMessage(Loader::Prefix(). Loader::getMessage($sender, "Messages.no-permission"));
                    PluginUtils::PlaySound($sender, "mob.villager.no", 1, 1);
                    return;
                }

                Loader::getToolsMenu()->getToolsMenuGUI($sender);
                PluginUtils::PlaySound($sender, "random.chestopen", 1, 1);
            break;

            default:
            if(!$sender->hasPermission("pvpshop.category.tools")){
                $sender->sendMessage(Loader::Prefix(). Loader::getMessage($sender, "Messages.no-permission"));
                PluginUtils::PlaySound($sender, "mob.villager.no", 1, 1);
                return;
            }

            $sender->sendMessage(Loader::Prefix(). "§c/pvpshop help");
            PluginUtils::PlaySound($sender, "mob.villager.no", 1, 1);
            break;
        }
    }
}
