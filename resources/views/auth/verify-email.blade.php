<!DOCTYPE html>
<html lang="id">
<head>
    <title>Verifikasi Email</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">Verifikasi Email Anda</div>
                    <div class="card-body">
                        <p>Kami telah mengirimkan kode verifikasi ke email Anda. Silakan cek email Anda dan masukkan kode di bawah ini.</p>
                        <form method="POST" action="{{ route('verify.email') }}">
                            @csrf
                            <div class="mb-3">
                                <label for="verification_code" class="form-label">Kode Verifikasi</label>
                                <input type="text" class="form-control" id="verification_code" name="verification_code" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Verifikasi</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>