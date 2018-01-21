<?php

/**
 * Created by PhpStorm.
 * User: tong.dv
 * Date: 19/01/2018
 * Time: 23:16
 */
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

        if(empty($key)){
            throw new \GeoCode\Exception\GeocodeException('Null key google api');
        }

        $googlePlacesApiParams = [
            'location' => 'location=' . urlencode($location),
            'type' => 'type=' . urlencode($type),
            'radius' => 'radius=' . urlencode($radius),
            'key' => 'key=' . $key
        ];
        // Optional parameters
        if(isset($keyword)){
            $googlePlacesApiParams['keyword'] = 'keyword=' . $keyword;
        }

        try {
            $data = json_decode(file_get_contents($googlePlacesApiUrl . join('&', $googlePlacesApiParams)), true);

            if (!empty($data['results'])) {
                foreach ($data['results'] as $item) {
                    $transformedResult = $this->transformer->transform($item);
                    if (!empty($transformedResult))
                        $result[] = $transformedResult;
                }
            }
        } catch (\Exception $exception) {
            $result = [];
        }

        return $result;
    }
}