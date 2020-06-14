<?php


namespace Freeze\command;


use Freeze\Freeze;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\utils\TextFormat;

class FreezeCommand extends Command {

    private $plugin;

    public function __construct(Freeze $plugin) {
        $this->plugin = $plugin;
        $this->setPermission("freeze.command");
        parent::__construct("freeze", "Freezes or unfreezes a player", "/freeze (player)");
    }

    public function execute(CommandSender $sender, string $commandLabel, array $args) {
        if(!$this->testPermission($sender)) {
            return;
        } elseif(!isset($args[0])) {
            $sender->sendMessage(TextFormat::RED . "Usage: " . $this->getUsage());
            return;
        }

        $target = $this->plugin->getServer()->getPlayer($args[0]);
        if($target == null) {
            $sender->sendMessage(TextFormat::RED . "$args[0] is not a valid player!");
            return;
        }

        $session = $this->plugin->getSessionManager()->getSession($target);
        if(!$session->isFrozen()) {
            $session->setFrozen(true);
            $target->sendMessage(TextFormat::AQUA . "You have been frozen!");
            $sender->sendMessage(TextFormat::GREEN . "You have frozen " . $target->getName() . "!");
        } else {
            $session->setFrozen(false);
            $target->sendMessage(TextFormat::AQUA . "You have been unfrozen!");
            $sender->sendMessage(TextFormat::GREEN . "You have unfrozen " . $target->getName() . "!");
        }
    }
}