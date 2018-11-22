<?php
session_start();

if(isset($_SESSION["admin"])) {
    header('Location: inicio_admin.php');
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="SPARKER - Premium directory and listings template by Ansonika.">
    <meta name="author" content="Ansonika">
    <title>SPARKER | Premium directory and listings template by Ansonika.</title>

    <!-- Favicons-->
    <link rel="shortcut icon" href="../assets/public/img/favicon.ico" type="image/x-icon">
    <link rel="apple-touch-icon" type="image/x-icon" href="../assets/public/img/apple-touch-icon-57x57-precomposed.png">
    <link rel="apple-touch-icon" type="image/x-icon" sizes="72x72" href="../assets/public/img/apple-touch-icon-72x72-precomposed.png">
    <link rel="apple-touch-icon" type="image/x-icon" sizes="114x114" href="../assets/public/img/apple-touch-icon-114x114-precomposed.png">
    <link rel="apple-touch-icon" type="image/x-icon" sizes="144x144" href="../assets/public/img/apple-touch-icon-144x144-precomposed.png">

    <!-- GOOGLE WEB FONT -->
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" rel="stylesheet">

    <!-- BASE CSS -->
    <link href="../assets/public/css/bootstrap.min.css" rel="stylesheet">
    <link href="../assets/public/css/style.css" rel="stylesheet">
	<link href="../assets/public/css/vendors.css" rel="stylesheet">

    <!-- YOUR CUSTOM CSS -->
    <link href="../assets/public/css/custom.css" rel="stylesheet">

    <style>
    #login aside {
    margin-bottom: 30px;
    display: block;
    }
    #login aside .form-group input {
    padding-left: 40px;
    }
    #login aside .form-group i {
    font-size: 21px;
    font-size: 1.3125rem;
    position: absolute;
    left: 12px;
    top: 34px;
    color: #ccc;
    width: 25px;
    height: 25px;
    display: block;
    font-weight: 400 !important;
    }

    #login_box {
        margin-top: 85px;
    }
    </style>

</head>

<body id="login_bg">
	
	<nav id="menu" class="fake_menu"></nav>
	
	<div id="login">
		<aside>
			<figure>
				<a href="index.html"><img src="../assets/public/img/logo.png" width="165" height="35" alt="" class="logo_sticky"></a>
			</figure>
            <div id="login_box">
                <div id="AJAXresponse"></div>
                <div class="form-group">
                    <label>Usuario</label>
                    <input type="text" class="form-control" id="usuario">
                    <i class="icon_profile"></i>
                </div>
                <div class="form-group">
                    <label>Password</label>
                    <input type="password" class="form-control" id="password">
                    <i class="icon_lock_alt"></i>
                </div>
                <button id="btnlogin" class="btn_1 rounded full-width">Iniciar Sesion</button>
                <div class="copy">© 2018 MaskhayPlace</div>
            </div>
		</aside>
	</div>
	<!-- /login -->
		
	<!-- COMMON SCRIPTS -->
    <script src="../assets/public/js/common_scripts.js"></script>
    <script src="../assets/public/js/functions.js"></script>
    
    <script>
    
    //Evento de inicio de sesion que envia a AJAX
    $(document).on('click', '#btnlogin', function() {
        var usuario = $('#usuario').val();
        var password = $('#password').val();
        
        // alert('Logeado, user: ' + usuario + ' password: ' + password);
        
        $.ajax({
            type: "POST",
            url: "request/login.php",
            data: {
                usuario: usuario,
                password: password
            },
            success: function(response){
                if(response == 1) {
                    $('#AJAXresponse').html('<div class="alert alert-success" role="alert">Inicio de Sesion con exito</div>');
                    location.href = 'inicio_admin.php';
                } else {
                    $('#AJAXresponse').html('<div class="alert alert-danger" role="alert">Error: '+response+'</div>');
                }
            }
        });

    });
    
    </script>
</body>
</html>