<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\SweepstakesTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\SweepstakesTable Test Case
 */
class SweepstakesTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\SweepstakesTable
     */
    protected $Sweepstakes;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected $fixtures = [
        'app.Sweepstakes',
        'app.Awards',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('Sweepstakes') ? [] : ['className' => SweepstakesTable::class];
        $this->Sweepstakes = $this->getTableLocator()->get('Sweepstakes', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->Sweepstakes);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\SweepstakesTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
