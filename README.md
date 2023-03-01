# PvPShop
[![](https://poggit.pmmp.io/shield.state/PvPShop)](https://poggit.pmmp.io/p/PvPShop)

[![](https://poggit.pmmp.io/shield.api/PvPShop)](https://poggit.pmmp.io/p/PvPShop)

**A basic pvp item shop. We also added items and armor with magical powers.**

![pvpshop-icon](https://user-images.githubusercontent.com/83558341/215066906-5c06393b-4ada-4222-bcec-a7e47ce8af4d.png)

<a href="https://discord.gg/YyE9XFckqb"><img src="https://img.shields.io/discord/837701868649709568?label=discord&color=7289DA&logo=discord" alt="Discord" /></a>

### 💡 Implementations
* [X] Configuration.
* [x] MultiLanguage.
* [x] EconmyAPI & BedrockEconomy.
* [X] Commands.
* [x] Keys in config.yml.

### 💾 Config
```yml
   #   ____            ____    ____    _                     
   #  |  _ \  __   __ |  _ \  / ___|  | |__     ___    _ __  
   #  | |_) | \ \ / / | |_) | \___ \  | '_ \   / _ \  | '_ \ 
   #  |  __/   \ V /  |  __/   ___) | | | | | | (_) | | |_) |
   #  |_|       \_/   |_|     |____/  |_| |_|  \___/  | .__/ 
   #                by fernanACM                      |_|    

   # Basic shop to buy pvp items. We have special items in this 
   # store to make it much more special.

   # Configuration version. DO NOT TOUCH
   config-version: "1.0.0"

   # Languages
   # "eng", // English
   # "spa", // Spanish
   # "ger", // German
   # "frc", // French
   # "indo", // Indonesian
   # "portg", // Portuguese
   # "vie" // Vietnamese
   language: eng

   # Prefix plugin
   Prefix: "§l[§aPvPShop§f]§8»§r "

   # ======(ECONOMY PROVIDER)======
   # Usa economyapi, bedrockeconomy, xp
   Economy: 
    provider: bedrockeconomy

   # Price of items in the store.
   Price:
   # ========(CATEGORY - ARMOR)============
   Armor:
     # ===(LEATHER)==
     leather-helmet: 20
     leather-chestplate: 20
     leather-leggings: 20
     leather-boots: 20
     # ===(GOLDEN)===
     golden-helmet: 40
     golden-chestplate: 40
     golden-leggings: 40
     golden-boots: 40
     # ===CHAINMAIL)===
     chainmail-helmet: 60
     chainmail-chestplate: 60
     chainmail-leggings: 60
     chainmail-boots: 60
     # ===(IRON)===
     iron-helmet: 100
     iron-chestplate: 100
     iron-leggings: 100
     iron-boots: 100
     # ===(DIAMOND)===
     diamond-helmet: 200
     diamond-chestplate: 200
     diamond-leggings: 200
     diamond-boots: 200
  
     # ========(CATEGORY - FOOD)============
     Food:
       chicken: 30
       # Amount to receive
       chicken-count: 22

       mutton: 30
       # Amount to receive
       mutton-count: 22

       porkchop: 60
       # Amount to receive
       porkchop-count: 22

       rabbit: 50
       # Amount to receive
       rabbit-count: 22

       salmon: 20
       # Amount to receive
       salmon-count: 22

       golden_apple: 120
       # Amount to receive
       golden_apple-count: 5

       enchanted_golden_apple: 300
       # Amount to receive
       enchanted_golden_apple-count: 2

      # ========(CATEGORY - TOOLS)=============
     Tools:
       # ===(WOOD)===
       wood_sword: 2
       wood_pickaxe: 2
       wood_axe: 2
       # ===(STONE)===
       stone_sword: 10
       stone_pickaxe: 10
       stone_axe: 10
       # ===(GOLDEN)===
       golden_sword: 20
       golden_pickaxe: 20
       golden_axe: 20
       # ===(IRON)===
       iron_sword: 30
       iron_pickaxe: 30
       iron_axe: 30
       # ===(DIAMOND)===
       diamond_sword: 60 
       diamond_pickaxe: 60 
       diamond_axe: 60

     Extras:
       totem: 300
       # ====(MAGIC ITEMS)=====
       speed: 800
       health: 850
       soup: 450
       # =====(MAGIC ARMOR)=====
       helmet: 1250        
       chestplate:  1350
       leggings: 1310
       boots: 1320
       # ====(Cooldown)====
     Cooldown:
       # items
       Items:
         speed: 60
         health: 60
         soup: 60
      # Potions
       Potions:
         speed: 30
         health: 30
         soup: 30
```

### 🕹 Commands
- ```/pvpshop``` > Open a menu for convenience
- ```/pvpshop help``` > Command list
- ```/pvpshop amor``` > Open the armor category.
- ```/pvpshop tools``` > Open the tools category.
- ```/pvpshop food``` > Open the food category.
- ```/pvpshop extra``` > Open the extra category.

### 🔒 Permissions
- Executing the command: ```pvpshop.command.acm:```
- Armor category: ```pvpshop.category.armor```
- Tools category: ```pvpshop.category.tools```
- Food category: ```pvpshop.category.food```
- Extra category: ```pvpshop.category.extras```
- **EXTRA PERMISSIONS:**
- ```pvpshop.items.totem```
- ```pvpshop.items.speed```
- ```pvpshop.items.health```
- ```pvpshop.items.soup```
- **ARMOR**
- ```pvpshop.armor.helmet```
- ```pvpshop.armor.chestplate```
- ```pvpshop.armor.leggings```
- ```pvpshop.armor.boots```

### 🌐 MultiLanguage
| Language | Translated by |
|----------|---------------|
| English | [fernanACM](https://github.com/fernanACM) |
| Spanish | [fernanACM](https://github.com/fernanACM) |
| Indonesian | PvPShop |
| German | [GamerMJay](https://github.com/GamerMJay) |
| French | PvPShop |
| Portuguese | PvPShop |
| Vietnamese | [NhanAZ](https://github.com/NhanAZ) |
***

### 📞 Contact 
| Redes | Tag | Link |
|-------|-------------|------|
| YouTube | fernanACM | [YouTube](https://www.youtube.com/channel/UC-M5iTrCItYQBg5GMuX5ySw) | 
| Discord | fernanACM#5078 | [Discord](https://discord.gg/YyE9XFckqb) |
| GitHub | fernanACM | [GitHub](https://github.com/fernanACM)
| Poggit | fernanACM | [Poggit](https://poggit.pmmp.io/ci/fernanACM)
****

### ✔ Credits
| Authors | Github | Lib |
|---------|--------|-----|
| CortexPE | [CortexPE](https://github.com/CortexPE) | [Commando](https://github.com/CortexPE/Commando/tree/master/) |
| Muqsit | [Muqsit](https://github.com/Muqsit) | [SimplePacketHandler](https://github.com/Muqsit/SimplePacketHandler) |
| Muqsit | [Muqsit](https://github.com/Muqsit) | [InvMenu](https://github.com/Muqsit/InvMenu) |
| DaPigGuy | [DaPigGuy](https://github.com/DaPigGuy) | [libPiggyEconomy](https://github.com/DaPigGuy/libPiggyEconomy) |
| DaPigGuy | [DaPigGuy](https://github.com/DaPigGuy) | [libPiggyUpdateChecker](https://github.com/DaPigGuy/libPiggyUpdateChecker) |
****
