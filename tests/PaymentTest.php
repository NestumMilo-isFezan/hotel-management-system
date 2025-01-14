<?php

use PHPUnit\Framework\TestCase;

class PaymentTest extends TestCase
{
    private bool $setupMessagePrinted = false;

    public function testSetupMessage()
    {
        $this->expectOutputString("Setting up PaymentTest...");
        $this->setUp();
    }

    public function setUp(): void
    {
        if (!$this->setupMessagePrinted) {
            echo "Setting up PaymentTest...";
            $this->setupMessagePrinted = true;
        }
    }
}
