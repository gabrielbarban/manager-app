<!DOCTYPE html>
<html lang="en">

  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>LOGIN | Manager</title>
  </head>

<body class="is-preload">

    <div id="wrapper">

        <div id="main">
          <div class="inner">

            @include('templatemo-js.partials.header')

            <section class="main-banner">
                <div class="container">
                    <div class="row justify-content-center mt-5">
                        <div class="col-md-6">
                            <?php
                                $message = \Illuminate\Support\Facades\Session::get('message');
                            ?>
                            <?php if (isset($message) && !empty($message)): ?>
                                <div class="alert alert-warning text-center mb-4" role="alert">
                                    <?php echo $message; ?>
                                </div>
                            <?php endif; ?>
                            <div class="card">
                                <div class="card-body">
                                    <h3 class="card-title text-center mb-4">ACESSO</h3>
                                    <form action="/authentication" method="POST">
                                        @csrf
                                        <div class="form-group">
                                            <label for="email">Email:</label>
                                            <input type="email" class="form-control" id="email" name="email" placeholder="Digite seu email">
                                        </div>
                                        <div class="form-group">
                                            <label for="password">Senha:</label>
                                            <input type="password" class="form-control" id="senha" name="senha" placeholder="Digite sua senha">
                                        </div>
                                        <button type="submit" class="btn btn-primary btn-block">Login</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

          </div>
        </div>
    </div>

    @include('templatemo-js.partials.footer')
</body>
  </body>

</html>
