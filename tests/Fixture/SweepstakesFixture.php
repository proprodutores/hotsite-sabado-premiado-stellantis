<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * SweepstakesFixture
 */
class SweepstakesFixture extends TestFixture
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
                'description' => 'Lorem ipsum dolor sit amet',
                'date_start' => '2024-07-12 14:11:21',
                'date_end' => '2024-07-12 14:11:21',
                'spaces' => 1,
                'active' => 1,
                'created' => '2024-07-12 14:11:21',
                'modified' => '2024-07-12 14:11:21',
            ],
        ];
        parent::init();
    }
}
