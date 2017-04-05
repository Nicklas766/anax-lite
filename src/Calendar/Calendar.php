<?php

namespace nicklas\Calendar;

class Calendar
{
    private $days = ["Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday", "Sunday"];
    private $year;
    private $month;
    private $numDays;

    private $currentDay;

    // Set all current date details
    public function __construct()
    {
        // Set general year
        $this->year = date("Y");

        // Get and set month and number of days in month
        $this->month = date("m");
        $this->numDays = cal_days_in_month(CAL_GREGORIAN, $this->month, 2017);

        // Get and set current day
        $this->currentDay = date('d');
    }

    public function showCal()
    {
        //cleanse current day
        $this->currentDay = date('d');


        if ($this->year . "-" . $this->month != date("Y") . "-" . date("m") && $this->year . "-0" . $this->month != date("Y") . "-" . date("m")) {
            $this->currentDay = 1337;
        }
        // Get monthname
        $monthName = date("F", mktime(0, 0, 0, $this->month, 1, $this->year));
        echo "<center><h1>";
        echo $monthName. " ";
        echo $this->year;
        echo "</h1></center>";
        // start with making div for the calendar
        echo "<div class='calendar-container'>";
        // start with making div for the calendar
        echo "<div class='calendar'>";
        $this->setDayNameDivs();
        $this->setDayDivs();
        $this->lastDivs();
        echo "</div>";
        // Image based on months name
        echo "<img src='img/calendar/$monthName.jpg' alt='No image found' style='height:608px; width:286px;'>";
        echo "</div>";
    }
    /**
     * Starts the session if not exists
     * @return void
     */
    public function setDayNameDivs()
    {

        foreach ($this->days as $day) {
            echo "<div class='calendar-day-name'>$day</div>";
        }
    }
    public function setDayDivs()
    {

        $date = date(''.$this->year.'-'."$this->month".'-1');
        $day = date('l', strtotime($date)); // Get first day of month


        // create empty divs based on the index of $this->days array, compared to first day of month
        $index = array_search($day, $this->days);

        // get numbers for previous months days
        if ($this->month == 1) {
            $previousDays = cal_days_in_month(CAL_GREGORIAN, 12, $this->year -1);
            $previousDays -= $index - 1;
        } else {
            $previousDays = cal_days_in_month(CAL_GREGORIAN, $this->month - 1, $this->year);
            $previousDays -= $index - 1;
        }

        for ($i = 1; $i <= $index; $i++) {
            echo "<div class='calendar-empty'>$previousDays</div>";
             $previousDays++;
        }

        // use index from day array and first day of month to create empty divs
        for ($i = 1; $i <= $this->numDays; $i++) {
            // if current day give green div
            if ($i == $this->currentDay) {
                echo "<div class='calendar-day' style='background:green; border: solid 1px black;'>";
            }
            // if sunday give red color
            if (date('l', strtotime(date(''.$this->year.'-'.$this->month.'-' . strval($i)))) == "Sunday" && $i != $this->currentDay) {
                echo "<div class='calendar-day' style='color:red; border: solid 1px red;'>";
            } // else create normal div
            elseif ($i != $this->currentDay) {
                echo "<div class='calendar-day'>";
            }
             echo "$i</div>";
        }
    }

    public function lastDivs()
    {
        $date = date(''.$this->year.'-'."$this->month".'-1');
        $day = date('l', strtotime($date)); // Get first day of month
        $index = array_search($day, $this->days);

        // count width makes sure all grey divs are sufficient
        $countWidth = ($index + $this->numDays) * 100;

        // CONTROL WIDTH
        // Control $countWidth to make sure div is fully with potential empty divs
        $countNextDays = 0;
        if ($countWidth < 3500) {
            while ($countWidth < 3500) {
                $countNextDays++;
                echo "<div class='calendar-empty'>$countNextDays</div>";
                $countWidth += 100;
            }
        }
        // Control $countWidth to make sure div is fully with potential empty divs
        if ($countWidth < 4200 && $countWidth != 3500) {
            if ($countWidth == 3500) {
                $countWidth = 4300;
            }
            while ($countWidth < 4200) {
                $countNextDays++;
                echo "<div class='calendar-empty'>$countNextDays</div>";
                $countWidth += 100;
            }
        }
    }

    public function nextMonth()
    {
        if ($this->month == 12) {
            $this->year++;
            $this->month = 1;
        } else {
            $this->month++;
        }
        $this->numDays = cal_days_in_month(CAL_GREGORIAN, $this->month, $this->year);
    }

    public function previousMonth()
    {
        if ($this->month == 1) {
            $this->year--;
            $this->month = 12;
        } else {
            $this->month--;
        }
        $this->numDays = cal_days_in_month(CAL_GREGORIAN, $this->month, $this->year);
    }
}
