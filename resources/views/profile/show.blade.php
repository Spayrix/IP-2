@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">

            <div class="col-md-4">
                <h1>Profile</h1>


                <div class="text-center mb-4">
                    <img src="{{ $user->avatar ? asset('storage/' . $user->avatar) : asset('images/default-avatar.png') }}" alt="Avatar" class="img-fluid rounded-circle" style="width: 150px; height: 150px;">
                    <form action="{{ route('profile.avatar.update') }}" method="POST" enctype="multipart/form-data" class="mt-2">
                        @csrf
                        <input type="file" name="avatar" class="form-control mb-2">
                        <button type="submit" class="btn btn-primary">Update Avatar</button>
                    </form>
                </div>


                <form action="{{ route('profile.update') }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="first_name" class="form-label">First Name</label>
                            <input type="text" name="first_name" id="first_name" class="form-control form-control-sm" value="{{ old('first_name', $user->first_name) }}" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="last_name" class="form-label">Last Name</label>
                            <input type="text" name="last_name" id="last_name" class="form-control form-control-sm" value="{{ old('last_name', $user->last_name) }}" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="gender" class="form-label">Gender</label>
                            <select name="gender" id="gender" class="form-control form-control-sm" required>
                                <option value="male" {{ old('gender', $user->gender) == 'male' ? 'selected' : '' }}>Male</option>
                                <option value="female" {{ old('gender', $user->gender) == 'female' ? 'selected' : '' }}>Female</option>
                                <option value="other" {{ old('gender', $user->gender) == 'other' ? 'selected' : '' }}>Other</option>
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="age" class="form-label">Age</label>
                            <input type="number" name="age" id="age" class="form-control form-control-sm" value="{{ old('age', $user->age) }}" required>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Save Changes</button>
                </form>
            </div>

            <!-- Middle Column: My Addresses -->
            <div class="col-md-4">
                <h2>My Addresses</h2>
                <form action="{{ route('address.store') }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="title" class="form-label">Address Title</label>
                            <input type="text" name="title" class="form-control form-control-sm" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="address_line" class="form-label">Address Line</label>
                            <input type="text" name="address_line" class="form-control form-control-sm" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="city" class="form-label">City</label>
                            <input type="text" name="city" class="form-control form-control-sm" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="state" class="form-label">State</label>
                            <input type="text" name="state" class="form-control form-control-sm" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="postal_code" class="form-label">Postal Code</label>
                            <input type="text" name="postal_code" class="form-control form-control-sm" required>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-success">Add Address</button>
                </form>

                <ul class="mt-3">
                    @foreach($addresses as $address)
                        <li>{{ $address->title }} - {{ $address->address_line }} <a href="{{ route('address.edit', $address->id) }}" class="btn btn-sm btn-warning">Edit</a> <a href="{{ route('address.destroy', $address->id) }}" class="btn btn-sm btn-danger">Delete</a></li>
                    @endforeach
                </ul>
            </div>

            <!-- Right Column: Account Settings -->
            <div class="col-md-4">
                <h2>Account Settings</h2>
                <form action="{{ route('profile.update') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" name="username" id="username" class="form-control form-control-sm" value="{{ old('username', $user->username) }}">
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" name="email" id="email" class="form-control form-control-sm" value="{{ old('email', $user->email) }}">
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">New Password</label>
                        <input type="password" name="password" id="password" class="form-control form-control-sm">
                    </div>
                    <div class="mb-3">
                        <label for="password_confirmation" class="form-label">Confirm New Password</label>
                        <input type="password" name="password_confirmation" id="password_confirmation" class="form-control form-control-sm">
                    </div>
                    <button type="submit" class="btn btn-primary">Save Changes</button>
                </form>
            </div>
        </div>
    </div>
@endsection
