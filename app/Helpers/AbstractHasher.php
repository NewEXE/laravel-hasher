<?php
/**
 * Created by PhpStorm.
 * User: newexe
 * Date: 07.04.18
 * Time: 23:24
 */

namespace App\Helpers;
use App\Repositories\Hasher\HasherRepositoryInterface;

/**
 * Class AbstractHasher
 * @package App\Helpers
 */
abstract class AbstractHasher
{
    /**
     * @var HasherRepositoryInterface
     */
    protected $repository;

    /**
     * AbstractHasher constructor.
     * @param HasherRepositoryInterface $hasherRepository
     */
    public function __construct(HasherRepositoryInterface $hasherRepository)
    {
        $this->repository = $hasherRepository;
    }

    /**
     * @param $user
     * @param $text
     * @param null $algos
     * @param $availableAlgos
     * @return bool
     */
    public function encode($user, $text, $algos, $availableAlgos)
    {
        return $this->repository->encode($user, $text, $algos, $availableAlgos);
    }

    /**
     * @param $user
     * @param $strings
     * @param $algos
     * @return bool
     */
    public function encodeMany($user, $strings, $algos)
    {
        return $this->repository->encodeMany($user, $strings, $algos);
    }

    /**
     * @return array
     */
    public function getEncoded()
    {
        return $this->repository->getEncoded();
    }

    /**
     * @return bool
     */
    public function saveEncoded(): bool
    {
        return $this->repository->saveEncoded();
    }

    /**
     * @return array
     */
    public function getAllAvailableAlgos()
    {
        return $this->repository->getAllAvailableAlgos();
    }

    /**
     * @return string
     */
    public function getRowsPrefix()
    {
        return $this->repository->getRowsPrefix();
    }
}