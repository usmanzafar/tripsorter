<?php
require_once(dirname(__FILE__) . '/simpletest/autorun.php');
    require ( '../libs/autoload.php');

class TestOfTransport extends UnitTestCase{
    function TestofSettingNullAsTransportName(){
        $transport = new TripSorter\Transport\Transport();
        $this->expectException();
        $transport->setName(null);
    }
    function TestofSettingEmptyStringAsTransportName(){
        $transport = new TripSorter\Transport\Transport();
        $this->expectException();
        $transport->setName('');
    }
    function TestofSettingQualifiedNameAsTransportName(){
        $transport = new TripSorter\Transport\Transport();
        $this->assertNull($transport->setName('RTA Bus'));
        $this->assertTrue($transport->getName());
    }
    function TestofSettingInvalidMethodAsTransportMethod(){
        $transport = new TripSorter\Transport\Transport();
        $this->expectException(new TripSorter\Exception\TransportTypeInvalid('Not a Valid method!'));
        $transport->setMethod('ballon');
    }

    function TestofSettingValidMethodAsTransportMethod(){
        $transport = new TripSorter\Transport\Transport();
        $this->assertTrue($transport->setMethod(\TripSorter\Transport\TransportInterface::METHOD_RAIL));
        $this->assertEqual($transport->getMethod(),\TripSorter\Transport\TransportInterface::METHOD_RAIL);

    }

}
