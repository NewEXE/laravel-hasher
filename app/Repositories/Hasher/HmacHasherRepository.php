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
use App\Models\HashAlgorithm;
use App\Models\User;
use App\Models\Vocabulary;
use Illuminate\Support\Collection;

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
     * @param $user
     * @param Vocabulary $item
     * @param null $algos
     * @param null $availableAlgos
     * @return bool
     * @throws AlgorithmNotImplementedException
     * @throws BadParamPassedException
     */
    public function encode($user, $item, $algos = null, $availableAlgos = null): bool
    {
        if (!$availableAlgos) $availableAlgos = $this->getAllAvailableAlgos();

        $passedAlgos = collect();

        if (!$algos)
        {
            $passedAlgos = $availableAlgos;
        }
        elseif ($algos instanceof Collection)
        {
            $passedAlgos = $algos;
        }
        elseif (is_string($algos))
        {
            $algo = HashAlgorithm::where('name', $this->getRowsPrefix() . $algos)->firstOrFail();
            $passedAlgos->put($algo->id, $algo);
        }
        else
        {
            throw new BadParamPassedException('Bad parameter passed');
        }

        foreach ($passedAlgos as $algo)
        {
            if ($availableAlgos->contains($algo))
            {
                $hash = $this->_encodeString($item->word, $algo->name);
                $this->hashes[] = [
                    'word_id' => $item->id,
                    'hash_algorithm_id' => $algo->id,
                    'user_id' => $user->id,
                    'hash' => $hash,
                    'hash_algorithm_key' => $this->hmacKey
                ];
            }
            else throw new AlgorithmNotImplementedException('Algorithm not exists!');
        }

        return true;
    }

    /**
     * @param Collection $items
     * @param Collection|null $algos
     * @return bool
     * @throws AlgorithmNotImplementedException
     * @throws BadParamPassedException
     */
    public function encodeMany($user, $items, $algos = null): bool
    {
        dd($user, $items, $algos);

        $availableAlgos = $this->getAllAvailableAlgos();

        foreach ($items as $item)
        {
            $this->encode($user, $item, $algos, $availableAlgos);
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
     * @param bool $fromDb
     * @return Collection|array
     */
    public function getAllAvailableAlgos($fromDb = true)
    {
        if ($fromDb)
        {
            /** @var Collection $hmacAlgos */
            $hmacAlgos = HashAlgorithm::hmac()->get(['id', 'name'])->keyBy('id');
        }
        else
        {
            /** @var array $hmacAlgos */
            $hmacAlgos = hash_hmac_algos();

            foreach ($hmacAlgos as &$algo)
            {
                $algo = $this->getRowsPrefix() . $algo;
            }
            unset($algo);
        }

        return $hmacAlgos;
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

    /**
     * @param string $string
     * @param string $algo
     * @return string
     */
    private function _encodeString(string $string, $algo)
    {
        $prefixLength = strlen($this->getRowsPrefix());
        $algo = substr($algo, $prefixLength);
        return hash_hmac($algo, $string, $this->hmacKey);
    }
}