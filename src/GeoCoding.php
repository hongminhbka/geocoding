<?php

namespace GeoCode;

/**
 * Created by PhpStorm.
 * User: tong.dv
 * Date: 19/01/2018
 * Time: 23:16
 */

use GeoCode\Exception\GeocodeException;
use GeoCode\Transform\TransformAbstract;
use GeoCode\Transform\TransformDefault;

class GeoCoding
{
    /** @var TransformAbstract */
    protected $transformer;

    /**
     * Search by type use google api
     *
     * @param $location
     * @param $type
     * @param $radius
     * @param null $keyword
     * @return array
     * @throws \GeoCode\Exception\GeocodeException
     */
    public function searchByType($location, $type, $radius, $keyword = null)
    {
        $result = array();

        $googlePlacesApiUrl = 'https://maps.googleapis.com/maps/api/place/nearbysearch/json?';

        $key = config('geocode.google-key.place');

        if (empty($key)) {
            throw new GeocodeException('Null key google api');
        }

        $googlePlacesApiParams = [
            'location' => 'location=' . urlencode($location),
            'type' => 'type=' . urlencode($type),
            'radius' => 'radius=' . urlencode($radius),
            'key' => 'key=' . $key
        ];
        // Optional parameters
        if (isset($keyword)) {
            $googlePlacesApiParams['keyword'] = 'keyword=' . $keyword;
        }

        try {
            $data = json_decode(file_get_contents($googlePlacesApiUrl . join('&', $googlePlacesApiParams)), true);

            if (!empty($data['results'])) {
                foreach ($data['results'] as $item) {
                    $transformedResult = $this->getTransformer()
                        ->transform($item);
                    if (!empty($transformedResult))
                        $result[] = $transformedResult;
                }
            }
        } catch (\Exception $exception) {
            throw new GeocodeException($exception->getMessage());
        }

        return $result;
    }

    /**
     * @return TransformAbstract
     */
    public function getTransformer()
    {
        if (empty($this->transformer)) {
            $this->transformer = new TransformDefault();
        };

        return $this->transformer;
    }

    /**
     * @param TransformAbstract $transformer
     */
    public function setTransformer($transformer)
    {
        $this->transformer = $transformer;
    }
}