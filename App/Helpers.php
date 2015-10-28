<?php
/**
 * Helper methods
 */
 
 if (! function_exists('createRolesListing')) {
        /**
         * Sort the selected films people into their retrospective roles
         * @param Array $people
         */
         function createRolesListing($people){
                $actors = [];
                $directors = [];
                $producers = [];
                foreach ($people as $person) {
                    if ($person->getRole() ==='Actor') {$actors[] = $person->getName();}
                    if ($person->getRole() ==='Director') {$directors[] = $person->getName();}
                    if ($person->getRole() ==='Producer') {$producers[] = $person->getName();}
                }
                return [
                    'actors' => $actors,
                    'directors' => $directors,
                    'producers' => $producers
                ];
         }
 }


 if (! function_exists('sortShowDateTimes')) {

        function sortShowDateTimes($dates){
                $sorted_dates = [];
                $sorted_times = [];
                foreach ($dates as $date) {
                    $readable_date = $date->getStartDate()->format('l jS \of F Y');
                    //-- if date is already set then just add times to that date.
                    if(in_array($readable_date, $date)){
                        $sorted_dates[$readable_date][] = $date->getStartDate()->format('H:i:');
                    } else {
                        $sorted_dates[] = $date->getStartDate()->format('l jS \of F Y');
                        $sorted_dates[$readable_date][] = $date->getStartDate()->format('H:i:');
                    }
                }
        
            return $sorted_dates;
        }

 }

 if (! function_exists('logErrors')) {
        /**
         * a simple visual output of any exceptions called 
         * how you want to do it is up to you though
         * @param   $message 
         */
        function logErrors($message){
            $_SESSION['errors'] = $message;
            header ('Location: ../Examples/errors.php'); 
        }

 }