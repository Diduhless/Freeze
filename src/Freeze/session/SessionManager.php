<?php


namespace Freeze\session;


use Freeze\Freeze;
use pocketmine\Player;

class SessionManager {

    /** @var Freeze */
    private $plugin;

    /** @var Session[] */
    private $sessions = [];

    public function __construct(Freeze $plugin) {
        $this->plugin = $plugin;
        $this->registerListener();
    }

    public function getSession(Player $player): ?Session {
        return $this->sessions[$player->getName()] ?? null;
    }

    public function startSession(Player $player): void {
        $this->sessions[$player->getName()] = new Session();
    }

    public function removeSession(Player $player): void {
        unset($this->sessions[$player->getName()]);
    }

    private function registerListener(): void {
        $this->plugin->getServer()->getPluginManager()->registerEvents(new SessionListener($this), $this->plugin);
    }

}