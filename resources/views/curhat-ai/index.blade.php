@extends('layouts.app')

@section('content')
<div class="container">
    <h3>Curhat AI</h3>
    <form action="{{ route('curhat.ai.store') }}" method="POST">
        @csrf
        <textarea name="curhatan" class="form-control mb-3" rows="4" placeholder="Tulis curhatanmu..."></textarea>
        <button type="submit" class="btn btn-primary">Kirim</button>
    </form>

    @if(session('curhatan'))
        <div class="mt-4">
            <h5>Curhatanmu:</h5>
            <p>{{ session('curhatan') }}</p>
            <h5>Jawaban AI:</h5>
            <p>{{ session('jawaban') }}</p>
        </div>
    @endif
</div>
@endsection
