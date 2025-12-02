const slotDateInput = document.getElementById('slotDate');


const navLinks = document.querySelectorAll('.sidebar .nav-link');
const tabs = document.querySelectorAll('.tab-pane');

const emailInput = document.getElementById('emailInput');
const emailFormatError = document.getElementById("emailFormatError");
const emailBookedError1 = document.getElementById("emailBookedError1");
let emailFormatValid = false;  
let emailBooked = false; 
const emailPattern = /^[a-zA-Z0-9._%+-]+@yenepoya\.edu\.in$/;


function showTab(tabId) {
  tabs.forEach(t => t.classList.remove('show','active'));
  navLinks.forEach(l => l.classList.remove('active'));
  document.getElementById(tabId).classList.add('show','active');
  document.querySelector(`.nav-link[data-tab="${tabId}"]`).classList.add('active');
}

function markTabCompleted(tabId) {
  const tabLink = document.querySelector(`.nav-link[data-tab="${tabId}"]`);
  if (tabLink) tabLink.classList.add('completed');
}

function setMinDate(){
  const today = new Date();
  const yyyy = today.getFullYear();
  const mm = String(today.getMonth()+1).padStart(2,'0');
  const dd = String(today.getDate()).padStart(2,'0');
  slotDateInput.value= `${yyyy}-${mm}-${dd}`;
  slotDateInput.min= `${yyyy}-${mm}-${dd}`;
}

// function disablePastSlotsIfToday() {
//   const selectedDateValue = slotDateInput.value;
//   // if (!selectedDateValue) return;
//   // const now = new Date();
//   const selected = new Date(selectedDateValue);
//   // const isToday = selected.getFullYear() === now.getFullYear()
//   //              && selected.getMonth() === now.getMonth()
//   //              && selected.getDate() === now.getDate();
//   const currentMinutes = selectedDateValue.getHours()*60 + selectedDateValue.getMinutes();

  
//    document.querySelectorAll(".slot-checkbox").forEach(cb => {
//     const label = cb.nextElementSibling; 
//     cb.disabled = false;
//     label.style.color = "black";

//     // Remove expired text if added before
//     // label.textContent = label.textContent.replace(" (Expired)", "");
//     label.textContent = `${label.textContent.split(" (")[0]} (Session Expired)`;
//     const [hour, minute] = cb.value.split(":").map(Number);
//       const slotStartMin = hour * 60 + minute;

//       if (currentMinutes >= slotStartMin) {
//         cb.disabled = true;
//         label.textContent += " (Session Expired)";
//         label.style.color = "#999";
//       }

//     // if (isToday) {
      
//     // }
//   });
// }

function fetchAndUpdateSlots(dateStr) {
  


  fetch(`http://localhost/MVC/public/home/getSlots?date=${dateStr}`)
    .then(res => res.json())
    .then(data => {
      if (data.status !== 'success') {
        console.error('get_slots error', data.message);
        return;
      }
      const slotsData = data.data;
      const MAX = 5;
      const now = new Date();
      const selected = new Date(dateStr);
      const isToday = selected.getFullYear() === now.getFullYear()
                   && selected.getMonth() === now.getMonth()
                   && selected.getDate() === now.getDate();
      const currentMinutes = now.getHours()*60 + now.getMinutes();

     document.querySelectorAll(".slot-checkbox").forEach(cb => {
    
    const label = cb.nextElementSibling;
    const booked = slotsData[cb.value] || 0;
    const remaining = MAX - booked;

    const [hour, minute] = cb.value.split(":").map(Number);
    const slotStartMin = hour * 60 + minute;

    label.textContent =  label.textContent.split(" (")[0];
    label.style.color = "black";


    if (remaining <= 0) {
        cb.disabled = true;
        label.textContent += " (Full)";
        label.style.color = "#999";
        return;
    }


    if (isToday && currentMinutes >= slotStartMin) {
        cb.disabled = true;
        label.textContent += " (Session Expired)";
        label.style.color = "#999";
        return;
    }
  
    cb.disabled = false;
    label.textContent += "";
    

    let oldSpan = label.querySelector("span");
if (oldSpan) oldSpan.remove();


const span = document.createElement("span");
span.textContent =` (${remaining}/${MAX}) Slots Available`;
span.style.color = "#17d3aaff";
span.style.marginLeft = "4px"; 


label.appendChild(span);

});


     
    })
    .catch(err => console.error('fetch slots failed', err));
}

function slotCheckboxBehaviour() {
  document.querySelectorAll('input[name="timeSlot"]').forEach(cb => {
    cb.addEventListener("change", function () {
      document.querySelectorAll('input[name="timeSlot"]').forEach(other => {
        if (other !== this) other.checked = false;
      });
    });
  });
}




// window.addEventListener('load',function(){
//   const emailInput = document.getElementById('emailInput');
//   const email = emailInput.value.trim();
//   setMinDate();
//   slotCheckboxBehaviour();
//   const selectedDate = slotDateInput.value;
//   if (!selectedDate) return;
//    disablePastSlotsIfToday();    
//   fetchAndUpdateSlots(selectedDate);
  
