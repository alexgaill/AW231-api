<?php
namespace Core\Traits;

trait DataSecureTrait {
    use DefaultTrait;

    /**
     * Encode les données reçues pour éviter l'injection de script
     *
     * @param array $data
     * @return array
     */
    public function verifyData(array $data): array
    {
        foreach ($data as $key => $value) {
            $data[$key] = htmlspecialchars($value);
        }
        return $data;
    }
}