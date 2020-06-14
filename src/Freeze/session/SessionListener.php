<?php


namespace Freeze\session;


use pocketmine\event\Listener;
use pocketmine\event\player\PlayerLoginEvent;
use pocketmine\event\player\PlayerQuitEvent;

class SessionListener implements Listener {

    /** @var SessionManager */
    private $manager;

    public function __construct(SessionManager $manager) {
        $this->manager = $manager;
    }

    public function onLogin(PlayerLoginEvent $event): void {
        $this->manager->startSession($event->getPlayer());
    }

    public function onQuit(PlayerQuitEvent $event): void {
        $this->manager->removeSession($event->getPlayer());
    }

}