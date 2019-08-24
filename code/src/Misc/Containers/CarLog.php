<?php
/**
 * Created by PhpStorm.
 * User: aryanpc
 * Date: 8/24/19
 * Time: 9:58 AM
 */

namespace App\Misc\Containers;


class CarLog
{

    /**
     * @var string $id
     */
    private $id;
    /**
     * @var string $lat
     */
    private $lat;
    /**
     * @var string $lng
     */
    private $lng;

    /**
     * CarLog constructor.
     * @param string $id
     * @param string $lat
     * @param string $lng
     */
    public function __construct(string $id, string $lat, string $lng)
    {
        $this->id = $id;
        $this->lat = $lat;
        $this->lng = $lng;
    }

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getLat(): string
    {
        return $this->lat;
    }

    /**
     * @return string
     */
    public function getLng(): string
    {
        return $this->lng;
    }



}