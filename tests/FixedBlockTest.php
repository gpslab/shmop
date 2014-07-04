<?php
/**
 * Shmop package
 *
 * @package   AnimeDb
 * @author    Peter Gribanov <info@peter-gribanov.ru>
 * @copyright Copyright (c) 2014, Peter Gribanov
 * @license   http://opensource.org/licenses/MIT
 */

namespace AnimeDb\Shmop\Tests;

use AnimeDb\Shmop\FixedBlock;

/**
 * Test shmop block fixed size
 *
 * @package AnimeDb\Shmop\Tests
 * @author  Peter Gribanov <info@peter-gribanov.ru>
 */
class FixedBlockTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Shmop id
     *
     * @var integer
     */
    const SHMOP_ID = 0xFF;

    /**
     * (non-PHPdoc)
     * @see PHPUnit_Framework_TestCase::tearDown()
     */
    protected function tearDown()
    {
        if ($shmid = @shmop_open(self::SHMOP_ID, 'w', 0644, 0)) {
            shmop_delete($shmid);
            shmop_close($shmid);
        }
    }

    /**
     * Test read and write
     */
    public function testReadAndWrite()
    {
        $sh = $this->getShmop();
        $this->assertTrue($sh->write('foo'));
        $this->assertEquals('foo', $sh->read());
    }

    /**
     * Test read empty data
     */
    public function testReadEmpty()
    {
        $this->assertEmpty($this->getShmop()->read());
    }

    /**
     * Test sync data
     */
    public function testSync()
    {
        $sh = $this->getShmop();
        $sh->write('foo');
        unset($sh);

        // new object
        $this->assertEquals('foo', $this->getShmop()->read());
    }

    /**
     * Test delete data
     */
    public function testDelete()
    {
        $sh = $this->getShmop();
        $sh->write('foo');
        $sh->delete();
        unset($sh);

        // new object
        $this->assertEmpty($this->getShmop()->read());
    }

    /**
     * Get shmop
     *
     * @return \AnimeDb\Shmop
     */
    protected function getShmop()
    {
        return new FixedBlock(self::SHMOP_ID, 3);
    }
}