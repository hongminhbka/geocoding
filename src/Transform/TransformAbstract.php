<?php

namespace GeoCode\Transform;
/**
 * Created by PhpStorm.
 * User: tong.dv
 * Date: 1/21/2018
 * Time: 10:11 AM
 */

abstract class TransformAbstract
{
    /**
     * @var array
     */
    protected $filable;

    /**
     * @param array $filable
     */
    public function setFilable($filable)
    {
        $this->filable = $filable;
    }
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