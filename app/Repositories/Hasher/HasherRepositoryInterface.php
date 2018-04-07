<?php
/**
 * Created by PhpStorm.
 * User: newexe
 * Date: 07.04.18
 * Time: 20:25
 */

namespace App\Repositories\Hasher;

/**
 * Interface HasherRepositoryInterface
 * @package App\Repositories\HmacHasher
 */
interface HasherRepositoryInterface
{
    /**
     * @param string $text
     * @param null $algos
     * @return mixed
     */
    public function encode(string $text, $algos = null);

    /**
     * @return array
     */
    public function getEncoded();

    /**
     * @return mixed
     */
    public function saveEncoded();

    /**
     * @return array
     */
    public function getAllAvailableAlgos();

    /**
     * @return string
     */
    public function getRowsPrefix();

}