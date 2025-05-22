<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Trades | Manager</title>
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
  <style>
    .card-fixed-height {
      height: 160px;
    }
    .card-icon {
      font-size: 2rem;
      opacity: 0.7;
    }
  </style>
</head>

<body class="is-preload">
  <div id="wrapper">
    <div id="main">
      <div class="inner">
        @include('templatemo-js.partials.header')
        <section class="main-banner">
          <h3 class="mb-3">Trades</h3>

          <button id="runBot" class="btn btn-primary mb-4"><i class="fa fa-bolt" aria-hidden="true"></i> run job</button>

          <div class="my-4">
            <canvas id="btcChart" height="100"></canvas>
          </div>

          <div class="row mt-4 mb-4">
            <div class="col-md-4">
              <div class="card bg-warning text-white card-fixed-height">
                <div class="card-body d-flex flex-column justify-content-center">
                  <div class="d-flex justify-content-between align-items-center">
                    <div>
                      <h5 class="card-title">Preço do Bitcoin</h5>
                      <p class="card-text font-weight-bold">R$ {{ number_format($btcPrice, 2, ',', '.') }}</p>
                    </div>
                    <i class="fas fa-coins card-icon"></i>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-4">
              <div class="card bg-dark text-white card-fixed-height">
                <div class="card-body d-flex flex-column justify-content-center">
                  <div class="d-flex justify-content-between align-items-center">
                    <div>
                      <h5 class="card-title">Lucro de hoje</h5>
                      <p class="card-text mb-1"><strong>R$ {{ number_format($todayProfit, 2, ',', '.') }}</strong></p>
                    </div>
                    <i class="fas fa-calendar-day card-icon"></i>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-4">
              <div class="card bg-success text-white card-fixed-height">
                <div class="card-body d-flex flex-column justify-content-center">
                  <div class="d-flex justify-content-between align-items-center">
                    <div>
                      <h5 class="card-title">Lucro do mês</h5>
                      <p class="card-text mb-1"><strong>R$ {{ number_format($monthProfit, 2, ',', '.') }}</strong></p>
                    </div>
                    <i class="fas fa-calendar-alt card-icon"></i>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="table-responsive">
            <table class="table table-striped">
              <thead>
                <tr>
                  <th>Data</th>
                  <th>Status</th>
                  <th>Valor investido</th>
                  <th>Quantidade - BTC</th>
                  <th>Preço de venda</th>
                  <th>Lucro</th>
                </tr>
              </thead>
              <tbody>
                @foreach($trades as $produtos)
                <tr>
                  <td>{{ $produtos->created_at }}</td>
                  <td>{{ $produtos->status }}</td>
                  <td>R$ {{ $produtos->amount_brl }}</td>
                  <td>{{ $produtos->amount_crypto }}</td>
                  <td>R$ {{ number_format($produtos->buy_price, 2) }}</td>
                  <td><?= (empty($produtos->profit_brl)) ? "" : "R$ ".$produtos->profit_brl ?></td>
                </tr>
                @endforeach
              </tbody>
            </table>
            <div class="d-flex justify-content-center mt-4">
              <nav>
                {!! $trades->appends(request()->query())->links('pagination::bootstrap-4') !!}
              </nav>
            </div>
          </div>
        </section>
      </div>
    </div>
    @include('templatemo-js.partials.sidebar')
  </div>
  @include('templatemo-js.partials.footer')

  <script>
    document.querySelectorAll('.editar-produtos').forEach(btn => {
      btn.addEventListener('click', function () {
        const userId = this.getAttribute('data-id');
        window.location.href = `/produto/${userId}`;
      });
    });

    document.getElementById('runBot').addEventListener('click', function () {
      fetch('/api/trading-bot/run')
        .then(response => response.json())
        .then(data => {
          Swal.fire({
            title: data.message,
            icon: 'info',
            confirmButtonText: 'Ok'
          });
        })
        .catch(error => {
          Swal.fire({
            title: 'Erro',
            text: 'Não foi possível executar o bot.',
            icon: 'error',
            confirmButtonText: 'Fechar'
          });
        });
    });

    const ctx = document.getElementById('btcChart').getContext('2d');
    const btcChart = new Chart(ctx, {
      type: 'line',
      data: {
        labels: {!! json_encode($btcHistory->pluck('created_at')->map(fn($d) => \Carbon\Carbon::parse($d)->format('H:i'))->toArray()) !!},
        datasets: [{
          label: 'Preço BTC',
          data: {!! json_encode($btcHistory->pluck('price')) !!},
          borderColor: 'rgba(75, 192, 192, 1)',
          backgroundColor: 'rgba(75, 192, 192, 0.2)',
          fill: true,
          tension: 0.1
        }]
      },
      options: {
        scales: {
          x: { display: true },
          y: { beginAtZero: false }
        }
      }
    });
  </script>
</body>

</html>
