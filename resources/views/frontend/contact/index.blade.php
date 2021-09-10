@extends('layouts.app')
@section('title', 'Contact us')
@section('content')
    <div class="breadcrumb-area pt-5 pb-5 mb-5" style="background-color: #09c6a2;">
        <div class="container">
            <div class="breadcrumb-content text-center">
                <h2>contact us</h2>
                <ul>
                    <li><a href="{{ route('home') }}">home</a></li>
                    <li> contact us</li>
                </ul>
            </div>
        </div>
    </div>

    <div class="container pb-5 mb-5">
        <div class="row">
            <div class="col-lg-8">
                <div class="col-lg-12">
                    <div class="contact-message">

                        <div class="contact-title">
                            <h4>Contact Information</h4>
                            @include('partials.frontend.flash')
                        </div>

                        <form action="{{ route('contact.store') }}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="contact-input-style mb-30">
                                        <input type="text" name="name" value="{{ old('name') }}" placeholder="Name">
                                        @error('name')<span class="text-danger">{{ $message }}</span>@enderror
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="contact-input-style mb-30">
                                        <input type="email" name="email" value="{{ old('email') }}" placeholder="Email">
                                        @error('email')<span class="text-danger">{{ $message }}</span>@enderror
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="contact-input-style mb-30">
                                        <input type="text" name="title" value="{{ old('title') }}" placeholder="Title">
                                        @error('title')<span class="text-danger">{{ $message }}</span>@enderror
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="contact-textarea-style mb-30">
                                        <textarea name="message" placeholder="Your message">{{ old('message') }}</textarea>
                                        @error('message')<span class="text-danger">{{ $message }}</span>@enderror
                                    </div>
                                    <button class="submit contact-btn btn-hover">
                                        <i class="far fa-envelope"></i> Send
                                    </button>
                                </div>
                            </div>
                        </form>

                        <p class="form-messege"></p>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="contact-info-wrapper">
                    <div class="contact-title">
                        <h4>Location & Details</h4>
                    </div>
                    <div class="contact-info">
                        <div class="single-contact-info">
                            <div class="contact-info-icon">
                                <i class="fas fa-map-marker-alt"></i>
                            </div>
                            <div class="contact-info-text">
                                <p><span>Address:</span> {!! getSettingsOf('address') !!}</p>
                            </div>
                        </div>
                        <div class="single-contact-info">
                            <div class="contact-info-icon">
                                <i class="far fa-envelope"></i>
                            </div>
                            <div class="contact-info-text">
                                <p><span>Email: </span> {!! getSettingsOf('site_email') !!}</p>
                            </div>
                        </div>
                        <div class="single-contact-info">
                            <div class="contact-info-icon">
                                <i class="fas fa-phone"></i>
                            </div>
                            <div class="contact-info-text">
                                <p><span>Phone: </span> {!! getSettingsOf('phone_number') !!}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
