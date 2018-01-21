<?php
/**
 * Created by PhpStorm.
 * User: tong.dv
 * Date: 1/21/2018
 * Time: 10:11 AM
 */

abstract class TransformAbstract
{
    /**
     * @param array $attribute
     *
     * @return array
     */
    public function transform(array $attribute)
    {
        return [];
    }
}