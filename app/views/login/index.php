<!doctype html>
<html lang="fa" dir="rtl">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>صفحه ورود</title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous" />

  <style>
    body {
      background: linear-gradient(135deg, #667eea, #764ba2);
      height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      color: #fff;
    }

    .card-login {
      background: rgba(255, 255, 255, 0.1);
      backdrop-filter: blur(10px);
      border-radius: 1rem;
      box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.37);
      padding: 2rem;
      width: 100%;
      max-width: 400px;
    }

    .form-control {
      background: rgba(255, 255, 255, 0.2);
      border: none;
      color: #fff;
      padding-left: 2.5rem;
      border-radius: 0.5rem;
    }

    .form-control::placeholder {
      color: #ddd;
    }

    .form-floating > label {
      color: #ddd;
    }

    .input-icon {
      position: absolute;
      left: 1rem;
      top: 50%;
      transform: translateY(-50%);
      color: #ddd;
      pointer-events: none;
    }

    .position-relative {
      position: relative;
    }

    .btn-primary {
      background-color: #6c63ff;
      border: none;
      font-weight: 600;
      transition: background-color 0.3s ease;
    }

    .btn-primary:hover {
      background-color: #5750d4;
    }

    #showError {
      color: #ff6b6b;
      margin-top: 0.5rem;
      min-height: 1.5rem;
      display: block;
      text-align: center;
    }

    a.register-link {
      color: #fff;
      text-decoration: none;
      font-weight: 600;
      display: block;
      text-align: center;
      margin-top: 1rem;
      transition: color 0.3s ease;
    }

    a.register-link:hover {
      color: #d1c4ff;
      text-decoration: underline;
    }
  </style>

  <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
</head>

<body>
  <main class="card-login">
    <form onsubmit="return false;">
      <h1 class="h3 mb-4 fw-bold text-center">لطفا وارد شوید</h1>

      <div class="form-floating position-relative mb-3">
        <input name="username" type="tel" class="form-control" id="username" placeholder="09*********" />
        <label for="username">موبایل</label>
        <i class="fas fa-mobile-alt input-icon"></i>
      </div>

      <div class="form-floating position-relative mb-3">
        <input name="password" type="password" class="form-control" id="password" placeholder="Password" />
        <label for="password">پسورد</label>
        <i class="fas fa-lock input-icon"></i>
      </div>

      <button id="btn" class="btn btn-primary w-100 py-2 mb-2" type="submit">ورود</button>
      <span id="showError"></span>
      <a href="register" class="register-link">ثبت نام</a>
    </form>
  </main>

  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script>
    function checkuser(inputuser) {
      var user = /^(?:(?:(?:\\+?|00)(98))|(0))?((?:90|91|92|93|99)[0-9]{8})$/;
      if (inputuser.match(user)) {
        return true;
      } else {
        return false;
      }
    }

    function CheckPassword(inputtxt) {
      var passw = /^(?=.*[a-z])(?=.*[A-Z]).{6,20}$/;
      if (inputtxt.match(passw)) {
        return true;
      } else {
        return false;
      }
    }

    $("#btn").on("click", function () {
      var username = document.getElementById("username").value;
      var password = document.getElementById("password").value;

      if (username == "" || password == "") {
        $("#showError").text("Username or Password is empty");
      } else if (!checkuser(username)) {
        $("#showError").text("user isnot valid");
      } else if (!CheckPassword(password)) {
        $("#showError").text("Password is not secure");
      } else {
        $.ajax({
          url: "index.php?url=login/check_data",
          type: "POST",
          data: {
            username: username,
            password: password,
          },
          success: function (response) {
            response = JSON.parse(response);
            if (response.status_code == "404") {
              $("#showError").text("Username or Password is wrong");
            } else {
              window.location = "index.php";
            }
          },
          error: function (xhr, status, error) {
            console.error("AJAX Error:", status, error);
            $("#showError").text("خطا در ارتباط با سرور: " + error);
          },
        });
      }
    });
  </script>
</body>

</html>
