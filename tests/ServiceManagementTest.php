<?php

use PHPUnit\Framework\TestCase;

class ServiceManagementTest extends TestCase
{
    public function testSetupMessage()
    {
        $this->expectOutputString("Setting up ServiceManagementTest...");
        $this->setUp();
    }

    public function setUp(): void
    {
        echo "Setting up ServiceManagementTest...";
    }
}
