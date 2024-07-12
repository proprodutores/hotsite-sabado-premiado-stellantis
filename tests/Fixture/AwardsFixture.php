<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * AwardsFixture
 */
class AwardsFixture extends TestFixture
{
    /**
     * Init method
     *
     * @return void
     */
    public function init(): void
    {
        $this->records = [
            [
                'id' => 1,
                'name' => 'Lorem ipsum dolor sit amet',
                'description' => 'Lorem ipsum dolor sit amet',
                'sweepstake_id' => 1,
                'active' => 1,
                'quantity' => 1,
                'balance' => 1,
                'spaces' => 1,
                'image' => 'Lorem ipsum dolor sit amet',
                'created' => '2024-07-12 17:00:35',
                'modified' => '2024-07-12 17:00:35',
            ],
        ];
        parent::init();
    }
}
