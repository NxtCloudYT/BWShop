<?php

declare(strict_types=1);

namespace Fludixx\BWShop;

use muqsit\invmenu\{InvMenu,InvMenuHandler};
use pocketmine\entity\Entity;
use pocketmine\entity\hostile\Zombie;
use pocketmine\event\Listener;
use pocketmine\item\Item;
use pocketmine\plugin\PluginBase;
use pocketmine\command\CommandSender;
use pocketmine\command\Command;
use pocketmine\Player;
use pocketmine\utils\Config;
use pocketmine\utils\TextFormat as f;
use pocketmine\event\entity\EntityDamageEvent;
use pocketmine\event\entity\EntityDamageByEntityEvent;
use Fludixx\BWShop;

class Main extends PluginBase implements Listener {

	const PREFIX = f::WHITE."SHOP".f::GRAY." ->".f::YELLOW." ";

	public function onEnable() : void{
		$this->getServer()->getPluginManager()->registerEvents($this, $this);
		$this->getLogger()->info(self::PREFIX."Geladen!");
	}

    public function onHit(EntityDamageEvent $event)
    {
        $entity = $event->getEntity();
        if($entity instanceof Zombie){
            if($event instanceof EntityDamageByEntityEvent){
                $player = $event->getDamager();
                if($player instanceof Player){
                    if(!InvMenuHandler::isRegistered()){
                        InvMenuHandler::register($this);
                    }
                    $this->Overview($player);
                    $event->setCancelled();
                }
            }
        }
    }
    
