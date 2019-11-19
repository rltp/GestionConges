<?php

    function create_calendar($month,$year,$dateArray) {

        // Create array containing abbreviations of days of week.
        $daysOfWeek = array('Lundi','Mardi','Mercredi','Jeudi','Vendredi','Samedi','Dimanche');
        $monthOfYear = array("Janvier", "Février", "Mars", "Avril", "Mai", "Juin", "Juillet", "Août", "Septembre", "Octobre", "Novembre", "Décembre");

        // What is the first day of the month in question?
        $firstDayOfMonth = mktime(0,0,0,$month,1,$year);

        // How many days does this month contain?
        $numberDays = date('t',$firstDayOfMonth);

        // Retrieve some information about the first day of the
        // month in question.
        $dateComponents = getdate($firstDayOfMonth);

        // What is the name of the month in question?
        $monthName = $monthOfYear[$month-1];

        // What is the index value (0-6) of the first day of the
        // month in question.
        $dayOfWeek = $dateComponents['wday']-1;

        // Create the table tag opener and day headers

        $calendar = "<table class='calendar'>";
        $calendar .= "<caption>$monthName $year</caption>";
        $calendar .= "<caption>
                        <a href='/gestionConges/liste/".((($month%12-1))? $year : $year-1)."/".(($month%12 -1) ? $month -1 : 12)."'> ← </a>
                        <a href='/gestionConges/liste/".(($month%12)? $year : $year+1)."/".(($month%12)+1)."'> → </a>
                    </caption>";
        $calendar .= "<tr>";

        // Create the calendar headers

        foreach($daysOfWeek as $day) {
            $calendar .= "<th class='header'>$day</th>";
        } 

        // Create the rest of the calendar

        // Initiate the day counter, starting with the 1st.

        $currentDay = 1;

        $calendar .= "</tr><tr>";

        // The variable $dayOfWeek is used to
        // ensure that the calendar
        // display consists of exactly 7 columns.

        if ($dayOfWeek > 0) { 
            $calendar .= "<td colspan='$dayOfWeek'>&nbsp;</td>"; 
        }
        
        $month = str_pad($month, 2, "0", STR_PAD_LEFT);
    
        while ($currentDay <= $numberDays) {

            // Seventh column (Saturday) reached. Start a new row.

            if ($dayOfWeek == 7) {

                $dayOfWeek = 0;
                $calendar .= "</tr><tr>";

            }
            
            $currentDayRel = str_pad($currentDay, 2, "0", STR_PAD_LEFT);
            
            $date = "$currentDayRel-$month-$year";
            if(isset($dateArray[$date])){
                $event = $dateArray[$date];
                switch($event[1]){
                    case 0: $class = "await"; break;
                    case 1: $class = "denied"; break;
                    case 2: $class = "allowed"; break;
                    default: $class = ""; break;
                }
                $calendar .= "<td class='day {$class}' rel='$date'><h3>$currentDay</h3><label>{$event[0]}</label></td>";
            } else
                $calendar .= "<td class='day' rel='$date'><h3>$currentDay</h3></td>";
            

            // Increment counters

            $currentDay++;
            $dayOfWeek++;

        }
        
        // Complete the row of the last week in month, if necessary

        if ($dayOfWeek != 7) { 
        
            $remainingDays = 7 - $dayOfWeek;
            $calendar .= "<td colspan='$remainingDays'>&nbsp;</td>"; 

        }
        
        $calendar .= "</tr>";

        $calendar .= "</table>";

        return $calendar;

    }
    $dateComponents = getdate();
    $year = (empty($parameter)) ? $dateComponents['year'] : intval($parameter); 			     
    $month = (empty($route[3])) ? $dateComponents['mon'] : intval($route[3]);

    $conges = getCongeFromSalaried($_SESSION['id']);
    $arrayDate = array();
    if(!empty($conges)) foreach($conges as $key => $conge) foreach($dates = date_range($conge['start'], $conge['end'], '+1 day') as $d) $arrayDate[$d] = array($conge['type'], $conge['status']);

    echo create_calendar($month,$year,$arrayDate);
?> 