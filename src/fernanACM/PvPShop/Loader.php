<?php

#      _       ____   __  __ 
#     / \     / ___| |  \/  |
#    / _ \   | |     | |\/| |
#   / ___ \  | |___  | |  | |
#  /_/   \_\  \____| |_|  |_|
# The creator of this plugin was fernanACM.
# https://github.com/fernanACM

namespace fernanACM\PvPShop;

use pocketmine\Server;
use pocketmine\player\Player;

use pocketmine\plugin\PluginBase;

use pocketmine\utils\Config;

# Libs
use DaPigGuy\libPiggyEconomy\libPiggyEconomy;
use DaPigGuy\libPiggyEconomy\providers\EconomyProvider;
use DaPigGuy\libPiggyUpdateChecker\libPiggyUpdateChecker;

use muqsit\invmenu\InvMenuHandler;
# My files
use fernanACM\PvPShop\utils\PluginUtils;

use fernanACM\PvPShop\Event;

use fernanACM\PvPShop\menu\category\armor\ArmorMenu;
use fernanACM\PvPShop\menu\category\tools\ToolsMenu;
use fernanACM\PvPShop\menu\category\food\FoodMenu;
//use fernanACM\PvPShop\menu\category\potions\PotionsMenu;
use fernanACM\PvPShop\menu\category\extra\ExtraMenu;
use fernanACM\PvPShop\menu\MenuGUI;

use fernanACM\PvPShop\commands\ShopCommand;

class Loader extends PluginBase{

    /** @var Config $config */
    public Config $config;

    /** @var Config $messages */
    public Config $messages;

    #========(PVPSHOP MENU)========
    /** @var MenuGUI $menu */
    public static MenuGUI $menu;

    /** @var ArmorMenu $armormenu */
    public static ArmorMenu $armormenu;

    /** @var ToolsMenu $toolsmenu */
    public static ToolsMenu $toolsmenu;

    /** @var FoodMenu $foodmenu */
    public static FoodMenu $foodmenu;

    //** @var PotionsMenu $potionsmenu */
    //public static PotionsMenu $potionsmenu;

    /** @var ExtraMenu $extramenu */
    public static ExtraMenu $extramenu;

    /** @var Loader $instance */
    public static Loader $instance;

    /** @var EconomyProvider $economyProvider */
    public static EconomyProvider $economyProvider;

    # CheckConfig
    public const CONFIG_VERSION = "1.0.0";
    public const LANGUAGE_VERSION = "1.0.0";

     # MultiLanguages
    public const LANGUAGES = [
        "eng", // English
        "spa", // Spanish
        "ger", // German
        "frc", // French
        "portg", // Portuguese
        "indo", // Indonesian
        "vie" // Vietnamese
    ];

    public function onLoad(): void{
        self::$instance = $this;
        self::$menu = new MenuGUI($this);
        self::$armormenu = new ArmorMenu($this);
        self::$foodmenu = new FoodMenu($this);
        self::$extramenu = new ExtraMenu($this);
        self::$toolsmenu = new ToolsMenu($this);
    }

    public function onEnable(): void{
        $this->loadFiles();
        $this->loadCheck();
        $this->loadVirions();
        $this->loadCommands();
        $this->loadEvents();
    }

    public function loadFiles(){
        # Config files
        @mkdir($this->getDataFolder() . "languages");
        $this->saveResource("config.yml");
        $this->config = new Config($this->getDataFolder() . "config.yml");
        # Languages
        foreach(self::LANGUAGES as $language){
            $this->saveResource("languages/" . $language . ".yml");
        }
        $this->messages = new Config($this->getDataFolder() . "languages/" . $this->config->get("language") . ".yml");
    }

    public function loadCheck(){
        # Update
        libPiggyUpdateChecker::init($this);
        # CONFIG
        if((!$this->config->exists("config-version")) || ($this->config->get("config-version") != self::CONFIG_VERSION)){
            rename($this->getDataFolder() . "config.yml", $this->getDataFolder() . "config_old.yml");
            $this->saveResource("config.yml");
            $this->getLogger()->critical("Your configuration file is outdated.");
            $this->getLogger()->notice("Your old configuration has been saved as config_old.yml and a new configuration file has been generated. Please update accordingly.");
        }
        # LANGUAGES
        $data = new Config($this->getDataFolder() . "languages/" . $this->config->get("language") . ".yml");
        if((!$data->exists("language-version")) || ($data->get("language-version") != self::LANGUAGE_VERSION)){
            rename($this->getDataFolder() . "languages/" . $this->config->get("language") . ".yml", $this->getDataFolder() . "languages/" . $this->config->get("language") . "_old.yml");
            foreach(self::LANGUAGES as $language){
                $this->saveResource("languages/" . $language . ".yml");
            }
            $this->getLogger()->critical("Your ".$this->config->get("language").".yml file is outdated.");
            $this->getLogger()->notice("Your old ".$this->config->get("language").".yml has been saved as ".$this->config->get("language")."_old.yml and a new ".$this->config->get("language").".yml file has been generated. Please update accordingly.");
        }
    }

    public function loadVirions(){
        foreach ([
        	"InvMenu" => InvMenuHandler::class,
            "libPiggyEconomy" => libPiggyEconomy::class,
            "libPiggyUpdateChecker" => libPiggyUpdateChecker::class
            ] as $virion => $class
        ){
            if(!class_exists($class)){
                $this->getLogger()->error($virion . " virion not found. Please download PvPShop from Poggit-CI or use DEVirion (not recommended).");
                $this->getServer()->getPluginManager()->disablePlugin($this);
                return;
            }
        }
        # Economy
        libPiggyEconomy::init();
        self::$economyProvider = libPiggyEconomy::getProvider($this->config->get("Economy"));

        # InvMenu
        if(!InvMenuHandler::isRegistered()){
            InvMenuHandler::register($this);
        }

        if($this->getServer()->getPluginManager()->getPlugin("InvCrashFix") === null){
            $this->getLogger()->error("Missing InvCrashFix plugin. Menus may not work as intended. Download: https://poggit.pmmp.io/r/197673/InvCrashFix_dev-5.phar");
        }
    }

    public function loadEvents(){
        Server::getInstance()->getPluginManager()->registerEvents(new Event($this), $this);
    }

    public function loadCommands(){
        Server::getInstance()->getCommandMap()->register("pvpshop", new ShopCommand($this));
    }

    public static function getMessage(Player $player, string $key): string{
        return PluginUtils::codeUtil($player, self::$instance->messages->getNested($key, $key));
    }

    public static function getInstance(): Loader{
        return self::$instance;
    }

    public static function getEconomy(): EconomyProvider{
        return self::$economyProvider;
    }

    public static function getMenu(): MenuGUI{
        return self::$menu;
    }

    public static function getArmorMenu(): ArmorMenu{
        return self::$armormenu;
    }

    public static function getToolsMenu(): ToolsMenu{
        return self::$toolsmenu;
    }

    public static function getFoodMenu(): FoodMenu{
        return self::$foodmenu;
    }

    /*public static function getPotionsMenu(): PotionsMenu{
        return self::$potionsmenu;
    }*/

    public static function getExtraMenu(): ExtraMenu{
        return self::$extramenu;
    }

    public static function Prefix(){
        return self::$instance->config->get("Prefix");
    }
}