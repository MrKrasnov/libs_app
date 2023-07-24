<?php

namespace app\components\helpers;

class ArrayHelper
{
    /**
     * @param array $firstArray
     * @param array $secondArray
     * @param string $keyName
     * @return array|null
     */
    public function removeDublicateValuesFromArrays(array $firstArray, array $secondArray, string $keyName) : ?array
    {
        $valuesToRemove = [];
        foreach ($secondArray as $item) {
            if (isset($item[$keyName])) {
                $valuesToRemove[] = $item[$keyName];
            }
        }

        $indexesToRemove = [];

        foreach ($valuesToRemove as $value) {
            foreach ($firstArray as $index => $item) {
                if (isset($item[$keyName]) && $item[$keyName] === $value) {
                    $indexesToRemove[] = $index;
                }
            }
        }

        foreach ($indexesToRemove as $index) {
            unset($firstArray[$index]);
        }

        return array_values($firstArray);
    }
}