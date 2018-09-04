<html>
  <head>
    <title>{{ config('backpack.base.project_name') }} Error 500</title>
    <link rel="stylesheet" href="{{ asset('css/erros.css') }}">
  </head>
  <body>
    <div class="container">
      <div class="content">
        <div class="title">500</div>
        <div class="quote">O erro não foi seu pedido foi o servidor que não conseguiu processa-lo.</div>
        <div class="explanation">
          <br>
          <small>
            <?php
              $default_error_message = "Ocorreu um erro interno no servidor. Se o erro persistir, entre em contato com a equipe de desenvolvimento.";
            ?>
            {!! $default_error_message !!}
         </small>
       </div>
      </div>
    </div>
  </body>
</html>
