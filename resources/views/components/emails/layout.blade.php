<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $title ?? config('app.name') }}</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            background-color: #f7f8f9;
            font-family: 'Instrument Sans', 'Helvetica Neue', Helvetica, Arial, sans-serif;
            -webkit-font-smoothing: antialiased;
        }
        .container {
            width: 100%;
            max-width: 600px;
            margin: 0 auto;
            padding: 40px 20px;
        }
        .header {
            text-align: center;
            margin-bottom: 30px;
        }
        .card {
            background-color: #ffffff;
            border: 1px solid #e2e8f0;
            border-radius: 8px;
            padding: 40px;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
        }
        .title {
            font-size: 24px;
            font-weight: 700;
            color: #0f172a;
            text-align: center;
            margin-bottom: 24px;
            letter-spacing: -0.025em;
        }
        .content {
            font-size: 16px;
            line-height: 1.6;
            color: #475569;
            text-align: center;
        }
        .code-container {
            margin: 32px 0;
            padding: 20px;
            text-align: center;
        }
        .code {
            font-size: 48px;
            font-weight: 800;
            color: #0f172a;
            letter-spacing: 0.1em;
        }
        .footer {
            margin-top: 40px;
            text-align: center;
            font-size: 12px;
            color: #94a3b8;
            line-height: 1.5;
        }
        .footer-logo {
            margin-bottom: 16px;
            opacity: 0.5;
        }
        .footer-links {
            margin-top: 12px;
        }
        .footer-links a {
            color: #64748b;
            text-decoration: underline;
            margin: 0 8px;
        }
        .button {
            display: inline-block;
            padding: 12px 24px;
            background-color: #ea580c;
            color: #ffffff !important;
            text-decoration: none;
            border-radius: 6px;
            font-weight: 700;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        

        <!-- Main Card -->
        <div class="card">
            @if(isset($title))
                <div class="title">{{ $title }}</div>
            @endif

            <div class="content">
                {{ $slot }}
            </div>

            @if(isset($footer_text))
                <div style="margin-top: 32px; border-top: 1px solid #f1f5f9; padding-top: 24px; font-size: 13px; color: #64748b; text-align: center;">
                    {{ $footer_text }}
                </div>
            @endif
        </div>

        <!-- Email Footer -->
        <div class="footer">
            
            
            <div style="margin-top: 8px;">
                Medvroom does not provide medical advice, diagnosis, or treatment. Please discuss all medical questions and concerns with your healthcare provider.
            </div>
            <div class="footer-links">
                <a href="#">Privacy</a>
                <a href="#">Terms</a>
            </div>
        </div>
    </div>
</body>
</html>
