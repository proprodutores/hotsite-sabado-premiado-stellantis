<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\AwardsTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\AwardsTable Test Case
 */
class AwardsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\AwardsTable
     */
    protected $Awards;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected $fixtures = [
        'app.Awards',
        'app.Sweepstakes',
        'app.Play',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('Awards') ? [] : ['className' => AwardsTable::class];
        $this->Awards = $this->getTableLocator()->get('Awards', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->Awards);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\AwardsTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     * @uses \App\Model\Table\AwardsTable::buildRules()
     */
    public function testBuildRules(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
