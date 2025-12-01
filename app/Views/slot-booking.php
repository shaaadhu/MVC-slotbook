<div class="tab-pane fade " id="slot-booking">
            <div class="card p-4">
              <h4 class="mb-4 fw-semibold ">Session Booking</h4>
              

            
            <form id="slotForm" >
                <div class="mb-3">
                
                  <label class="form-label fw-semibold">Date Selection</label>
                  <input type="date" class="form-control" id="slotDate" required>
                </div>

              <div class="mb-3">
                          <label class="form-label fw-semibold">Select Session</label>

                          <p class="my-2">Each session is 1 hour.You can select only 1 session.</p>

                          
                          
              
                <div style="max-height: 200px; overflow-y: auto; padding: 10px; border: 2px solid #afafafff; border-radius: 8px;">

                  <div class="form-check py-2 px-5 rounded-3 border border-light mt-1 cbox">
                      <input class="form-check-input slot-checkbox" type="checkbox" name="timeSlot" value="09:00" id="slot1">
                      <label class="form-check-label" for="slot1">09:00 AM - 10:00 AM</label>
                  </div> 

                  <div class="form-check py-2 px-5 rounded-3 border border-light mt-1 cbox">
                      <input class="form-check-input slot-checkbox" type="checkbox" name="timeSlot" value="10:00" id="slot2">
                      <label class="form-check-label" for="slot2">10:00 AM - 11:00 AM</label>
                  </div>

                  <div class="form-check py-2 px-5 rounded-3 border border-light mt-1 cbox">
                      <input class="form-check-input slot-checkbox" type="checkbox" name="timeSlot" value="11:00" id="slot3">
                      <label class="form-check-label" for="slot3">11:00 AM - 12:00 PM</label>
                  </div>

                  <div class="form-check py-2 px-5 rounded-3 border border-light mt-1 cbox">
                      <input class="form-check-input slot-checkbox" type="checkbox" name="timeSlot" value="12:00" id="slot4">
                      <label class="form-check-label" for="slot4">12:00 PM - 01:00 PM</label>
                  </div>

                  <div class="form-check py-2 px-5 rounded-3 border border-light mt-1 cbox">
                      <input class="form-check-input slot-checkbox" type="checkbox" name="timeSlot" value="13:00" id="slot5">
                      <label class="form-check-label" for="slot5">01:00 PM - 02:00 PM</label>
                  </div>

                  <div class="form-check py-2 px-5 rounded-3 border border-light mt-1 cbox">
                      <input class="form-check-input slot-checkbox" type="checkbox" name="timeSlot" value="14:00" id="slot6">
                      <label class="form-check-label" for="slot6">02:00 PM - 03:00 PM</label>
                  </div>

                  <div class="form-check py-2 px-5 rounded-3 border border-light mt-1 cbox">
                      <input class="form-check-input slot-checkbox" type="checkbox" name="timeSlot" value="15:00" id="slot7">
                      <label class="form-check-label" for="slot7">03:00 PM - 04:00 PM</label>
                  </div>

                  <div class="form-check py-2 px-5 rounded-3 border border-light mt-1 cbox">
                      <input class="form-check-input slot-checkbox" type="checkbox" name="timeSlot" value="16:00" id="slot8">
                      <label class="form-check-label" for="slot8">04:00 PM - 05:00 PM</label>
                  </div>

                </div>


              </div>

                <div class="mb-3">
                
                  <label class="form-label fw-semibold">Reason</label>
                  <textarea class="form-control" aria-label="With textarea" id="reason" required></textarea>
                </div>

    
                <div class="mb-3 ">
                  <button type="cancel" class="btn btn-light float-start">back</button>
                    <button type="submit" class="btn btn-primary float-end"fw-semibold>Continue</button>
                    
                </div>
                
            </form>
            </div>
</div>