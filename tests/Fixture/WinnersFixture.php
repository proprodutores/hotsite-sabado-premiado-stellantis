<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * WinnersFixture
 */
class WinnersFixture extends TestFixture
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
                'sapid' => 'Lorem ipsum dolor sit amet',
                'phone' => 'Lorem ipsum dolor sit amet',
                'shift' => 'Lorem ipsum dolor sit amet',
                'user_id' => 1,
                'created' => '2024-08-21 09:24:31',
                'modified' => '2024-08-21 09:24:31',
            ],
        ];
        parent::init();
    }
}
