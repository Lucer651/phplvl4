<?php
//oop opdracht

 class Student {

    public int $studentNumber;
    public String $studentName;
    public String $cohort;
    public DateTime $dateOfBirth;
    public int $length;

    //method
    public function getAge() : int{
        $currentDate = new DateTime();

        $difference = $currentDate->diff($this->dateOfBirth);
        $currentYear = $difference->y;
        return $currentYear;
    }
 }

 $jannes = new Student();

 $jannes->studentNumber = 606111;
 $jannes->studentName = "Yannick";
 $jannes->$cohort = "C25";
 $jannes->$dateOfBirth = 12-12-2007;
 $jannes->$length = 165;

 var_dumb($jannes);