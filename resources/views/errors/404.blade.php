<html>
  <head>
    <title>{{ config('backpack.base.project_name') }} Error 404</title>

    <link rel="stylesheet" href="{{ asset('css/erros.css') }}">

  </head>
  <body>
    <div class="container">
      <div class="content">
        <div class="title">404</div>
        <div class="quote">Página não encontrada.</div>
        <div class="explanation">
          <br>
          <small>
            <?php
              $default_error_message = '<ul><a href='.url('/').'>Por favor, volte para nossa <b>Página Inicial</b></a></ul>';
            ?>
            {!! $default_error_message !!}
         </small>
       </div>
      </div>
    </div>
  </body>
</html>
