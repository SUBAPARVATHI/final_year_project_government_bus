<!DOCTYPE html>
<html>
<head>
    <?php include('header.php') ?>
    <title>Admin Login | Online Bus Reservation</title>
    <style>
        body {
            background: linear-gradient(135deg, rgb(191, 193, 204), #764ba2); /* Background gradient */
            font-family: Arial, sans-serif;
            margin: 0;
        }

        .login-container {
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .card {
            width: 400px;
            background: rgba(255, 255, 255, 0.3); /* Glassmorphism effect */
            padding: 25px;
            border-radius: 10px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.3);
            backdrop-filter: blur(10px);
        }

        .card-header-edge {
            background-color: #28a745;
            padding: 10px;
            border-radius: 10px 10px 0 0;
            font-size: 18px;
            text-align: center;
        }

        .card-body {
            padding: 20px;
        }

        h2 {
            color: white;
            margin-bottom: 20px;
        }

        input, textarea {
            width: 100%;
            margin: 10px 0;
            padding: 12px;
            border-radius: 5px;
            border: 1px solid #ccc;
            font-size: 16px;
            background: rgba(255, 255, 255, 0.8);
        }

        button {
            background-color: #28a745;
            color: white;
            padding: 12px;
            border: none;
            border-radius: 5px;
            width: 100%;
            font-size: 16px;
            cursor: pointer;
            transition: 0.3s;
        }

        button:hover {
            background: #218838;
        }

        a {
            color: white;
            text-decoration: underline;
        }

        .form-group {
            margin-bottom: 15px;
        }
    </style>
</head>

<body id="login-body" class="bg-light">
    <div class="login-container">
        <div class="card">
            <div class="card-header-edge text-white">
                <strong>Admin Login Panel</strong>
            </div>
            <div class="card-body">
                <form id="login-frm">
                    
                    <div class="form-group">
                        <label>Username</label>
                        <input type="username" name="username" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" name="password" class="form-control">
                    </div> 
                    <div class="form-group text-right">
                        <button class="btn btn-success btn-block" name="submit">Login as Admin</button>
                        <br><br>
                        <a href="./index.php">Back to Home</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

<script>
    $(document).ready(function(){
        $('#login-frm').submit(function(e){
            e.preventDefault()
            $('#login-frm button').attr('disable', true)
            $('#login-frm button').html('Checking details...')

            $.ajax({
                url:'./login_auth.php',
                method:'POST',
                data:$(this).serialize(),
                error:err=>{
                    console.log(err)
                    alert('An error occurred');
                    $('#login-frm button').removeAttr('disable')
                    $('#login-frm button').html('Login')
                },
                success:function(resp){
                    if(resp == 1){
                        location.replace('index.php?page=home')
                    } else {
                        alert("Incorrect username or password.")
                        $('#login-frm button').removeAttr('disable')
                        $('#login-frm button').html('Login')
                    }
                }
            })
        })
    })
</script>
</html>
