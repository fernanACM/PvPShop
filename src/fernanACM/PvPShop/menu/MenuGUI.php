<?php

#      _       ____   __  __ 
#     / \     / ___| |  \/  |
#    / _ \   | |     | |\/| |
#   / ___ \  | |___  | |  | |
#  /_/   \_\  \____| |_|  |_|
# The creator of this plugin was fernanACM.
# https://github.com/fernanACM

namespace fernanACM\PvPShop\menu;

use Closure;

use pocketmine\player\Player;

use muqsit\invmenu\InvMenu;
use muqsit\invmenu\type\InvMenuTypeIds;
use muqsit\invmenu\transaction\InvMenuTransaction;
use muqsit\invmenu\transaction\InvMenuTransactionResult;

use pocketmine\block\VanillaBlocks;
use pocketmine\item\VanillaItems;

use fernanACM\PvPShop\Loader;
use fernanACM\PvPShop\utils\PluginUtils;

class MenuGUI{

    /**
     * @param Player $player
     * @return void
     */
    public function getMenuGUI(Player $player): void{
        $menu = InvMenu::create(InvMenuTypeIds::TYPE_CHEST);
        $inv = $menu->getInventory();
        $menu->setName(Loader::getMessage($player, "MenuCategory-name"));
        $menu->setListener(Closure::fromCallable([$this, "getActionMenuGUI"]));

        // CONTENT
        for($i = 0;$i < 27;$i++){
            if(!in_array($i, [11, 12, 13, 14, 15, 22])){
                $inv->setItem($i, VanillaBlocks::IRON_BARS()->asItem()->setCustomName("§r"));
            }
        }

        $inv->setItem(11, VanillaItems::DIAMOND_CHESTPLATE()->setCustomName(Loader::getMessage($player, "Menu-category.armor-name"))->setLore([Loader::getMessage($player, "Menu-category.armor-info")]));
        $inv->setItem(12, VanillaItems::IRON_SWORD()->setCustomName(Loader::getMessage($player, "Menu-category.tools-name"))->setLore([Loader::getMessage($player, "Menu-category.tools-info")]));
        $inv->setItem(13, VanillaItems::COOKED_CHICKEN()->setCustomName(Loader::getMessage($player, "Menu-category.food-name"))->setLore([Loader::getMessage($player, "Menu-category.food-info")]));
        $inv->setItem(14, VanillaItems::TOTEM()->setCustomName(Loader::getMessage($player, "Menu-category.extras-name"))->setLore([Loader::getMessage($player, "Menu-category.extras-info")]));
        $inv->setItem(15, VanillaItems::OAK_BOAT()->setCustomName(Loader::getMessage($player, "Menu-category.coming-soon-name")));
        //$inv->setItem(15, VanillaItems::HEALING_POTION()->setCustomName(Loader::getMessage($player, "Menu-category.potions-info")));

        $inv->setItem(22, VanillaBlocks::BARRIER()->asItem()->setCustomName(Loader::getMessage($player, "Menu-category.close")));
        $menu->send($player);
    }

    /**
     * @param InvMenuTransaction $transactio
     * @return InvMenuTransactionResult
     */
    public function getActionMenuGUI(InvMenuTransaction $transaction): InvMenuTransactionResult{
        $player = $transaction->getPlayer();
        $action = $transaction->getAction();
        switch($action->getSlot()){
            case 11: // ARMOR
                if($player->hasPermission("pvpshop.category.armor")){
                    Loader::getArmorMenu()->getArmorMenuGUI($player);
                    PluginUtils::PlaySound($player, "random.click", 1, 1);
                }else{
                    $player->removeCurrentWindow();
                    $player->sendMessage(Loader::Prefix(). Loader::getMessage($player, "Messages.no-permission"));
                    PluginUtils::PlaySound($player, "mob.villager.no", 1, 1);
                }
            break;

            case 12: // TOOLS
                if($player->hasPermission("pvpshop.category.tools")){
                    Loader::getToolsMenu()->getToolsMenuGUI($player);
                    PluginUtils::PlaySound($player, "random.click", 1, 1);
                }else{
                    $player->removeCurrentWindow();
                    $player->sendMessage(Loader::Prefix(). Loader::getMessage($player, "Messages.no-permission"));
                    PluginUtils::PlaySound($player, "mob.villager.no", 1, 1);
                }
            break;

            case 13: // FOOD
                if($player->hasPermission("pvpshop.category.food")){
                    Loader::getFoodMenu()->getFoodMenuGUI($player);
                    PluginUtils::PlaySound($player, "random.click", 1, 1);
                }else{
                    $player->removeCurrentWindow();
                    $player->sendMessage(Loader::Prefix(). Loader::getMessage($player, "Messages.no-permission"));
                    PluginUtils::PlaySound($player, "mob.villager.no", 1, 1);
                }
            break;

            /*case 14: // POTIONS
                Loader::getPotionsMenu()->getPotionsMenu($player);
                PluginUtils::PlaySound($player, "random.click", 1, 1);
            break;*/

            case 14: // EXTRAS
                if($player->hasPermission("pvpshop.category.extras")){
                    Loader::getExtraMenu()->getExtraMenuGUI($player);
                    PluginUtils::PlaySound($player, "random.click", 1, 1);
                }else{
                    $player->removeCurrentWindow();
                    $player->sendMessage(Loader::Prefix(). Loader::getMessage($player, "Messages.no-permission"));
                    PluginUtils::PlaySound($player, "mob.villager.no", 1, 1);
                }
            break;

            case 15: // COMING SOON
                $player->removeCurrentWindow();
                $player->sendMessage(Loader::Prefix(). Loader::getMessage($player, "Messages.coming-soon"));
                PluginUtils::PlaySound($player, "mob.villager.no", 1, 1);
            break;

            case 22: // CLOSE
                $player->removeCurrentWindow();
                PluginUtils::PlaySound($player, "random.click", 1, 1);
            break;
        }

        return $transaction->discard();
    }
}