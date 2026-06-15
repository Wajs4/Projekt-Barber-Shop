<?php
namespace App\Models;

class Booking
{
    private $id;
    private $name;
    private $phone;
    private $date;
    private $time;
    private $branch;
    private $people;
    private $message;

    public function __construct($id = null, $name = '', $phone = '', $date = '', $time = '', $branch = '', $people = 1, $message = '')
    {
        $this->id = $id;
        $this->name = $name;
        $this->phone = $phone;
        $this->date = $date;
        $this->time = $time;
        $this->branch = $branch;
        $this->people = (int)$people;
        $this->message = $message;
    }

    public function getId() { return $this->id; }
    public function getName() { return $this->name; }
    public function getPhone() { return $this->phone; }
    public function getDate() { return $this->date; }
    public function getTime() { return $this->time; }
    public function getBranch() { return $this->branch; }
    public function getPeople() { return $this->people; }
    public function getMessage() { return $this->message; }
}

// Backwards-compatibility alias
if (!class_exists('Booking')) {
    class_alias(__NAMESPACE__ . '\\Booking', 'Booking');
}

?>