// });


emailInput.addEventListener("blur", function () {
    const email = emailInput.value.trim();

   
    emailFormatError.style.display = "none";
    emailBookedError.style.display = "none";
    emailInput.classList.remove("is-invalid");

    
    if (!emailPattern.test(email)) {
        emailFormatValid = false;
        emailBooked = false; 
        emailFormatError.style.display = "block";
        emailInput.classList.add("is-invalid");
        return; 
    }

    emailFormatValid = true;

    
    fetch('http://localhost/MVC/public/home/checkEmail', { 
        method: 'POST',
        headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
        body: new URLSearchParams({email}) 
    })
    .then(r => r.json())
    .then(data => {
   
        if (data.status === 'error') {

         
           
             emailBooked = true;
        emailBookedError.style.display = "block";
        } else if (data.status === 'success') {
          
          
            
             emailBooked = false;
        }
    })
    .catch(error => console.error('Error:', error));
   

});

document.getElementById('personalForm').addEventListener('submit', function (e) {
  e.preventDefault();


  if (!emailFormatValid) {
    emailFormatError.style.display = "block";
    emailInput.classList.add("is-invalid");
    return;
  }

  if (emailBooked) {
    emailBookedError.style.display = "block";
    emailInput.classList.add("is-invalid");
    return;
  }
  

  setMinDate();
  slotCheckboxBehaviour();
  const selectedDate = slotDateInput.value;
  
  //  disablePastSlotsIfToday();    
  fetchAndUpdateSlots(selectedDate);
  
  markTabCompleted('personal-info');
  showTab('slot-booking');
});


slotDateInput.addEventListener('change', function () {
  const selectedDate = this.value;
  
  // disablePastSlotsIfToday();    
  fetchAndUpdateSlots(selectedDate);
});

document.getElementById('slotForm').addEventListener('submit', function(e){
  e.preventDefault();
  
   const date = document.getElementById('slotDate').value;
  
  const selectedTime = document.querySelector('input[name="timeSlot"]:checked');


  const name =document.getElementById('name').value;
  const email = document.getElementById('emailInput').value;
  const phone=document.getElementById('phone').value;
  const department = document.getElementById('department').value;
  const design =document.getElementById('design').value;
 const time = selectedTime.value;
 const reason=document.getElementById('reason').value;

 
  
  document.getElementById("rev_fullname").textContent = name;
document.getElementById("rev_email").textContent = email;
document.getElementById("rev_phone").textContent = phone;
document.getElementById("rev_department").textContent = department;
document.getElementById("rev_designation").textContent = design;
document.getElementById("rev_date").textContent = date;
document.getElementById("rev_slots").textContent = time;
document.getElementById("rev_reason").textContent = reason;

  markTabCompleted('slot-booking');
  showTab('confirm-booking');
});


document.addEventListener('click', function(e){

  if (e.target.id === 'finalSubmit') {
    const name =document.getElementById('name').value;
  const email = document.getElementById('emailInput').value;
    const department = document.getElementById('department').value;
    const date = document.getElementById('slotDate').value;
    const checkedSlot = document.querySelector('input[name="timeSlot"]:checked');
    const time_slot = checkedSlot ? checkedSlot.value : "";




    const confirmTab = document.getElementById('success');

    
    
    fetch('http://localhost/MVC/public/home/bookSlot', {
      method: 'POST',
      headers: {'Content-Type':'application/x-www-form-urlencoded'},
      body: new URLSearchParams({name, email, department, date, time_slot})
    })
    .then(r => r.json())
    .then(data => {
      if (data.status === 'success') {
        markTabCompleted('confirm-booking');
        showTab('success');
        confirmTab.innerHTML = `
          <div class="card text-center p-5">
            <h2 class="text-success mb-3"> Booking Confirmed!</h2>
            <p class="mb-4">${data.message}</p>
            <button class="btn btn-primary" id="newBookingBtn">Book Another Slot</button>
          </div>
        `;
       
      } else {
        confirmTab.innerHTML = `
          <div class="card text-center p-4">
            <h2 class="text-danger mb-3"> Booking Failed</h2>
            <p class="mb-3">${data.message}</p>
            <button class="btn btn-primary" id="newBookingBtn">Try Again</button>
          </div>
        `;
        
       
      }
    })
    .catch(err => {
      console.error(err);
      confirmTab.innerHTML = `
        <div class="card text-center p-4">
          <h2 class="text-danger mb-3"> Server Error</h2>
          <p class="mb-3">Please try again later.</p>
          <button class="btn btn-primary" id="newBookingBtn">Try Again</button>
        </div>
      `;
    });
  }

 
  if (e.target.id === 'newBookingBtn') {
    document.getElementById('personalForm').reset();
    document.getElementById('slotForm').reset();
    
    document.querySelectorAll('.nav-link').forEach(l => l.classList.remove('completed'));

   
  
    setMinDate();
   
    showTab('personal-info'); 

  }
});







