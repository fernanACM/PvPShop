<?php

#      _       ____   __  __ 
#     / \     / ___| |  \/  |
#    / _ \   | |     | |\/| |
#   / ___ \  | |___  | |  | |
#  /_/   \_\  \____| |_|  |_|
# The creator of this plugin was fernanACM.
# https://github.com/fernanACM

namespace fernanACM\PvPShop;

use pocketmine\player\Player;

use pocketmine\event\Listener;

use pocketmine\entity\effect\EffectInstance;
use pocketmine\entity\effect\VanillaEffects;

use pocketmine\event\block\BlockBreakEvent;

use pocketmine\event\entity\EntityDamageByEntityEvent;
use pocketmine\event\entity\EntityDamageEvent;

use pocketmine\event\player\PlayerItemConsumeEvent;
use pocketmine\event\player\PlayerItemUseEvent;
use pocketmine\event\player\PlayerJumpEvent;
use pocketmine\event\player\PlayerMoveEvent;

use fernanACM\PvPShop\Loader;
use fernanACM\PvPShop\utils\CooldownUtils;

class Event implements Listener{

    /**
     * @param BlockBreakEvent $event
     * @return void
     */
    public function onBreak(BlockBreakEvent $event): void{
        $player = $event->getPlayer();
        $chestplate = $player->getArmorInventory()->getChestplate();
        if($chestplate->getNamedTag()->getTag("PvPShop") !== null){
            $tag = $chestplate->getNamedTag()->getString("PvPShop");
            switch($tag){
                case "Chestplate":
                    $player->getEffects()->add(new EffectInstance(VanillaEffects::HASTE(), 5 * 20, 2, false, false, null));
                break;
            }
        }
    }

    /**
     * @param PlayerMoveEvent $event
     * @return void
     */
    public function onMove(PlayerMoveEvent $event): void{
        $player = $event->getPlayer();
        // HELMET
        $helmet = $player->getArmorInventory()->getHelmet();
        if($helmet->getNamedTag()->getTag("PvPShop") !== null){
            $tag = $helmet->getNamedTag()->getString("PvPShop");
            switch($tag){
                case "Helmet":
                    $player->getEffects()->add(new EffectInstance(VanillaEffects::NIGHT_VISION(), 10 * 20, 1, false, false, null));
                break;
            }
        }

        // LEGGINGS
        $leggings = $player->getArmorInventory()->getLeggings();
        if($leggings->getNamedTag()->getTag("PvPShop") !== null){
            $tag = $leggings->getNamedTag()->getString("PvPShop");
            switch($tag){
                case "Leggings":
                    $player->getEffects()->add(new EffectInstance(VanillaEffects::FIRE_RESISTANCE(), 5 * 20, 1, false, false, null));
                break;
            }
        }

        // BOOTS
        $boots = $player->getArmorInventory()->getBoots();
        if($boots->getNamedTag()->getTag("PvPShop") !== null){
            $tag = $boots->getNamedTag()->getString("PvPShop");
            switch($tag){
                case "Boots":
                    $player->getEffects()->add(new EffectInstance(VanillaEffects::SPEED(), 5 * 20, 1, false, false, null));
                break;
            }
        }
    }

    /**
     * @param PlayerJumpEvent $event
     * @return void
     */
    public function onJump(PlayerJumpEvent $event): void{
        $player = $event->getPlayer();
        $leggings = $player->getArmorInventory()->getLeggings();
        if($leggings->getNamedTag()->getTag("PvPShop") !== null){
            $tag = $leggings->getNamedTag()->getString("PvPShop");
            switch($tag){
                case "Leggings":
                    $player->getEffects()->add(new EffectInstance(VanillaEffects::JUMP_BOOST(), 5 * 20, 2, false, false, null));
                break;
            }
        }
    }

    /**
     * @param EntityDamageByEntityEvent $event
     * @return void
     */
    public function onEntityByDamage(EntityDamageByEntityEvent $event): void{
        $player = $event->getEntity();
        $damager = $event->getDamager();
        
        if(!$damager instanceof Player){
            return;
        }

        if($player instanceof Player){
            $chestplate = $player->getArmorInventory()->getChestplate();
            if($chestplate->getNamedTag()->getTag("PvPShop") !== null){
                $tag = $chestplate->getNamedTag()->getString("PvPShop");
                switch($tag){
                    case "Chestplate":
                        $damager->getEffects()->add(new EffectInstance(VanillaEffects::NAUSEA(), 3 * 20, 1, false, false, null));
                        $damager->getEffects()->add(new EffectInstance(VanillaEffects::WITHER(), 5 * 20, 1, false, false, null));
                    break;
                }
            }

            $leggings = $player->getArmorInventory()->getLeggings();
            if($leggings->getNamedTag()->getTag("PvPShop") !== null){
                $tag = $leggings->getNamedTag()->getString("PvPShop");
                switch($tag){
                    case "Leggings":
                        $damager->getEffects()->add(new EffectInstance(VanillaEffects::REGENERATION(), 8 * 20, 1, false, false, null));
                    break;
                }
            }

            $boots = $player->getArmorInventory()->getBoots();
            if($boots->getNamedTag()->getTag("PvPShop") !== null){
                $tag = $boots->getNamedTag()->getString("PvPShop");
                switch($tag){
                    case "Boots":
                        $damager->getEffects()->add(new EffectInstance(VanillaEffects::BLINDNESS(), 10 * 20, 1, false, false, null));
                    break;
                }
            }

            $soup_cooldown_potion = Loader::getInstance()->config->getNested("Cooldown.Potions.soup");
            $soup_cooldown = Loader::getInstance()->config->getNested("Cooldown.Items.soup");

            $item = $damager->getInventory()->getItemInHand();
            if($item->getNamedTag()->getTag("PvPShop") !== null){
                $tag = $item->getNamedTag()->getString("PvPShop");
                switch($tag){
                    case "Soup":
                        if(!CooldownUtils::inCooldown("Soup", $damager->getName())){
                            $player->getEffects()->add(new EffectInstance(VanillaEffects::WITHER(), $soup_cooldown_potion * 20, 1, false, false, null));
                            $player->getEffects()->add(new EffectInstance(VanillaEffects::BLINDNESS(), 10 * 20, 1, false, false, null));
                            $player->getEffects()->add(new EffectInstance(VanillaEffects::JUMP_BOOST(), 3 * 20, 1, false, false, null));

                            $item->pop();
                            $damager->getInventory()->setItemInHand($item);
                            CooldownUtils::setCooldown("Soup", $damager->getName(), $soup_cooldown);
                        }else{
                            $cooldown = CooldownUtils::getCooldown("Soup", $damager->getName());
                            $damager->sendMessage(Loader::Prefix(). str_replace(["{TIME}"], [$cooldown], Loader::getMessage($damager, "Messages.in-cooldown")));
                        }
                    break;
                }
            }
        }
    }

