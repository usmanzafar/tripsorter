<?php
namespace TripSorter\Ticket; 

use TripSorter\Exception\TicketTypeInvalid;
use TripSorter\Exception\TransportTypeInvalid;
use TripSorter\Transport\Transport;
use TripSorter\Helpers\Helper;

class Ticket implements TicketInterface {

    private $id;
    private $source;
    private $destination;
    private $seat_no;
    private $transport;

    /*
     * Sets the id
     * @param int $id
     * @returns void
     */
    public function setId($id = null)
    {
        if (is_null($id)) {
            $id = Helper::generateID();
        }

        $this->id = $id;

    }

    public function getId()
    {
        return $this->id;
    }

    /*
     * Sets the source
     * @param int $source
     * @throws TicketTypeInvalid if source is empty
     * @returns void
     */
    public function setSource($source)
    {
        if (is_null($source)) {
            throw new TicketTypeInvalid("Source cannot be empty");
        }

        $this->source = $source;
    }

    /*
     * Gets the source
     * @returns string
     */
    public function getSource()
    {
        return $this->source;
    }

    /*
     * Sets the destination
     * @param int $destination
     * @throws TicketTypeInvalid if destination is empty
     * @returns void
     */
    public function setDestination($destination)
    {
        if (is_null($destination)) {
            throw new TicketTypeInvalid("Destination cannot be empty");
        }

        $this->destination = $destination;
    }

    /*
     * returns the destination
     * @returns string
     */
    public function getDestination()
    {
        return $this->destination;
    }

    /*
     * sets the seat
     * @param string $seat_no
     * @returns void
     */
    public function setSeatNo($seat_no)
    {
        $this->seat_no = $seat_no;
    }

    /*
     * gets the seat no
     * @returns string
     */
    public function getSeatNo()
    {
        return $this->seat_no;
    }

    /*
     * Sets the transport method of the ticket
     * @param object $transport
     * @returns void
     */
    public function setTransport($transport)
    {
        if ($transport instanceof Transport) {
            $this->transport = $transport;
        } else {
            throw new TransportTypeInvalid("Invalid Transport object passed");
        }
    }

    /*
     * gets the transport
     * @returns string
     */
    public function getTransport()
    {
        return $this->transport;
    }
}
