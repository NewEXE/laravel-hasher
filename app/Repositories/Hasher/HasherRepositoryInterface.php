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
    public function encode(string $text, $algos = null): bool;

    /**
     * @return array
     */
    public function getEncoded(): array;

    /**
     * @return bool
     */
    public function saveEncoded(): bool;

    /**
     * @return array
     */
    public function getAllAvailableAlgos(): array;

    /**
     * @return string
     */
    public function getRowsPrefix(): string;

}