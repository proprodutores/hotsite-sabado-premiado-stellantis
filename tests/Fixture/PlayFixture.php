<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * PlayFixture
 */
class PlayFixture extends TestFixture
{
    /**
     * Table name
     *
     * @var string
     */
    public $table = 'play';
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
                'drawn_position' => 'Lorem ipsum dolor sit amet',
                'award_id' => 1,
                'user_id' => 1,
                'created' => '2024-07-12 13:48:56',
                'modified' => '2024-07-12 13:48:56',
            ],
        ];
        parent::init();
    }
}
