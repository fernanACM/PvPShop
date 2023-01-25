<?php

#      _       ____   __  __ 
#     / \     / ___| |  \/  |
#    / _ \   | |     | |\/| |
#   / ___ \  | |___  | |  | |
#  /_/   \_\  \____| |_|  |_|
# The creator of this plugin was fernanACM.
# https://github.com/fernanACM

namespace fernanACM\PvPShop\menu\category\tools;

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

class ToolsMenu{

    /**
     * @param Player $player
     * @return void
     */
    public function getToolsMenuGUI(Player $player): void{
        $menu = InvMenu::create(InvMenuTypeIds::TYPE_DOUBLE_CHEST);
        $inv = $menu->getInventory();
        $menu->setListener(Closure::fromCallable([$this, "getActionToolsMenu"]));
        $menu->setName(Loader::getMessage($player, "ToolsShop-name"));
        $config = Loader::getInstance()->config;

        # =========(WOOD=========
        $wood_sword = $config->getNested("Price.Tools.wood_sword");
        $wood_pickaxe = $config->getNested("Price.Tools.wood_pickaxe");
        $wood_axe = $config->getNested("Price.Tools.wood_axe");
        # ========(STONE)========
        $stone_sword = $config->getNested("Price.Tools.stone_sword");
        $stone_pickaxe = $config->getNested("Price.Tools.stone_pickaxe");
        $stone_axe = $config->getNested("Price.Tools.stone_axe");
        # ========(GOLD)======
        $golden_sword = $config->getNested("Price.Tools.golden_sword");
        $golden_pickaxe = $config->getNested("Price.Tools.golden_pickaxe");
        $golden_axe = $config->getNested("Price.Tools.golden_axe");
        # ========(IRON)=========
        $iron_sword = $config->getNested("Price.Tools.iron_sword");
        $iron_pickaxe = $config->getNested("Price.Tools.iron_pickaxe");
        $iron_axe = $config->getNested("Price.Tools.iron_axe");
        #========(DIAMOND)============
        $diamond_sword = $config->getNested("Price.Tools.diamond_sword");
        $diamond_pickaxe = $config->getNested("Price.Tools.diamond_pickaxe");
        $diamond_axe = $config->getNested("Price.Tools.diamond_axe");

        for($i = 0; $i < 54; $i++){
            if(!in_array($i, [10, 11, 12, 14, 15, 16, 28, 29, 30, 32, 33, 34, 39, 40, 41, 47, 49])){
                $inv->setItem($i, VanillaBlocks::IRON_BARS()->asItem()->setCustomName("§r"));
            }
        }

        // WOOD
        $inv->setItem(10, VanillaItems::WOODEN_SWORD()->setCustomName(str_replace(["{PRICE}"], [$wood_sword], Loader::getMessage($player, "ToolsShop-info.wood_sword"))));
        $inv->setItem(11, VanillaItems::WOODEN_PICKAXE()->setCustomName(str_replace(["{PRICE}"], [$wood_pickaxe], Loader::getMessage($player, "ToolsShop-info.wood_pickaxe"))));
        $inv->setItem(12, VanillaItems::WOODEN_AXE()->setCustomName(str_replace(["{PRICE}"], [$wood_axe], Loader::getMessage($player, "ToolsShop-info.wood_axe"))));

        // STONE
        $inv->setItem(14, VanillaItems::STONE_SWORD()->setCustomName(str_replace(["{PRICE}"], [$stone_sword], Loader::getMessage($player, "ToolsShop-info.stone_sword"))));
        $inv->setItem(15, VanillaItems::STONE_PICKAXE()->setCustomName(str_replace(["{PRICE}"], [$stone_pickaxe], Loader::getMessage($player, "ToolsShop-info.stone_pickaxe"))));
        $inv->setItem(16, VanillaItems::STONE_AXE()->setCustomName(str_replace(["{PRICE}"], [$stone_axe], Loader::getMessage($player, "ToolsShop-info.stone_axe"))));

        // GOLD
        $inv->setItem(28, VanillaItems::GOLDEN_SWORD()->setCustomName(str_replace(["{PRICE}"], [$golden_sword], Loader::getMessage($player, "ToolsShop-info.golden_sword"))));
        $inv->setItem(29, VanillaItems::GOLDEN_PICKAXE()->setCustomName(str_replace(["{PRICE}"], [$golden_pickaxe], Loader::getMessage($player, "ToolsShop-info.golden_pickaxe"))));
        $inv->setItem(30, VanillaItems::GOLDEN_AXE()->setCustomName(str_replace(["{PRICE}"], [$golden_axe], Loader::getMessage($player, "ToolsShop-info.golden_axe"))));

        // IRON
        $inv->setItem(32, VanillaItems::IRON_SWORD()->setCustomName(str_replace(["{PRICE}"], [$iron_sword], Loader::getMessage($player, "ToolsShop-info.iron_sword"))));
        $inv->setItem(33, VanillaItems::IRON_PICKAXE()->setCustomName(str_replace(["{PRICE}"], [$iron_pickaxe], Loader::getMessage($player, "ToolsShop-info.iron_pickaxe"))));
        $inv->setItem(34, VanillaItems::IRON_AXE()->setCustomName(str_replace(["{PRICE}"], [$iron_axe], Loader::getMessage($player, "ToolsShop-info.iron_axe"))));

        // DIAMOND
        $inv->setItem(39, VanillaItems::DIAMOND_SWORD()->setCustomName(str_replace(["{PRICE}"], [$diamond_sword], Loader::getMessage($player, "ToolsShop-info.diamond_sword"))));
        $inv->setItem(40, VanillaItems::DIAMOND_PICKAXE()->setCustomName(str_replace(["{PRICE}"], [$diamond_pickaxe], Loader::getMessage($player, "ToolsShop-info.diamond_pickaxe"))));
        $inv->setItem(41, VanillaItems::DIAMOND_AXE()->setCustomName(str_replace(["{PRICE}"], [$diamond_axe], Loader::getMessage($player, "ToolsShop-info.diamond_axe"))));

        // EXTRAS
        $inv->setItem(47, VanillaItems::ARROW()->setCustomName(Loader::getMessage($player, "Menu-category.return")));
        $inv->setItem(49, VanillaBlocks::BARRIER()->asItem()->setCustomName(Loader::getMessage($player, "Menu-category.close")));

        $menu->send($player);
    }

