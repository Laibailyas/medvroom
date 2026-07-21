<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <style>
        body { font-family: DejaVu Sans, sans-serif; color: #1e293b; font-size: 12px; line-height: 1.6; }
        h1 { font-size: 22px; margin-bottom: 4px; }
        .meta { color: #94a3b8; font-size: 10px; text-transform: uppercase; letter-spacing: 1px; margin-bottom: 24px; }
        .content h2 { font-size: 15px; margin-top: 20px; }
        .content p { margin: 8px 0; }
        .content ul, .content ol { margin: 8px 0 8px 20px; }
    </style>
</head>
<body>
    <h1>{{ $title }}</h1>
    <p class="meta">Version {{ $version }} &middot; MedVroom</p>
    <div class="content">
        {!! $content !!}
    </div>
</body>
</html>
