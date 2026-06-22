<?php

class Film {
    public String $title;
    public String $director;
    public int $durationInMinutes;
    public int $ageRestriction;

    public function getDurationAsString() : String {
        $hours = intdiv($this->durationInMinutes, 60);
        $minutes = $this->durationInMinutes % 60;
        $durationAsString = "{$hours}h {$minutes}m";
        return $durationAsString;
    }
    public function isGoodForAge(int $leeftijd) : bool {
        return $leeftijd >= $this->ageRestriction;
    }
    public function getSummary() : String {
        return "{$this->title} - {$this->director} - {$this->getDurationAsString()} - {$this->ageRestriction}";
    }

}

class Room {
    public int $roomNumber;
    public int $amountOfSeats;
    public bool $isIMAX;

    public function getRoomName() : String {
        //Geef de naam van de zaal, bijv "Room 3", en check IMAX
        if ($this->isIMAX) {
            $RoomName =  "IMAX Room {$this->roomNumber}";
        } else {
            $RoomName = "Room {$this->roomNumber}";
        }
        return $RoomName;
    }
}

class Show {
    public Film $film;
    public Room $room;
    public String $date;
    public String $time;
    public float $ticketprice;
    private array $tickets = [];

    public function sellTicket(String $name) : Ticket {
        //check free seats, give ticket to a named person
        if ($this->isFull()) {
            throw new Exception("Error, Room is full");
        } else {
            $this->tickets[] = new Ticket($name);
        }
    }
    public function getFreeSeats() : int {
        sizeof($this->tickets);
    }
    public function isFull() : bool {


    }
    public function getEarnings() : float {

    }
    public function getTicketAmount() : int {

    }

}

$Beekeeper = new Film();

$Beekeeper->title = "The Beekeeper";
$Beekeeper->director = "Jason Statham";
$Beekeeper->durationInMinutes = 108;
$Beekeeper->ageRestriction = 16;

$imax1 = new Room();

$imax1->roomNumber = 1;
$imax1->amountOfSeats = 50;
$imax1->isIMAX = true;

echo $imax1->getRoomName();
echo "<br>";
echo $Beekeeper->getSummary();



