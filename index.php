<?php

class Calendar
{
    private $year;
    
    function __construct()
    {
    }
    
    public function setYear($year)
    {
        $this->year = $year;
    }
    
    public function getCalendarHTML()
    {
        return $this->createCalendarHTML();
    }
    
    private function monthDays($month)
    {
        return (int) date("t", strtotime($this->year . "-" . $month . "-01"));
    }
    
    private function monthStartAtWeekDay($month)
    {
        return (int) date("N", strtotime($this->year . "-" . $month . "-01"));
    }
    
    private function weekDayName($weekDayNumber)
    {
        $wDayNames = array(
            "Mon",
            "Tue",
            "Wed",
            "Thu",
            "Fri",
            "Sat",
            "Sun"
        );
        return $wDayNames[$weekDayNumber];
    }
    
    private function createCalendarHTML()
    {
        $outputHtml = "<table>";
        for ($month = 1; $month <= 12; $month++) {
            $currMonthDays = $this->monthDays($month);
            $weekDayStart  = $this->monthStartAtWeekDay($month);
            $mday          = 0;
            
            for ($mr = 0; $mr <= 5; $mr++) {
                if ($mr == 0) {
                    $outputHtml .= "<tr>";
                    for ($wd = 0; $wd <= 6; $wd++) {
                        $outputHtml .= "<td align=center>";
                        $outputHtml .= $this->weekDayName($wd);
                        $outputHtml .= "</td>";
                    }
                    $outputHtml .= "</tr>";
                }
                
                $outputHtml .= "<tr>";
                for ($wd = 1; $wd <= 7; $wd++) {
                    $outputHtml .= "<td align=center>";
                    if ($mday < $currMonthDays && ($mday > 0 || $wd == $weekDayStart)) {
                        $mday++;
                        $outputHtml .= $mday;
                    }
                    $outputHtml .= "</td>";
                }
                $outputHtml .= "</tr>";
            }
        }
        $outputHtml .= "</table>";
        return $outputHtml;
    }
    
}

$calendar = new Calendar();
$calendar->setYear(2017);
echo $calendar->getCalendarHTML();
