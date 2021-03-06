<?php

namespace hm\SteveWarn;

use pocketmine\plugin\PluginBase;
use pocketmine\event\Listener;
use pocketmine\event\player\PlayerJoinEvent;
use pocketmine\network\protocol\ChatPacket;
use pocketmine\event\player\PlayerChatEvent;
use pocketmine\event\player\PlayerCommandPreprocessEvent;
use pocketmine\event\player\PlayerMoveEvent;
use pocketmine\event\player\PlayerKickEvent;
use Gentleman\task\KickTask;

class SteveWarn extends PluginBase implements Listener {
	public function onEnable() {
		$this->getServer ()->getPluginManager ()->registerEvents ( $this, $this );
	}
	public function PlayerJoin(PlayerJoinEvent $event) {
		$player = $event->getPlayer ();
		if (strtolower ( $player->getName () ) == "steve") {
			$event->setJoinMessage ( "" );
			$message = "[경고] 닉네임이 Steve입니다, 해당닉네임은 사용불가능합니다\n[경고] 자동으로 킥처리되며 닉네임 변경시 정상이용가능합니다";
			$player->sendMessage ( $message );
			$player->sendMessage ( $message );
			$player->sendMessage ( $message );
			$this->getServer ()->getScheduler ()->scheduleDelayedTask ( new KickTask ( $player ), 200 );
		}
	}
	public function onPlayerChat(PlayerChatEvent $event) {
		if (strtolower ( $event->getPlayer ()->getName () ) == "steve") $event->setCancelled ();
	}
	public function onPlayerCommand(PlayerCommandPreprocessEvent $event) {
		if (strtolower ( $event->getPlayer ()->getName () ) == "steve") $event->setCancelled ();
	}
	public function onPlayerKick(PlayerKickEvent $event) {
		if ($event->getReason () == "기본닉네임") $event->setQuitMessage ( "" );
	}
}
?>
