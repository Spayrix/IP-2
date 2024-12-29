@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Profile</h1>

        <!-- Avatar Bölümü -->
        <div class="text-center mb-4">
            <!-- Avatar Resmi -->
            <img src="{{ $user->avatar ? asset('storage/' . $user->avatar) : 'default-avatar.png' }}" alt="Avatar" class="img-fluid rounded-circle" style="width: 150px; height: 150px;">

            <!-- Avatar Yükleme Formu -->
            <form action="{{ route('profile.avatar.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="file" name="avatar" class="form-control mb-2">
                <button type="submit" class="btn btn-primary">Avatarı Güncelle</button>
            </form>
        </div>

        <!-- Diğer Profil Bilgileri -->
        <div>
            <strong>Name:</strong> {{ $user->first_name }} {{ $user->last_name }}
            <br>
            <strong>Email:</strong> {{ $user->email }}
        </div>
    </div>
@endsection
