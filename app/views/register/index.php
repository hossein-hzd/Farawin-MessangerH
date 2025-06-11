<!doctype html>
<html lang="fa" dir="rtl">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>صفحه ثبت نام</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
  <link href="../assets/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    .bd-placeholder-img {
      font-size: 1.125rem;
      text-anchor: middle;
      -webkit-user-select: none;
      -moz-user-select: none;
      user-select: none;
    }
  </style>
</head>

<body class="d-flex align-items-center py-4 bg-light">
  <main class="form-signin w-30 m-auto">
    <form id="registerForm" onsubmit="return false;">
      <h1 class="h3 mb-3 fw-normal">ثبت نام</h1>
      <div class="form-floating">
        <input name="username" type="tel" class="form-control" id="username" placeholder="09*********">
        <label for="username">موبایل</label>
      </div><br>
      <div class="form-floating">
        <input name="password" type="password" class="form-control" id="password" placeholder="Password">
        <label for="password">پسورد</label>
      </div><br>
      <button id="btnRegister" class="btn btn-primary w-100 py-2" type="submit">ثبت نام</button>
    </form>
    <span id="showError" class="text-danger"></span><br>
    <button id="btnLogin" class="btn btn-secondary w-100 py-2"><a href="login" style="color: white; text-decoration: none;">ورود</a></button>
  </main>
  <script src="public/js/jquery-3.4.1.min.js"></script>
  <script>
    function checkuser(inputuser) {
      var user = /^(?:(?:(?:\\+?|00)(98))|(0))?((?:90|91|92|93|99)[0-9]{8})$/;
      return user.test(inputuser);
    }

    function CheckPassword(inputtxt) {
      var passw = /^(?=.*[a-z])(?=.*[A-Z]).{6,20}$/;
      return passw.test(inputtxt);
    }
    $("#btnRegister").on('click', function() {
      var username = $("#username").val();
      var password = $("#password").val();
      if (username === "" || password === "") {
        $("#showError").text("موبایل یا پسورد خالی است");
      } else if (!checkuser(username)) {
        $("#showError").text("موبایل معتبر نیست");
      } else if (!CheckPassword(password)) {
        $("#showError").text("پسورد باید شامل حروف بزرگ، کوچک و عدد باشد و بین 6 تا 20 کاراکتر باشد");
      } else {
        $.ajax({
          url: "<?= URL; ?>register/insert_data",
          type: "POST",
          data: {
            "username": username,
            "password": password
          },
          success: function(response) {
            response = JSON.parse(response);
            if (response.status_code === "200") {
              window.location = "<?= URL ?>login";
            } else if (response.status_code === "404") {
              $("#showError").text("نام کاربری قبلا ثبت شده است");
            } else {
              $("#showError").text("خطا در ثبت نام");
            }
          },
          error: function() {
            $("#showError").text("خطا در ارتباط با سرور");
          }
        });
      }
    });
  </script>
</body>

</html>