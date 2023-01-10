<?php

#      _       ____   __  __ 
#     / \     / ___| |  \/  |
#    / _ \   | |     | |\/| |
#   / ___ \  | |___  | |  | |
#  /_/   \_\  \____| |_|  |_|
# The creator of this plugin was fernanACM.
# https://github.com/fernanACM

namespace fernanACM\PvPShop\menu\category\armor;

use Closure;

use pocketmine\player\Player;

use muqsit\invmenu\InvMenu;
use muqsit\invmenu\transaction\InvMenuTransaction;
use muqsit\invmenu\transaction\InvMenuTransactionResult;
use muqsit\invmenu\type\InvMenuTypeIds;

use pocketmine\block\VanillaBlocks;
use pocketmine\item\VanillaItems;

use fernanACM\PvPShop\Loader;
use fernanACM\PvPShop\utils\PluginUtils;

class ArmorMenu{

    /**
     * @param Player $player
     * @return void
     */
     public function getArmorMenuGUI(Player $player): void{
        $menu = InvMenu::create(InvMenuTypeIds::TYPE_DOUBLE_CHEST);
        $inv = $menu->getInventory();
        $menu->setListener(Closure::fromCallable([$this, "getActionArmorMenu"]));
        $menu->setName(Loader::getMessage($player, "ArmorShop-name"));
        $config = Loader::getInstance()->config;

        // PRICES
        # ========(LEATHER)============
        $leather_helmet = $config->getNested("Price.Armor.leather-helmet");
        $leather_chestplate = $config->getNested("Price.Armor.leather-chestplate");
        $leather_leggings = $config->getNested("Price.Armor.leather-leggings");
        $leather_boots = $config->getNested("Price.Armor.leather-boots");
        # ========(GOLD)============
        $golden_helmet = $config->getNested("Price.Armor.golden-helmet");
        $golden_chestplate = $config->getNested("Price.Armor.golden-chestplate");
        $golden_leggings = $config->getNested("Price.Armor.golden-leggings");
        $golden_boots = $config->getNested("Price.Armor.golden-boots");
        # ========(CHAINMAIL)=========
        $chainmail_helmet = $config->getNested("Price.Armor.chainmail-helmet");
        $chainmail_chestplate = $config->getNested("Price.Armor.chainmail-chestplate");
        $chainmail_leggings = $config->getNested("Price.Armor.chainmail-leggings");
        $chainmail_boots = $config->getNested("Price.Armor.chainmail-boots");
        # ========(IRON)============
        $iron_helmet = $config->getNested("Price.Armor.iron-helmet");
        $iron_chestplate = $config->getNested("Price.Armor.iron-chestplate");
        $iron_leggings = $config->getNested("Price.Armor.iron-leggings");
        $iron_boots = $config->getNested("Price.Armor.iron-boots");
        # ========(DIAMOND)============
        $diamond_helmet = $config->getNested("Price.Armor.diamond-helmet");
        $diamond_chestplate = $config->getNested("Price.Armor.diamond-chestplate");
        $diamond_leggings = $config->getNested("Price.Armor.diamond-leggings");
        $diamond_boots = $config->getNested("Price.Armor.diamond-boots");

        // CONTENT
        for($i = 0; $i < 54; $i++){
            if(!in_array($i, [9, 18, 27, 36, 11, 20, 29, 38, 13, 22, 31, 40, 15, 24, 33, 42, 17, 26, 35, 44, 47, 49])){
                $inv->setItem($i, VanillaBlocks::IRON_BARS()->asItem()->setCustomName("§r"));
            }
        }
        // LEATHER
        $inv->setItem(9, VanillaItems::LEATHER_CAP()->setCustomName(str_replace(["{PRICE}"], [$leather_helmet], Loader::getMessage($player, "ArmorShop-info.leather_helmet"))));
        $inv->setItem(18, VanillaItems::LEATHER_TUNIC()->setCustomName(str_replace(["{PRICE}"], [$leather_chestplate], Loader::getMessage($player, "ArmorShop-info.leather_chestplate"))));
        $inv->setItem(27, VanillaItems::LEATHER_PANTS()->setCustomName(str_replace(["{PRICE}"], [$leather_leggings], Loader::getMessage($player, "ArmorShop-info.leather_leggings"))));
        $inv->setItem(36, VanillaItems::LEATHER_BOOTS()->setCustomName(str_replace(["{PRICE}"], [$leather_boots], Loader::getMessage($player, "ArmorShop-info.leather_boots"))));

        // GOLD
        $inv->setItem(11, VanillaItems::GOLDEN_HELMET()->setCustomName(str_replace(["{PRICE}"], [$golden_helmet], Loader::getMessage($player, "ArmorShop-info.golden_helmet"))));
        $inv->setItem(20, VanillaItems::GOLDEN_CHESTPLATE()->setCustomName(str_replace(["{PRICE}"], [$golden_chestplate], Loader::getMessage($player, "ArmorShop-info.golden_chestplate"))));
        $inv->setItem(29, VanillaItems::GOLDEN_LEGGINGS()->setCustomName(str_replace(["{PRICE}"], [$golden_leggings], Loader::getMessage($player, "ArmorShop-info.golden_leggings"))));
        $inv->setItem(38, VanillaItems::GOLDEN_BOOTS()->setCustomName(str_replace(["{PRICE}"], [$golden_boots], Loader::getMessage($player, "ArmorShop-info.golden_boots"))));

        // CHAINMAIL
        $inv->setItem(13, VanillaItems::CHAINMAIL_HELMET()->setCustomName(str_replace(["{PRICE}"], [$chainmail_helmet], Loader::getMessage($player, "ArmorShop-info.chainmail_helmet"))));
        $inv->setItem(22, VanillaItems::CHAINMAIL_CHESTPLATE()->setCustomName(str_replace(["{PRICE}"], [$chainmail_chestplate], Loader::getMessage($player, "ArmorShop-info.chainmail_chestplate"))));
        $inv->setItem(31, VanillaItems::CHAINMAIL_LEGGINGS()->setCustomName(str_replace(["{PRICE}"], [$chainmail_leggings], Loader::getMessage($player, "ArmorShop-info.chainmail_leggings"))));
        $inv->setItem(40, VanillaItems::CHAINMAIL_BOOTS()->setCustomName(str_replace(["{PRICE}"], [$chainmail_boots], Loader::getMessage($player, "ArmorShop-info.chainmail_boots"))));

        // IRON
        $inv->setItem(15, VanillaItems::IRON_HELMET()->setCustomName(str_replace(["{PRICE}"], [$iron_helmet], Loader::getMessage($player, "ArmorShop-info.iron_helmet"))));
        $inv->setItem(24, VanillaItems::IRON_CHESTPLATE()->setCustomName(str_replace(["{PRICE}"], [$iron_chestplate], Loader::getMessage($player, "ArmorShop-info.iron_chestplate"))));
        $inv->setItem(33, VanillaItems::IRON_LEGGINGS()->setCustomName(str_replace(["{PRICE}"], [$iron_leggings], Loader::getMessage($player, "ArmorShop-info.iron_leggings"))));
        $inv->setItem(42, VanillaItems::IRON_BOOTS()->setCustomName(str_replace(["{PRICE}"], [$iron_boots], Loader::getMessage($player, "ArmorShop-info.iron_boots"))));

        // DIAMOND
        $inv->setItem(17, VanillaItems::DIAMOND_HELMET()->setCustomName(str_replace(["{PRICE}"], [$diamond_helmet], Loader::getMessage($player, "ArmorShop-info.diamond_helmet"))));
        $inv->setItem(26, VanillaItems::DIAMOND_CHESTPLATE()->setCustomName(str_replace(["{PRICE}"], [$diamond_chestplate], Loader::getMessage($player, "ArmorShop-info.diamond_chestplate"))));
        $inv->setItem(35, VanillaItems::DIAMOND_LEGGINGS()->setCustomName(str_replace(["{PRICE}"], [$diamond_leggings], Loader::getMessage($player, "ArmorShop-info.diamond_leggings"))));
        $inv->setItem(44, VanillaItems::DIAMOND_BOOTS()->setCustomName(str_replace(["{PRICE}"], [$diamond_boots], Loader::getMessage($player, "ArmorShop-info.diamond_boots"))));

        // CLOSE MENU
        $inv->setItem(49, VanillaBlocks::BARRIER()->asItem()->setCustomName(Loader::getMessage($player, "Menu-category.close")));

        // RETURN
        $inv->setItem(47, VanillaItems::ARROW()->setCustomName(Loader::getMessage($player, "Menu-category.return")));
        $menu->send($player);
     }

