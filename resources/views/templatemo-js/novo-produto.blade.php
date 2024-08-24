<!DOCTYPE html>
<html lang="en">

  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Novo Produto | Manager</title>
  </head>

<body class="is-preload">
    <div id="wrapper">
        <div id="main">
          <div class="inner">
            @include('templatemo-js.partials.header')
            <div class="mb-3 d-flex">
                <a href="/produtos" class="btn btn-primary"><i class="fa fa-reply" aria-hidden="true"></i> Voltar</a>
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
                        <h3 class="card-title text-center mb-4">Novo Produto</h3>
                        <form action="/produto/save" method="POST">
                            @csrf

                            <div class="form-group">
                                <label for="nome">Nome:</label>
                                <input type="text" class="form-control" id="nome" name="nome" required>
                            </div>

                            <div class="form-group">
                                <label for="descricao">Descrição:</label>
                                <textarea class="form-control" id="descricao" name="descricao" rows="4"></textarea>
                            </div>

                            <div class="form-group">
                                <label for="preco">Preço:</label>
                                <input type="number" step="0.01" class="form-control" id="preco" name="preco">
                            </div>

                            <div class="form-group">
                                <label for="categoria_id">Categoria:</label>
                                <select class="form-control" id="categoria_id" name="categoria_id" required>
                                    <option value="">Selecione uma categoria</option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->nome }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="imagem_url">URL da Imagem:</label>
                                <input type="text" class="form-control" id="imagem_url" name="imagem_url">
                            </div>

                            <div class="form-group form-check">
                                <input type="checkbox" class="form-check-input" id="ativo" name="ativo">
                                <label class="form-check-label" for="ativo">Ativo</label>
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
