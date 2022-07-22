<?php
declare(strict_types=1);

namespace Acme\Disbursement\Domain\ValueObject;

/**
 * @author  Adi Putra <adiputrapermana@gmail.com>
 */
enum DisbursementStrategyCode: string
{
    case RTGS = 'rtgs';
    case INTERBANK = 'interbank';
}