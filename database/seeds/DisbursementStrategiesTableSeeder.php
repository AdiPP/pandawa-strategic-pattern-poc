<?php

namespace Database\Seeders;

use Acme\Disbursement\Domain\Model\DisbursementStrategy;
use Acme\Disbursement\Domain\Repository\DisbursementStrategyRepository;
use Acme\Disbursement\Domain\ValueObject\DisbursementStrategyCode;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DisbursementStrategiesTableSeeder extends Seeder
{
    const DATA = [
        [
            'id'    => '47e0edf1-3c6b-4f63-b3b6-1da710af345b',
            'name'  => 'rtgs',
            'priority' => 100,
            'code' => DisbursementStrategyCode::RTGS
        ],
        [
            'id'    => '578a23c9-2bf1-4b79-b838-743008b454dc',
            'name'  => 'interbank',
            'priority' => 50,
            'code' => DisbursementStrategyCode::INTERBANK
        ],
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (self::DATA as $datum) {
            if (null === $this->disbursementStrategyRepository()->find($datum['id'])) {
                $strategy = new DisbursementStrategy($datum);

                $this->disbursementStrategyRepository()->save($strategy);
            }
        }
    }

    private function disbursementStrategyRepository(): DisbursementStrategyRepository
    {
        return app(DisbursementStrategyRepository::class);
    }
}
