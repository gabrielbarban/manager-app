<!DOCTYPE html>
<html lang="en">

  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Usuários | Manager</title>
  </head>

<body class="is-preload">
    <div id="wrapper">
        <div id="main">
          <div class="inner">
            @include('templatemo-js.partials.header')
            <div class="mb-3 d-flex justify-content-end">
                <a href="/usuario/novo" class="btn btn-primary">Adicionar Novo Usuário <i class="fa fa-user" aria-hidden="true"></i></a>
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
                                <th>Email</th>
                                <th>Ação</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($usuarios as $usuario)
                                <tr>
                                    <td>{{ $usuario->nome }}</td>
                                    <td>{{ $usuario->email }}</td>
                                    <td>
                                        <button type="button" class="btn btn-primary editar-usuario" data-id="{{ $usuario->id }}">
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
    document.querySelectorAll('.editar-usuario').forEach(btn => {
        btn.addEventListener('click', function() {
            const userId = this.getAttribute('data-id');
            window.location.href = `/usuario/${userId}`;
        });
    });
</script>

</html>
