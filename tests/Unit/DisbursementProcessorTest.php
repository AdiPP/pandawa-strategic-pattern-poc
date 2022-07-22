<?php
declare(strict_types=1);

namespace Tests\Unit;

use Acme\Disbursement\Domain\Service\DisbursementProcessor;
use Acme\Disbursement\Domain\ValueObject\DisbursementStrategyCode;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

/**
 * @author  Adi Putra <adiputrapermana@gmail.com>
 */
class DisbursementProcessorTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    protected function setUp(): void
    {
        parent::setUp();

        $this->seed();
        $this->setUpFaker();
    }

    public function testProcessRTGSDisburse(): void
    {
        $processor = $this->disbursementProcessor();
        $result = $processor->process(1000000000);

        $this->assertSame(DisbursementStrategyCode::RTGS->value, $result);
    }

    public function testProcessInterbankDisburse(): void
    {
        $processor = $this->disbursementProcessor();
        $result = $processor->process(999999999);

        $this->assertSame(DisbursementStrategyCode::INTERBANK->value, $result);
    }

    private function disbursementProcessor(): DisbursementProcessor
    {
        return app(DisbursementProcessor::class);
    }
}