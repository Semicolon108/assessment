<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    
</head>
<body>
<nav class="navbar navbar-light bg-light">
  <div class="container">
    <a class="navbar-brand" href="#">
      <img src="/docs/5.0/assets/brand/bootstrap-logo.svg" alt="" width="30" height="24">
    </a>
  </div>
</nav>
    <div class="container py-5 mt-5 col-6 mx-auto bg-light h-auto">
        <div class="card col-9 mx-auto border-0 bg-dark">
            <div class="card-body">
                <h5 class="card-title text-center">Login</h5>
                <form>
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Email address</label>
                        <input type="email" required class="form-control" id="email" aria-describedby="emailHelp">
                        <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Password</label>
                        <input type="password" required class="form-control" id="password">
                    </div>
                    
                    <button type="submit" id="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script>
    $("#submit").click((event) => {
        event.preventDefault();
        let data = new FormData();
        data.append("email",$("#email").val());
        data.append("password",$("#password").val());
        data.append("login",true);
        //console.log($("#email").val(),$("#password").val());
        $.ajax({
            url: "requestHandler.php",
            method: "POST",
            data: data,
            cache: false,
            processData: false,
            contentType: false,
            success: (response) => {
                if(response == "success"){
                   window.location.href = "teacherpanel.php";
                }else{
                    console.log(response);
                }
            }
        })
    })
</script>
</html>