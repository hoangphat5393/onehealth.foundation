@php
    if ($lc == 'vi') {
        $lk = '';
    } else {
        $lk = $lc;
    }
@endphp

@extends($templatePath . '.layouts.index')

@section('seo')
@endsection

@section('content')
    <div id='contact-page'>
        <div id="contact-banner" class="banner">
            <div class="bg-fill">
                <div class="bg-img w-100">
                    <img src="{{ url('assets/images/bg-contact.jpg') }}">
                </div>
                <div class="bg-overlay"></div>
            </div>
            <div class="banner-content">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-6 p-md-5 pt-3 bg-white contact-page-info">
                            {!! htmlspecialchars_decode(setting_option('contact-compay')) !!}
                            <iframe
                                src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d15666.832744319301!2d106.7347412!3d10.9853848!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3174db4ec82e3157%3A0xe0ac6aa0b2b864a4!2zQ8OUTkcgVFkgVE5ISCBTWCAtIFRNIEjDk0EgS0VPIELDjE5IIFRI4bqgTkg!5e0!3m2!1svi!2s!4v1701240180057!5m2!1svi!2s"
                                width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                        </div>
                        <div class="col-lg-6 p-md-5 pt-3 bg-white contact-page-info">
                            <form method="POST" action="{{ url('contact.html') }}" enctype="multipart/form-data">
                                @csrf
                                @include($templatePath . '.contact.contact_content')
                                <div class="text-center">
                                    <button type="submit" class="btn btn-primary">{{ __('Send message') }}</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
