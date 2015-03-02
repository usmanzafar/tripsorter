<?php
namespace TripSorter\Helpers; 

class Helper {

    /*
     * Generates the ID based on the criteria set
     * @returns string|integer
     */
    public static function generateID($type='alphanumeric',$limit=5)
    {
        switch($type){
            case 'alphanumeric':
                return self::generateAlphaNumericString($limit);
            break;
            case 'integer':
                return rand(250000,60000);
            break;
        }
    }

    /*
     * Generates the alphanumeric characters based on the limit set
     * @param int $limit
     * @returns string alphanumeric
     */
    public static function generateAlphaNumericString($limit=5){
        $list = 'abcdefghijklmnopqrstuvwxyz0123456789';
        $alphanumeric = '';
        for ($i = 0; $i < $limit; $i++) {
            $alphanumeric .= $list[rand(0, strlen($list) - 1)];
        }
        return $alphanumeric;
    }
}
