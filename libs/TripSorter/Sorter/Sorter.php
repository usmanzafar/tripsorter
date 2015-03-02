<?php

namespace TripSorter\Sorter; 
use TripSorter\Exception\ArrayInvalid;
use TripSorter\Ticket\Ticket;

class Sorter {
    private $startPoint;
    private $endPoint;
    private $currentPoint;
    private $ticket_unsorted;
    private $ticket_sorted;

    private $destinations;
    private $sources;

    /*
     * Takes the array of tickets of ticket objects type and does all
     * the basic calculations for the array to be sorted
     * @param array $tickets
     *
     * @return void
     */
    public function __construct($tickets)
    {

        //Ensuring that Tickets are what we need
        if (!is_array($tickets)) {
            throw new ArrayInvalid('Not a valid array');
        }
        if (empty($tickets)) {
            throw new ArrayInvalid('Tickets cannot be empty in order to be processed');
        }
        if (count($tickets) <= 1) {
            throw new ArrayInvalid('Collection array must have at least 2 tickets');
        }
        $this->validateTickets($tickets);


        $this->ticket_unsorted = $tickets;
        $this->init();

    }

    /*
     * Ensures that array has valid tickets of Ticket type
     * @param array $tickets
     * @throws ArrayInvalid if the value is not array of valid ticket type objects
     * @returns void
     */
    protected function validateTickets($tickets)
    {
        foreach ($tickets as $ticket) {
            if ($ticket instanceof Ticket) {
                continue;
            } else {
                throw new ArrayInvalid('Cannot contain non-Ticket object');
            }
        }
    }

    /*
     * initiates and prepares the data to be sorted
     * @throws ArrayInvalid if the value is not array of valid ticket type objects
     * @returns avoid
     */
    protected function init()
    {
        $this->ticket_sorted = array();
        $this->getDestinations();
        $this->getSources();
        $this->startPoint = $this->getStartPoint();
        $this->endPoint = $this->getEndPoint();

        //the first time the startpoint and currentPosition will be same
        $this->currentPoint = $this->startPoint;
    }

    /*
     * Retrieves the list of destinations in unsorted tickets array
     */
    protected function getDestinations()
    {
        foreach ($this->ticket_unsorted as $ticket) {
            $this->destinations[] = $ticket->getDestination();
        }
        return $this->destinations;
    }

    /*
     * Retrieves the list of sources in unsorted tickets array
     */
    protected function getSources()
    {
        foreach ($this->ticket_unsorted as $ticket) {
            $this->sources[] = $ticket->getSource();
        }
    }

    /*
     * returns the very first journey start point aka source
     * @returns array
     */
    protected function getStartPoint()
    {
        foreach ($this->sources as $source) {
            if (!in_array($source, $this->destinations)) {
                return $source;
            }
        }

    }

    /*
     * returns the very last journey end point aka destination
     */
    protected function getEndPoint()
    {
        foreach ($this->destinations as $destination) {
            if (!in_array($destination, $this->sources)) {
                return $destination;
            }
        }

    }

    /*
     * heart of the sorted class, this sorts the array based on the source and
     * destination. It iterates tickets array till the current point is found
     * in the source, if done then iteration moves to the next array making the destination
     * of current route as starting point of currentPoint
     */
    protected function sort()
    {

        while (true) {
            foreach ($this->ticket_unsorted as $key => $ticket) {
                if ($this->currentPoint == $ticket->getSource()) {
                    $this->ticket_sorted[] = $ticket;
                    $this->currentPoint = $ticket->getDestination();
                    unset($this->ticket_unsorted[$key]);//removing the ticket
                }// end of if
            }//end for each

            if ($this->currentPoint == $this->endPoint) //if its the last ticket
            {
                break;
            }
        }

    }

    /*
     * Returns the sorted array of tickets
     * @returns array
     */
    public function getSorted()
    {
        $this->sort();
        return $this->ticket_sorted;
    }

    /*
     * Spits out all the elements in the processing of sorting tickets array
     */
    public function debug()
    {
        echo "<pre>";

        echo '<br />-------Tickets-------<br />';
        print_r($this->ticket_unsorted);
        echo '<br />-------Destinations-------<br />';
        print_r($this->destinations);
        echo '<br />-------Sources-------<br />';
        print_r($this->sources);

        echo '<br />-------Start Point-------<br />';
        echo($this->startPoint);

        echo '<br />-------End point-------<br />';
        echo($this->endPoint);

        echo "</pre>";

    }

}
