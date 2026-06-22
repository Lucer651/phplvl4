<?php

class Student
{
    public int $studentNummer;
    public string $name;
    public string $cohort;
    public DateTime $dateOfBirth;

    function __construct(string $name, int $studentNummer, string $cohort, DateTime $dateOfBirth)
    {
        $this->name = $name;
        $this->studentNummer = $studentNummer;
        $this->cohort = $cohort;
        $this->dateOfBirth = $dateOfBirth;
    }
    function GetAge()
    {
        $getAge = date_diff($this->dateOfBirth, new DateTime);
        return $getAge->y;
    }
}



$jesse = new Student('Jesse', 606111, '4S5A', new DateTime('2007-12-24'));
echo 'Age: ' . $jesse->GetAge();
?>