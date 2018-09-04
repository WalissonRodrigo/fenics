<html>
  <head>
    <title>{{ config('backpack.base.project_name') }} Error 503</title>
    <link rel="stylesheet" href="{{ asset('css/erros.css') }}">
  </head>
  <body>
    <div class="container">
      <div class="content">
        <div class="title">503</div>
        <div class="quote">Não é você, sou eu.</div>
        <div class="explanation">
          <br>
          <small>
            <?php
              $default_error_message = "O servidor está sobrecarregado ou inativo para manutenção. Por favor, tente novamente mais tarde.";
            ?>
            {!! $default_error_message !!}
         </small>
       </div>
      </div>
    </div>
  </body>
</html>
