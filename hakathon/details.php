<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Personal Details Form</title>
  <style>
    html, body {
      height: 100%;
      margin: 0;
      padding: 0;
    }
    body {
      min-height: 100vh;
      font-family: Arial, sans-serif;
      background-color: #f5f5f5;
      display: flex;
      justify-content: center;
      align-items: center;
    }
    .container {
      background: white;
      border-radius: 10px;
      box-shadow: 0 0 10px rgba(0,0,0,0.2);
      padding: 30px 40px;
      width: 100%;
      max-width: 400px;
      box-sizing: border-box;
    }
    .container h2 {
      color: green;
      text-align: center;
      margin-bottom: 25px;
    }
    .form-group {
      margin-bottom: 15px;
    }
    label {
      display: block;
      font-weight: bold;
      margin-bottom: 5px;
    }
    input, select {
      width: 100%;
      padding: 8px;
      border: 1px solid #ccc;
      border-radius: 5px;
      box-sizing: border-box;
    }
    .form-group input[type="file"] {
      padding: 3px;
    }
    button {
      background-color: green;
      color: white;
      border: none;
      padding: 10px;
      width: 100%;
      border-radius: 5px;
      cursor: pointer;
      font-size: 16px;
    }
    button:hover {
      background-color: darkgreen;
    }
    @media (max-width: 500px) {
      .container {
        padding: 20px 10px;
        max-width: 95vw;
      }
      button {
        font-size: 15px;
        padding: 9px;
      }
    }
  </style>
</head>
<body>
  <div class="container">
    <h2>Personal Details</h2>
    <form action="submit.php" method="post" enctype="multipart/form-data">
      <!-- <div class="form-group">
        <label for="photo">User Photo:</label>
        <input type="file" id="photo" name="photo" accept="image/*" required>
      </div> -->

      <div class="form-group">
        <label for="fullname">Full Name:</label>
        <input type="text" id="fullname" name="fullname" required>
      </div>

      <!-- <div class="form-group">
        <label for="gender">Gender:</label>
        <select id="gender" name="gender" required>
          <option value="">Select</option>
          <option value="Female">Female</option>
          <option value="Male">Male</option>
          <option value="Other">Other</option>
        </select>
      </div> -->

      <div class="form-group">
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required>
      </div>

      <div class="form-group">
        <label for="phone">Phone Number:</label>
        <input type="tel" id="phone" name="phone" pattern="^\+977-[0-9]{10}$" placeholder="+977-98XXXXXXXX" required>
      </div>

      <div class="form-group">
        <label for="location">Current Location:</label>
        <input type="text" id="location" name="location" required>
      </div>

      <button type="submit">Submit</button>
    </form>
  </div>
</body>
</html>