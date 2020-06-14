<?php


namespace Freeze;


use Freeze\command\FreezeCommand;
use Freeze\session\SessionManager;
use pocketmine\plugin\PluginBase;

class Freeze extends PluginBase {

    /** @var SessionManager */
    private $sessionManager;

    public function onEnable() {
        $this->sessionManager = new SessionManager($this);

        $server = $this->getServer();
        $server->getPluginManager()->registerEvents(new FreezeListener($this), $this);
        $server->getCommandMap()->register("freeze", new FreezeCommand($this));
    }

    public function getSessionManager(): SessionManager {
        return $this->sessionManager;
    }

}