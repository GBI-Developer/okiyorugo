<?php
namespace App\Test\TestCase\Shell\Task;

use App\Shell\Task\GetAnalyticsReportTask;
use Cake\TestSuite\TestCase;

/**
 * App\Shell\Task\GetAnalyticsReportTask Test Case
 */
class GetAnalyticsReportTaskTest extends TestCase
{
    /**
     * ConsoleIo mock
     *
     * @var \Cake\Console\ConsoleIo|\PHPUnit_Framework_MockObject_MockObject
     */
    public $io;

    /**
     * Test subject
     *
     * @var \App\Shell\Task\GetAnalyticsReportTask
     */
    public $GetAnalyticsReport;

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $this->io = $this->getMockBuilder('Cake\Console\ConsoleIo')->getMock();
        $this->GetAnalyticsReport = new GetAnalyticsReportTask($this->io);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->GetAnalyticsReport);

        parent::tearDown();
    }

    /**
     * Test getOptionParser method
     *
     * @return void
     */
    public function testGetOptionParser()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test main method
     *
     * @return void
     */
    public function testMain()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
