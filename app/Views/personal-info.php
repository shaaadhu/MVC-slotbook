<div class="tab-pane fixed-tab-content fade show active" id="personal-info">
            <div class="card p-4">
              <h4 class="mb-5 fw-semibold">Personal Information</h4>
              <form id="personalForm">
                
                  <div id="emailBookedError" class="alert alert-warning text-center" style="display:none;">
                    <i class="bi bi-exclamation-diamond"></i>
                  This email already has a booking.
                  </div>
                <div class="row justify-content-around">
                  <div class="mb-4 col-md-6">
                    <label class="form-label">Name</label>
                    <input type="text" class="form-control" id="name" required>
                  </div>     
                  <div class="mb-4 col-md-6">
                  <label class="form-label">Email</label>
                  <input 
                    type="email" 
                    class="form-control" 
                    id="emailInput" 
                    placeholder="example@yenepoya.edu.in" 
                    required
                    pattern="[a-zA-Z0-9._%+-]+@yenepoya\.edu\.in$"
                  >
                  <span id="email-feedback"></span>
                

                  <div id="emailFormatError" class="text-danger mt-1" style="display:none;">
                  Please enter a valid email @yenepoya.edu.in.
                  </div>


                  </div>
                </div>
                
                <div class="row justify-content-around">
                    <div class="mb-3 col-md-6">
                    <label class="form-label">Phone Number</label>
                    <input type="text" class="form-control" id="phone" required>
                  </div>
                <div class="mb-4 col-md-6">
                  <label class="form-label">Department</label>
                  <select class="form-select" id="department" required>
                    <option value="">Select Department</option>
                    <option>Information Technology</option>
                    <option>Computer Science</option>
                    <option>Electronics & Communication</option>
                    <option>Mechanical Engineering</option>
                    <option>Civil Engineering</option>
                  </select>
                </div>
                </div>

                <div class="mb-4">
                  <label class="form-label">Designation</label>
                  <select class="form-select" id="design" required>
                    <option value="">Select Designation</option>
                    <option>Professor</option>
                    <option>Staff</option>
                    <option>Student</option>
                    <option>Intern</option>
                    <option>other</option>
                  </select>
                </div>
                

                <button type="submit" class="btn btn-primary float-end fw-semibold mb-5 pb-1" id="continue">Continue</button>
              </form>
            </div>
          </div>