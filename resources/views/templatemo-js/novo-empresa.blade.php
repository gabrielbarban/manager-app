<!DOCTYPE html>
<html lang="en">

  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Nova Empresa | Manager</title>
  </head>

<body class="is-preload">
    <div id="wrapper">
        <div id="main">
          <div class="inner">
            @include('templatemo-js.partials.header')
            <div class="mb-3 d-flex">
                <a href="/empresas" class="btn btn-primary"><i class="fa fa-reply" aria-hidden="true"></i> Voltar</a>
            </div>
            <section class="main-banner">
                @if(session('error'))
                    <div id="error-alert" class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                    <script>
                        setTimeout(function(){
                            $('#error-alert').fadeOut('slow');
                        }, 3000);
                    </script>
                @endif

                <div class="card">
                    <div class="card-body">
                        <h3 class="card-title text-center mb-4">Nova Empresa</h3>
                        <form action="/empresa/save" method="POST">
                            @csrf

                            <div class="form-group">
                                <label for="nome">Nome:</label>
                                <input type="text" class="form-control" id="nome" name="nome" required>
                            </div>

                            <div class="form-group">
                                <label for="email">Email:</label>
                                <input type="email" class="form-control" id="email" name="email">
                            </div>


                            <div class="form-group">
                                <label for="email">Telefone:</label>
                                <input type="text" class="form-control" id="telefone" name="telefone">
                            </div>


                            <div class="form-group">
                                <label for="email">Obs:</label>
                                <input type="text" class="form-control" id="obs" name="obs">
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
