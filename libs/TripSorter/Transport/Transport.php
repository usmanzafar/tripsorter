<?php

namespace TripSorter\Transport;

use TripSorter\Exception\TransportTypeInvalid;
use TripSorter\Helpers\Helper;

class Transport implements TransportInterface {

    private $name;
    private $id;
    private $method;

    /*
     * Sets the name of the transport
     * @param string
     * @throws TransportTypeInvalid if $name is null
     */
    public function setName($name)
    {
        if ( empty($name) ) {
            throw new TransportTypeInvalid("Invalid Name for the transport");
        }

        $this->name = $name;
    }

    public function getName()
    {
        return $this->name;
    }


    public function setId($id=null)
    {
        if(is_null($id))
            $id = Helper::generateID();
        $this->id = $id;

    }

    public function getId()
    {
        return $this->id;
    }

    public function setMethod($method){
        switch($method){
            case TransportInterface::METHOD_AIR:
            case TransportInterface::METHOD_RAIL:
            case TransportInterface::METHOD_ROAD:
            case TransportInterface::METHOD_WATER:
                return $this->method = $method;
            break;

            default:
                throw new TransportTypeInvalid("Not a Valid method!");
            break;
        }
        return $this;

    }

    public function getMethod(){
        return $this->method;
    }


}
