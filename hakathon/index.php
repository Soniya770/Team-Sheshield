<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Emergency Help App</title>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;800&display=swap" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />
  <link rel="stylesheet" href="css/style.css" />

  <link rel="manifest" href="manifest.json" />
  <meta name="theme-color" content="#d72660">

  <audio id="sosAlarm"  src="sound.mp3"  preload="auto"></audio>
   

</head>
<body>
  <div class="phone-mockup">
    <div class="header">
      <div class="app-logo">
        <img src="images/image.jpg" alt="App Logo" />
      </div>
      <div class="location-info">
        <i class="fas fa-map-marker-alt"></i>
      <a href="../hakathon/location.html">
<button><p> Share Location</p></button></a>
        <!-- <a href="https://www.google.com/maps?q=Kathmandu,Nepal-" target="_blank"> -->
          
</a>

    <!-- <p id="location">Location </p> -->
      </div>
    </div>

    <div class="user-info">
      <div class="user-text">
        <div class="greeting">Hi Madhura!</div>
        <!-- <div class="profile-complete">Complete profile <i class="fas fa-chevron-right"></i></div> -->
      </div>
    </div>

    <div class="main-question">Emergency help Needed?</div>

    <div class="sos-button-container">
      <div class="sos-button" onclick="triggerSOS()">
  <i class="fas fa-broadcast-tower"></i>
</div>
    </div>

    <div class="service-cards">
      <div class="service-card" onclick="window.location.href='tel:100'">
        <div class="service-card-icon"><i class="fas fa-shield-alt"></i></div>
        <div class="service-card-info">
          <div class="service-card-title">Police</div>
          <div class="service-card-number">100</div>
        </div>
        <i class="fas fa-chevron-right arrow-icon"></i>
      </div>

      <div class="service-card" onclick="openHelplineModal()">
        <div class="service-card-icon"><i class="fas fa-female"></i></div>
        <div class="service-card-info">
          <div class="service-card-title">Women Helpline</div>
        </div>
        <i class="fas fa-chevron-right arrow-icon"></i>
      </div>

      <div class="service-card" onclick="openNearbyModal()">
        <div class="service-card-icon"><i class="fas fa-people-arrows"></i></div>
        <div class="service-card-info">
          <div class="service-card-title">Nearby Help</div>
        </div>
        <i class="fas fa-chevron-right arrow-icon"></i>
      </div>

      <div class="service-card" onclick="openFriendsModal()">
        <div class="service-card-icon"><i class="fas fa-user-friends"></i></div>
        <div class="service-card-info">
          <div class="service-card-title">Alert Friends</div>
        </div>
        <i class="fas fa-chevron-right arrow-icon"></i>
      </div>
    </div>

    <!-- <div class="bottom-nav">
      <div class="nav-item active"><i class="fas fa-home"></i><br /><span>Home</span></div>
      <div class="nav-item"><i class="fas fa-plus-circle"></i><br /><span>Add</span></div>
      <div class="nav-item" onclick="window.location.href='alrets.html'">
        <i class="fas fa-bell"></i><br /><span>Alerts</span>
      </div>
      <div class="nav-item" onclick="window.location.href='profile.html'">
        <i class="fas fa-user-circle"></i><br /><span>Profile</span>
      </div>
    </div>
  </div> -->
  <?php include("bottom-nav.php") ?>

  <!-- Modals -->
  <div class="modal" id="helplineModal">
    <div class="modal-content">
      <span class="close" onclick="closeHelplineModal()">&times;</span>
      <h3>Women Helpline Numbers</h3>
      <ul>
        <li><strong>National:</strong> <a href="tel:1091">1091</a></li>
        <li><strong>Local NGO:</strong> <a href="tel:1234567890">1234567890</a></li>
        <li><strong>Emergency:</strong> <a href="tel:112">112</a></li>
      </ul>
    </div>
  </div>

  <div class="modal" id="friendsModal">
    <div class="modal-content">
      <span class="close" onclick="closeFriendsModal()">&times;</span>
      <h3>Alert Your Friends</h3>
      <ul>
        <li>👩‍🦰 Sita Sharma – <a href="tel:9801234567">9801234567</a></li>
        <li>👩 Rina Thapa – <a href="tel:9809876543">9809876543</a></li>
      </ul>
    </div>
  </div>

  <div class="modal" id="nearbyModal">
    <div class="modal-content">
      <span class="close" onclick="closeNearbyModal()">&times;</span>
      <h3>Nearby Helpers Online</h3>
      <ul>
        <li>👨 Ram Joshi – <a href="tel:9811122233">9811122233</a></li>
        <li>👨‍⚕️ Dr. Bikash – <a href="tel:9840011223">9840011223</a></li>
      </ul>
    </div>
  </div>

  <script>

    function triggerSOS() {
  // Play the alert sound
  const alertSound = document.getElementById("alertTone");
  alertSound.play();
  
  // Show the alert (you can remove this if you just want the sound)
  alert('SOS Alert Sent! Help is on the way!');
  
  // Here you would also add code to actually send the SOS signal
  // to your backend or emergency contacts

  function triggerSOS() {
  // Create audio context if needed
  const AudioContext = window.AudioContext || window.webkitAudioContext;
  const audioContext = new AudioContext();
  
  // Play the alert sound
  const alertSound = document.getElementById("alertTone");
  alertSound.play();
  
  // Resume audio context if suspended
  if (audioContext.state === 'suspended') {
    audioContext.resume();
  }
  
  // Rest of your SOS functionality...
}
}
    function openHelplineModal() {
      document.getElementById("helplineModal").style.display = "flex";
    }
    function closeHelplineModal() {
      document.getElementById("helplineModal").style.display = "none";
    }

    function openFriendsModal() {
      document.getElementById("friendsModal").style.display = "flex";
    }
    function closeFriendsModal() {
      document.getElementById("friendsModal").style.display = "none";
    }

    function openNearbyModal() {
      document.getElementById("nearbyModal").style.display = "flex";
    }
    function closeNearbyModal() {
      document.getElementById("nearbyModal").style.display = "none";
    }

    //location

    // script.js
// function getLocation() {
//   const locationDisplay = document.getElementById("location");

//   if (navigator.geolocation) {
//     navigator.geolocation.getCurrentPosition(showPosition, showError);
//   } else {
//     locationDisplay.innerText = "Geolocation is not supported by this browser.";
//   }
// }

// function showPosition(position) {
//   const latitude = position.coords.latitude;
//   const longitude = position.coords.longitude;
//   document.getElementById("location").innerText =
//     "Latitude: " + latitude + "\nLongitude: " + longitude;
// }

// function showError(error) {
//   switch (error.code) {
//     case error.PERMISSION_DENIED:
//       alert("User denied the request for Geolocation.");
//       break;
//     case error.POSITION_UNAVAILABLE:
//       alert("Location information is unavailable.");
//       break;
//     case error.TIMEOUT:
//       alert("The request to get user location timed out.");
//       break;
//     case error.UNKNOWN_ERROR:
//       alert("An unknown error occurred.");
//       break;
//   }
// }

  // if ('serviceWorker' in navigator) {
  //   navigator.serviceWorker.register('sw.js').then(function(reg) {
  //     console.log('Service Worker registered', reg);
  //   }).catch(function(err) {
  //     console.error('Service Worker failed', err);
  //   });
  // }

   if ('serviceWorker' in navigator) {
    navigator.serviceWorker.register('sw.js')
      .then(reg => console.log('Service Worker registered:', reg))
      .catch(err => console.error('Service Worker error:', err));
  }

  </script>
</body>
</html>