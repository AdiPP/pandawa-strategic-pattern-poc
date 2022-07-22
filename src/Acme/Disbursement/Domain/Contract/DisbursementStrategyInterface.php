<?php
declare(strict_types=1);

namespace Acme\Disbursement\Domain\Contract;

use Acme\Disbursement\Domain\ValueObject\DisburseData;

/**
 * @author  Adi Putra <adiputrapermana@gmail.com>
 */
interface DisbursementStrategyInterface
{
    public function getName(): string;

    public function getPriority(): int;

    public function disburse(DisburseData $data): ?string;

    public function support(DisburseData $data): bool;
}