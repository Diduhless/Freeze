<?php


namespace Freeze\session;



class Session {

    /** @var bool */
    private $frozen = false;

    public function isFrozen(): bool {
        return $this->frozen;
    }

    public function setFrozen(bool $frozen): void {
        $this->frozen = $frozen;
    }

}