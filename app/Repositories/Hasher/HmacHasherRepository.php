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


    /**
     * @param string $string
     * @param null $algos
     * @return bool
     * @throws AlgorithmNotImplementedException
     * @throws BadParamPassedException
     */
    public function encode(string $string, $algos = null): bool
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

        return true;

    }

    /**
     * @return array
     */
    public function getEncoded(): array
    {
        return $this->hashes;
    }

    /**
     * @return array
     */
    public function getAllAvailableAlgos(): array
    {
        return hash_hmac_algos();
    }

    /**
     * @return string
     */
    public function getRowsPrefix(): string
    {
        return $this->rowsPrefix;
    }

    /**
     * @return bool
     */
    public function saveEncoded(): bool
    {
        return true;
    }

    private function _encodeString(string $string, string $algo)
    {
        return hash_hmac($algo, $string, $this->hmacKey);
    }
}