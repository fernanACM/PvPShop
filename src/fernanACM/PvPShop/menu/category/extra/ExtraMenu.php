<?php

#      _       ____   __  __ 
#     / \     / ___| |  \/  |
#    / _ \   | |     | |\/| |
#   / ___ \  | |___  | |  | |
#  /_/   \_\  \____| |_|  |_|
# The creator of this plugin was fernanACM.
# https://github.com/fernanACM

namespace fernanACM\PvPShop\menu\category\extra;

use Closure;

use pocketmine\player\Player;

use muqsit\invmenu\InvMenu;
use muqsit\invmenu\type\InvMenuTypeIds;
use muqsit\invmenu\transaction\InvMenuTransaction;
use muqsit\invmenu\transaction\InvMenuTransactionResult;

use pocketmine\block\VanillaBlocks;
use pocketmine\item\VanillaItems;

use fernanACM\PvPShop\Loader;
use fernanACM\PvPShop\utils\ItemUtils;
use fernanACM\PvPShop\utils\PluginUtils;

class ExtraMenu{

    /**
     * @param Player $player
     * @return void
     */
    public function getExtraMenuGUI(Player $player): void{
        $menu = InvMenu::create(InvMenuTypeIds::TYPE_CHEST);
        $inv = $menu->getInventory();
        $menu->setListener(Closure::fromCallable([$this, "getActionExtraMenu"]));
        $menu->setName(Loader::getMessage($player, "ExtrasShop-name"));
        $config = Loader::getInstance()->config;

        $totem = $config->getNested("Price.Extras.totem");
        $speed = $config->getNested("Price.Extras.speed");
        $health = $config->getNested("Price.Extras.health");
        $soup = $config->getNested("Price.Extras.soup");
        $helmet = $config->getNested("Price.Extras.helmet");
        $chestplate = $config->getNested("Price.Extras.chestplate");
        $leggings = $config->getNested("Price.Extras.leggings");
        $boots = $config->getNested("Price.Extras.boots");

        // EXTRAS
        $speed_cooldown= $config->getNested("Cooldown.Potions.speed");

        $health_cooldown = $config->getNested("Cooldown.Potions.health");
        
        $soup_cooldown = $config->getNested("Cooldown.Potions.soup");

        for($i = 0; $i < 27; $i++){
            if(!in_array($i, [3, 4, 5, 11, 12, 13, 14, 15, 20, 22])){
                $inv->setItem($i, VanillaBlocks::IRON_BARS()->asItem()->setCustomName("§r"));
            }
        }

        $inv->setItem(3, ItemUtils::getItemSpeed()->setCustomName(str_replace(["{PRICE}"], [$speed], Loader::getMessage($player, "ExtrasShop-info.speed")))->setLore([str_replace(["{TIME}"], [$speed_cooldown], Loader::getMessage($player, "ExtrasShop-info.speed-info"))]));
        $inv->setItem(4, ItemUtils::getItemHealth()->setCustomName(str_replace(["{PRICE}"], [$health], Loader::getMessage($player, "ExtrasShop-info.health")))->setLore([str_replace(["{TIME}"], [$health_cooldown], Loader::getMessage($player, "ExtrasShop-info.health-info"))]));
        $inv->setItem(5, ItemUtils::getItemSoup()->setCustomName(str_replace(["{PRICE}"], [$soup], Loader::getMessage($player, "ExtrasShop-info.soup")))->setLore([str_replace(["{TIME}"], [$soup_cooldown], Loader::getMessage($player, "ExtrasShop-info.soup-info"))]));

        $inv->setItem(11, ItemUtils::getHeltmetX()->setCustomName(str_replace(["{PRICE}"], [$helmet], Loader::getMessage($player, "ExtrasShop-info.helmet")))->setLore([Loader::getMessage($player, "ExtrasShop-info.helmet-info")]));
        $inv->setItem(12, ItemUtils::getChestPlateX()->setCustomName(str_replace(["{PRICE}"], [$chestplate], Loader::getMessage($player, "ExtrasShop-info.chestplate")))->setLore([Loader::getMessage($player, "ExtrasShop-info.chestplate-info")]));

        $inv->setItem(13, VanillaItems::TOTEM()->setCustomName(str_replace(["{PRICE}"], [$totem], Loader::getMessage($player, "ExtrasShop-info.totem"))));
        
        $inv->setItem(14, ItemUtils::getLeggingsX()->setCustomName(str_replace(["{PRICE}"], [$leggings], Loader::getMessage($player, "ExtrasShop-info.leggings")))->setLore([Loader::getMessage($player, "ExtrasShop-info.leggings-info")]));
        $inv->setItem(15, ItemUtils::getBootsX()->setCustomName(str_replace(["{PRICE}"], [$boots], Loader::getMessage($player, "ExtrasShop-info.boots")))->setLore([Loader::getMessage($player, "ExtrasShop-info.boots-info")]));

        // EXTRAS
        $inv->setItem(20, VanillaItems::ARROW()->setCustomName(Loader::getMessage($player, "Menu-category.return")));
        $inv->setItem(22, VanillaBlocks::BARRIER()->asItem()->setCustomName(Loader::getMessage($player, "Menu-category.close")));

        $menu->send($player);
    }

