<x-guest-layout>
    
    <head>
    <title>Upload Excel Sheet</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>
<body>
@if (session('success'))
    <div class="alert alert-success mt-3">
        {{ session('success') }}
    </div>
@endif

@if (session('error'))
    <div class="alert alert-danger mt-3">
        {{ session('error') }}
    </div>
@endif

@if ($errors->any())
    <div class="alert alert-danger mt-3">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<div class="container">
    <h2 class="mt-5">Upload Excel Sheet</h2>

<!-- Button to download the template -->
<a href="{{ route('users.template') }}" class="btn btn-secondary mb-3">Download Excel Template</a>

<a href="/export/userstemp.xlsx" class="btn btn-secondary mb-3">Download Excel Template</a>

    <form action="{{ route('users.import') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="file">Excel File:</label>
            <input type="file" name="file" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Upload</button>
    </form>
</div>
</body>
</x-guest-layout>