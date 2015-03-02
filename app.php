<?php
use TripSorter\Exception\TransportTypeInvalid;
use TripSorter\Helpers\Helper;

require ( __DIR__.'/libs/autoload.php');


$transport_bus = new TripSorter\Transport\Transport();
$transport_air = new TripSorter\Transport\Transport();
$transport_rail = new TripSorter\Transport\Transport();
$ticketA = new TripSorter\Ticket\Ticket();
$ticketB = new TripSorter\Ticket\Ticket();
$ticketC = new TripSorter\Ticket\Ticket();
$ticketD = new TripSorter\Ticket\Ticket();


    try{

        //Setting Transport Type
        $transport_bus->setName('RTA Bus');
        $transport_bus->setId('8A');
        $transport_bus->setMethod(\TripSorter\Transport\TransportInterface::METHOD_ROAD);

        $transport_air->setName('Fly Dubai');
        $transport_air->setId('A88');
        $transport_air->setMethod(\TripSorter\Transport\TransportInterface::METHOD_AIR);

        $transport_rail->setName('RTA Rail');
        $transport_rail->setId('DRB0');
        $transport_rail->setMethod(\TripSorter\Transport\TransportInterface::METHOD_RAIL);

        //Setting Tickets now

        $ticketA->setId(Helper::generateAlphaNumericString(5));
        $ticketA->setSource('Dubai');
        $ticketA->setDestination('Sharjah');
        $ticketA->setSeatNo('A201422');
        $ticketA->setTransport($transport_bus);

        $ticketB->setId(Helper::generateAlphaNumericString(5));
        $ticketB->setSource('Abu Dhabi');
        $ticketB->setDestination('Ajman');
        $ticketB->setSeatNo('B401433');
        $ticketB->setTransport($transport_bus);

        $ticketC->setId(Helper::generateAlphaNumericString(5));
        $ticketC->setSource('Sharjah');
        $ticketC->setDestination('Abu Dhabi');
        $ticketC->setSeatNo('C4X211');
        $ticketC->setTransport($transport_air);

        $ticketD->setId(Helper::generateAlphaNumericString(5));
        $ticketD->setSource('Ajman');
        $ticketD->setDestination('Al Ain');
        $ticketD->setSeatNo('C4X211');
        $ticketD->setTransport($transport_rail);


            //Passing on arrays can be in any order
        $array = array($ticketD,$ticketA,$ticketB,$ticketC);

        $final_tickets = new TripSorter\Sorter\Sorter($array);


        //$final_tickets->debug();
        $tickets = $final_tickets->getSorted();

    }
    catch (TransportTypeInvalid $ex){
        echo $ex->getMessage();
    }

?>
<html>
<head>
    <title>This is the Test</title>
</head>
<body>
<h2>Raw Tickets Collection</h2>
<ol style="text-transform: capitalize;color: #666;font-size:14px;font-family: Arial;padding:25px 50px;">
    <?php


        foreach($array as $ticket){
            echo '<li> From '.$ticket->getSource(). ' go to '.$ticket->getDestination().' . ';
            echo 'Sit in '.$ticket->getSeatNo().' of '.$ticket->getTransport()->getName().' - '.$ticket->getTransport()->getId(). ' that travels via '.$ticket->getTransport()->getMethod();
            echo '</li>';

        }

    ?>
</ol>

<h2>Sorted Tickets Collection [Solution]</h2>

<ol style="text-transform: capitalize;color: #666;font-size:14px;font-family: Arial;padding:25px 50px;">
<?php


    foreach($tickets as $ticket){
        echo '<li> From '.$ticket->getSource(). ' go to '.$ticket->getDestination().' . ';
        echo 'Sit in '.$ticket->getSeatNo().' of '.$ticket->getTransport()->getName().' - '.$ticket->getTransport()->getId(). ' that travels via '.$ticket->getTransport()->getMethod();
        echo '</li>';

    }

?>
</ol>

</body>
</html>
