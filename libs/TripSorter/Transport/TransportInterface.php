<?php

namespace TripSorter\Transport; 


interface TransportInterface {
    const METHOD_AIR = 'air';
    const METHOD_WATER = 'water';
    const METHOD_ROAD = 'road';
    const METHOD_RAIL = 'rail';

public function getName();
public function setName($input);
public function setID($id);
public function getId();
public function setMethod($method);
public function getMethod();
}
