<?php

#      _       ____   __  __ 
#     / \     / ___| |  \/  |
#    / _ \   | |     | |\/| |
#   / ___ \  | |___  | |  | |
#  /_/   \_\  \____| |_|  |_|
# The creator of this plugin was fernanACM.
# https://github.com/fernanACM

namespace fernanACM\PvPShop\utils;

use fernanACM\PvPShop\Loader;
use pocketmine\item\enchantment\EnchantmentInstance;
use pocketmine\item\enchantment\VanillaEnchantments;

use pocketmine\item\Item;
use pocketmine\item\VanillaItems;

use pocketmine\nbt\tag\CompoundTag;

use pocketmine\color\Color;

class ItemUtils{

    /**
     * a@return Item
     */
    public static function getItemSpeed(): Item{
        $speed = VanillaItems::SUGAR();
        $speed->setNamedTag(CompoundTag::create()->setString("PvPShop", "Speed"));
        $speed->addEnchantment(new EnchantmentInstance(VanillaEnchantments::UNBREAKING()));
        return $speed;
    }

    /**
     * a@return Item
     */
    public static function getItemHealth(): Item{
        $health = VanillaItems::APPLE();
        $health->setNamedTag(CompoundTag::create()->setString("PvPShop", "Health"));
        $health->addEnchantment(new EnchantmentInstance(VanillaEnchantments::UNBREAKING()));
        return $health;
    }

    /**
     * a@return Item
     */
    public static function getItemSoup(): item{
        $soup = VanillaItems::BEETROOT_SOUP();
        $soup->setNamedTag(CompoundTag::create()->setString("PvPShop", "Soup"));
        $soup->addEnchantment(new EnchantmentInstance(VanillaEnchantments::UNBREAKING()));
        return $soup;
    }

    # ======(MAGIC ARMOR)======
    
    /**
     * a@return Item
     */
    public static function getHeltmetX(): Item{
        $helmet = VanillaItems::LEATHER_CAP()->setCustomColor(new Color(210, 61, 61));
        $helmet->setNamedTag(CompoundTag::create()->setString("PvPShop", "Helmet"));
        $helmet->addEnchantment(new EnchantmentInstance(VanillaEnchantments::UNBREAKING()));
        return $helmet;
    }

    /**
     * a@return Item
     */
    public static function getChestPlateX(): Item{
        $chestplate = VanillaItems::GOLDEN_CHESTPLATE();
        $chestplate->setNamedTag(CompoundTag::create()->setString("PvPShop", "Chestplate"));
        $chestplate->addEnchantment(new EnchantmentInstance(VanillaEnchantments::UNBREAKING()));
        return $chestplate;
    }

    /**
     * a@return Item
     */
    public static function getLeggingsX(): Item{
        $leggings = VanillaItems::LEATHER_PANTS()->setCustomColor(new Color(87, 212, 25));
        $leggings->setNamedTag(CompoundTag::create()->setString("PvPShop", "Leggings"));
        $leggings->addEnchantment(new EnchantmentInstance(VanillaEnchantments::UNBREAKING()));
        return $leggings;
    }

    /**
     * a@return Item
     */
    public static function getBootsX(): Item{
        $boots = VanillaItems::GOLDEN_BOOTS();
        $boots->setNamedTag(CompoundTag::create()->setString("PvPShop", "Boots"));
        $boots->addEnchantment(new EnchantmentInstance(VanillaEnchantments::UNBREAKING()));
        return $boots;
    }
}