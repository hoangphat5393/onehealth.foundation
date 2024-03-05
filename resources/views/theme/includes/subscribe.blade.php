<div class="row">
    <div class="col-md-8 pt-3">
        <h4>Bản tin điện tử</h4>
        <div role="form" class="wpcf7" id="wpcf7-f2105-o1" lang="en-US" dir="ltr">
            <div class="screen-reader-response">
                <p role="status" aria-live="polite" aria-atomic="true"></p>
                <ul></ul>
            </div>
            <form action="" method="post" class="" novalidate="novalidate">
                @csrf
                <div class="row">
                    <div class="col-6">
                        <label for="email" class="visually-hidden">Password</label>
                        <input type="email" class="form-control border-custom" id="inputPassword2" placeholder="Địa chỉ email của bạn">
                    </div>
                    <div class="col-auto">
                        <button type="submit" class="btn btn-custom">Đăng ký</button>
                        <span class="ajax-loader"></span>
                    </div>
                </div>
                {{-- <div class="input-group mb-3">
                    <span class="wpcf7-form-control-wrap email-372">
                        <input type="email" name="email-372" value="" size="40" class="form-control border-custom" placeholder="Địa chỉ email của bạn">
                    </span>
                    <button type="submit" class="btn btn-custom">Đăng ký</button>
                    <span class="ajax-loader"></span>
                    <p></p>
                    <div class="input-group-prepend"></div>
                </div>
                <input type="text" name="a9I63" value="" style="display: none !important;"> --}}
            </form>
        </div>

        <p class="my-3">Để nhận những thông tin mới nhất về One Health Foundation</p>
        <div class="">
            <p style="display: inline-flex;">Theo dõi chúng tôi</p>
            <ul style="list-style: none; display: inline-flex;">
                <li style="margin-right: 10px">
                    <a href="{{ setting_option('facebook') }}" target="_blank">
                        <img src="https://onehealth.foundation/wp-content/themes/thewish/img/icon/fb.png">
                    </a>
                </li>
                <li style="margin-right: 10px">
                    <a href="{{ setting_option('twitter') }}" target="_blank">
                        <img src="https://onehealth.foundation/wp-content/themes/thewish/img/icon/twitter.png">
                    </a>
                </li>
                <li style="margin-right: 10px">
                    <a href="{{ setting_option('youtube') }}" target="_blank">
                        <img src="https://onehealth.foundation/wp-content/themes/thewish/img/icon/youtube.png">
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>
