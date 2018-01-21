<?php

namespace GeoCode\Transform;
/**
 * Created by PhpStorm.
 * User: tong.dv
 * Date: 1/21/2018
 * Time: 11:58 AM
 */

class TransformDefault extends TransformAbstract
{
    protected $filable = [
        'id',
        'primary',
        'zip_code',
        'district',
        'state_province',
        'country',
        'street',
        'lat',
        'lon',
        'phone_number',
        'name',
        'picture',
        'type'
    ];
}