	public function Overview(Player $player) {
		$menu = InvMenu::create(InvMenu::TYPE_CHEST);
		$menu->readonly();
		$menu->setName(f::DARK_GRAY."§r§7» §cBWSHOP §7«");
		$minv = $menu->getInventory();
		$platzhalter1 = Item::get(Item::STAINED_GLASS_PANE, 8)->setCustomName("");
		$platzhalter2 = Item::get(Item::STAINED_GLASS_PANE, 8)->setCustomName("");
		$selected = Item::get(Item::STAINED_GLASS_PANE, 14)->setCustomName("Derzeitige Kategorie");
		$sandstone = Item::get(Item::SANDSTONE, 0, 16);
		$sandstone->setCustomName(f::YELLOW."16x".f::WHITE." Sandstein".f::RED." 4 Bronze");
		$stick = Item::get(Item::STICK, 0, 1);
		$stick->setCustomName(f::YELLOW."1x".f::WHITE." Stick".f::RED." 8 Bronze");
		$picke = Item::get(Item::WOODEN_PICKAXE, 0, 1);
		$picke->setCustomName(f::YELLOW."1x".f::WHITE." Spitzhacke".f::RED." 4 Bronze");
		$schwert1 = Item::get(Item::STONE_SWORD, 0, 1);
		$schwert1->setCustomName(f::YELLOW."1x".f::WHITE." Schwert - 1".f::GRAY." 1 Eisen");
		$helm = Item::get(Item::LEATHER_CAP)->setCustomName(f::YELLOW. "1x".f::WHITE." Kappe".f::RED." 1 Bronze");
		$brust1 = Item::get(Item::CHAINMAIL_CHESTPLATE)->setCustomName(f::YELLOW. "1x".f::WHITE." Rüstung - 1".f::GRAY." 1 Eisen");
		$hose = Item::get(Item::LEATHER_LEGGINGS)->setCustomName(f::YELLOW. "1x".f::WHITE." Hose".f::RED." 1 Bronze");
		$boots = Item::get(Item::LEATHER_BOOTS)->setCustomName(f::YELLOW. "1x".f::WHITE." Schuhe".f::RED." 1 Bronze");
		$bett = Item::get(Item::CHEST, 14, 1);$bett->setCustomName(f::RED."Normale Kategorie");
		$stein = Item::get(Item::SANDSTONE, 0, 1);$stein->setCustomName(f::RED."Block Kategorie");
		$brust = Item::get(Item::CHAINMAIL_CHESTPLATE, 0, 1);$brust->setCustomName(f::YELLOW."Rüstungs Kategorie");
		$battle = Item::get(Item::IRON_SWORD, 0, 1);$battle->setCustomName(f::YELLOW."Kampf Kategorie");
		$extra = Item::get(Item::TNT, 0, 1);$extra->setCustomName(f::YELLOW."Spielereien");

		//Zeile 1
        $minv->setItem(0, $bett);
        $minv->setItem(1, $platzhalter1);
        $minv->setItem(2, $stein);
        $minv->setItem(3, $platzhalter1);
        $minv->setItem(4, $brust);
        $minv->setItem(5, $platzhalter1);
        $minv->setItem(6, $battle);
        $minv->setItem(7, $platzhalter1);
        $minv->setItem(8, $extra);

        //Zeile 2
        $minv->setItem(9, $selected);
        $minv->setItem(10, $platzhalter2);
        $minv->setItem(11, $platzhalter2);
        $minv->setItem(12, $platzhalter2);
        $minv->setItem(13, $platzhalter2);
        $minv->setItem(14, $platzhalter2);
        $minv->setItem(15, $platzhalter2);
        $minv->setItem(16, $platzhalter2);
        $minv->setItem(17, $platzhalter2);

		$minv->setItem(18, $stick);
		$minv->setItem(19, $picke);
		$minv->setItem(20, $sandstone);
		$minv->setItem(21, $schwert1);
		$minv->setItem(22, $platzhalter1);
		$minv->setItem(23, $helm);
		$minv->setItem(24, $brust1);
		$minv->setItem(25, $hose);
		$minv->setItem(26, $boots);
		$menu->send($player);
		$menu->setListener([new BWListener($this), "onTransaction"]);
	}
	public function Bau(Player $player) {
		$menu = InvMenu::create(InvMenu::TYPE_CHEST);
		$menu->readonly();
		$menu->setName(f::DARK_GRAY."§r§7» §cBWSHOP §7«");
		$minv = $menu->getInventory();
		$platzhalter1 = Item::get(Item::STAINED_GLASS_PANE, 8)->setCustomName("");
		$platzhalter2 = Item::get(Item::STAINED_GLASS_PANE, 7)->setCustomName("");
		$selected = Item::get(Item::STAINED_GLASS_PANE, 14)->setCustomName("Derzeitige Kategorie");
		$sandstone = Item::get(Item::SANDSTONE, 0, 4);
		$sandstone->setCustomName(f::YELLOW."4x".f::WHITE." Sandstein".f::RED." 1 Bronze");
		$sandstone2 = Item::get(Item::SANDSTONE, 0, 16);
		$sandstone2->setCustomName(f::YELLOW."16x".f::WHITE." Sandstein".f::RED." 4 Bronze");
		$sandstone3 = Item::get(Item::SANDSTONE, 0, 64);
		$sandstone3->setCustomName(f::YELLOW."64x".f::WHITE." Sandstein".f::RED." 16 Bronze");
		$endstein = Item::get(Item::END_STONE, 0, 1);
		$endstein->setCustomName(f::YELLOW."1x".f::WHITE." Endstone".f::RED." 16 Bronze");
		$web = Item::get(Item::WEB, 0, 1);
		$web->setCustomName(f::YELLOW."1x".f::WHITE." Cobweb".f::RED." 8 Bronze");
        $bett = Item::get(Item::CHEST, 14, 1);$bett->setCustomName(f::RED."Normale Kategorie");
        $stein = Item::get(Item::SANDSTONE, 0, 1);$stein->setCustomName(f::RED."Block Kategorie");
        $brust = Item::get(Item::CHAINMAIL_CHESTPLATE, 0, 1);$brust->setCustomName(f::YELLOW."Rüstungs Kategorie");
        $battle = Item::get(Item::IRON_SWORD, 0, 1);$battle->setCustomName(f::YELLOW."Kampf Kategorie");
        $extra = Item::get(Item::TNT, 0, 1);$extra->setCustomName(f::YELLOW."Spielereien");

        //Zeile 1
        $minv->setItem(0, $bett);
        $minv->setItem(1, $platzhalter1);
        $minv->setItem(2, $stein);
        $minv->setItem(3, $platzhalter1);
        $minv->setItem(4, $brust);
        $minv->setItem(5, $platzhalter1);
        $minv->setItem(6, $battle);
        $minv->setItem(7, $platzhalter1);
        $minv->setItem(8, $extra);

        //Zeile 2
        $minv->setItem(9, $platzhalter2);
        $minv->setItem(10, $platzhalter2);
        $minv->setItem(11, $selected);
        $minv->setItem(12, $platzhalter2);
        $minv->setItem(13, $platzhalter2);
        $minv->setItem(14, $platzhalter2);
        $minv->setItem(15, $platzhalter2);
        $minv->setItem(16, $platzhalter2);
        $minv->setItem(17, $platzhalter2);


        //Zeile3
        $minv->setItem(18, $platzhalter1);
		$minv->setItem(19, $sandstone);
		$minv->setItem(20, $sandstone2);
		$minv->setItem(21, $sandstone3);
		$minv->setItem(22, $platzhalter1);
        $minv->setItem(23, $platzhalter1);
		$minv->setItem(24, $endstein);
        $minv->setItem(25, $platzhalter1);
		$minv->setItem(26, $web);

		$menu->send($player);
		$menu->setListener([new BWListener($this), "onTransaction"]);
	}
	public function Ruestung(Player $player) {
		$menu = InvMenu::create(InvMenu::TYPE_CHEST);
		$menu->readonly();
		$menu->setName(f::DARK_GRAY."§r§7» §cBWSHOP §7«");
		$minv = $menu->getInventory();
		$platzhalter1 = Item::get(Item::STAINED_GLASS_PANE, 8)->setCustomName("");
		$platzhalter2 = Item::get(Item::STAINED_GLASS_PANE, 7)->setCustomName("");
		$selected = Item::get(Item::STAINED_GLASS_PANE, 14)->setCustomName("Derzeitige Kategorie");
		$sandstone = Item::get(Item::SANDSTONE, 0, 16);
		$sandstone->setCustomName(f::YELLOW."16x".f::WHITE." Sandstein".f::RED." 4 Bronze");
		$stick = Item::get(Item::STICK, 0, 1);
		$stick->setCustomName(f::YELLOW."1x".f::WHITE." Stick".f::RED." 8 Bronze");
		$picke = Item::get(Item::WOODEN_PICKAXE, 0, 1);
		$picke->setCustomName(f::YELLOW."1x".f::WHITE." Spitzhacke".f::RED." 4 Bronze");
		$schwert1 = Item::get(Item::STONE_SWORD, 0, 1);
		$schwert1->setCustomName(f::YELLOW."1x".f::WHITE." Schwert - 1".f::GRAY." 1 Eisen");
		$schwert2 = Item::get(Item::GOLDEN_SWORD, 0, 1);
		$schwert2->setCustomName(f::YELLOW."1x".f::WHITE." Schwert - 2".f::GRAY." 3 Eisen");
		$schwert3 = Item::get(Item::IRON_SWORD, 0, 1);
		$schwert3->setCustomName(f::YELLOW."1x".f::WHITE." Schwert - 3".f::GRAY." 5 Gold");
		$bow1 = Item::get(Item::BOW, 0, 1);
		$bow1->setCustomName(f::YELLOW."1x".f::WHITE." Bogen - 1".f::GOLD." 4 Gold");
        $bett = Item::get(Item::CHEST, 14, 1);$bett->setCustomName(f::RED."Normale Kategorie");
        $stein = Item::get(Item::SANDSTONE, 0, 1);$stein->setCustomName(f::RED."Block Kategorie");
        $brust = Item::get(Item::CHAINMAIL_CHESTPLATE, 0, 1);$brust->setCustomName(f::YELLOW."Rüstungs Kategorie");
        $battle = Item::get(Item::IRON_SWORD, 0, 1);$battle->setCustomName(f::YELLOW."Kampf Kategorie");
        $extra = Item::get(Item::TNT, 0, 1);$extra->setCustomName(f::YELLOW."Spielereien");

        $minv->setItem(0, $bett);
        $minv->setItem(1, $platzhalter1);
        $minv->setItem(2, $stein);
        $minv->setItem(3, $platzhalter1);
        $minv->setItem(4, $brust);
        $minv->setItem(5, $platzhalter1);
        $minv->setItem(6, $battle);
        $minv->setItem(7, $platzhalter1);
        $minv->setItem(8, $extra);

        //Zeile 2
        $minv->setItem(9, $platzhalter2);
        $minv->setItem(10, $platzhalter2);
        $minv->setItem(11, $platzhalter1);
        $minv->setItem(12, $platzhalter2);
        $minv->setItem(13, $platzhalter2);
        $minv->setItem(14, $platzhalter2);
        $minv->setItem(15, $selected);
        $minv->setItem(16, $platzhalter2);
        $minv->setItem(17, $platzhalter2);

        //Zeile 3
        $minv->setItem(18, $schwert1);
		$minv->setItem(19, $schwert2);
		$minv->setItem(20, $schwert3);
		$minv->setItem(21, $platzhalter1);
		$minv->setItem(22, $stick);
		$minv->setItem(23, $picke);
		$minv->setItem(24, $platzhalter1);
        $minv->setItem(25, $bow1);
		$minv->setItem(26, $platzhalter1);

		$menu->send($player);
		$menu->setListener([new BWListener($this), "onTransaction"]);
	}
	public function Battle(Player $player) {
		$menu = InvMenu::create(InvMenu::TYPE_CHEST);
		$menu->readonly();
		$menu->setName(f::DARK_GRAY."§r§7» §cBWSHOP §7«");
		$minv = $menu->getInventory();
		$platzhalter1 = Item::get(Item::STAINED_GLASS_PANE, 8)->setCustomName("");
		$platzhalter2 = Item::get(Item::STAINED_GLASS_PANE, 7)->setCustomName("");
		$selected = Item::get(Item::STAINED_GLASS_PANE, 14)->setCustomName("Derzeitige Kategorie");
		$sandstone = Item::get(Item::SANDSTONE, 0, 16);
		$sandstone->setCustomName(f::YELLOW."16x".f::WHITE." Sandstein".f::RED." 4 Bronze");
        $stick = Item::get(Item::STICK, 0, 1);
        $stick->setCustomName(f::YELLOW."1x".f::WHITE." Stick".f::RED." 8 Bronze");
		$picke = Item::get(Item::WOODEN_PICKAXE, 0, 1);
		$picke->setCustomName(f::YELLOW."1x".f::WHITE." Spitzhacke".f::RED." 4 Bronze");
		$schwert1 = Item::get(Item::STONE_SWORD, 0, 1);
		$schwert1->setCustomName(f::YELLOW."1x".f::WHITE." Schwert - 1".f::GRAY." 1 Eisen");
		$helm = Item::get(Item::LEATHER_CAP)->setCustomName(f::YELLOW. "1x".f::WHITE." Kappe".f::RED." 1 Bronze");
		$brust1 = Item::get(Item::CHAINMAIL_CHESTPLATE)->setCustomName
		(f::YELLOW. "1x".f::WHITE." Rüstung - 1".f::GRAY." 1 Eisen");
		$brust2 = Item::get(Item::CHAINMAIL_CHESTPLATE)->setCustomName
		(f::YELLOW. "1x".f::WHITE." Rüstung - 2" .f::GRAY." 3 Eisen");
		$brust3 = Item::get(Item::IRON_CHESTPLATE)->setCustomName
		(f::YELLOW. "1x".f::WHITE." Rüstung - 3" .f::GRAY." 2 Gold");
		$brust4 = Item::get(Item::LEATHER_CHESTPLATE)->setCustomName
		(f::YELLOW. "1x".f::WHITE." Rüstung" .f::RED." 2 Bronze");
		$hose = Item::get(Item::LEATHER_LEGGINGS)->setCustomName
		(f::YELLOW. "1x".f::WHITE." Hose".f::RED." 1 Bronze");
		$boots = Item::get(Item::LEATHER_BOOTS)->setCustomName
		(f::YELLOW. "1x".f::WHITE." Schuhe".f::RED." 1 Bronze");
        $bett = Item::get(Item::CHEST, 14, 1);$bett->setCustomName(f::RED."Normale Kategorie");
        $stein = Item::get(Item::SANDSTONE, 0, 1);$stein->setCustomName(f::RED."Block Kategorie");
        $brust = Item::get(Item::CHAINMAIL_CHESTPLATE, 0, 1);$brust->setCustomName(f::YELLOW."Rüstungs Kategorie");
        $battle = Item::get(Item::IRON_SWORD, 0, 1);$battle->setCustomName(f::YELLOW."Kampf Kategorie");
        $extra = Item::get(Item::TNT, 0, 1);$extra->setCustomName(f::YELLOW."Spielereien");

		//Zeile 1
        $minv->setItem(0, $bett);
        $minv->setItem(1, $platzhalter1);
        $minv->setItem(2, $stein);
        $minv->setItem(3, $platzhalter1);
        $minv->setItem(4, $brust);
        $minv->setItem(5, $platzhalter1);
        $minv->setItem(6, $battle);
        $minv->setItem(7, $platzhalter1);
        $minv->setItem(8, $extra);

        //Zeile 2
        $minv->setItem(9, $platzhalter2);
        $minv->setItem(10, $platzhalter2);
        $minv->setItem(11, $platzhalter1);
        $minv->setItem(12, $platzhalter2);
        $minv->setItem(13, $selected);
        $minv->setItem(14, $platzhalter2);
        $minv->setItem(15, $platzhalter1);
        $minv->setItem(16, $platzhalter2);
        $minv->setItem(17, $platzhalter2);

		//ZEile 3
		$minv->setItem(18, $brust1);
		$minv->setItem(19, $brust2);
		$minv->setItem(20, $brust3);
		$minv->setItem(21, $brust4);
		$minv->setItem(22, $platzhalter1);
		$minv->setItem(23, $helm);
		$minv->setItem(24, $brust1);
		$minv->setItem(25, $hose);
		$minv->setItem(26, $boots);

		$menu->send($player);
		$menu->setListener([new BWListener($this), "onTransaction"]);
	}
	public function Extra(Player $player) {
		$menu = InvMenu::create(InvMenu::TYPE_CHEST);
		$menu->readonly();
		$menu->setName(f::DARK_GRAY."§r§7» §cBWSHOP §7«");
		$minv = $menu->getInventory();
		$platzhalter1 = Item::get(Item::STAINED_GLASS_PANE, 8)->setCustomName("");
		$platzhalter2 = Item::get(Item::STAINED_GLASS_PANE, 7)->setCustomName("");
		$selected = Item::get(Item::STAINED_GLASS_PANE, 14)->setCustomName("Derzeitige Kategorie");
		$tnt = Item::get(Item::LADDER, 0, 1)->setCustomName(f::YELLOW. "1x".f::WHITE." Leiter".f::GOLD." 8 Bronze");
		$fire = Item::get(Item::CHEST, 0, 1)->setCustomName(f::YELLOW. "1x".f::WHITE." Truhe".f::GRAY." 1 Eisen");
		$ender = Item::get(Item::ENDER_PEARL, 0, 1)->setCustomName(f::YELLOW. "1x".f::WHITE." Enderperle".f::GOLD." 12 Gold");
		$safe = Item::get(Item::SNOWBALL, 0, 3)->setCustomName(f::YELLOW. "3x".f::WHITE." Schneeball".f::GOLD." 8 Eisen");
        $bett = Item::get(Item::CHEST, 14, 1);$bett->setCustomName(f::RED."Normale Kategorie");
        $stein = Item::get(Item::SANDSTONE, 0, 1);$stein->setCustomName(f::RED."Block Kategorie");
        $brust = Item::get(Item::CHAINMAIL_CHESTPLATE, 0, 1);$brust->setCustomName(f::YELLOW."Rüstungs Kategorie");
        $battle = Item::get(Item::IRON_SWORD, 0, 1);$battle->setCustomName(f::YELLOW."Kampf Kategorie");
        $extra = Item::get(Item::TNT, 0, 1);$extra->setCustomName(f::YELLOW."Spielereien");
        //Zeile 1
        $minv->setItem(0, $bett);
        $minv->setItem(1, $platzhalter1);
        $minv->setItem(2, $stein);
        $minv->setItem(3, $platzhalter1);
        $minv->setItem(4, $brust);
        $minv->setItem(5, $platzhalter1);
        $minv->setItem(6, $battle);
        $minv->setItem(7, $platzhalter1);
        $minv->setItem(8, $extra);

        //Zeile 2
        $minv->setItem(9, $platzhalter2);
        $minv->setItem(10, $platzhalter2);
        $minv->setItem(11, $platzhalter1);
        $minv->setItem(12, $platzhalter2);
        $minv->setItem(13, $platzhalter1);
        $minv->setItem(14, $platzhalter2);
        $minv->setItem(15, $platzhalter1);
        $minv->setItem(16, $platzhalter1);
        $minv->setItem(17, $selected);

        //Zeile 3
        $minv->setItem(18, $platzhalter1);
        $minv->setItem(19, $platzhalter1);
		$minv->setItem(20, $tnt);
        $minv->setItem(21, $platzhalter1);
		$minv->setItem(22, $ender);
		$minv->setItem(23, $safe);
		$minv->setItem(24, $fire);
		$minv->setItem(25, $platzhalter1);
		$minv->setItem(26, $platzhalter1);

		$menu->send($player);
		$menu->setListener([new BWListener($this), "onTransaction"]);
	}

}
    
