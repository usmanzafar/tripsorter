<?php

namespace TripSorter\Ticket; 


interface TicketInterface {
    public function setId($id);
    public function getId();
    public function setSource($source);
    public function getSource();
    public function setDestination($destination);
    public function getDestination();
    public function setSeatNo($seatNo);
    public function getSeatNo();
    public function setTransport($transport);
    public function getTransport();

}
