<!DOCTYPE html>
<html lang="pt-br">

<head>
	<title>Cadastro</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<link href="https://fonts.googleapis.com/css?family=Lato:300,400,700&display=swap" rel="stylesheet">

	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet/less" type="text/css" href="styles.less" />
	<link rel="stylesheet" href="../../src/css//style.css">
	<style>
		.btn {
			color: black;
			border: none;
			padding: 10px 20px;
			text-align: center;
			text-decoration: none;
			display: inline-block;
			font-size: 16px;
			margin: 4px 2px;
			cursor: pointer;
		}
	</style>

</head>

<body>
	<section class="ftco-section" style="background-color: #b06e7f">
		<div class="container">
			<div class="row justify-content-center">
			</div>
			<div class="row justify-content-center">
				<div class="col-md-7 col-lg-5">
					<div class="wrap">
						<div class="login-wrap p-4 p-md-5">

							<!-- Botão Voltar -->
							<button type="button" class="btn btn-default" onclick="goBack()" aria-label="Left Align">
								<span class="fa fa-arrow-left" aria-hidden="true"></span> Voltar
							</button>

							<div class="d-flex">
								<div class="w-100">
									<h3 class="text-center mb-4" style="font-weight: bold; color: #2b1219">Cadastrar</h3>
								</div>
							</div>
							<form action="data.php" method="post">
								<div class="form-group mt-3">
									<input type="text" class="form-control" id="usuario_nome" name="nome" required>
									<label class="form-control-placeholder" for="usuario_nome">Nome</label>
								</div>
								<div class="form-group mt-3">
									<input type="text" class="form-control" id="email" name="email" required>
									<label class="form-control-placeholder" for="email">Email</label>
								</div>
								<div class="form-group">
									<input type="password" class="form-control" id="senha" name="senha" minlength="8" maxlength="16" required>
									<label class="form-control-placeholder" for="senha">Senha</label>
									<span toggle="#password-field" class="fa fa-fw fa-eye field-icon toggle-password"></span>
								</div>
								<div class="form-group">
									<input type="password" class="form-control" id="confirma-senha" name="confSenha" minlength="8" maxlength="16" required>
									<label class="form-control-placeholder" for="confirma-senha">Confirma senha</label>
									<span toggle="#password-field" class="fa fa-fw fa-eye field-icon toggle-password"></span>
								</div>
								<div class="form-group">
									<button type="submit" class="form-control btn btn-primary submit px-3">Cadastrar</button>
								</div>
							</form> <!-- Adicionei o fechamento da tag form aqui -->
						</div>
					</div>
				</div>
			</div>
		</div> <!-- Adicionei o fechamento da div container aqui -->
	</section>

	<script>
		function goBack() {
			window.history.back();
		}
	</script>
</body>

</html>