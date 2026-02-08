<?php

use PHPUnit\Framework\TestCase;

class RoomManagementTest extends TestCase
{
    private bool $setupMessagePrinted = false;

    public function testSetupMessage()
    {
        $this->expectOutputString("Setting up RoomManagementTest...");
        $this->setUp();
    }

    public function setUp(): void
    {
        if (!$this->setupMessagePrinted) {
            echo "Setting up RoomManagementTest...";
            $this->setupMessagePrinted = true;
        }
    }
}
