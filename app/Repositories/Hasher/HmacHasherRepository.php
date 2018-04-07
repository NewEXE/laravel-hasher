<?php
/**
 * Created by PhpStorm.
 * User: newexe
 * Date: 07.04.18
 * Time: 20:25
 */

namespace App\Repositories\Hasher;
use App\Exceptions\Hasher\AlgorithmNotImplementedException;
use App\Exceptions\Hasher\BadParamPassedException;

/**
 * Class HmacHasherRepository
 * @package App\Repositories\HmacHasher
 */
class HmacHasherRepository implements HasherRepositoryInterface
{
    /**
     * @var array
     */
    private $hashes;

    /**
     * @var string Shared secret key used for generating the HMAC variant of the message digest
     */
    private $hmacKey;

    /**
     * @var string
     */
    private $rowsPrefix;

    /**
     * HmacHasherRepository constructor.
     */
    public function __construct()
    {
        $this->hashes = [];
        $this->hmacKey = config('hasher.hmac_key');
        $this->rowsPrefix = config('hasher.hmac_table_rows_prefix');
    }


    public function encode(string $string, $algos = null)
    {
        $availableAlgos = $this->getAllAvailableAlgos();
        $passedAlgos = [];

        if (!$algos)
        {
            $passedAlgos = $availableAlgos;
        }
        elseif (is_array($algos))
        {
            $passedAlgos = $algos;
        }
        elseif (is_string($algos))
        {
            $passedAlgos[] = $algos;
        }
        else
        {
            throw new BadParamPassedException('Bad parameter passed');
        }

        foreach ($passedAlgos as $algo)
        {
            if (in_array($algo, $availableAlgos))
            {
                $hash = $this->_encodeString($string, $algo);
                $this->hashes[$algo] = $hash;
            }
            else throw new AlgorithmNotImplementedException('Algorithm not exists!');
        }

    }

    /**
     * @return array
     */
    public function getEncoded()
    {
        return $this->hashes;
    }

    /**
     * @return array
     */
    public function getAllAvailableAlgos()
    {
        return hash_hmac_algos();
    }

    /**
     * @return string
     */
    public function getRowsPrefix()
    {
        return $this->rowsPrefix;
    }

    /**
     *
     */
    public function saveEncoded()
    {

    }

    private function _encodeString(string $string, string $algo)
    {
        return hash_hmac($algo, $string, $this->hmacKey);
    }
}