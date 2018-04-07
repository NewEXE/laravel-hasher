<?php
/**
 * Created by PhpStorm.
 * User: newexe
 * Date: 07.04.18
 * Time: 20:05
 */

namespace App\Helpers;
use App\Repositories\Hasher\HasherRepositoryInterface;

/**
 * Class HmacHasher
 * @package App\Helpers
 */
class HmacHasher extends AbstractHasher
{
    public function __construct(HasherRepositoryInterface $repository)
    {
        parent::__construct($repository);
    }

}