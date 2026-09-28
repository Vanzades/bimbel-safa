<link rel="icon" href="{{ asset('image/favicon.ico') }}" sizes="any">
<link rel="shortcut icon" href="{{ asset('image/favicon.ico') }}">
@foreach ([16, 32, 48, 64, 192, 512] as $size)
    <link rel="icon" type="image/png" sizes="{{ $size }}x{{ $size }}" href="{{ asset('image/favicon-' . $size . 'x' . $size . '.png') }}">
@endforeach
<link rel="apple-touch-icon" sizes="180x180" href="{{ asset('image/favicon-180x180.png') }}">
<meta name="theme-color" content="#1e1b4b">
