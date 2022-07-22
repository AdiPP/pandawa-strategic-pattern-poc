<?php
declare(strict_types=1);

namespace Acme\Disbursement\Domain\Model;

use Acme\Disbursement\Domain\ValueObject\DisbursementStrategyCode;
use Pandawa\Component\Ddd\AbstractModel;

/**
 * @property string $name
 * @property int $priority
 * @property string $code
 *
 * @author  Adi Putra <adiputrapermana@gmail.com>
 */
class DisbursementStrategy extends AbstractModel
{
    protected $casts = [
        'name' => 'string',
        'priority' => 'integer',
        'code' => DisbursementStrategyCode::class
    ];
}