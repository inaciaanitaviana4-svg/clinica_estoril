<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Código de Recuperação - Clínica Estoril</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }
        .header {
            background: linear-gradient(135deg, #3498db, #2980b9);
            color: white;
            padding: 20px;
            text-align: center;
            border-radius: 10px 10px 0 0;
        }
        .content {
            background: #f9f9f9;
            padding: 30px;
            border-radius: 0 0 10px 10px;
        }
        .code {
            font-size: 32px;
            font-weight: bold;
            color: #3498db;
            text-align: center;
            padding: 20px;
            background: white;
            border-radius: 10px;
            letter-spacing: 5px;
            margin: 20px 0;
        }
        .footer {
            text-align: center;
            padding: 20px;
            font-size: 12px;
            color: #999;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h2>Clínica Estoril</h2>
            <p>Recuperação de Senha</p>
        </div>
        
        <div class="content">
            <p>Olá <strong>{{ $nome }}</strong>,</p>
            
            <p>Recebemos uma solicitação para redefinir a senha da sua conta na Clínica Estoril. Utilize o código abaixo para continuar com a recuperação:</p>
            
            <div class="code">
                {{ $codigo }}
            </div>
            
            <p><strong>Importante:</strong> Este código é válido por apenas <strong>15 minutos</strong>. Se você não solicitou a recuperação de senha, ignore este email.</p>
            
            <p>Se tiver problemas, entre em contato com o nosso suporte.</p>
            
            <p>Atenciosamente,<br>
            <strong>Equipe Clínica Estoril</strong></p>
        </div>
        
        <div class="footer">
            <p>© 2026 Clínica Estoril. Todos os direitos reservados.</p>
            <p>Municipio do Kilamba Kiaxi-Luanda, Golf2 vila Estoril, Angola</p>
        </div>
    </div>
</body>
</html>