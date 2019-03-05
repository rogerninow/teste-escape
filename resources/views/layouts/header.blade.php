 <header>
     <div class="navbar navbar-dark bg-dark box-shadow">
         <div class="container d-flex justify-content-between">
             <a href="/" class="navbar-brand d-flex align-items-center">
                 <i class="fa fa-newspaper"></i>&nbsp
                 <strong>{{ config('app.name', 'Escape') }}</strong>
             </a>
             <div class="dropleft">
                <button class="navbar-toggler" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <a class="dropdown-item" href="/categorias">Categorias</a>
                    <a class="dropdown-item" href="/noticias">Notícias</a>
                    <a class="dropdown-item" href="/">Listar Notícias</a>
                </div>
            </div>
         </div>
     </div>
 </header>