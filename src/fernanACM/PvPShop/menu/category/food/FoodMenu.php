<?php

#      _       ____   __  __ 
#     / \     / ___| |  \/  |
#    / _ \   | |     | |\/| |
#   / ___ \  | |___  | |  | |
#  /_/   \_\  \____| |_|  |_|
# The creator of this plugin was fernanACM.
# https://github.com/fernanACM

namespace fernanACM\PvPShop\menu\category\food;

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

class FoodMenu{

    /**
     * @param Player $player
     * @return void
     */
    public function getFoodMenuGUI(Player $player): void{
        $menu = InvMenu::create(InvMenuTypeIds::TYPE_CHEST);
        $inv = $menu->getInventory();
        $menu->setListener(Closure::fromCallable([$this, "getActionFoodMenu"]));
        $menu->setName(Loader::getMessage($player, "FoodShop-name"));
        $config = Loader::getInstance()->config;

        // PRICES
        $chicken = $config->getNested("Price.Food.chicken");
        $mutton = $config->getNested("Price.Food.mutton");
        $porkchop = $config->getNested("Price.Food.porkchop");
        $rabbit = $config->getNested("Price.Food.rabbit");
        $salmon = $config->getNested("Price.Food.salmon");
        $golden_apple = $config->getNested("Price.Food.golden_apple");
        $enchanted_golden_apple = $config->getNested("Price.Food.enchanted_golden_apple");

         // COUNT
         $chicken_count = $config->getNested("Price.Food.chicken-count");
         $mutton_count = $config->getNested("Price.Food.mutton-count");
         $porkchop_count = $config->getNested("Price.Food.porkchop-count");
         $rabbit_count = $config->getNested("Price.Food.rabbit-count");
         $salmon_count = $config->getNested("Price.Food.salmon-count");
         $golden_apple_count = $config->getNested("Price.Food.golden_apple-count");
         $enchanted_golden_apple_count = $config->getNested("Price.Food.enchanted_golden_apple-count");

        for($i = 0; $i < 27; $i++){
            if(!in_array($i, [10, 11, 12, 13, 14, 15, 16, 20, 22])){
                $inv->setItem($i, VanillaBlocks::IRON_BARS()->asItem()->setCustomName("§r"));
            }
        }

        // CONTENT
        $inv->setItem(10, VanillaItems::COOKED_CHICKEN()->setCustomName(str_replace(["{PRICE}", "{COUNT}"], [$chicken, $chicken_count], Loader::getMessage($player, "FoodShop-info.chicken"))));
        $inv->setItem(11, VanillaItems::COOKED_MUTTON()->setCustomName(str_replace(["{PRICE}", "{COUNT}"], [$mutton, $mutton_count], Loader::getMessage($player, "FoodShop-info.mutton"))));
        $inv->setItem(12, VanillaItems::COOKED_PORKCHOP()->setCustomName(str_replace(["{PRICE}", "{COUNT}"], [$porkchop, $porkchop_count], Loader::getMessage($player, "FoodShop-info.porkchop"))));
        $inv->setItem(13, VanillaItems::COOKED_RABBIT()->setCustomName(str_replace(["{PRICE}", "{COUNT}"], [$rabbit, $rabbit_count], Loader::getMessage($player, "FoodShop-info.rabbit"))));
        $inv->setItem(14, VanillaItems::COOKED_SALMON()->setCustomName(str_replace(["{PRICE}", "{COUNT}"], [$salmon, $salmon_count], Loader::getMessage($player, "FoodShop-info.salmon"))));
        $inv->setItem(15, VanillaItems::GOLDEN_APPLE()->setCustomName(str_replace(["{PRICE}", "{COUNT}"], [$golden_apple, $golden_apple_count], Loader::getMessage($player, "FoodShop-info.golden_apple"))));
        $inv->setItem(16, VanillaItems::ENCHANTED_GOLDEN_APPLE()->setCustomName(str_replace(["{PRICE}", "{COUNT}"], [$enchanted_golden_apple, $enchanted_golden_apple_count], Loader::getMessage($player, "FoodShop-info.enchanted_golden_apple"))));

        // CLOSE & RETURN
        $inv->setItem(20, VanillaItems::ARROW()->setCustomName(Loader::getMessage($player, "Menu-category.return")));
        $inv->setItem(22, VanillaBlocks::BARRIER()->asItem()->setCustomName(Loader::getMessage($player, "Menu-category.close")));
        $menu->send($player);
    }