    /**
     * @param InvMenuTransaction $transaction
     * @return InvMenuTransactionResult
     */
    public function getActionExtraMenu(InvMenuTransaction $transaction): InvMenuTransactionResult{
        $player = $transaction->getPlayer();
        $action = $transaction->getAction();
        $config = Loader::getInstance()->config;

        $totem = $config->getNested("Price.Extras.totem");
        $speed = $config->getNested("Price.Extras.speed");
        $health = $config->getNested("Price.Extras.health");
        $soup = $config->getNested("Price.Extras.soup");
        $helmet = $config->getNested("Price.Extras.helmet");
        $chestplate = $config->getNested("Price.Extras.chestplate");
        $leggings = $config->getNested("Price.Extras.leggings");
        $boots = $config->getNested("Price.Extras.boots");

        switch($action->getSlot()){
            case 3:
                if(Loader::getEconomy()->getMoney($player, function(float|int $money) use($player, $speed): void{
                    if(!$player->hasPermission("pvpshop.items.speed")){
                        $player->removeCurrentWindow();
                        $player->sendMessage(Loader::Prefix(). Loader::getMessage($player, "Messages.no-permission"));
                        PluginUtils::PlaySound($player, "mob.endermen.portal", 1, 1);
                        return;
                    }

                    if(!$player->getInventory()->canAddItem(ItemUtils::getItemSpeed())){
                        $player->removeCurrentWindow();
                        $player->sendMessage(Loader::Prefix(). Loader::getMessage($player, "Messages.inventory-full"));
                        PluginUtils::PlaySound($player, "mob.endermen.portal", 1, 1);
                        return;
                    }

                    if($money >= $speed){
                        Loader::getEconomy()->takeMoney($player, $speed);
                        $player->sendMessage(Loader::Prefix(). str_replace(["{PRICE}"], [$speed], Loader::getMessage($player, "Messages.successful-purchase")));
                        $player->getInventory()->addItem(ItemUtils::getItemSpeed()->setCount(1)->setCustomName(Loader::getMessage($player, "ExtrasShop-info.speed-name")));
                        PluginUtils::PlaySound($player, "random.levelup", 1, 1.5);
                    }else{
                        $player->removeCurrentWindow();
                        $player->sendMessage(Loader::Prefix(). Loader::getMessage($player, "Messages.no-money"));
                        PluginUtils::PlaySound($player, "mob.villager.no", 1, 1);
                    }
                }));
            break;

            case 4:
                if(Loader::getEconomy()->getMoney($player, function(float|int $money) use($player, $health): void{
                    if(!$player->hasPermission("pvpshop.items.health")){
                        $player->removeCurrentWindow();
                        $player->sendMessage(Loader::Prefix(). Loader::getMessage($player, "Messages.no-permission"));
                        PluginUtils::PlaySound($player, "mob.endermen.portal", 1, 1);
                        return;
                    }

                    if(!$player->getInventory()->canAddItem(ItemUtils::getItemHealth())){
                        $player->removeCurrentWindow();
                        $player->sendMessage(Loader::Prefix(). Loader::getMessage($player, "Messages.inventory-full"));
                        PluginUtils::PlaySound($player, "mob.endermen.portal", 1, 1);
                        return;
                    }

                    if($money >= $health){
                        Loader::getEconomy()->takeMoney($player, $health);
                        $player->sendMessage(Loader::Prefix(). str_replace(["{PRICE}"], [$health], Loader::getMessage($player, "Messages.successful-purchase")));
                        $player->getInventory()->addItem(ItemUtils::getItemHealth()->setCount(1)->setCustomName(Loader::getMessage($player, "ExtrasShop-info.health-name")));
                        PluginUtils::PlaySound($player, "random.levelup", 1, 1.5);
                    }else{
                        $player->removeCurrentWindow();
                        $player->sendMessage(Loader::Prefix(). Loader::getMessage($player, "Messages.no-money"));
                        PluginUtils::PlaySound($player, "mob.villager.no", 1, 1);
                    }
                }));
            break;

            case 5:
                if(Loader::getEconomy()->getMoney($player, function(float|int $money) use($player, $soup): void{
                    if(!$player->hasPermission("pvpshop.items.soup")){
                        $player->removeCurrentWindow();
                        $player->sendMessage(Loader::Prefix(). Loader::getMessage($player, "Messages.no-permission"));
                        PluginUtils::PlaySound($player, "mob.endermen.portal", 1, 1);
                        return;
                    }

                    if(!$player->getInventory()->canAddItem(ItemUtils::getItemSoup())){
                        $player->removeCurrentWindow();
                        $player->sendMessage(Loader::Prefix(). Loader::getMessage($player, "Messages.inventory-full"));
                        PluginUtils::PlaySound($player, "mob.endermen.portal", 1, 1);
                        return;
                    }

                    if($money >= $soup){
                        Loader::getEconomy()->takeMoney($player, $soup);
                        $player->sendMessage(Loader::Prefix(). str_replace(["{PRICE}"], [$soup], Loader::getMessage($player, "Messages.successful-purchase")));
                        $player->getInventory()->addItem(ItemUtils::getItemSoup()->setCount(1)->setCustomName(Loader::getMessage($player, "ExtrasShop-info.soup-name")));
                        PluginUtils::PlaySound($player, "random.levelup", 1, 1.5);
                    }else{
                        $player->removeCurrentWindow();
                        $player->sendMessage(Loader::Prefix(). Loader::getMessage($player, "Messages.no-money"));
                        PluginUtils::PlaySound($player, "mob.villager.no", 1, 1);
                    }
                }));
            break;

            case 11:
                if(Loader::getEconomy()->getMoney($player, function(float|int $money) use($player, $helmet): void{
                    if(!$player->hasPermission("pvpshop.armor.helmet")){
                        $player->removeCurrentWindow();
                        $player->sendMessage(Loader::Prefix(). Loader::getMessage($player, "Messages.no-permission"));
                        PluginUtils::PlaySound($player, "mob.endermen.portal", 1, 1);
                        return;
                    }

                    if(!$player->getInventory()->canAddItem(ItemUtils::getHeltmetX())){
                        $player->removeCurrentWindow();
                        $player->sendMessage(Loader::Prefix(). Loader::getMessage($player, "Messages.inventory-full"));
                        PluginUtils::PlaySound($player, "mob.endermen.portal", 1, 1);
                        return;
                    }

                    if($money >= $helmet){
                        Loader::getEconomy()->takeMoney($player, $helmet);
                        $player->sendMessage(Loader::Prefix(). str_replace(["{PRICE}"], [$helmet], Loader::getMessage($player, "Messages.successful-purchase")));
                        $player->getInventory()->addItem(ItemUtils::getHeltmetX()->setCount(1)->setCustomName(Loader::getMessage($player, "ExtrasShop-info.helmet-name")));
                        PluginUtils::PlaySound($player, "random.levelup", 1, 1.5);
                    }else{
                        $player->removeCurrentWindow();
                        $player->sendMessage(Loader::Prefix(). Loader::getMessage($player, "Messages.no-money"));
                        PluginUtils::PlaySound($player, "mob.villager.no", 1, 1);
                    }
                }));
            break;

            case 12:
                if(Loader::getEconomy()->getMoney($player, function(float|int $money) use($player, $chestplate): void{
                    if(!$player->hasPermission("pvpshop.armor.chestplate")){
                        $player->removeCurrentWindow();
                        $player->sendMessage(Loader::Prefix(). Loader::getMessage($player, "Messages.no-permission"));
                        PluginUtils::PlaySound($player, "mob.endermen.portal", 1, 1);
                        return;
                    }

                    if(!$player->getInventory()->canAddItem(ItemUtils::getChestPlateX())){
                        $player->removeCurrentWindow();
                        $player->sendMessage(Loader::Prefix(). Loader::getMessage($player, "Messages.inventory-full"));
                        PluginUtils::PlaySound($player, "mob.endermen.portal", 1, 1);
                        return;
                    }

                    if($money >= $chestplate){
                        Loader::getEconomy()->takeMoney($player, $chestplate);
                        $player->sendMessage(Loader::Prefix(). str_replace(["{PRICE}"], [$chestplate], Loader::getMessage($player, "Messages.successful-purchase")));
                        $player->getInventory()->addItem(ItemUtils::getChestPlateX()->setCount(1)->setCustomName(Loader::getMessage($player, "ExtrasShop-info.chestplate-name")));
                        PluginUtils::PlaySound($player, "random.levelup", 1, 1.5);
                    }else{
                        $player->removeCurrentWindow();
                        $player->sendMessage(Loader::Prefix(). Loader::getMessage($player, "Messages.no-money"));
                        PluginUtils::PlaySound($player, "mob.villager.no", 1, 1);
                    }
                }));
            break;

            case 13:
                if(Loader::getEconomy()->getMoney($player, function(float|int $money) use($player, $totem): void{
                    if(!$player->hasPermission("pvpshop.items.totem")){
                        $player->removeCurrentWindow();
                        $player->sendMessage(Loader::Prefix(). Loader::getMessage($player, "Messages.no-permission"));
                        PluginUtils::PlaySound($player, "mob.endermen.portal", 1, 1);
                        return;
                    }

                    if(!$player->getInventory()->canAddItem(VanillaItems::TOTEM())){
                        $player->removeCurrentWindow();
                        $player->sendMessage(Loader::Prefix(). Loader::getMessage($player, "Messages.inventory-full"));
                        PluginUtils::PlaySound($player, "mob.endermen.portal", 1, 1);
                        return;
                    }

                    if($money >= $totem){
                        Loader::getEconomy()->takeMoney($player, $totem);
                        $player->sendMessage(Loader::Prefix(). str_replace(["{PRICE}"], [$totem], Loader::getMessage($player, "Messages.successful-purchase")));
                        $player->getInventory()->addItem(VanillaItems::TOTEM()->setCount(1)->setCustomName(Loader::getMessage($player, "ExtrasShop-info.leggings-name")));
                        PluginUtils::PlaySound($player, "random.levelup", 1, 1.5);
                    }else{
                        $player->removeCurrentWindow();
                        $player->sendMessage(Loader::Prefix(). Loader::getMessage($player, "Messages.no-money"));
                        PluginUtils::PlaySound($player, "mob.villager.no", 1, 1);
                    }
                }));
            break;

            case 14:
                if(Loader::getEconomy()->getMoney($player, function(float|int $money) use($player, $leggings): void{
                    if(!$player->hasPermission("pvpshop.armor.leggings")){
                        $player->removeCurrentWindow();
                        $player->sendMessage(Loader::Prefix(). Loader::getMessage($player, "Messages.no-permission"));
                        PluginUtils::PlaySound($player, "mob.endermen.portal", 1, 1);
                        return;
                    }

                    if(!$player->getInventory()->canAddItem(ItemUtils::getLeggingsX())){
                        $player->removeCurrentWindow();
                        $player->sendMessage(Loader::Prefix(). Loader::getMessage($player, "Messages.inventory-full"));
                        PluginUtils::PlaySound($player, "mob.endermen.portal", 1, 1);
                        return;
                    }

                    if($money >= $leggings){
                        Loader::getEconomy()->takeMoney($player, $leggings);
                        $player->sendMessage(Loader::Prefix(). str_replace(["{PRICE}"], [$leggings], Loader::getMessage($player, "Messages.successful-purchase")));
                        $player->getInventory()->addItem(ItemUtils::getLeggingsX()->setCount(1)->setCustomName(Loader::getMessage($player, "ExtrasShop-info.boots-name")));
                        PluginUtils::PlaySound($player, "random.levelup", 1, 1.5);
                    }else{
                        $player->removeCurrentWindow();
                        $player->sendMessage(Loader::Prefix(). Loader::getMessage($player, "Messages.no-money"));
                        PluginUtils::PlaySound($player, "mob.villager.no", 1, 1);
                    }
                }));
            break;

            case 15:
                if(Loader::getEconomy()->getMoney($player, function(float|int $money) use($player, $boots): void{
                    if(!$player->hasPermission("pvpshop.armor.boots")){
                        $player->removeCurrentWindow();
                        $player->sendMessage(Loader::Prefix(). Loader::getMessage($player, "Messages.no-permission"));
                        PluginUtils::PlaySound($player, "mob.endermen.portal", 1, 1);
                        return;
                    }

                    if(!$player->getInventory()->canAddItem(ItemUtils::getBootsX())){
                        $player->removeCurrentWindow();
                        $player->sendMessage(Loader::Prefix(). Loader::getMessage($player, "Messages.inventory-full"));
                        PluginUtils::PlaySound($player, "mob.endermen.portal", 1, 1);
                        return;
                    }

                    if($money >= $boots){
                        Loader::getEconomy()->takeMoney($player, $boots);
                        $player->sendMessage(Loader::Prefix(). str_replace(["{PRICE}"], [$boots], Loader::getMessage($player, "Messages.successful-purchase")));
                        $player->getInventory()->addItem(ItemUtils::getBootsX()->setCount(1));
                        PluginUtils::PlaySound($player, "random.levelup", 1, 1.5);
                    }else{
                        $player->removeCurrentWindow();
                        $player->sendMessage(Loader::Prefix(). Loader::getMessage($player, "Messages.no-money"));
                        PluginUtils::PlaySound($player, "mob.villager.no", 1, 1);
                    }
                }));
            break;

            case 20: // RETURN
                Loader::getMenu()->getMenuGUI($player);
                PluginUtils::PlaySound($player, "random.click", 1, 1); 
            break;

            case 22: // CLOSE
                $player->removeCurrentWindow();
                PluginUtils::PlaySound($player, "random.click", 1, 1); 
            break;
        }
        return $transaction->discard();
    }
}