<?php
/**
 * Created by PhpStorm.
 * User: newexe
 * Date: 07.04.18
 * Time: 20:25
 */

namespace App\Repositories\Hasher;
use Illuminate\Support\Collection;

/**
 * Interface HasherRepositoryInterface
 * @package App\Repositories\HmacHasher
 */
interface HasherRepositoryInterface
{
    /**
     * @param $user
     * @param mixed $text
     * @param Collection $algos
     * @param Collection $availableAlgos
     * @return mixed
     */
    public function encode($user, $text, $algos, $availableAlgos): bool;

    /**
     * @param $user
     * @param mixed $strings
     * @param mixed|null $algos
     * @return bool
     */
    public function encodeMany($user, $strings, $algos): bool;

    /**
     * @return array
     */
    public function getEncoded(): array;

    /**
     * @return bool
     */
    public function saveEncoded(): bool;

    /**
     * @return mixed
     */
    public function getAllAvailableAlgos();

    /**
     * @return string
     */
    public function getRowsPrefix(): string;

}