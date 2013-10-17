<?php
/**
 * Created by Thibaud BARDIN (Irvyne)
 * This code is under the MIT License (https://github.com/Irvyne/license/blob/master/MIT.md)
 */

abstract class BaseHydrate
{
    protected function hydrate($array) {
        foreach ($array as $attribute => $value) {
            $method = 'set'.ucfirst($attribute);
            if (method_exists($this, $method)) {
                $this->$method($value);
            } else {
                throw new BadMethodCallException(sprintf(
                    'Attribute "%s" or method "%s" does not exists',
                    $attribute, $method
                ));
            }
        }
    }
}