<?php


namespace Freeze;


use Freeze\session\SessionManager;
use pocketmine\event\Listener;
use pocketmine\event\player\PlayerMoveEvent;

class FreezeListener implements Listener {

    /** @var SessionManager */
    private $sessionManager;

    public function __construct(Freeze $plugin) {
        $this->sessionManager = $plugin->getSessionManager();
    }

    public function onMove(PlayerMoveEvent $event): void {
        if($this->sessionManager->getSession($event->getPlayer())->isFrozen()) {
            $event->setCancelled();
        }
    }

}