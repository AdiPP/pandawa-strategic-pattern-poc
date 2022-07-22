<?php
declare(strict_types=1);

namespace Acme\Disbursement\Domain\Service;

use Acme\Disbursement\Domain\Contract\DisbursementStrategyInterface;
use Acme\Disbursement\Domain\ValueObject\DisburseData;
use Illuminate\Container\RewindableGenerator;
use InvalidArgumentException;

/**
 * @author  Adi Putra <adiputrapermana@gmail.com>
 */
class DisbursementStrategyManager
{
    /**
     * @param DisbursementStrategyInterface[] $extractors
     */
    public function __construct(
        protected RewindableGenerator|array $extractors
    )
    {
        $this->extractors = [];

        foreach ($extractors as $extractor) {
            if (!$extractor instanceof DisbursementStrategyInterface) {
                throw new \RuntimeException('Something wrong.');
            }

            $this->add($extractor);
        }

        $this->sortExtractorsByPriority();
    }

    private function add(DisbursementStrategyInterface $disbursementStrategy): void
    {
        $this->extractors[] = $disbursementStrategy;
    }

    private function sortExtractorsByPriority(): void
    {
        $extractor = $this->extractors;

        usort($extractor, function (
            DisbursementStrategyInterface $disbursementStrategyA,
            DisbursementStrategyInterface $disbursementStrategyB
        ) {
            $priorityA = $disbursementStrategyA->getPriority();
            $priorityB = $disbursementStrategyB->getPriority();

           if ($priorityA === $priorityB) {
               return 0;
           }

           return ($priorityA < $priorityB) ? 1 : -1;
        });

        $this->extractors = $extractor;
    }

    public function disburse(DisburseData $data): string
    {
        foreach ($this->extractors as $extractor) {
            if (null !== $identifier = $extractor->disburse($data)) {
                return $identifier;
            }
        }

        throw new \RuntimeException('Something wrong.');
    }
}