    /**
     * @param InvMenuTransaction $transaction
     * @return InvMenuTransactionResult
     */
    public function getActionFoodMenu(InvMenuTransaction $transaction): InvMenuTransactionResult{
        $player = $transaction->getPlayer();
        $action = $transaction->getAction();
        $config = Loader::getInstance()->config;

        // PRICES
        $chicken = $config->getNested("Price.Food.chicken");
        $mutton = $config->getNested("Price.Food.mutton");
        $porkchop = $config->getNested("Price.Food.porkchop");
        $rabbit = $config->getNested("Price.Food.rabbit");
        $salmon = $config->getNested("Price.Food.salmon");
        $golden_apple = $config->getNested("Price.Food.golden_apple");
        $enchanted_golden_apple = $config->getNested("Price.Food.enchanted_golden_apple");

        // COUNT
        $chicken_count = $config->getNested("Price.Food.chicken-count");
        $mutton_count = $config->getNested("Price.Food.mutton-count");
        $porkchop_count = $config->getNested("Price.Food.porkchop-count");
        $rabbit_count = $config->getNested("Price.Food.rabbit-count");
        $salmon_count = $config->getNested("Price.Food.salmon-count");
        $golden_apple_count = $config->getNested("Price.Food.golden_apple-count");
        $enchanted_golden_apple_count = $config->getNested("Price.Food.enchanted_golden_apple-count");


        switch($action->getSlot()){
            case 10: // CHICKEN
                Loader::getEconomy()->getMoney($player, function(float|int $money) use($player, $chicken, $chicken_count): void{
                    if(!$player->getInventory()->canAddItem(VanillaItems::COOKED_CHICKEN())){
                        $player->removeCurrentWindow();
                        $player->sendMessage(Loader::Prefix(). Loader::getMessage($player, "Messages.inventory-full"));
                        PluginUtils::PlaySound($player, "mob.endermen.portal", 1, 1);
                        return;
                    }

                    if($money >= $chicken){
                        Loader::getEconomy()->takeMoney($player, $chicken);
                        $player->sendMessage(Loader::Prefix(). str_replace(["{PRICE}"], [$chicken], Loader::getMessage($player, "Messages.successful-purchase")));
                        $player->getInventory()->addItem(VanillaItems::COOKED_CHICKEN()->setCount($chicken_count));
                        PluginUtils::PlaySound($player, "random.levelup", 1, 1.5);
                    }else{
                        $player->removeCurrentWindow();
                        $player->sendMessage(Loader::Prefix(). Loader::getMessage($player, "Messages.no-money"));
                        PluginUtils::PlaySound($player, "mob.villager.no", 1, 1); 
                    }
                });
            break;
            
            case 11: // MUTTON
                if(Loader::getEconomy()->getMoney($player, function(float|int $money) use($player, $mutton, $mutton_count): void{
                    if(!$player->getInventory()->canAddItem(VanillaItems::COOKED_MUTTON())){
                        $player->removeCurrentWindow();
                        $player->sendMessage(Loader::Prefix(). Loader::getMessage($player, "Messages.inventory-full"));
                        PluginUtils::PlaySound($player, "mob.endermen.portal", 1, 1);
                        return;
                    }

                    if($money >= $mutton){
                        Loader::getEconomy()->takeMoney($player, $mutton);
                        $player->sendMessage(Loader::Prefix(). str_replace(["{PRICE}"], [$mutton], Loader::getMessage($player, "Messages.successful-purchase")));
                        $player->getInventory()->addItem(VanillaItems::COOKED_MUTTON()->setCount($mutton_count));
                        PluginUtils::PlaySound($player, "random.levelup", 1, 1.5);
                    }else{
                        $player->removeCurrentWindow();
                        $player->sendMessage(Loader::Prefix(). Loader::getMessage($player, "Messages.no-money"));
                        PluginUtils::PlaySound($player, "mob.villager.no", 1, 1);
                    }
                }));
            break;

            case 12: // PORKCHOP
                if(Loader::getEconomy()->getMoney($player, function(float|int $money) use($player, $porkchop, $porkchop_count): void{
                    if(!$player->getInventory()->canAddItem(VanillaItems::COOKED_PORKCHOP())){
                        $player->removeCurrentWindow();
                        $player->sendMessage(Loader::Prefix(). Loader::getMessage($player, "Messages.inventory-full"));
                        PluginUtils::PlaySound($player, "mob.endermen.portal", 1, 1);
                        return;
                    }

                    if($money >= $porkchop){
                        Loader::getEconomy()->takeMoney($player, $porkchop);
                        $player->sendMessage(Loader::Prefix(). str_replace(["{PRICE}"], [$porkchop], Loader::getMessage($player, "Messages.successful-purchase")));
                        $player->getInventory()->addItem(VanillaItems::COOKED_PORKCHOP()->setCount($porkchop_count));
                        PluginUtils::PlaySound($player, "random.levelup", 1, 1.5);
                    }else{
                        $player->removeCurrentWindow();
                        $player->sendMessage(Loader::Prefix(). Loader::getMessage($player, "Messages.no-money"));
                        PluginUtils::PlaySound($player, "mob.villager.no", 1, 1);
                    }
                }));
            break;

            case 13: // RABBIT
                if(Loader::getEconomy()->getMoney($player, function(float|int $money) use($player, $rabbit, $rabbit_count): void{
                    if(!$player->getInventory()->canAddItem(VanillaItems::COOKED_RABBIT())){
                        $player->removeCurrentWindow();
                        $player->sendMessage(Loader::Prefix(). Loader::getMessage($player, "Messages.inventory-full"));
                        PluginUtils::PlaySound($player, "mob.endermen.portal", 1, 1);
                        return;
                    }

                    if($money >= $rabbit){
                        Loader::getEconomy()->takeMoney($player, $rabbit);
                        $player->sendMessage(Loader::Prefix(). str_replace(["{PRICE}"], [$rabbit], Loader::getMessage($player, "Messages.successful-purchase")));
                        $player->getInventory()->addItem(VanillaItems::COOKED_RABBIT()->setCount($rabbit_count));
                        PluginUtils::PlaySound($player, "random.levelup", 1, 1.5);
                    }else{
                        $player->removeCurrentWindow();
                        $player->sendMessage(Loader::Prefix(). Loader::getMessage($player, "Messages.no-money"));
                        PluginUtils::PlaySound($player, "mob.villager.no", 1, 1);
                    }
                }));
            break;

            case 14: // SALMON
                if(Loader::getEconomy()->getMoney($player, function(float|int $money) use($player, $salmon, $salmon_count): void{
                    if(!$player->getInventory()->canAddItem(VanillaItems::COOKED_SALMON())){
                        $player->removeCurrentWindow();
                        $player->sendMessage(Loader::Prefix(). Loader::getMessage($player, "Messages.inventory-full"));
                        PluginUtils::PlaySound($player, "mob.endermen.portal", 1, 1);
                        return;
                    }

                    if($money >= $salmon){
                        Loader::getEconomy()->takeMoney($player, $salmon);
                        $player->sendMessage(Loader::Prefix(). str_replace(["{PRICE}"], [$salmon], Loader::getMessage($player, "Messages.successful-purchase")));
                        $player->getInventory()->addItem(VanillaItems::COOKED_SALMON()->setCount($salmon_count));
                        PluginUtils::PlaySound($player, "random.levelup", 1, 1.5);
                    }else{
                        $player->removeCurrentWindow();
                        $player->sendMessage(Loader::Prefix(). Loader::getMessage($player, "Messages.no-money"));
                        PluginUtils::PlaySound($player, "mob.villager.no", 1, 1);
                    }
                }));
            break;

            case 15: // GOLDEN APPLE
                if(Loader::getEconomy()->getMoney($player, function(float|int $money) use($player, $golden_apple, $golden_apple_count): void{
                    if(!$player->getInventory()->canAddItem(VanillaItems::GOLDEN_APPLE())){
                        $player->removeCurrentWindow();
                        $player->sendMessage(Loader::Prefix(). Loader::getMessage($player, "Messages.inventory-full"));
                        PluginUtils::PlaySound($player, "mob.endermen.portal", 1, 1);
                        return;
                    }

                    if($money >= $golden_apple){
                        Loader::getEconomy()->takeMoney($player, $golden_apple);
                        $player->sendMessage(Loader::Prefix(). str_replace(["{PRICE}"], [$golden_apple], Loader::getMessage($player, "Messages.successful-purchase")));
                        $player->getInventory()->addItem(VanillaItems::GOLDEN_APPLE()->setCount($golden_apple_count));
                        PluginUtils::PlaySound($player, "random.levelup", 1, 1.5);
                    }else{
                        $player->removeCurrentWindow();
                        $player->sendMessage(Loader::Prefix(). Loader::getMessage($player, "Messages.no-money"));
                        PluginUtils::PlaySound($player, "mob.villager.no", 1, 1);
                    }
                }));
            break;

            case 16: // ENCHANTED GOLDEN APPLE
                if(Loader::getEconomy()->getMoney($player, function(float|int $money) use($player, $enchanted_golden_apple, $enchanted_golden_apple_count): void{
                    if(!$player->getInventory()->canAddItem(VanillaItems::ENCHANTED_GOLDEN_APPLE())){
                        $player->removeCurrentWindow();
                        $player->sendMessage(Loader::Prefix(). Loader::getMessage($player, "Messages.inventory-full"));
                        PluginUtils::PlaySound($player, "mob.endermen.portal", 1, 1);
                        return;
                    }

                    if($money >= $enchanted_golden_apple){
                        Loader::getEconomy()->takeMoney($player, $enchanted_golden_apple);
                        $player->sendMessage(Loader::Prefix(). str_replace(["{PRICE}"], [$enchanted_golden_apple], Loader::getMessage($player, "Messages.successful-purchase")));
                        $player->getInventory()->addItem(VanillaItems::ENCHANTED_GOLDEN_APPLE()->setCount($enchanted_golden_apple_count));
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