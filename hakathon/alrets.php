<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Human Protection App - Alerts</title>
  <link rel="stylesheet" href="css/alert.css" />
  <link rel="stylesheet" href="css/style.css" />
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" />
  <style>
    /* Some minimal inline styles if needed */
    /* .feature-card {
      cursor: pointer;
      padding: 1em;
      margin-bottom: 1em;
      border: 1px solid #ccc;
      border-radius: 10px;
      background: #f9f9f9;
      display: flex;
      gap: 1em;
      align-items: center;
    }
    .icon {
      font-size: 2em;
    }
    .guardian-list {
      margin-top: 10px;
      display: none;
    }
    .bottom-nav {
      position: fixed;
      bottom: 0;
      left: 0;
      right: 0;
      background: white;
      border-top: 1px solid #ddd;
      display: flex;
      justify-content: space-around;
      padding: 10px 0;
      font-family: 'Poppins', sans-serif;
    }
    .nav-item {
      text-align: center;
      color: #666;
      font-size: 0.9em;
    }
    .nav-item.active {
      color: #007bff;
      font-weight: 600;
    } */
  </style>
</head>
<body>
  <div class="phone-mockup">
    <div class="container">

      <h1>Alerts</h1>

      <!-- Panic Voice Recording Feature -->
      <div class="feature-card" onclick="startRecording()">
        <i class="icon">🎙️</i>
        <div>
          <h2>Panic Voice Recording</h2>
          <p>Automatically record audio during emergencies</p>
          <div id="recordingStatus"></div>
        </div>
      </div>

      <!-- Emergency Contact Management Feature -->
      <div class="feature-card" onclick="toggleGuardianList()">
        <i class="icon">👥</i>
        <div>
          <h2>Emergency Contact Management</h2>
          <p>Manage trusted contacts and guardian notifications</p>
          <div class="guardian-list" id="guardianList">
            <ul>
              <li>Dad: +977-9765211655</li>
              <li>Mom: +977-9800000002</li>
              <li>Sister: +977-9800000003</li>
            </ul>
          </div>
        </div>
      </div>

      <!-- Nearby Rescue -->
      <div class="feature-card">
        <i class="icon">🏥</i>
        <div>
          <h2>Nearby Help or Rescue Centers</h2>
          <p>View police stations, hospitals, and shelters</p>
        </div>
      </div>

      <!-- Incident Reporting with Camera -->
      <div class="feature-card">
        <i class="icon">📝</i>
        <div>
          <h2>Incident Reporting</h2>
          <p>
            <button onclick="captureAndSendSnapshot()">📷 Capture & Send Photo</button><br/>
            <button onclick="recordAndSendVideo()">🎥 Record & Send Video</button>
          </p>
        </div>
      </div>

      <!-- Camera Preview -->
      <video id="incidentCamera" width="100%" autoplay playsinline style="display:none; border-radius: 10px; margin-top: 10px;"></video>
      <canvas id="snapshotCanvas" style="display:none;"></canvas>

      <!-- Advice -->
      <!-- Advice -->
<div class="feature-card" onclick="toggleAdvice()" style="cursor: pointer;">
  <i class="icon">👤</i>
  <div>
    <h2>Advice and Suggestion</h2>
    <p>Tagging and location</p>
    <ul id="advice-list" class="hidden">
      <li>🔔 Be aware of your surroundings and trust your instincts.</li>
      <li>🚶 Walk confidently and avoid isolated or dark areas when alone.</li>
    </ul>
  </div>
