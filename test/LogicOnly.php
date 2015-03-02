<?php
/*
 * This is a logic only, it is used to test the logic and make a method that does the
 * sort tasks, it does not use anything related to TDD
 * This file was more of a like a rough book to see and play around with sorting
 * Note: Sending this as a reference as its the basis of Sorter Logic
 *
 */

    $tickets[0] = array(
        'source' => "dubai",
        'dest' => "shj",
        'id'=> 'ticket 1'
    );
    $tickets[1] = array(
        'source' => "abudhabi",
        'dest' => "ajman",
        'id' => 'ticket 2'
    );
    $tickets[2] = array(
        'source' => "ajman",
        'dest' => "fujairah",
        'id'=> 'ticket 4'
    );
    $tickets[3] = array(
        'source' => "shj",
        'dest' => "abudhabi",
        'id'=> 'ticket 3'
    );

// 0, 2 ,1, 3


    //get the start
    //get the end
    //set the current as start
    //-------------
    // Start looking from the current destination and match with each source
    // as while loop and keep unsetting if found one - use temp array

    $startPoint = '';
    $endpoint =  '';
    $orderTickets = array();

    foreach ($tickets as $ticket){
        $source[] = $ticket['source'];
        $destination[] =  $ticket['dest'];
    }
    //print_r($source);print_r($destination);

    //Get the start point
    foreach($source as $src){
        if(!in_array($src,$destination)){
            $startPoint = $src;
        }
    }

    //Get the endpoint
    foreach($destination as $dest){
        if(!in_array($dest,$source)){
            $endpoint =  $dest;
        }
    }

    $currentPlace = $startPoint;

    $counter = 1;
    //Do the sorting
    while (true){
        //run the for loop to check the current point with other journeys
        foreach($tickets as $key=>$value){
            if($currentPlace ==  $value['source']){
                $orderTickets[] = $tickets[$key];

                $currentPlace = $value['dest'];
                unset($tickets[$key]);
            }

        }
        $counter +=1;
        echo "Executed".$counter."<br>";


        if ($currentPlace==$endpoint){
            echo $value['dest'].'----'.$endpoint."<br />";
            break;
        }





    }
    print_r($orderTickets);





    die();
