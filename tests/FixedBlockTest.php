<?php
/**
 * Shmop package.
 *
 * @author    Peter Gribanov <info@peter-gribanov.ru>
 * @copyright Copyright (c) 2014, Peter Gribanov
 * @license   http://opensource.org/licenses/MIT
 */

namespace AnimeDb\Shmop\Tests;

use AnimeDb\Shmop\FixedBlock;

class FixedBlockTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var int
     */
    const SHMOP_ID = 0xFF;

    /**
     * @var string
     */
    const WORD = 'foo';

    /**
     * @var FixedBlock
     */
    protected $fb;

    protected function setUp()
    {
        $this->fb = new FixedBlock(self::SHMOP_ID, strlen(self::WORD));
    }

    protected function tearDown()
    {
        if ($shmid = @shmop_open(self::SHMOP_ID, 'w', 0644, 0)) {
            /*
             * Fill memory block for fix bug
             * @link https://bugs.php.net/bug.php?id=71921
             */
            shmop_write($shmid, str_pad('', strlen(self::WORD), ' '), 0);
            shmop_delete($shmid);
            shmop_close($shmid);
        }
    }

    public function testReadAndWrite()
    {
        $this->assertTrue($this->fb->write(self::WORD));
        $this->assertEquals(self::WORD, $this->fb->read());
    }

    public function testReadEmpty()
    {
        $this->assertEmpty($this->fb->read());
    }

    public function testSync()
    {
        $this->fb->write(self::WORD);
        $this->fb = null;

        // new object
        $fb = new FixedBlock(self::SHMOP_ID, 3);
        $this->assertEquals(self::WORD, $fb->read());
    }

    public function testDelete()
    {
        $this->fb->write(self::WORD);
        $this->assertTrue($this->fb->delete());
        $this->fb = null;

        // new object
        $fb = new FixedBlock(self::SHMOP_ID, 3);
        $this->assertEmpty($fb->read());
    }
}
