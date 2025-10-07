<form method="POST" action="{{ route('otp.verify') }}">
    @csrf

    <h2>Verifikasi Kode OTP</h2>
    <p>Kode OTP telah dikirim ke email **{{ $email }}**. Silakan periksa kotak masuk Anda.</p>
    
    <input type="hidden" name="email" value="{{ $email }}">

    <div>
        <label for="otp">Kode OTP</label>
        <input id="otp" type="text" name="otp" required autofocus>
    </div>

    @error('otp')
        <div>{{ $message }}</div>
    @enderror

    <div>
        <button type="submit">Verifikasi</button>
    </div>
</form>
