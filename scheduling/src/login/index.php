<!DOCTYPE html>
<html lang="pt-br">
  <head>
  	<title>Login</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<link href="https://fonts.googleapis.com/css?family=Lato:300,400,700&display=swap" rel="stylesheet">

	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	
	<link rel="stylesheet" href="../css/style.css">

	</head>
	<body style="background-color: #b06e7f">
	<section class="ftco-section" >
		<div class="container" >
			<div class="row justify-content-center">
			</div>
			<div class="row justify-content-center">
				<div class="col-md-7 col-lg-5">
					<div class="wrap">
						<div class="login-wrap p-4 p-md-5">
			      	<div class="d-flex">
			      		<div class="w-100">
			      			<h3 class="text-center mb-4" style=" font-weight: bold; color: #2b1219">Logar</h3>
			      		</div>
			      	</div>
							<form action="data.php" class="signin-form" method="post">
			      		<div class="form-group mt-3">
			      			<input type="text" class="form-control" id="email" name="email" required>
			      			<label class="form-control-placeholder" for="email">Email</label>
			      		</div>
						<div class="form-group">
						<input type="password" class="form-control" id="senha" name="senha" required>
						<label class="form-control-placeholder" for="senha">Senha</label>
						<span toggle="#password-field" class="fa fa-fw fa-eye field-icon toggle-password"></span>
						</div>
						<div class="form-group">
							<button type="submit" class="form-control btn btn-primary submit px-3" style="background-color: #d9537f">Entrar</button>
						</div>
						<div class="form-group d-md-flex">
		          </form>
		          <p class="text-center">Ainda não é membro? <a data-toggle="tab" href="../register/index.php" style="color: #d01669">Cadatre-se</a></p>
		        </div>
		      </div>
				</div>
			</div>
		</div>
	</section>
	</body>
</html>

