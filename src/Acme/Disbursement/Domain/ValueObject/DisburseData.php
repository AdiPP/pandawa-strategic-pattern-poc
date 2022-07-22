<?php
declare(strict_types=1);

namespace Acme\Disbursement\Domain\ValueObject;

/**
 * @author  Adi Putra <adiputrapermana@gmail.com>
 */
class DisburseData
{
    public function __construct(
        private readonly int $amount
    )
    {
    }

    public function getAmount(): int
    {
        return $this->amount;
    }
}