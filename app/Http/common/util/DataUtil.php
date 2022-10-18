<?php

namespace App\Http\common\util;

trait DataUtil
{

    /**
     * Check if request has data return it otherwise return null.
     *
     * @param object $attributes
     * @param String $property
     * @return mixed
     */
    public function isExists(array $attributes, string $property)
    {
        if (property_exists((object)$attributes, $property))
            return $attributes[$property];
        return $attributes[$property] ?? null;
    }

    public function isNotEmpty(array $data, string $property): bool
    {
        return property_exists((object)$data, $property) && $data[$property] != "" && $data[$property] != null;
    }

    public function isNullOrEmpty(array $data, string $property): bool
    {
        return property_exists((object)$data, $property) && ($data[$property] == "" || $data[$property] == null);
    }

    public function unsetNullOrEmptyProperties(array &$data, array $properties = [])
    {
        foreach ($properties as $property) if ($this->isNullOrEmpty($data, $property)) unset($data[$property]);
    }

}
