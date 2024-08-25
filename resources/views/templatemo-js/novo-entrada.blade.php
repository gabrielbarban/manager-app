<!DOCTYPE html>
<html lang="en">

  <head>
    <meta charset="utf-8">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Nova entrada | Manager</title>
  </head>

<body class="is-preload">
    <div id="wrapper">
        <div id="main">
          <div class="inner">
            @include('templatemo-js.partials.header')
            <div class="mb-3 d-flex">
                <a href="/entradas" class="btn btn-primary"><i class="fa fa-reply" aria-hidden="true"></i> Voltar</a>
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
                        <h3 class="card-title text-center mb-4">Nova entrada</h3>
                        <form action="/entrada/save" method="POST">
                            @csrf

                            <input type="hidden" id="transacao_tipo_id" name="transacao_tipo_id" value="1">

                            <div class="form-group">
                                <label for="titulo">Título:</label>
                                <input type="text" class="form-control" id="titulo" name="titulo" required>
                            </div>

                            <div class="form-group">
                                <label for="desc">Descrição:</label>
                                <textarea class="form-control" id="desc" name="desc" rows="4"></textarea>
                            </div>

                            <div class="form-group">
                                <label for="valor">Valor:</label>
                                <input type="number" step="0.01" class="form-control" id="valor" name="valor" readonly>
                            </div>

                            <div class="form-group">
                                <label for="categoria_id">Status:</label>
                                <select class="form-control" id="status" name="status" required>
                                    <option value="1">Confirmada</option>
                                    <option value="0">Em análise</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="categoria_id">Cliente:</label>
                                <select class="form-control" id="cliente_id" name="cliente_id" required>
                                    <option value="">Selecione um cliente</option>
                                    @foreach($clientes as $cliente)
                                        <option value="{{ $cliente->id }}">{{ $cliente->nome }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="categoria_id">Produto:</label>
                                <select class="form-control" id="produto_id" name="produto_id[]" multiple required>
                                    <option value="">Selecione os produtos</option>
                                    @foreach($produtos as $produto)
                                        <option value="{{ $produto->id }}">{{ $produto->nome }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="titulo">Observação:</label>
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
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#produto_id').select2({
                placeholder: "Selecione os produtos",
                allowClear: true,
                width: '100%'
            });

            function calcularValorTotal() {
                var produtosSelecionados = $('#produto_id').val();

                if (produtosSelecionados.length === 0) {
                    $('#valor').val('0.00');
                    return;
                }

                $.ajax({
                    url: '/produto/calcula-valor',
                    method: 'GET',
                    data: {
                        produtos: produtosSelecionados,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        $('#valor').val(response.valor);
                    },
                    error: function() {
                        $('#valor').val('0.00');
                    }
                });
            }

            $('#produto_id').on('change', function() {
                calcularValorTotal();
            });

            $('#valor').val('0.00');
        });
    </script>
</body>
</html>
