<?php
declare(strict_types=1);

namespace Acme\Disbursement;

use Acme\Disbursement\Domain\AcmeDisbursementDomainModule;
use Pandawa\Component\Module\AbstractModule;

/**
 * @author  Adi Putra <adiputrapermana@gmail.com>
 */
class AcmeDisbursementModule extends AbstractModule
{
    protected $subModules = [
        AcmeDisbursementDomainModule::class,
    ];
}