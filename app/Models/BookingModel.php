<?php
require_once __DIR__ . '/../config.php';
class BookingModel{

     private function connect(){

        $string = 'mysql:hostname=' . DB_HOST . ';dbname=' . DB_NAME;
        $con= new PDO($string,DB_USER,DB_PASS);
        return $con;
    }

public function showslot(){
    // echo"hello";
    // $con=$this->connect();
    // $name="shaaaadhu";
    // $email="kkkkk@yenopoya.edu.in";
    // $department="Civil Engineering";
    // $date = date('Y-m-d');
    // $time_slot="16:00";



    //    $this->booked($name,$email,$department,$date,$time_slot);

    
}

// public function view($con){
//     $sql="select * from bookings";
//     $stmt = $con->prepare($sql);
//    $stmt->execute();
//     $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
//     print_r($results);

// }


public function findEmail($email) {
     $sql="SELECT id FROM bookings WHERE email = :email";
      $stmt = $this->connect()->prepare($sql);
      $stmt->bindValue(':email', $email);
      $stmt->execute();
  
    if ($stmt->rowCount() > 0) {
        return true; 
       
    } else {
        return false;
        
    }
}

public function findSlotsByDate($date){

    $slots = ["09:00","10:00","11:00","12:00","13:00","14:00","15:00","16:00"];
        $availability = [];

        foreach ($slots as $slot) {
            $stmt = $this->connect()->prepare("SELECT COUNT(*) FROM bookings WHERE date = :date AND time_slot = :slot");
            $stmt->bindParam(':date', $date);
            $stmt->bindParam(':slot', $slot);
            $stmt->execute();
            $count = $stmt->fetchColumn();
            $availability[$slot] = (int)$count;
        }
        return $availability;
        // print_r($availability);
        
}

public function booked($name,$email,$department,$date,$time_slot){

    $stmt = $this->connect()->prepare("SELECT id FROM bookings WHERE email = :email");
    $stmt->bindParam(':email', $email);
    $stmt->execute();
    if ($stmt->rowCount() > 0) {
        return ["status"=>"error","message"=>"This email has already booked a slot and cannot book again."];
        exit;
    }
    
    $stmt = $this->connect()->prepare("SELECT COUNT(*) FROM bookings WHERE date = :date AND time_slot = :time_slot");
    $stmt->bindParam(':date', $date);
    $stmt->bindParam(':time_slot', $time_slot);
    $stmt->execute();
    $count = $stmt->fetchColumn();

    if ($count >= 5) {
        
        return ["status"=>"error","message"=>"This slot is full (5/5 bookings)."];
       
        exit;
    }

    $sql="INSERT INTO bookings (name, email, department, date, time_slot) VALUES (:name, :email, :department, :date, :time_slot)";
    $insert = $this->connect()->prepare($sql);
    $params = [
        ':name'      => $name,
        ':email'      => $email,
        ':department' => $department,
        ':date'      => $date,
        ':time_slot' => $time_slot
    ];
    if ($insert->execute($params)) {
        return ["status"=>"success","message"=>"Booking confirmed successfully!"];
       
    } else {
    
        return ["status"=>"error","message"=>"Failed to save booking."];
       

    
    }

}
}