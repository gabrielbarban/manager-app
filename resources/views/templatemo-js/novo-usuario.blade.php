<!DOCTYPE html>
<html lang="en">

  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Novo Usuario | Manager</title>
  </head>

<body class="is-preload">
    <div id="wrapper">
        <div id="main">
          <div class="inner">
            @include('templatemo-js.partials.header')
            <div class="mb-3 d-flex">
                <a href="/usuarios" class="btn btn-primary"><i class="fa fa-reply" aria-hidden="true"></i> Voltar</a>
            </div>
            <section class="main-banner">
                <div class="card">
                    <div class="card-body">
                        <h3 class="card-title text-center mb-4">Novo usuário</h3>
                        <form action="/usuario/save" method="POST">
                            @csrf

                            <div class="form-group">
                                <label for="nome">Nome:</label>
                                <input type="text" class="form-control" id="nome" name="nome" >
                            </div>

                            <div class="form-group">
                                <label for="email">Email:</label>
                                <input type="email" class="form-control" id="email" name="email" >
                            </div>

                            <div class="form-group">
                                <label for="password">Senha:</label>
                                <input type="password" class="form-control" id="senha" name="senha" >
                            </div>

                            <div class="form-group">
                                <label for="password">Senha novamente:</label>
                                <input type="password" class="form-control" id="senha2" name="senha2" >
                            </div>

                            <button type="submit" class="btn btn-primary ">Cadastrar <i class="fa fa-check" aria-hidden="true"></i></button>
                        </form>
                    </div>
                </div>
            </section>
          </div>
        </div>
        @include('templatemo-js.partials.sidebar')
    </div>
    @include('templatemo-js.partials.footer')
</body>
</html>
