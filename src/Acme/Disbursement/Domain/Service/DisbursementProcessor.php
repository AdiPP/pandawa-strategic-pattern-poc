<?php
declare(strict_types=1);

namespace Acme\Disbursement\Domain\Service;

use Acme\Disbursement\Domain\Contract\DisbursementStrategyInterface;
use Acme\Disbursement\Domain\ValueObject\DisburseData;

/**
 * @author  Adi Putra <adiputrapermana@gmail.com>
 */
class DisbursementProcessor
{
    public function __construct(
        private readonly DisbursementStrategyManager $disbursementStrategyManager
    )
    {
    }

    public function process(int $amount): string
    {
        return $this->disbursementStrategyManager->disburse(
            new DisburseData($amount)
        );
    }
}