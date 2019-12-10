<?php

namespace TomHart\Utilities;

class ArrayUtil
{


    /**
     * Given an array of strings, look in the class, or $data for a matching property/key.
     * Can also supply nested properties using ->, e.g. parent->name
     * @param string[] $params
     * @param mixed $model
     * @param mixed[] $data
     * @return mixed[]
     */
    public static function populateArrayFromObject(array $params, $model, array $data = [])
    {

        $return = [];
        foreach ($params as $name) {
            if (isset($data[$name])) {
                $return[$name] = $data[$name];
                continue;
            }
            $root = $model;
            // Split the name on -> so we can set URL parts from relationships.
            $exploded = explode('->', $name);
            // Remove the last one, this is the attribute we actually want to get.
            $last = array_pop($exploded);
            // Change the $root to be whatever relationship in necessary.
            foreach ($exploded as $part) {
                $root = $root->$part;
            }

            if ($last && (property_exists($root, $last) || (method_exists($root, '__get') && $root->$last))) {
                // Get the value.
                $return[$name] = $root->$last;
                continue;
            }

            $return[$name] = null;
        }

        return $return;
    }
}
