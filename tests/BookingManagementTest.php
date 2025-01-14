<?php

use PHPUnit\Framework\TestCase;

class BookingManagementTest extends TestCase
{
    public function testSetupMessage()
    {
        $this->expectOutputString("Setting up BookingManagementTest...");
        $this->setUp();
    }

    public function setUp(): void
    {
        echo "Setting up BookingManagementTest...";
    }
}
