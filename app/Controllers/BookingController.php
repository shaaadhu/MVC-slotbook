<?php
require_once __DIR__ . '/../Models/BookingModel.php';
class BookingController {

public function showSlot() {

require_once __DIR__ . '/../Views/layout.php';

}

public function checkEmail() {
  
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        $email = $_POST['email'] ?? '';
        $model=new BookingModel;    
        $emailExists = $model->findEmail($email);
        header('Content-Type: application/json');
        if ($emailExists) {        
            echo json_encode(['status' => 'error']);
        } else {            
            echo json_encode(['status' => 'success']);
        }
        exit;
    }
}

public function getSlots(){

    if ($_SERVER['REQUEST_METHOD'] === 'GET'){
        $date = $_GET['date'] ?? '';
         $model=new BookingModel;  
        $availabilityData = $model->findSlotsByDate($date);
        $response = [
            'status' => 'success',
            'message' => 'Slot data loaded successfully.',
            'data' => $availabilityData
        ];
        header('Content-Type: application/json');
        echo json_encode( $response);
        exit;
        
    }

}

public function bookSlot(){
     if ($_SERVER['REQUEST_METHOD'] === 'POST'){
        $name = trim($_POST['name'] );
        $email = trim($_POST['email'] );
        $department = trim($_POST['department'] );
        $date = trim($_POST['date'] );
        $time_slot = trim($_POST['time_slot'] );
        $model=new BookingModel;   
        $booked = $model->booked($name,$email,$department,$date,$time_slot);
         header('Content-Type: application/json');        
        echo json_encode($booked);
        exit;
     }

}

}




