<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Student</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
</head>

<body>
    <div class="container mt-5">
        <h1>Upload from file</h1>
        <a href="{{ route('downloadExcel') }}" class="text-secondary">Download Excel Template</a>

        @if (session()->has('success'))
            <div class="alert alert-success mt-2">
                {{ session('success') }}
            </div>
        @endif

        @if (session()->has('error'))
            <div class="alert alert-danger mt-2">
                {{ session('error') }}
            </div>
        @endif

        <form action="{{ route('excelStore') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="my-3">
                <input class="form-control" type="file" id="file" name="file" required accept="xlsx/*">
            </div>

            <div class="row mb-5">
                <div class="col-6">
                    <button type="submit" class="btn btn-outline-primary w-100 text-uppercase">upload</button>
                </div>
                <div class="col-6">
                    <a href="{{ route('index') }}" class="btn btn-outline-danger w-100 text-uppercase">cancel</a>
                </div>
            </div>
        </form>

        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Name</th>
                    <th scope="col">Level</th>
                    <th scope="col">Class</th>
                    <th scope="col">Parent Contact</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $r)
                    <tr>
                        <td>{{ $r->name }}</td>
                        <td>{{ $r->level }}</td>
                        <td>{{ $r->class }}</td>
                        <td>{{ $r->parent }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous">
    </script>
</body>

</html>