    /**
     * @param EntityDamageEvent $event
     * @return void
     */
    public function onDamage(EntityDamageEvent $event): void{
        $player = $event->getEntity();

        if(!$player instanceof Player){
            return;
        }

        $boots = $player->getArmorInventory()->getBoots();
        if($boots->getNamedTag()->getTag("PvPShop") !== null){
            $tag = $boots->getNamedTag()->getString("PvPShop");
            switch($tag){
                case "Boots":
                    if($event->getCause() === EntityDamageEvent::CAUSE_FALL){
                        $event->cancel();
                    }
                break;
            }
        }
    }

    /**
     * @param PlayerItemUseEvent $event
     * @return void
     */
    public function onUse(PlayerItemUseEvent $event): void{
        $player = $event->getPlayer();

        $item = $player->getInventory()->getItemInHand();

        $speed = Loader::getInstance()->config->getNested("Cooldown.Items.speed");
        $speed_potion = Loader::getInstance()->config->getNested("Cooldown.Potions.speed");

        $health = Loader::getInstance()->config->getNested("Cooldown.Items.speed");
        $health_potion = Loader::getInstance()->config->getNested("Cooldown.Potions.speed");

        if($item->getNamedTag()->getTag("PvPShop") !== null){
            $tag = $item->getNamedTag()->getString("PvPShop");
            switch($tag){
                case "Speed":
                    if(!CooldownUtils::inCooldown("Speed", $player->getName())){
                        $player->getEffects()->add(new EffectInstance(VanillaEffects::SPEED(), $speed_potion * 20, 2, false, false, null));
                        $player->getEffects()->add(new EffectInstance(VanillaEffects::HASTE(), 5 * 20, 1, false, false, null));
                        $player->getEffects()->add(new EffectInstance(VanillaEffects::REGENERATION(), 3 * 20, 1, false, false, null));

                        $item->pop();
                        $player->getInventory()->setItemInHand($item);
                        CooldownUtils::setCooldown("Speed", $player->getName(), $speed);
                    }else{
                        $cooldown = CooldownUtils::getCooldown("Speed", $player->getName());
                        $player->sendMessage(Loader::Prefix(). str_replace(["{TIME}"], [$cooldown], Loader::getMessage($player, "Messages.in-cooldown")));
                    }
                break;

                case "Health":
                    if(!CooldownUtils::inCooldown("Health", $player->getName())){
                        $player->getEffects()->add(new EffectInstance(VanillaEffects::REGENERATION(), $health_potion * 20, 2, false, false, null));
                        $player->getEffects()->add(new EffectInstance(VanillaEffects::RESISTANCE(), 8 * 20, 1, false, false, null));
                        $player->getEffects()->add(new EffectInstance(VanillaEffects::SLOWNESS(), 10 * 20, 1, false, false, null));

                        $item->pop();
                        $player->getInventory()->setItemInHand($item);
                        CooldownUtils::setCooldown("Health", $player->getName(), $health);
                    }else{
                        $cooldown = CooldownUtils::getCooldown("Health", $player->getName());
                        $player->sendMessage(Loader::Prefix(). str_replace(["{TIME}"], [$cooldown], Loader::getMessage($player, "Messages.in-cooldown")));
                    }
                break;
            }
        }
    }

    /**
     * @param PlayerItemConsumeEvent $even
     * @return void
     */
    public function onConsume(PlayerItemConsumeEvent $event): void{
        $player = $event->getPlayer();
        $soup = $player->getInventory()->getItemInHand();
        if($soup->getNamedTag()->getTag("PvPShop") !== null){
            $tag = $soup->getNamedTag()->getString("PvPShop");
            switch($tag){
                case "Soup":
                    $event->cancel();
                break;

                case "Health":
                    $event->cancel();
                break;
            }
        }
    }
}