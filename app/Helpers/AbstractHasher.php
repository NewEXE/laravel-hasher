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
     * @param $text
     * @param null $algos
     * @return bool
     */
    public function encode($text, $algos = null)
    {
        return $this->repository->encode($text, $algos);
    }

    /**
     * @param $texts
     * @param $algos
     * @return bool
     */
    public function encodeMany($texts, $algos)
    {
        return $this->repository->encodeMany($texts, $algos);
    }

    /**
     * @return array
     */
    public function getEncoded()
    {
        return $this->repository->getEncoded();
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