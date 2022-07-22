<?php
declare(strict_types=1);

namespace Acme\Disbursement\Domain\Service\DisbursementStrategyAdapter;

use Acme\Disbursement\Domain\Contract\DisbursementStrategyInterface;
use Acme\Disbursement\Domain\Model\DisbursementStrategy;
use Acme\Disbursement\Domain\Repository\DisbursementStrategyRepository;
use Acme\Disbursement\Domain\ValueObject\DisburseData;
use Acme\Disbursement\Domain\ValueObject\DisbursementStrategyCode;

/**
 * @author  Adi Putra <adiputrapermana@gmail.com>
 */
class RTGSDisbursementStrategyAdapter implements DisbursementStrategyInterface
{
    private int $priority;

    public function __construct(
        private readonly DisbursementStrategyRepository $disbursementStrategyRepository
    )
    {
        /** @var DisbursementStrategy $strategy */
        $strategy = $this->disbursementStrategyRepository->findOneBy([
            'code' => $this->getName()
        ]);

        $this->priority = $strategy->priority;
    }

    public function getName(): string
    {
        return DisbursementStrategyCode::RTGS->value;
    }

    public function getPriority(): int
    {
        return $this->priority;
    }

    public function disburse(DisburseData $data): ?string
    {
        if ($this->support($data)) {
            return $this->getName();
        }

        return null;
    }

    public function support(DisburseData $data): bool
    {
        return $data->getAmount() >= 1000000000;
    }
}