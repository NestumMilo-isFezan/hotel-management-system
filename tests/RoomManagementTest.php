<?php

use PHPUnit\Framework\TestCase;

class RoomManagementTest extends TestCase
{
    public function testSetupMessage()
    {
        $this->expectOutputString("Setting up RoomManagementTest...");
        $this->setUp();
    }

    public function setUp(): void
    {
        echo "Setting up RoomManagementTest...";
    }
}
