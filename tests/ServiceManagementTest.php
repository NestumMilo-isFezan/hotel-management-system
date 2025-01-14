<?php

use PHPUnit\Framework\TestCase;

class ServiceManagementTest extends TestCase
{
    private bool $setupMessagePrinted = false;

    public function testSetupMessage()
    {
        $this->expectOutputString("Setting up ServiceManagementTest...");
        $this->setUp();
    }

    public function setUp(): void
    {
        if (!$this->setupMessagePrinted) {
            echo "Setting up ServiceManagementTest...";
            $this->setupMessagePrinted = true;
        }
    }
}
