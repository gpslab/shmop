<?php
/**
 * Shmop package.
 *
 * @author    Peter Gribanov <info@peter-gribanov.ru>
 * @copyright Copyright (c) 2014, Peter Gribanov
 * @license   http://opensource.org/licenses/MIT
 */
namespace AnimeDb\Shmop;

class FixedBlock
{
    /**
     * Default permission (octal) that will be used in created memory blocks.
     *
     * @var int
     */
    const DEFAULT_PERMISSION = 0644;

    /**
     * Shared memory block id returned by shmop_open.
     *
     * @var int
     */
    protected $shmid;

    /**
     * Shared memory block instantiation.
     *
     * In the constructor we'll check if the block we're going to manipulate
     * already exists or needs to be created. If it exists, let's open it.
     *
     * @param string $id
     * @param int $size
     * @param int $perms
     */
    public function __construct($id, $size, $perms = self::DEFAULT_PERMISSION)
    {
        if ($this->exists($id)) {
            $this->shmid = shmop_open($id, 'w', $perms, $size);
        } else {
            $this->shmid = shmop_open($id, 'c', $perms, $size);
        }
    }

    /**
     * Checks if a shared memory block with the provided id exists or not.
     *
     * @param string $id
     *
     * @return bool
     */
    public function exists($id)
    {
        return (bool) @shmop_open($id, 'a', 0, 0);
    }

    /**
     * Writes on a shared memory block.
     *
     * @param string $data
     *
     * @return bool
     */
    public function write($data)
    {
        return shmop_write($this->shmid, $data, 0) !== false;
    }

    /**
     * Reads from a shared memory block.
     *
     * @return string
     */
    public function read()
    {
        return trim(shmop_read($this->shmid, 0, shmop_size($this->shmid)));
    }

    /**
     * Mark a shared memory block for deletion.
     *
     * @return bool
     */
    public function delete()
    {
        /*
         * Bug fix
         * @link https://bugs.php.net/bug.php?id=71921
         */
        shmop_write($this->shmid, str_pad('', shmop_size($this->shmid), ' '), 0);

        return shmop_delete($this->shmid);
    }

    /**
     * Closes the shared memory block and stops manipulation.
     */
    public function __destruct()
    {
        shmop_close($this->shmid);
    }
}
