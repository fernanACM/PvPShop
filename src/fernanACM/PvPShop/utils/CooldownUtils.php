<?php

#      _       ____   __  __ 
#     / \     / ___| |  \/  |
#    / _ \   | |     | |\/| |
#   / ___ \  | |___  | |  | |
#  /_/   \_\  \____| |_|  |_|
# The creator of this plugin was fernanACM.
# https://github.com/fernanACM

namespace fernanACM\PvPShop\utils;

class CooldownUtils{

    /** @var array $cooldown*/
    public static array $cooldown = [];

    /**
     * @param string $type
     * @param string $player
     * @return bool
     */
    public static function inCooldown(string $type, string $player): bool{
        if(isset(self::$cooldown[$type]) && isset(self::$cooldown[$type][$player])){
            return self::$cooldown[$type][$player] > time();
        }
        return false;
    }

    /**
     * @param string $type
     * @param string $player
     * @return int
     */
    public static function getCooldown(string $type, string $player): int{
        return self::$cooldown[$type][$player] - time();
    }

    /**
     * @param string $type
     * @param string $player
     * @param int $cooldown
     * @return void
     */
    public static function setCooldown(string $type, string $player, int $cooldown): void{
        self::$cooldown[$type][$player] = time() + $cooldown;
    }

    /**
     * @param string $type
     * @param string $player
     * @return void
     */
    public static function deleteCooldown(string $type, string $player): void{
        self::$cooldown[$type][$player] = 0;
    }
}