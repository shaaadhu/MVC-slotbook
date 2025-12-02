<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <title>Slot Booking App</title>

 
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
     <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
  
  <link rel="stylesheet" href="<?=ROOT?>/css/style.css">
  
</head>
<body>
 
  <div class="container ">

   <div class="row justify-content-center  d-flex py-5  overflow-hidden">

    <?php include __DIR__ . '/leftbar.php'; ?>

      <div class="col-md-8 col-lg-7 content">
        <div class="tab-content ">

          
        <?php include __DIR__ . '/personal-info.php'; ?> 

        <?php include __DIR__ . '/slot-booking.php'; ?>

        <?php include __DIR__ . '/confirm-booking.php'; ?> 

        <?php include __DIR__ . '/success.php'; ?> 

          

        </div>
      </div>
</div>
    
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

  
  <script src="<?=ROOT?>/js/script.js"></script>

  

</body>
</html>