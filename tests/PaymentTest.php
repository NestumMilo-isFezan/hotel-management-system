<?php

use PHPUnit\Framework\TestCase;

class PaymentTest extends TestCase
{
    public function testSetupMessage()
    {
        $this->expectOutputString("Setting up PaymentTest...");
        $this->setUp();
    }

    public function setUp(): void
    {
        echo "Setting up PaymentTest...";
    }
}
