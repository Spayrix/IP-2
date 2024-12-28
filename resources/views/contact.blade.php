@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="my-4 text-center">Contact Us</h1>

        <div class="row">
            <!-- Contact Form -->
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Send Us a Message</h5>

                        <form method="POST" action="{{ route('contact.submit') }}">
                            @csrf
                            <div class="mb-3">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" class="form-control" id="name" name="name" required>
                            </div>

                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" name="email" required>
                            </div>

                            <div class="mb-3">
                                <label for="message" class="form-label">Message</label>
                                <textarea class="form-control" id="message" name="message" rows="4" required></textarea>
                            </div>

                            <button type="submit" class="btn btn-primary">Send Message</button>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Contact Information -->
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Our Office</h5>
                        <p><strong>Address:</strong> 123 E-Commerce St, Some City, Country</p>
                        <p><strong>Phone:</strong> (123) 456-7890</p>
                        <p><strong>Email:</strong> contact@ecommerce.com</p>

                        <h5 class="mt-4">Follow Us</h5>
                        <a href="https://facebook.com" class="btn btn-primary" target="_blank">Facebook</a>
                        <a href="https://twitter.com" class="btn btn-info ms-2" target="_blank">Twitter</a>
                        <a href="https://instagram.com" class="btn btn-danger ms-2" target="_blank">Instagram</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
