<?php
    $id_usuario = \Illuminate\Support\Facades\Session::get('id_usuario');
    $nome_usuario = \Illuminate\Support\Facades\Session::get('nome_usuario');
    $email_usuario = \Illuminate\Support\Facades\Session::get('email_usuario');
?>

<div id="sidebar">
    <div class="inner">
        
        <div style="margin-top: 50px !important; margin-left: 4px !important; color: white !important; font-size: 15px !important">
            <i class="fa fa-user" aria-hidden="true"></i> {{ $nome_usuario }}
        </div>
        <!-- Menu -->
        <nav id="menu">
            <ul>
            <li><a href="/painel"><i class="fa fa-tachometer" aria-hidden="true"></i> Painel</a></li>
            <li><a href="/produtos"><i class="fa fa-bolt" aria-hidden="true"></i> Produtos</a></li>
            <li><a href="/entradas"><i class="fa fa-plus" aria-hidden="true"></i> Receitas</a></li>
            <li><a href="/despesas"><i class="fa fa-minus" aria-hidden="true"></i> Despesas</a></li>
            <li>
                <span class="opener"><i class="fa fa-cogs" aria-hidden="true"></i> Configurações</span>
                <ul>
                    <li><a href="/usuarios"><i class="fa fa-user" aria-hidden="true"></i> Usuários</a></li>
                    <li><a href="/empresas"><i class="fa fa-university" aria-hidden="true"></i> Clientes</a></li>
                    <li><a href="/categorias"><i class="fa fa-tag" aria-hidden="true"></i> Categorias</a></li>
                </ul>
            </li>
            <li><a href="/logout"><i class="fa fa-sign-out"></i> Sair</a></li>
            </ul>
        </nav>

        <!-- Footer -->
        <footer id="footer">
            <br><br><br><br><br><br><br><br>
            <p class="copyright">Copyright &copy; 2024 Barban Softwares LTDA
        </footer>
    </div>
</div>