@extends('admin.layouts.app')
@section('seo')
    <?php
    $data_seo = [
        'title' => 'Message | ' . Helpers::get_option_minhnn('seo-title-add'),
    ];
    $seo = WebService::getSEO($data_seo);
    ?>
    @include('admin.partials.seo')
@endsection
@section('content')
    <div class="row justify-content-center pt-lg-5 pt-3">
        <div class="col-lg-8">
            <div id="talkjs-container" style="height: 650px;"></div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        Talk.ready.then(function() {
            // The core TalkJS lib has loaded, so let's identify the current user  to TalkJS.

            // Note: this code is exactly equal to the `var operator =` declaration in
            // user.html
            var me = new Talk.User({
                // just hardcode any user id, as long as your real users don't have this id
                id: "myapp_operator",
                name: "CNLGaming",
                email: "huunamtn@gmail.com",
                photoUrl: "https://cnlgaming.com/upload/images/favicon.png",
                welcomeMessage: "Hi there! How can I help you?"
            });

            // TODO: replace the appId below with the appId provided in the Dashboard
            window.talkSession = new Talk.Session({
                appId: "{{ config('talkjs.app_id') }}",
                me: me
            });

            var inbox = talkSession.createInbox();
            inbox.mount(document.getElementById("talkjs-container"));
        });
    </script>
@endpush
