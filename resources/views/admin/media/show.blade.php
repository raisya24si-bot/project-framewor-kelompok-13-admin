<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Preview Media</title>
    <style>
        body {
            margin: 0;
            background: #000;
            height: 100vh;
            overflow: hidden;
        }

        .toolbar {
            position: fixed;
            top: 15px;
            right: 20px;
            z-index: 9999;
            display: flex;
            gap: 10px;
        }

        .btn {
            padding: 8px 14px;
            border-radius: 6px;
            text-decoration: none;
            font-size: 14px;
            color: #fff;
            background: rgba(0,0,0,.7);
        }

        .btn:hover {
            background: #dc3545;
        }

        .viewer {
            width: 100%;
            height: 100%;
        }

        img {
            max-width: 90%;
            max-height: 90%;
            margin: auto;
            display: block;
            margin-top: 5%;
            border-radius: 8px;
            background: #fff;
        }

        iframe {
            width: 100%;
            height: 100%;
            border: none;
            background: #fff;
        }
    </style>
</head>
<body>

    {{-- TOOLBAR --}}
    <div class="toolbar">
        <a href="{{ url()->previous() }}" class="btn">✕ Tutup</a>
        <a href="{{ asset('storage/'.$media->file_url) }}" class="btn" download>⬇ Download</a>
    </div>

    {{-- VIEWER --}}
    <div class="viewer">
        @if(Str::startsWith($media->mime_type, 'image'))
            <img src="{{ asset('storage/'.$media->file_url) }}">
        
        @elseif($media->mime_type === 'application/pdf')
            {{-- PDF FULLSCREEN --}}
            <iframe src="{{ asset('storage/'.$media->file_url) }}#toolbar=1&navpanes=0"></iframe>

        @else
            <p style="color:white;text-align:center;margin-top:20%">
                File tidak dapat dipreview.
            </p>
        @endif
    </div>

</body>
</html>
