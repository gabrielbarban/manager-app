<!DOCTYPE html>
<html lang="en">

  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Categorias | Manager</title>
  </head>

<body class="is-preload">
    <div id="wrapper">
        <div id="main">
          <div class="inner">
            @include('templatemo-js.partials.header')
            <div class="mb-3 d-flex justify-content-end">
                <a href="/categoria/novo" class="btn btn-primary">Adicionar Nova Categoria <i class="fa fa-tag" aria-hidden="true"></i></a>
            </div>
            @if(session('success'))
                <div id="success-alert" class="alert alert-success">
                    {{ session('success') }}
                </div>
                <script>
                    setTimeout(function(){
                        $('#success-alert').fadeOut('slow');
                    }, 3000);
                </script>
            @endif
            <section class="main-banner">
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Nome</th>
                                <th>Ação</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($categorias as $categoria)
                                <tr>
                                    <td>{{ $categoria->nome }}</td>
                                    <td>
                                        <button type="button" class="btn btn-primary editar-categoria" data-id="{{ $categoria->id }}">
                                            <i class="fa fa-pencil-square-o" aria-hidden="true"></i> Editar
                                        </button>
                                        <button type="button" class="btn btn-danger">
                                            <i class="fa fa-trash" aria-hidden="true"></i> Excluir
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </section>
          </div>
        </div>
        @include('templatemo-js.partials.sidebar')
    </div>
    @include('templatemo-js.partials.footer')
</body>

<script>
    document.querySelectorAll('.editar-categoria').forEach(btn => {
        btn.addEventListener('click', function() {
            const userId = this.getAttribute('data-id');
            window.location.href = `/categoria/${userId}`;
        });
    });
</script>

</html>
