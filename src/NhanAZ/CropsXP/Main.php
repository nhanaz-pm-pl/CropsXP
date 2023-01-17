<?php

declare(strict_types=1);

namespace NhanAZ\CropsXP;

use pocketmine\block\Bamboo;
use pocketmine\block\Beetroot;
use pocketmine\block\BrownMushroomBlock;
use pocketmine\block\Cactus;
use pocketmine\block\Carrot;
use pocketmine\block\CocoaBlock;
use pocketmine\block\Melon;
use pocketmine\block\NetherWartPlant;
use pocketmine\block\Potato;
use pocketmine\block\Pumpkin;
use pocketmine\block\RedMushroomBlock;
use pocketmine\block\SeaPickle;
use pocketmine\block\Sugarcane;
use pocketmine\block\SweetBerryBush;
use pocketmine\block\Wheat;
use pocketmine\event\block\BlockBreakEvent;
use pocketmine\event\Listener;
use pocketmine\item\enchantment\VanillaEnchantments;
use pocketmine\player\GameMode;
use pocketmine\plugin\PluginBase;

class Main extends PluginBase implements Listener {

	protected function onEnable(): void {
		$this->saveDefaultConfig();
		$this->getServer()->getPluginManager()->registerEvents($this, $this);
	}

	public function onBlockBreak(BlockBreakEvent $event): void {
		$player = $event->getPlayer();
		$block = $event->getBlock();
		$item = $event->getItem();
		if (!$player->getGamemode()->equals(GameMode::SURVIVAL())) {
			return;
		}
		if ($block instanceof Wheat || $block instanceof Beetroot || $block instanceof Carrot) {
			if ($block->getAge() >= Wheat::MAX_AGE or $block->getAge() >= Beetroot::MAX_AGE or $block->getAge() >= Carrot::MAX_AGE) {
				$event->setXpDropAmount(mt_rand(0, 3));
			} else {
				$event->setXpDropAmount(mt_rand(0, 1));
			}
			return;
		}
		if ($block instanceof Potato) {
			if ($block->getAge() >= Potato::MAX_AGE) {
				$event->setXpDropAmount(mt_rand(1, 5));
			} else {
				$event->setXpDropAmount(mt_rand(0, 1));
			}
			return;
		}
		if ($block instanceof Melon) {
			if ($item->hasEnchantment(VanillaEnchantments::SILK_TOUCH())) {
				$event->setXpDropAmount(mt_rand(0, 1));
			} else {
				$event->setXpDropAmount(mt_rand(3, 7));
			}
			return;
		}
		if ($block instanceof Pumpkin) {
			$event->setXpDropAmount(mt_rand(0, 1));
			return;
		}
		if ($block instanceof Bamboo) {
			$event->setXpDropAmount(mt_rand(0, 1));
			return;
		}
		if ($block instanceof CocoaBlock) {
			if ($block->getAge() >= CocoaBlock::MAX_AGE) {
				$event->setXpDropAmount(mt_rand(1, 3));
			} else {
				$event->setXpDropAmount(mt_rand(0, 1));
			}
			return;
		}
		if ($block instanceof Sugarcane) {
			$event->setXpDropAmount(mt_rand(0, 1));
			return;
		}
		if ($block instanceof SweetBerryBush) {
			if ($block->getAge() === $block::STAGE_MATURE) {
				$event->setXpDropAmount(mt_rand(2, 3));
				return;
			}
			if ($block->getAge() >= $block::STAGE_BUSH_SOME_BERRIES) {
				$event->setXpDropAmount(mt_rand(1, 2));
				return;
			}
			return;
		}
		if ($block instanceof Cactus) {
			$event->setXpDropAmount(mt_rand(0, 1));
			return;
		}
		if ($block instanceof RedMushroomBlock || $block instanceof BrownMushroomBlock) {
			if ($item->hasEnchantment(VanillaEnchantments::SILK_TOUCH())) {
				$event->setXpDropAmount(mt_rand(0, 1));
			} else {
				$event->setXpDropAmount(mt_rand(0, 2));
			}
			return;
		}
		if ($block instanceof SeaPickle) {
			$event->setXpDropAmount(mt_rand(0, $block->getCount()));
			return;
		}
		if ($block instanceof NetherWartPlant) {
			if ($block->getAge() === NetherWartPlant::MAX_AGE) {
				$event->setXpDropAmount(mt_rand(2, 4));
			} else {
				$event->setXpDropAmount(mt_rand(0, 1));
			}
			return;
		}
	}
}
