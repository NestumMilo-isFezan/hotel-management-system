<?php

use PHPUnit\Framework\TestCase;

class BookingManagementTest extends TestCase
{
    private bool $setupMessagePrinted = false;

    public function testSetupMessage()
    {
        $this->expectOutputString("Setting up BookingManagementTest...");
        $this->setUp();
    }

    public function setUp(): void
    {
        if (!$this->setupMessagePrinted) {
            echo "Setting up BookingManagementTest...";
            $this->setupMessagePrinted = true;
        }
    }
}
