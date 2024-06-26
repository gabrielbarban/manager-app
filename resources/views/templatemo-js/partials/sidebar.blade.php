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
            <li><a href="/receitas"><i class="fa fa-plus" aria-hidden="true"></i> Receitas</a></li>
            <li><a href="/despesas"><i class="fa fa-minus" aria-hidden="true"></i> Despesas</a></li>
            <li>
                <span class="opener"><i class="fa fa-cogs" aria-hidden="true"></i> Configurações</span>
                <ul>
                    <li><a href="/usuarios"><i class="fa fa-user" aria-hidden="true"></i> Usuários</a></li>
                    <li><a href="/empresas"><i class="fa fa-university" aria-hidden="true"></i> Empresas</a></li>
                    <li><a href="/categorias"><i class="fa fa-tag" aria-hidden="true"></i> Categorias</a></li>
                </ul>
            </li>
            <li><a href="/logout"><i class="fa fa-sign-out"></i> Sair</a></li>
            <!--
                <li>
                    <span class="opener">Dropdown One</span>
                    <ul>
                    <li><a href="#">First Sub Menu</a></li>
                    <li><a href="#">Second Sub Menu</a></li>
                    <li><a href="#">Third Sub Menu</a></li>
                    </ul>
                </li>
                <li>
                    <span class="opener">Dropdown Two</span>
                    <ul>
                    <li><a href="#">Sub Menu #1</a></li>
                    <li><a href="#">Sub Menu #2</a></li>
                    <li><a href="#">Sub Menu #3</a></li>
                    </ul>
                </li>
                <li><a href="https://www.google.com">External Link</a></li>
            -->
            </ul>
        </nav>

        <!-- Featured Posts 
        <div class="featured-posts">
            <div class="heading">
            <h2>Featured Posts</h2>
            </div>
            <div class="owl-carousel owl-theme">
            <a href="#">
                <div class="featured-item">
                <img src="assets/images/featured_post_01.jpg" alt="featured one">
                <p>Aliquam egestas convallis eros sed gravida. Curabitur consequat sit.</p>
                </div>
            </a>
            <a href="#">
                <div class="featured-item">
                <img src="assets/images/featured_post_01.jpg" alt="featured two">
                <p>Donec a scelerisque massa. Aliquam non iaculis quam. Duis arcu turpis.</p>
                </div>
            </a>
            <a href="#">
                <div class="featured-item">
                <img src="assets/images/featured_post_01.jpg" alt="featured three">
                <p>Suspendisse ac convallis urna, vitae luctus ante. Donec sit amet.</p>
                </div>
            </a>
            </div>
        </div>
        -->

        <!-- Footer -->
        <footer id="footer">
            <br><br><br><br><br><br><br><br><br><br><br><br>
            <p class="copyright">Copyright &copy; 2024 Barban Softwares LTDA
        </footer>
    </div>
</div>