</div>

      <!-- Navigation Footer -->
      <!-- <div class="bottom-nav">
        <div class="nav-item active"><i class="fas fa-home"></i><br /><span>Home</span></div>
        <div class="nav-item"><i class="fas fa-plus-circle"></i><br /><span>Add</span></div>
        <div class="nav-item" onclick="window.location.href='alerts.html'">
          <i class="fas fa-bell"></i><br /><span>Alerts</span>
        </div>
        <div class="nav-item" onclick="window.location.href='profile.html'">
          <i class="fas fa-user-circle"></i><br /><span>Profile</span>
        </div>
      </div> -->
      <?php include("bottom-nav.php") ?>

    </div>
  </div>

  <script>
    let mediaRecorder;
    let isRecording = false;
    let videoStream = null;
    let recordedChunks = [];

    // function startRecording() {
      // const status = document.getElementById("recordingStatus");

      // if (isRecording) {
      //   mediaRecorder.stop();
      //   isRecording = false;
      //   status.textContent = "Recording stopped.";
      //   return;
      // }

      // if (navigator.mediaDevices && navigator.mediaDevices.getUserMedia) {
      //   navigator.mediaDevices.getUserMedia({ audio: true })
      //     .then(function (stream) {
      //       mediaRecorder = new MediaRecorder(stream);
      //       mediaRecorder.start();
      //       isRecording = true;
      //       status.textContent = "Recording started...";

      //       mediaRecorder.ondataavailable = function (e) {
      //         console.log("Audio data captured:", e.data);
      //       };
      //     })
      //     .catch(function (err) {
      //       console.error("Microphone error:", err);
      //       status.textContent = "Microphone access denied.";
      //     });
      // } else {
      //   status.textContent = "Audio recording not supported in this browser.";
      // }
      function startRecording() {
      const status = document.getElementById("recordingStatus");

      if (isRecording) {
        mediaRecorder.stop();
        isRecording = false;
        status.textContent = "Recording stopped, uploading...";

        mediaRecorder.onstop = () => {
          const audioBlob = new Blob(audioChunks, { type: "audio/webm" });
          audioChunks = [];

          const formData = new FormData();
          formData.append("voiceRecord", audioBlob, "panic_recording.webm");

          fetch("upload.php", {
            method: "POST",
            body: formData
          })
            .then(response => response.text())
            .then(data => {
              status.textContent = "Audio uploaded successfully!";
              console.log(data);
            })
            .catch(err => {
              status.textContent = "Audio upload failed.";
              console.error(err);
            });
        };

        return;
      }

      if (navigator.mediaDevices && navigator.mediaDevices.getUserMedia) {
        navigator.mediaDevices.getUserMedia({ audio: true })
          .then(stream => {
            mediaRecorder = new MediaRecorder(stream);
            mediaRecorder.start();
            isRecording = true;
            status.textContent = "Recording started...";

            mediaRecorder.ondataavailable = e => {
              audioChunks.push(e.data);
            };
          })
          .catch(err => {
            status.textContent = "Microphone access denied.";
            console.error(err);
          });
      } else {
        status.textContent = "Audio recording not supported in this browser.";
      }
    }
    // }

    function toggleGuardianList() {
      const list = document.getElementById("guardianList");
      list.style.display = list.style.display === "block" ? "none" : "block";
    }

    function startCamera() {
      const video = document.getElementById("incidentCamera");
      return navigator.mediaDevices.getUserMedia({ video: true, audio: true })
        .then(stream => {
          videoStream = stream;
          video.srcObject = stream;
          video.style.display = "block";
          return stream;
        });
    }

    function stopCamera() {
      const video = document.getElementById("incidentCamera");
      if (videoStream) {
        videoStream.getTracks().forEach(track => track.stop());
      }
      video.style.display = "none";
    }

    function captureAndSendSnapshot() {
      const canvas = document.getElementById("snapshotCanvas");
      const video = document.getElementById("incidentCamera");

      startCamera().then(() => {
        setTimeout(() => {
          const context = canvas.getContext("2d");
          canvas.width = video.videoWidth;
          canvas.height = video.videoHeight;
          context.drawImage(video, 0, 0, canvas.width, canvas.height);

          canvas.toBlob(function (blob) {
            const formData = new FormData();
            formData.append("incidentImage", blob, "snapshot.jpg");

            fetch("upload.php", {
              method: "POST",
              body: formData
            })
              .then(response => response.text())
              .then(data => {
                alert("📷 Photo sent successfully!");
                console.log(data);
              })
              .catch(error => {
                alert("❌ Error sending photo.");
                console.error(error);
              });

            stopCamera();
          }, "image/jpeg");
        }, 3000);
      });
    }

    function recordAndSendVideo() {
      const video = document.getElementById("incidentCamera");
      recordedChunks = [];

      navigator.mediaDevices.getUserMedia({ video: true, audio: true })
        .then(function (stream) {
          videoStream = stream;
          video.srcObject = stream;
          video.style.display = "block";

          mediaRecorder = new MediaRecorder(stream);
          mediaRecorder.ondataavailable = function (e) {
            if (e.data.size > 0) {
              recordedChunks.push(e.data);
            }
          };

          mediaRecorder.onstop = function () {
            const blob = new Blob(recordedChunks, { type: "video/webm" });
            const formData = new FormData();
            formData.append("incidentVideo", blob, "incident_video.webm");

            fetch("upload.php", {
              method: "POST",
              body: formData
            })
              .then(response => response.text())
              .then(data => {
                alert("🎥 Video sent successfully!");
                console.log(data);
              })
              .catch(error => {
                alert("❌ Error sending video.");
                console.error(error);
              });

            stream.getTracks().forEach(track => track.stop());
            video.style.display = "none";
          };

          mediaRecorder.start();

          setTimeout(() => {
            mediaRecorder.stop();
          }, 5000);
        })
        .catch(function (error) {
          alert("❌ Unable to access video/audio.");
          console.error("Error:", error);
        });
    }
  </script>
</body>
</html>