    /**
     * @param InvMenuTransaction $transaction
     * @return InvMenuTransactionResult
     */
    public function getActionToolsMenu(InvMenuTransaction $transaction): InvMenuTransactionResult{
        $player = $transaction->getPlayer();
        $action = $transaction->getAction();
        $config = Loader::getInstance()->config;

        # =========(WOOD=========
        $wood_sword = $config->getNested("Price.Tools.wood_sword");
        $wood_pickaxe = $config->getNested("Price.Tools.wood_pickaxe");
        $wood_axe = $config->getNested("Price.Tools.wood_axe");
        # ========(STONE)========
        $stone_sword = $config->getNested("Price.Tools.stone_sword");
        $stone_pickaxe = $config->getNested("Price.Tools.stone_pickaxe");
        $stone_axe = $config->getNested("Price.Tools.stone_axe");
        # ========(GOLD)======
        $golden_sword = $config->getNested("Price.Tools.golden_sword");
        $golden_pickaxe = $config->getNested("Price.Tools.golden_pickaxe");
        $golden_axe = $config->getNested("Price.Tools.golden_axe");
        # ========(IRON)=========
        $iron_sword = $config->getNested("Price.Tools.iron_sword");
        $iron_pickaxe = $config->getNested("Price.Tools.iron_pickaxe");
        $iron_axe = $config->getNested("Price.Tools.iron_axe");
        #========(DIAMOND)============
        $diamond_sword = $config->getNested("Price.Tools.diamond_sword");
        $diamond_pickaxe = $config->getNested("Price.Tools.diamond_pickaxe");
        $diamond_axe = $config->getNested("Price.Tools.diamond_axe");


        switch($action->getSlot()){
            # =========(WOOD)=================
            case 10: // SWORD
                if(Loader::getEconomy()->getMoney($player, function(float|int $money) use($player, $wood_sword): void{
                    if(!$player->getInventory()->canAddItem(VanillaItems::WOODEN_SWORD())){
                        $player->removeCurrentWindow();
                        $player->sendMessage(Loader::Prefix(). Loader::getMessage($player, "Messages.inventory-full"));
                        PluginUtils::PlaySound($player, "mob.endermen.portal", 1, 1);
                        return;
                    }

                    if($money >= $wood_sword){
                        Loader::getEconomy()->takeMoney($player, $wood_sword);
                        $player->sendMessage(Loader::Prefix(). str_replace(["{PRICE}"], [$wood_sword], Loader::getMessage($player, "Messages.successful-purchase")));
                        $player->getInventory()->addItem(VanillaItems::WOODEN_SWORD()->setCount(1));
                        PluginUtils::PlaySound($player, "random.levelup", 1, 1.5);
                    }else{
                        $player->removeCurrentWindow();
                        $player->sendMessage(Loader::Prefix(). Loader::getMessage($player, "Messages.no-money"));
                        PluginUtils::PlaySound($player, "mob.villager.no", 1, 1);
                    }
                }));
            break;

            case 11: // PIACKAXE
                if(Loader::getEconomy()->getMoney($player, function(float|int $money) use($player, $wood_pickaxe): void{
                    if(!$player->getInventory()->canAddItem(VanillaItems::WOODEN_PICKAXE())){
                        $player->removeCurrentWindow();
                        $player->sendMessage(Loader::Prefix(). Loader::getMessage($player, "Messages.inventory-full"));
                        PluginUtils::PlaySound($player, "mob.endermen.portal", 1, 1);
                        return;
                    }

                    if($money >= $wood_pickaxe){
                        Loader::getEconomy()->takeMoney($player, $wood_pickaxe);
                        $player->sendMessage(Loader::Prefix(). str_replace(["{PRICE}"], [$wood_pickaxe], Loader::getMessage($player, "Messages.successful-purchase")));
                        $player->getInventory()->addItem(VanillaItems::WOODEN_PICKAXE()->setCount(1));
                        PluginUtils::PlaySound($player, "random.levelup", 1, 1.5);
                    }else{
                        $player->removeCurrentWindow();
                        $player->sendMessage(Loader::Prefix(). Loader::getMessage($player, "Messages.no-money"));
                        PluginUtils::PlaySound($player, "mob.villager.no", 1, 1);
                    }
                }));
            break;

            case 12: // AXE
                if(Loader::getEconomy()->getMoney($player, function(float|int $money) use($player, $wood_axe): void{
                    if(!$player->getInventory()->canAddItem(VanillaItems::WOODEN_AXE())){
                        $player->removeCurrentWindow();
                        $player->sendMessage(Loader::Prefix(). Loader::getMessage($player, "Messages.inventory-full"));
                        PluginUtils::PlaySound($player, "mob.endermen.portal", 1, 1);
                        return;
                    }

                    if($money >= $wood_axe){
                        Loader::getEconomy()->takeMoney($player, $wood_axe);
                        $player->sendMessage(Loader::Prefix(). str_replace(["{PRICE}"], [$wood_axe], Loader::getMessage($player, "Messages.successful-purchase")));
                        $player->getInventory()->addItem(VanillaItems::WOODEN_AXE()->setCount(1));
                        PluginUtils::PlaySound($player, "random.levelup", 1, 1.5);
                    }else{
                        $player->removeCurrentWindow();
                        $player->sendMessage(Loader::Prefix(). Loader::getMessage($player, "Messages.no-money"));
                        PluginUtils::PlaySound($player, "mob.villager.no", 1, 1);
                    }
                }));
            break;

            # ===========(STONE)============
            case 14: // SWORD
                if(Loader::getEconomy()->getMoney($player, function(float|int $money) use($player, $stone_sword): void{
                    if(!$player->getInventory()->canAddItem(VanillaItems::STONE_SWORD())){
                        $player->removeCurrentWindow();
                        $player->sendMessage(Loader::Prefix(). Loader::getMessage($player, "Messages.inventory-full"));
                        PluginUtils::PlaySound($player, "mob.endermen.portal", 1, 1);
                        return;
                    }

                    if($money >= $stone_sword){
                        Loader::getEconomy()->takeMoney($player, $stone_sword);
                        $player->sendMessage(Loader::Prefix(). str_replace(["{PRICE}"], [$stone_sword], Loader::getMessage($player, "Messages.successful-purchase")));
                        $player->getInventory()->addItem(VanillaItems::STONE_SWORD()->setCount(1));
                        PluginUtils::PlaySound($player, "random.levelup", 1, 1.5);
                    }else{
                        $player->removeCurrentWindow();
                        $player->sendMessage(Loader::Prefix(). Loader::getMessage($player, "Messages.no-money"));
                        PluginUtils::PlaySound($player, "mob.villager.no", 1, 1);
                    }
                }));
            break;

            case 15: // PICKAXE
                if(Loader::getEconomy()->getMoney($player, function(float|int $money) use($player, $stone_pickaxe): void{
                    if(!$player->getInventory()->canAddItem(VanillaItems::STONE_PICKAXE())){
                        $player->removeCurrentWindow();
                        $player->sendMessage(Loader::Prefix(). Loader::getMessage($player, "Messages.inventory-full"));
                        PluginUtils::PlaySound($player, "mob.endermen.portal", 1, 1);
                        return;
                    }

                    if($money >= $stone_pickaxe){
                        Loader::getEconomy()->takeMoney($player, $stone_pickaxe);
                        $player->sendMessage(Loader::Prefix(). str_replace(["{PRICE}"], [$stone_pickaxe], Loader::getMessage($player, "Messages.successful-purchase")));
                        $player->getInventory()->addItem(VanillaItems::STONE_PICKAXE()->setCount(1));
                        PluginUtils::PlaySound($player, "random.levelup", 1, 1.5);
                    }else{
                        $player->removeCurrentWindow();
                        $player->sendMessage(Loader::Prefix(). Loader::getMessage($player, "Messages.no-money"));
                        PluginUtils::PlaySound($player, "mob.villager.no", 1, 1);
                    }
                }));
            break;

            case 16: // AXE
                if(Loader::getEconomy()->getMoney($player, function(float|int $money) use($player, $stone_axe): void{
                    if(!$player->getInventory()->canAddItem(VanillaItems::STONE_AXE())){
                        $player->removeCurrentWindow();
                        $player->sendMessage(Loader::Prefix(). Loader::getMessage($player, "Messages.inventory-full"));
                        PluginUtils::PlaySound($player, "mob.endermen.portal", 1, 1);
                        return;
                    }

                    if($money >= $stone_axe){
                        Loader::getEconomy()->takeMoney($player, $stone_axe);
                        $player->sendMessage(Loader::Prefix(). str_replace(["{PRICE}"], [$stone_axe], Loader::getMessage($player, "Messages.successful-purchase")));
                        $player->getInventory()->addItem(VanillaItems::STONE_AXE()->setCount(1));
                        PluginUtils::PlaySound($player, "random.levelup", 1, 1.5);
                    }else{
                        $player->removeCurrentWindow();
                        $player->sendMessage(Loader::Prefix(). Loader::getMessage($player, "Messages.no-money"));
                        PluginUtils::PlaySound($player, "mob.villager.no", 1, 1);
                    }
                }));
            break;

            # ========(GOLD=============
            case 28: // SWORD
                if(Loader::getEconomy()->getMoney($player, function(float|int $money) use($player, $golden_sword): void{
                    if(!$player->getInventory()->canAddItem(VanillaItems::GOLDEN_SWORD())){
                        $player->removeCurrentWindow();
                        $player->sendMessage(Loader::Prefix(). Loader::getMessage($player, "Messages.inventory-full"));
                        PluginUtils::PlaySound($player, "mob.endermen.portal", 1, 1);
                        return;
                    }

                    if($money >= $golden_sword){
                        Loader::getEconomy()->takeMoney($player, $golden_sword);
                        $player->sendMessage(Loader::Prefix(). str_replace(["{PRICE}"], [$golden_sword], Loader::getMessage($player, "Messages.successful-purchase")));
                        $player->getInventory()->addItem(VanillaItems::GOLDEN_SWORD()->setCount(1));
                        PluginUtils::PlaySound($player, "random.levelup", 1, 1.5);
                    }else{
                        $player->removeCurrentWindow();
                        $player->sendMessage(Loader::Prefix(). Loader::getMessage($player, "Messages.no-money"));
                        PluginUtils::PlaySound($player, "mob.villager.no", 1, 1);
                    }
                }));
            break;

            case 29: // PICKAXE
                if(Loader::getEconomy()->getMoney($player, function(float|int $money) use($player, $golden_pickaxe): void{
                    if(!$player->getInventory()->canAddItem(VanillaItems::GOLDEN_PICKAXE())){
                        $player->removeCurrentWindow();
                        $player->sendMessage(Loader::Prefix(). Loader::getMessage($player, "Messages.inventory-full"));
                        PluginUtils::PlaySound($player, "mob.endermen.portal", 1, 1);
                        return;
                    }

                    if($money >= $golden_pickaxe){
                        Loader::getEconomy()->takeMoney($player, $golden_pickaxe);
                        $player->sendMessage(Loader::Prefix(). str_replace(["{PRICE}"], [$golden_pickaxe], Loader::getMessage($player, "Messages.successful-purchase")));
                        $player->getInventory()->addItem(VanillaItems::GOLDEN_PICKAXE()->setCount(1));
                        PluginUtils::PlaySound($player, "random.levelup", 1, 1.5);
                    }else{
                        $player->removeCurrentWindow();
                        $player->sendMessage(Loader::Prefix(). Loader::getMessage($player, "Messages.no-money"));
                        PluginUtils::PlaySound($player, "mob.villager.no", 1, 1);
                        return;
                    }
                }));
            break;

            case 30: // AXE
                if(Loader::getEconomy()->getMoney($player, function(float|int $money) use($player, $golden_axe): void{
                    if(!$player->getInventory()->canAddItem(VanillaItems::GOLDEN_AXE())){
                        $player->removeCurrentWindow();
                        $player->sendMessage(Loader::Prefix(). Loader::getMessage($player, "Messages.inventory-full"));
                        PluginUtils::PlaySound($player, "mob.endermen.portal", 1, 1);
                        return;
                    }

                    if($money >= $golden_axe){
                        Loader::getEconomy()->takeMoney($player, $golden_axe);
                        $player->sendMessage(Loader::Prefix(). str_replace(["{PRICE}"], [$golden_axe], Loader::getMessage($player, "Messages.successful-purchase")));
                        $player->getInventory()->addItem(VanillaItems::GOLDEN_AXE()->setCount(1));
                        PluginUtils::PlaySound($player, "random.levelup", 1, 1.5);
                    }else{
                        $player->removeCurrentWindow();
                        $player->sendMessage(Loader::Prefix(). Loader::getMessage($player, "Messages.no-money"));
                        PluginUtils::PlaySound($player, "mob.villager.no", 1, 1);
                    }
                }));
            break;

            # ========(IRON)=========
            case 32: // SWORD
                if(Loader::getEconomy()->getMoney($player, function(float|int $money) use($player, $iron_sword): void{
                    if(!$player->getInventory()->canAddItem(VanillaItems::IRON_SWORD())){
                        $player->removeCurrentWindow();
                        $player->sendMessage(Loader::Prefix(). Loader::getMessage($player, "Messages.inventory-full"));
                        PluginUtils::PlaySound($player, "mob.endermen.portal", 1, 1);
                        return;
                    }

                    if($money >= $iron_sword){
                        Loader::getEconomy()->takeMoney($player, $iron_sword);
                        $player->sendMessage(Loader::Prefix(). str_replace(["{PRICE}"], [$iron_sword], Loader::getMessage($player, "Messages.successful-purchase")));
                        $player->getInventory()->addItem(VanillaItems::IRON_SWORD()->setCount(1));
                        PluginUtils::PlaySound($player, "random.levelup", 1, 1.5);
                    }else{
                        $player->removeCurrentWindow();
                        $player->sendMessage(Loader::Prefix(). Loader::getMessage($player, "Messages.no-money"));
                        PluginUtils::PlaySound($player, "mob.villager.no", 1, 1);
                    }
                }));
            break;

            case 33: // PICKAXE
                if(Loader::getEconomy()->getMoney($player, function(float|int $money) use($player, $iron_pickaxe): void{
                    if(!$player->getInventory()->canAddItem(VanillaItems::IRON_PICKAXE())){
                        $player->removeCurrentWindow();
                        $player->sendMessage(Loader::Prefix(). Loader::getMessage($player, "Messages.inventory-full"));
                        PluginUtils::PlaySound($player, "mob.endermen.portal", 1, 1);
                        return;
                    }

                    if($money >= $iron_pickaxe){
                        Loader::getEconomy()->takeMoney($player, $iron_pickaxe);
                        $player->sendMessage(Loader::Prefix(). str_replace(["{PRICE}"], [$iron_pickaxe], Loader::getMessage($player, "Messages.successful-purchase")));
                        $player->getInventory()->addItem(VanillaItems::IRON_PICKAXE()->setCount(1));
                        PluginUtils::PlaySound($player, "random.levelup", 1, 1.5);
                    }else{
                        $player->removeCurrentWindow();
                        $player->sendMessage(Loader::Prefix(). Loader::getMessage($player, "Messages.no-money"));
                        PluginUtils::PlaySound($player, "mob.villager.no", 1, 1);
                    }
                }));
            break;

            case 34: // AXE
                if(Loader::getEconomy()->getMoney($player, function(float|int $money) use($player, $iron_axe): void{
                    if(!$player->getInventory()->canAddItem(VanillaItems::IRON_AXE())){
                        $player->removeCurrentWindow();
                        $player->sendMessage(Loader::Prefix(). Loader::getMessage($player, "Messages.inventory-full"));
                        PluginUtils::PlaySound($player, "mob.endermen.portal", 1, 1);
                        return;
                    }

                    if($money >= $iron_axe){
                        Loader::getEconomy()->takeMoney($player, $iron_axe);
                        $player->sendMessage(Loader::Prefix(). str_replace(["{PRICE}"], [$iron_axe], Loader::getMessage($player, "Messages.successful-purchase")));
                        $player->getInventory()->addItem(VanillaItems::IRON_AXE()->setCount(1));
                        PluginUtils::PlaySound($player, "random.levelup", 1, 1.5);
                    }else{
                        $player->removeCurrentWindow();
                        $player->sendMessage(Loader::Prefix(). Loader::getMessage($player, "Messages.no-money"));
                        PluginUtils::PlaySound($player, "mob.villager.no", 1, 1); 
                    }
                }));
            break;

            # =========(DIAMOND)=========
            case 39: // SWORD
                if(Loader::getEconomy()->getMoney($player, function(float|int $money) use($player, $diamond_sword): void{
                    if(!$player->getInventory()->canAddItem(VanillaItems::DIAMOND_SWORD())){
                        $player->removeCurrentWindow();
                        $player->sendMessage(Loader::Prefix(). Loader::getMessage($player, "Messages.inventory-full"));
                        PluginUtils::PlaySound($player, "mob.endermen.portal", 1, 1);
                        return;
                    }
                    
                    if($money >= $diamond_sword){
                        Loader::getEconomy()->takeMoney($player, $diamond_sword);
                        $player->sendMessage(Loader::Prefix(). str_replace(["{PRICE}"], [$diamond_sword], Loader::getMessage($player, "Messages.successful-purchase")));
                        $player->getInventory()->addItem(VanillaItems::DIAMOND_SWORD()->setCount(1));
                        PluginUtils::PlaySound($player, "random.levelup", 1, 1.5);
                    }else{
                        $player->removeCurrentWindow();
                        $player->sendMessage(Loader::Prefix(). Loader::getMessage($player, "Messages.no-money"));
                        PluginUtils::PlaySound($player, "mob.villager.no", 1, 1);
                    }
                }));
            break;

            case 40: // PICKAXE
                if(Loader::getEconomy()->getMoney($player, function(float|int $money) use($player, $diamond_pickaxe): void{
                    if(!$player->getInventory()->canAddItem(VanillaItems::DIAMOND_PICKAXE())){
                        $player->removeCurrentWindow();
                        $player->sendMessage(Loader::Prefix(). Loader::getMessage($player, "Messages.inventory-full"));
                        PluginUtils::PlaySound($player, "mob.endermen.portal", 1, 1);
                        return;
                    }

                    if($money >= $diamond_pickaxe){
                        Loader::getEconomy()->takeMoney($player, $diamond_pickaxe);
                        $player->sendMessage(Loader::Prefix(). str_replace(["{PRICE}"], [$diamond_pickaxe], Loader::getMessage($player, "Messages.successful-purchase")));
                        $player->getInventory()->addItem(VanillaItems::DIAMOND_PICKAXE()->setCount(1));
                        PluginUtils::PlaySound($player, "random.levelup", 1, 1.5);
                    }else{
                        $player->removeCurrentWindow();
                        $player->sendMessage(Loader::Prefix(). Loader::getMessage($player, "Messages.no-money"));
                        PluginUtils::PlaySound($player, "mob.villager.no", 1, 1);
                    }
                }));
            break;

            case 41: // AXE
                if(Loader::getEconomy()->getMoney($player, function(float|int $money) use($player, $diamond_axe): void{
                    if(!$player->getInventory()->canAddItem(VanillaItems::DIAMOND_AXE())){
                        $player->removeCurrentWindow();
                        $player->sendMessage(Loader::Prefix(). Loader::getMessage($player, "Messages.inventory-full"));
                        PluginUtils::PlaySound($player, "mob.endermen.portal", 1, 1);
                        return;
                    }

                    if($money >= $diamond_axe){
                        Loader::getEconomy()->takeMoney($player, $diamond_axe);
                        $player->sendMessage(Loader::Prefix(). str_replace(["{PRICE}"], [$diamond_axe], Loader::getMessage($player, "Messages.successful-purchase")));
                        $player->getInventory()->addItem(VanillaItems::DIAMOND_AXE()->setCount(1));
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

            case 49: // CLOSE
                $player->removeCurrentWindow();
                PluginUtils::PlaySound($player, "random.click", 1, 1); 
            break;
        }

        return $transaction->discard();
    }
}
