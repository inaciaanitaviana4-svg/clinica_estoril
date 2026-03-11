<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Clí­nica Estoril - A sua saude nas melhores mãos ">
    <link rel="icon" type="image/jpg" href="imagem/logo.jpg">
    <link rel="stylesheet" href="/styles.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
        <link rel="stylesheet" type="text/css" href="/toastify.min.css" />
    <title>Clínica Estoril - Página Não Encontrada</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
            padding: 50px;
            background-color: #f4f4f4;
        }
        .error-container {
            max-width: 600px;
            margin: 0 auto;
            background: white;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        h1 {
            font-size: 72px;
            color: red;
            margin: 0;
        }
        h2 {
            color: #333;
            margin-top: 0;
        }
        p {
            color: #666;
            line-height: 1.6;
        }
        .btn {
            display: inline-block;
            padding: 10px 20px;
            background-color:  #0066cc;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            margin-top: 20px;
        }
        .btn:hover {
            background-color: #2980b9;
        }
    </style>
</head>
<body>
    <div class="error-container">
        <h1>404</h1>
        <h2>Oops! Página não encontrada</h2>
        <p>A página que vocé está procurando pode ter sido removida, 
           teve seu nome alterado ou está temporariamente indisponível.</p>
       
         <a href="{{ url('/') }}" class="btn"><i class="voltar"> Voltar para a pagina inicial<i></a>
    </div>
</body>
</html>