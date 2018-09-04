<html>
  <head>
    <title>{{ config('backpack.base.project_name') }} Error 401</title>

    <link rel="stylesheet" href="{{ asset('css/erros.css') }}">
  </head>
  <body>
    <div class="container">
      <div class="content">
        <div class="title">401</div>
        <div class="quote">Ação não autorizada.</div>
        <div class="explanation">
          <br>
          <small>
            <?php
              $default_error_message = "<a href='".url('/')."'>Por favor, volte para nossa Página Inicial</a>.";
            ?>
            {!! $default_error_message !!}
         </small>
       </div>
      </div>
    </div>
  </body>
</html>
