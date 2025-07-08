<?php

//step 1

// Collecting data from the form of index.php using  oop class inheritance
class Student {
    private $id;
    private $name;
    private $course;
    private $phone;
 
    private static $file_path = "store.txt"; // File path to store student data

    // Constructor
    function  __construct($_id, $_name, $_course, $_phone) {
        $this->id = $_id;
        $this->name = $_name;
        $this->course = $_course;
        $this->phone = $_phone;
    }

    // Convert to CSV format
    public function collect() {
        return $this->id . "\n" . $this->name . "\n" . $this->course . "\n" . $this->phone . PHP_EOL;  // End Of Line
    }

    // Save to file
    public function store() {
        file_put_contents(self::$file_path, $this->collect(), FILE_APPEND);
    }
}


//display_students function

public static function display_students(){
        $students=file(self::$file_path);
        echo "<b>ID | Name | COURSE | PHONE</b><br/>";
        foreach($students as $student){
       list($id,$name,$course,$phone)=explode(",",trim($student));
       echo "$id | $name | $course | $phone<br/>";
       
        }
    
        
}  
 
?>




  