     /**
      * @param InvMenuTransaction $transaction
      * @return InvMenuTransactionResult
      */
    public function getActionArmorMenu(InvMenuTransaction $transaction): InvMenuTransactionResult{
        $player = $transaction->getPlayer();
        $action = $transaction->getAction();

        $config = Loader::getInstance()->config;

        // PRICES
        # ========(LEATHER)============
        $leather_helmet = $config->getNested("Price.Armor.leather-helmet");
        $leather_chestplate = $config->getNested("Price.Armor.leather-chestplate");
        $leather_leggings = $config->getNested("Price.Armor.leather-leggings");
        $leather_boots = $config->getNested("Price.Armor.leather-boots");
        # ========(GOLD)============
        $golden_helmet = $config->getNested("Price.Armor.golden-helmet");
        $golden_chestplate = $config->getNested("Price.Armor.golden-chestplate");
        $golden_leggings = $config->getNested("Price.Armor.golden-leggings");
        $golden_boots = $config->getNested("Price.Armor.golden-boots");
        # ========(CHAINMAIL)=========
        $chainmail_helmet = $config->getNested("Price.Armor.chainmail-helmet");
        $chainmail_chestplate = $config->getNested("Price.Armor.chainmail-chestplate");
        $chainmail_leggings = $config->getNested("Price.Armor.chainmail-leggings");
        $chainmail_boots = $config->getNested("Price.Armor.chainmail-boots");
        # ========(IRON)============
        $iron_helmet = $config->getNested("Price.Armor.iron-helmet");
        $iron_chestplate = $config->getNested("Price.Armor.iron-chestplate");
        $iron_leggings = $config->getNested("Price.Armor.iron-leggings");
        $iron_boots = $config->getNested("Price.Armor.iron-boots");
        # ========(DIAMOND)============
        $diamond_helmet = $config->getNested("Price.Armor.diamond-helmet");
        $diamond_chestplate = $config->getNested("Price.Armor.diamond-chestplate");
        $diamond_leggings = $config->getNested("Price.Armor.diamond-leggings");
        $diamond_boots = $config->getNested("Price.Armor.diamond-boots");

        switch($action->getSlot()){
            # =========(LEATHER)==========
            case 9: // HELMET
                if(Loader::getEconomy()->getMoney($player, function(float|int $money) use($player, $leather_helmet): void{
                    if(!$player->getInventory()->canAddItem(VanillaItems::LEATHER_CAP())){
                        $player->removeCurrentWindow();
                        $player->sendMessage(Loader::Prefix(). Loader::getMessage($player, "Messages.inventory-full"));
                        PluginUtils::PlaySound($player, "mob.endermen.portal", 1, 1);
                        return;
                    }

                    if($money >= $leather_helmet){
                        Loader::getEconomy()->takeMoney($player, $leather_helmet);
                        $player->sendMessage(Loader::Prefix(). str_replace(["{PRICE}"], [$leather_helmet], Loader::getMessage($player, "Messages.successful-purchase")));
                        $player->getInventory()->addItem(VanillaItems::LEATHER_CAP()->setCount(1));
                        PluginUtils::PlaySound($player, "random.levelup", 1, 1.5);
                    }else{
                        $player->removeCurrentWindow();
                        $player->sendMessage(Loader::Prefix(). Loader::getMessage($player, "Messages.no-money"));
                        PluginUtils::PlaySound($player, "mob.villager.no", 1, 1);
                    }
                }));
            break;

            case 18: // CHESTPLATE
                if(Loader::getEconomy()->getMoney($player, function(float|int $money) use($player, $leather_chestplate): void{
                    if(!$player->getInventory()->canAddItem(VanillaItems::LEATHER_TUNIC())){
                        $player->removeCurrentWindow();
                        $player->sendMessage(Loader::Prefix(). Loader::getMessage($player, "Messages.inventory-full"));
                        PluginUtils::PlaySound($player, "mob.endermen.portal", 1, 1);
                        return;
                    }

                    if($money >= $leather_chestplate){
                        Loader::getEconomy()->takeMoney($player, $leather_chestplate);
                        $player->sendMessage(Loader::Prefix(). str_replace(["{PRICE}"], [$leather_chestplate], Loader::getMessage($player, "Messages.successful-purchase")));
                        $player->getInventory()->addItem(VanillaItems::LEATHER_TUNIC()->setCount(1));
                        PluginUtils::PlaySound($player, "random.levelup", 1, 1.5);
                    }else{
                        $player->removeCurrentWindow();
                        $player->sendMessage(Loader::Prefix(). Loader::getMessage($player, "Messages.no-money"));
                        PluginUtils::PlaySound($player, "mob.villager.no", 1, 1);
                    }
                }));
            break;

            case 27: // LEGGINGS
                if(Loader::getEconomy()->getMoney($player, function(float|int $money) use($player, $leather_leggings): void{
                    if(!$player->getInventory()->canAddItem(VanillaItems::LEATHER_PANTS())){
                        $player->removeCurrentWindow();
                        $player->sendMessage(Loader::Prefix(). Loader::getMessage($player, "Messages.inventory-full"));
                        PluginUtils::PlaySound($player, "mob.endermen.portal", 1, 1);
                        return;
                    }

                    if($money >= $leather_leggings){
                        Loader::getEconomy()->takeMoney($player, $leather_leggings);
                        $player->sendMessage(Loader::Prefix(). str_replace(["{PRICE}"], [$leather_leggings], Loader::getMessage($player, "Messages.successful-purchase")));
                        $player->getInventory()->addItem(VanillaItems::LEATHER_PANTS()->setCount(1));
                        PluginUtils::PlaySound($player, "random.levelup", 1, 1.5);
                    }else{
                        $player->removeCurrentWindow();
                        $player->sendMessage(Loader::Prefix(). Loader::getMessage($player, "Messages.no-money"));
                        PluginUtils::PlaySound($player, "mob.villager.no", 1, 1);
                    }
                }));
            break;

            case 36: // BOOTS
                if(Loader::getEconomy()->getMoney($player, function(float|int $money) use($player, $leather_boots): void{
                    if(!$player->getInventory()->canAddItem(VanillaItems::LEATHER_BOOTS())){
                        $player->removeCurrentWindow();
                        $player->sendMessage(Loader::Prefix(). Loader::getMessage($player, "Messages.inventory-full"));
                        PluginUtils::PlaySound($player, "mob.endermen.portal", 1, 1);
                        return;
                    }

                    if($money >= $leather_boots){
                        Loader::getEconomy()->takeMoney($player, $leather_boots);
                        $player->sendMessage(Loader::Prefix(). str_replace(["{PRICE}"], [$leather_boots], Loader::getMessage($player, "Messages.successful-purchase")));
                        $player->getInventory()->addItem(VanillaItems::LEATHER_BOOTS()->setCount(1));
                        PluginUtils::PlaySound($player, "random.levelup", 1, 1.5);
                    }else{
                        $player->removeCurrentWindow();
                        $player->sendMessage(Loader::Prefix(). Loader::getMessage($player, "Messages.no-money"));
                        PluginUtils::PlaySound($player, "mob.villager.no", 1, 1);
                    }
                }));
            break;

            # =========(GOLD)===========
            case 11: // HELMET
                if(Loader::getEconomy()->getMoney($player, function(float|int $money) use($player, $golden_helmet): void{
                    if(!$player->getInventory()->canAddItem(VanillaItems::GOLDEN_HELMET())){
                        $player->removeCurrentWindow();
                        $player->sendMessage(Loader::Prefix(). Loader::getMessage($player, "Messages.inventory-full"));
                        PluginUtils::PlaySound($player, "mob.endermen.portal", 1, 1);
                        return;
                    }

                    if($money >= $golden_helmet){
                        Loader::getEconomy()->takeMoney($player, $golden_helmet);
                        $player->sendMessage(Loader::Prefix(). str_replace(["{PRICE}"], [$golden_helmet], Loader::getMessage($player, "Messages.successful-purchase")));
                        $player->getInventory()->addItem(VanillaItems::GOLDEN_HELMET()->setCount(1));
                        PluginUtils::PlaySound($player, "random.levelup", 1, 1.5);
                    }else{
                        $player->removeCurrentWindow();
                        $player->sendMessage(Loader::Prefix(). Loader::getMessage($player, "Messages.no-money"));
                        PluginUtils::PlaySound($player, "mob.villager.no", 1, 1);
                    }
                }));
            break;

            case 20: // CHESTPLATE
                if(Loader::getEconomy()->getMoney($player, function(float|int $money) use($player, $golden_chestplate): void{
                    if(!$player->getInventory()->canAddItem(VanillaItems::GOLDEN_CHESTPLATE())){
                        $player->removeCurrentWindow();
                        $player->sendMessage(Loader::Prefix(). Loader::getMessage($player, "Messages.inventory-full"));
                        PluginUtils::PlaySound($player, "mob.endermen.portal", 1, 1);
                        return;
                    }

                    if($money >= $golden_chestplate){
                        Loader::getEconomy()->takeMoney($player, $golden_chestplate);
                        $player->sendMessage(Loader::Prefix(). str_replace(["{PRICE}"], [$golden_chestplate], Loader::getMessage($player, "Messages.successful-purchase")));
                        $player->getInventory()->addItem(VanillaItems::GOLDEN_CHESTPLATE()->setCount(1));
                        PluginUtils::PlaySound($player, "random.levelup", 1, 1.5);
                    }else{
                        $player->removeCurrentWindow();
                        $player->sendMessage(Loader::Prefix(). Loader::getMessage($player, "Messages.no-money"));
                        PluginUtils::PlaySound($player, "mob.villager.no", 1, 1);
                    }
                }));
            break;

            case 29: // LEGGINGS
                if(Loader::getEconomy()->getMoney($player, function(float|int $money) use($player, $golden_leggings): void{
                    if(!$player->getInventory()->canAddItem(VanillaItems::GOLDEN_LEGGINGS())){
                        $player->removeCurrentWindow();
                        $player->sendMessage(Loader::Prefix(). Loader::getMessage($player, "Messages.inventory-full"));
                        PluginUtils::PlaySound($player, "mob.endermen.portal", 1, 1);
                        return;
                    }

                    if($money >= $golden_leggings){
                        Loader::getEconomy()->takeMoney($player, $golden_leggings);
                        $player->sendMessage(Loader::Prefix(). str_replace(["{PRICE}"], [$golden_leggings], Loader::getMessage($player, "Messages.successful-purchase")));
                        $player->getInventory()->addItem(VanillaItems::GOLDEN_LEGGINGS()->setCount(1));
                        PluginUtils::PlaySound($player, "random.levelup", 1, 1.5);
                    }else{
                        $player->removeCurrentWindow();
                        $player->sendMessage(Loader::Prefix(). Loader::getMessage($player, "Messages.no-money"));
                        PluginUtils::PlaySound($player, "mob.villager.no", 1, 1);
                    }
                }));
            break;

            case 38: // BOOTS
                if(Loader::getEconomy()->getMoney($player, function(float|int $money) use($player, $golden_boots): void{
                    if(!$player->getInventory()->canAddItem(VanillaItems::GOLDEN_BOOTS())){
                        $player->removeCurrentWindow();
                        $player->sendMessage(Loader::Prefix(). Loader::getMessage($player, "Messages.inventory-full"));
                        PluginUtils::PlaySound($player, "mob.endermen.portal", 1, 1);
                        return;
                    }

                    if($money >= $golden_boots){
                        Loader::getEconomy()->takeMoney($player, $golden_boots);
                        $player->sendMessage(Loader::Prefix(). str_replace(["{PRICE}"], [$golden_boots], Loader::getMessage($player, "Messages.successful-purchase")));
                        $player->getInventory()->addItem(VanillaItems::GOLDEN_BOOTS()->setCount(1));
                        PluginUtils::PlaySound($player, "random.levelup", 1, 1.5);
                    }else{
                        $player->removeCurrentWindow();
                        $player->sendMessage(Loader::Prefix(). Loader::getMessage($player, "Messages.no-money"));
                        PluginUtils::PlaySound($player, "mob.villager.no", 1, 1);
                    }
                }));
            break;

            # ==========(CHAINMAIL)===========
            case 13: // HELMET
                if(Loader::getEconomy()->getMoney($player, function(float|int $money) use($player, $chainmail_helmet): void{
                    if(!$player->getInventory()->canAddItem(VanillaItems::CHAINMAIL_HELMET())){
                        $player->removeCurrentWindow();
                        $player->sendMessage(Loader::Prefix(). Loader::getMessage($player, "Messages.inventory-full"));
                        PluginUtils::PlaySound($player, "mob.endermen.portal", 1, 1);
                        return;
                    }

                    if($money >= $chainmail_helmet){
                        Loader::getEconomy()->takeMoney($player, $chainmail_helmet);
                        $player->sendMessage(Loader::Prefix(). str_replace(["{PRICE}"], [$chainmail_helmet], Loader::getMessage($player, "Messages.successful-purchase")));
                        $player->getInventory()->addItem(VanillaItems::CHAINMAIL_HELMET()->setCount(1));
                        PluginUtils::PlaySound($player, "random.levelup", 1, 1.5);
                    }else{
                        $player->removeCurrentWindow();
                        $player->sendMessage(Loader::Prefix(). Loader::getMessage($player, "Messages.no-money"));
                        PluginUtils::PlaySound($player, "mob.villager.no", 1, 1);
                    }
                }));
            break;

            case 22: // CHESTPLATE
                if(Loader::getEconomy()->getMoney($player, function(float|int $money) use($player, $chainmail_chestplate): void{
                    if(!$player->getInventory()->canAddItem(VanillaItems::CHAINMAIL_CHESTPLATE())){
                        $player->removeCurrentWindow();
                        $player->sendMessage(Loader::Prefix(). Loader::getMessage($player, "Messages.inventory-full"));
                        PluginUtils::PlaySound($player, "mob.endermen.portal", 1, 1);
                        return;
                    }

                    if($money >= $chainmail_chestplate){
                        Loader::getEconomy()->takeMoney($player, $chainmail_chestplate);
                        $player->sendMessage(Loader::Prefix(). str_replace(["{PRICE}"], [$chainmail_chestplate], Loader::getMessage($player, "Messages.successful-purchase")));
                        $player->getInventory()->addItem(VanillaItems::CHAINMAIL_CHESTPLATE()->setCount(1));
                        PluginUtils::PlaySound($player, "random.levelup", 1, 1.5);
                    }else{
                        $player->removeCurrentWindow();
                        $player->sendMessage(Loader::Prefix(). Loader::getMessage($player, "Messages.no-money"));
                        PluginUtils::PlaySound($player, "mob.villager.no", 1, 1);
                    }
                }));
            break;

            case 31: // LEGGINGS
                if(Loader::getEconomy()->getMoney($player, function(float|int $money) use($player, $chainmail_leggings): void{
                    if(!$player->getInventory()->canAddItem(VanillaItems::CHAINMAIL_LEGGINGS())){
                        $player->removeCurrentWindow();
                        $player->sendMessage(Loader::Prefix(). Loader::getMessage($player, "Messages.inventory-full"));
                        PluginUtils::PlaySound($player, "mob.endermen.portal", 1, 1);
                        return;
                    }

                    if($money >= $chainmail_leggings){
                        Loader::getEconomy()->takeMoney($player, $chainmail_leggings);
                        $player->sendMessage(Loader::Prefix(). str_replace(["{PRICE}"], [$chainmail_leggings], Loader::getMessage($player, "Messages.successful-purchase")));
                        $player->getInventory()->addItem(VanillaItems::CHAINMAIL_LEGGINGS()->setCount(1));
                        PluginUtils::PlaySound($player, "random.levelup", 1, 1.5);
                    }else{
                        $player->removeCurrentWindow();
                        $player->sendMessage(Loader::Prefix(). Loader::getMessage($player, "Messages.no-money"));
                        PluginUtils::PlaySound($player, "mob.villager.no", 1, 1);
                    }
                }));
            break;

            case 40: // BOOTS
                if(Loader::getEconomy()->getMoney($player, function(float|int $money) use($player, $chainmail_boots): void{
                    if(!$player->getInventory()->canAddItem(VanillaItems::CHAINMAIL_BOOTS())){
                        $player->removeCurrentWindow();
                        $player->sendMessage(Loader::Prefix(). Loader::getMessage($player, "Messages.inventory-full"));
                        PluginUtils::PlaySound($player, "mob.endermen.portal", 1, 1);
                        return;
                    }

                    if($money >= $chainmail_boots){
                        Loader::getEconomy()->takeMoney($player, $chainmail_boots);
                        $player->sendMessage(Loader::Prefix(). str_replace(["{PRICE}"], [$chainmail_boots], Loader::getMessage($player, "Messages.successful-purchase")));
                        $player->getInventory()->addItem(VanillaItems::CHAINMAIL_BOOTS()->setCount(1));
                        PluginUtils::PlaySound($player, "random.levelup", 1, 1.5);
                    }else{
                        $player->removeCurrentWindow();
                        $player->sendMessage(Loader::Prefix(). Loader::getMessage($player, "Messages.no-money"));
                        PluginUtils::PlaySound($player, "mob.villager.no", 1, 1);
                    }
                }));
            break;

            # ==========(IRON)===========
            case 15: // HELMET
                if(Loader::getEconomy()->getMoney($player, function(float|int $money) use($player, $iron_helmet): void{
                    if(!$player->getInventory()->canAddItem(VanillaItems::IRON_HELMET())){
                        $player->removeCurrentWindow();
                        $player->sendMessage(Loader::Prefix(). Loader::getMessage($player, "Messages.inventory-full"));
                        PluginUtils::PlaySound($player, "mob.endermen.portal", 1, 1);
                        return;
                    }

                    if($money >= $iron_helmet){
                        Loader::getEconomy()->takeMoney($player, $iron_helmet);
                        $player->sendMessage(Loader::Prefix(). str_replace(["{PRICE}"], [$iron_helmet], Loader::getMessage($player, "Messages.successful-purchase")));
                        $player->getInventory()->addItem(VanillaItems::IRON_HELMET()->setCount(1));
                        PluginUtils::PlaySound($player, "random.levelup", 1, 1.5);
                    }else{
                        $player->removeCurrentWindow();
                        $player->sendMessage(Loader::Prefix(). Loader::getMessage($player, "Messages.no-money"));
                        PluginUtils::PlaySound($player, "mob.villager.no", 1, 1); 
                    }
                }));
            break;

            case 24: // CHESTPLATE
                if(Loader::getEconomy()->getMoney($player, function(float|int $money) use($player, $iron_chestplate): void{
                    if(!$player->getInventory()->canAddItem(VanillaItems::IRON_CHESTPLATE())){
                        $player->removeCurrentWindow();
                        $player->sendMessage(Loader::Prefix(). Loader::getMessage($player, "Messages.inventory-full"));
                        PluginUtils::PlaySound($player, "mob.endermen.portal", 1, 1);
                        return;
                    }

                    if($money >= $iron_chestplate){
                        Loader::getEconomy()->takeMoney($player, $iron_chestplate);
                        $player->sendMessage(Loader::Prefix(). str_replace(["{PRICE}"], [$iron_chestplate], Loader::getMessage($player, "Messages.successful-purchase")));
                        $player->getInventory()->addItem(VanillaItems::IRON_CHESTPLATE()->setCount(1));
                        PluginUtils::PlaySound($player, "random.levelup", 1, 1.5);
                    }else{
                        $player->removeCurrentWindow();
                        $player->sendMessage(Loader::Prefix(). Loader::getMessage($player, "Messages.no-money"));
                        PluginUtils::PlaySound($player, "mob.villager.no", 1, 1);
                    }
                }));
            break;

            case 33: // LEGGINGS
                if(Loader::getEconomy()->getMoney($player, function(float|int $money) use($player, $iron_leggings): void{
                    if(!$player->getInventory()->canAddItem(VanillaItems::IRON_LEGGINGS())){
                        $player->removeCurrentWindow();
                        $player->sendMessage(Loader::Prefix(). Loader::getMessage($player, "Messages.inventory-full"));
                        PluginUtils::PlaySound($player, "mob.endermen.portal", 1, 1);
                        return;
                    }

                    if($money >= $iron_leggings){
                        Loader::getEconomy()->takeMoney($player, $iron_leggings);
                        $player->sendMessage(Loader::Prefix(). str_replace(["{PRICE}"], [$iron_leggings], Loader::getMessage($player, "Messages.successful-purchase")));
                        $player->getInventory()->addItem(VanillaItems::IRON_LEGGINGS()->setCount(1));
                        PluginUtils::PlaySound($player, "random.levelup", 1, 1.5);
                    }else{
                        $player->removeCurrentWindow();
                        $player->sendMessage(Loader::Prefix(). Loader::getMessage($player, "Messages.no-money"));
                        PluginUtils::PlaySound($player, "mob.villager.no", 1, 1);
                    }
                }));
            break;

            case 42: // BOOTS
                if(Loader::getEconomy()->getMoney($player, function(float|int $money) use($player, $iron_boots): void{
                    if(!$player->getInventory()->canAddItem(VanillaItems::IRON_BOOTS())){
                        $player->removeCurrentWindow();
                        $player->sendMessage(Loader::Prefix(). Loader::getMessage($player, "Messages.inventory-full"));
                        PluginUtils::PlaySound($player, "mob.endermen.portal", 1, 1);
                        return;
                    }

                    if($money >= $iron_boots){
                        Loader::getEconomy()->takeMoney($player, $iron_boots);
                        $player->sendMessage(Loader::Prefix(). str_replace(["{PRICE}"], [$iron_boots], Loader::getMessage($player, "Messages.successful-purchase")));
                        $player->getInventory()->addItem(VanillaItems::IRON_BOOTS()->setCount(1));
                        PluginUtils::PlaySound($player, "random.levelup", 1, 1.5);
                    }else{
                        $player->removeCurrentWindow();
                        $player->sendMessage(Loader::Prefix(). Loader::getMessage($player, "Messages.no-money"));
                        PluginUtils::PlaySound($player, "mob.villager.no", 1, 1);
                    }
                }));
            break;

            # ========(DIAMOND)========
            case 17: // HELMET
                if(Loader::getEconomy()->getMoney($player, function(float|int $money) use($player, $diamond_helmet): void{
                    if(!$player->getInventory()->canAddItem(VanillaItems::DIAMOND_HELMET())){
                        $player->removeCurrentWindow();
                        $player->sendMessage(Loader::Prefix(). Loader::getMessage($player, "Messages.inventory-full"));
                        PluginUtils::PlaySound($player, "mob.endermen.portal", 1, 1);
                        return;
                    }

                    if($money >= $diamond_helmet){
                        Loader::getEconomy()->takeMoney($player, $diamond_helmet);
                        $player->sendMessage(Loader::Prefix(). str_replace(["{PRICE}"], [$diamond_helmet], Loader::getMessage($player, "Messages.successful-purchase")));
                        $player->getInventory()->addItem(VanillaItems::DIAMOND_HELMET()->setCount(1));
                        PluginUtils::PlaySound($player, "random.levelup", 1, 1.5);
                    }else{
                        $player->removeCurrentWindow();
                        $player->sendMessage(Loader::Prefix(). Loader::getMessage($player, "Messages.no-money"));
                        PluginUtils::PlaySound($player, "mob.villager.no", 1, 1);
                    }
                }));
            break;

            case 26: // CHESTPLATE
                if(Loader::getEconomy()->getMoney($player, function(float|int $money) use($player, $diamond_chestplate): void{
                    if(!$player->getInventory()->canAddItem(VanillaItems::DIAMOND_CHESTPLATE())){
                        $player->removeCurrentWindow();
                        $player->sendMessage(Loader::Prefix(). Loader::getMessage($player, "Messages.inventory-full"));
                        PluginUtils::PlaySound($player, "mob.endermen.portal", 1, 1);
                        return;
                    }

                    if($money >= $diamond_chestplate){
                        Loader::getEconomy()->takeMoney($player, $diamond_chestplate);
                        $player->sendMessage(Loader::Prefix(). str_replace(["{PRICE}"], [$diamond_chestplate], Loader::getMessage($player, "Messages.successful-purchase")));
                        $player->getInventory()->addItem(VanillaItems::DIAMOND_CHESTPLATE()->setCount(1));
                        PluginUtils::PlaySound($player, "random.levelup", 1, 1.5);
                    }else{
                        $player->removeCurrentWindow();
                        $player->sendMessage(Loader::Prefix(). Loader::getMessage($player, "Messages.no-money"));
                        PluginUtils::PlaySound($player, "mob.villager.no", 1, 1);
                    }
                }));
            break;

            case 35: // LEGGINGS
                if(Loader::getEconomy()->getMoney($player, function(float|int $money) use($player, $diamond_leggings): void{
                    if(!$player->getInventory()->canAddItem(VanillaItems::DIAMOND_LEGGINGS())){
                        $player->removeCurrentWindow();
                        $player->sendMessage(Loader::Prefix(). Loader::getMessage($player, "Messages.inventory-full"));
                        PluginUtils::PlaySound($player, "mob.endermen.portal", 1, 1);
                        return;
                    }

                    if($money >= $diamond_leggings){
                        Loader::getEconomy()->takeMoney($player, $diamond_leggings);
                        $player->sendMessage(Loader::Prefix(). str_replace(["{PRICE}"], [$diamond_leggings], Loader::getMessage($player, "Messages.successful-purchase")));
                        $player->getInventory()->addItem(VanillaItems::DIAMOND_LEGGINGS()->setCount(1));
                        PluginUtils::PlaySound($player, "random.levelup", 1, 1.5);
                    }else{
                        $player->removeCurrentWindow();
                        $player->sendMessage(Loader::Prefix(). Loader::getMessage($player, "Messages.no-money"));
                        PluginUtils::PlaySound($player, "mob.villager.no", 1, 1);  
                    }
                }));
            break;

            case 44: // BOOTS
                if(Loader::getEconomy()->getMoney($player, function(float|int $money) use($player, $diamond_boots): void{
                    if(!$player->getInventory()->canAddItem(VanillaItems::DIAMOND_BOOTS())){
                        $player->removeCurrentWindow();
                        $player->sendMessage(Loader::Prefix(). Loader::getMessage($player, "Messages.inventory-full"));
                        PluginUtils::PlaySound($player, "mob.endermen.portal", 1, 1);
                        return;
                    }

                    if($money >= $diamond_boots){
                        Loader::getEconomy()->takeMoney($player, $diamond_boots);
                        $player->sendMessage(Loader::Prefix(). str_replace(["{PRICE}"], [$diamond_boots], Loader::getMessage($player, "Messages.successful-purchase")));
                        $player->getInventory()->addItem(VanillaItems::DIAMOND_BOOTS()->setCount(1));
                        PluginUtils::PlaySound($player, "random.levelup", 1, 1.5);
                    }else{
                        $player->removeCurrentWindow();
                        $player->sendMessage(Loader::Prefix(). Loader::getMessage($player, "Messages.no-money"));
                        PluginUtils::PlaySound($player, "mob.villager.no", 1, 1); 
                    }
                }));
            break;

            case 47: // RETURN
                Loader::getMenu()->getMenuGUI($player);
                PluginUtils::PlaySound($player, "random.click", 1, 1); 
            break;

            case 49: //CLOSE
                $player->removeCurrentWindow();
                PluginUtils::PlaySound($player, "random.click", 1, 1); 
            break;
        }
        return $transaction->discard();
    } 
}