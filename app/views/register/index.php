

<base href=<?=URL ?>>

<html lang="fa" dir="rtl">

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.122.0">
    <title>صفحه ثبت نام</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/5.3/examples/sign-in/">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@docsearch/css@3">

    <style>
      .form-control {
        color: red;
      }
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }

      .b-example-divider {
        width: 100%;
        height: 3rem;
        background-color: rgba(0, 0, 0, .1);
        border: solid rgba(0, 0, 0, .15);
        border-width: 1px 0;
        box-shadow: inset 0 .5em 1.5em rgba(0, 0, 0, .1), inset 0 .125em .5em rgba(0, 0, 0, .15);
      }

      .b-example-vr {
        flex-shrink: 0;
        width: 1.5rem;
        height: 100vh;
      }

      .bi {
        vertical-align: -.125em;
        fill: currentColor;
      }

      .nav-scroller {
        position: relative;
        z-index: 2;
        height: 2.75rem;
        overflow-y: hidden;
      }

      .nav-scroller .nav {
        display: flex;
        flex-wrap: nowrap;
        padding-bottom: 1rem;
        margin-top: -1px;
        overflow-x: auto;
        text-align: center;
        white-space: nowrap;
        -webkit-overflow-scrolling: touch;
      }

      .btn-bd-primary {
        --bd-violet-bg: #712cf9;
        --bd-violet-rgb: 112.520718, 44.062154, 249.437846;

        --bs-btn-font-weight: 600;
        --bs-btn-color: var(--bs-white);
        --bs-btn-bg: var(--bd-violet-bg);
        --bs-btn-border-color: var(--bd-violet-bg);
        --bs-btn-hover-color: var(--bs-white);
        --bs-btn-hover-bg: #6528e0;
        --bs-btn-hover-border-color: #6528e0;
        --bs-btn-focus-shadow-rgb: var(--bd-violet-rgb);
        --bs-btn-active-color: var(--bs-btn-hover-color);
        --bs-btn-active-bg: #5a23c8;
        --bs-btn-active-border-color: #5a23c8;
      }

      .bd-mode-toggle {
        z-index: 1500;
      }

      .bd-mode-toggle .dropdown-menu .active .bi {
        display: block !important;
      }
    </style>

    
    <!-- Custom styles for this template -->
     <link href="sign-in.css" rel="stylesheet">
  </head>
  <body class="d-flex align-items-center px-8 bg-light">
    
    
<main class="form-signin w-30 m-auto " >
  <form onsubmit="return false;" >
     <h1 class="h3 mb-3 fw-normal"> لطفا وارد کنید</h1>
    <div class="form-floating">
      <input type="tel" name="username" class="form-control" id="floatingInput"  placeholder="09*******">
      <label for="floatingInput">موبایل</label>
    </div>
    <div class="form-floating">
      <input type="password" name="password"  class="form-control" id="floatingPassword" placeholder="Password">
        <label for="floatingPassword">رمز عبور</label>
    </div>
    <div class="form-floating">
      <input type="password" name="confirm-password" class="form-control" id="floatingconfirm-password" placeholder="Password">
      <label for="floatingPassword">تکرار رمز عبور</label>
    </div>
    <br>
    <button class="btn btn-primary w-100 py-2" type="submit" id="btn" >ثبت نام</button>
    <br>
    
    <span style="background-color: red;" id="showError"></span>
    
    
  </form>
  <button class="btn btn-success w-100 py-2" id="bt" ><a href="login" style="color:azure">ورود</a></button>
  
</main>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
<script src="public/js/jquery-3.4.1.min.js"></script>

<script>
  function checkuser(inputuser){
    var user=/^(?:(?:(?:\\+?|00)(98))|(0))?((?:90|91|92|93|99)[0-9]{8})$/;
    if(inputuser.match(user)){
      return true
    }
    else{
      return false;
    }
  }
    function CheckPassword(inputtxt)
    {
        var passw = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,20}$/;
        if(inputtxt.match(passw))
        {
            return true;
        }
        else
        {
            return false;
        }
    }
    $("#btn").on('click',function (){
        
          var username = document.getElementById("floatingInput").value;
          var password = document.getElementById("floatingPassword").value;
          var confirm_password = document.getElementById("floatingconfirm-password").value;
         
          
          if(username == ""||password == ""){
              $("#showError").text("Username or Password is empty");
          }
          else if(!checkuser(username)){
            $("#showError").text("username is not valid")
          }
           else if (!CheckPassword(password)){
              $("#showError").text("Password is not secure");
          } 
        
          
          else {
              $.ajax({
                  url: "<?= URL; ?>register/insert_data",
                  type: "POST",
                  data: {
                      "username": username,
                      "password": password,
                      "confirm-password":confirm_password
                  },
                  success: function (response){
                      response = JSON.parse(response);
                      if(response.status_code == "404"){
                          $("#showError").text("Username or Password is wrong");
                      } else {
                          window.location = "<?= URL; ?>login";
                      }
                  },
                  error: function (response) {
                      alert("dsgdgfdgdfgd");
                  }
              });
          }
        }
    )
          ;
</script>
    </body>
</html> 
