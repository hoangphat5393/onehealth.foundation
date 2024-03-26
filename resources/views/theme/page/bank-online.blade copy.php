@extends('theme.layouts.index')

@section('seo')
    @include($templatePath . '.layouts.seo', $seo ?? [])
@endsection

@section('content')
    <main id="donate_online">

        {!! htmlspecialchars_decode($page->content) !!}

        <section class="block17">
            <div class="container">
                <div class="row my-5">
                    <div class="col">
                        <h2>CÙNG ONEHEALTH FOUNDATION - <br> THẮP SÁNG ƯỚC MƠ CỦA HÀNG TRIỆU GIA ĐÌNH VIỆT NAM</h2>
                    </div>
                </div>
                <div class="row mb-5">
                    <div class="col-md-8">
                        {{-- <form name="donateForm" method="post" target="_self" action="https://onehealth.foundation/paypal"> --}}
                        <form name="donateForm" method="post" target="_self" action="#">

                            <!--display error/success message-->

                            <div class="amountDiv mb-3">
                                <div class="alert alert-success d-none  ">
                                    <strong>Giao dịch Thất bại !</strong>
                                    <p><strong>Mã giao dịch: </strong> </p>
                                    <span>Thông tin lỗi: ()<br> </span>
                                </div>
                                <input type="hidden" name="cmd" value="_s-xclick">
                                <input type="hidden" name="hosted_button_id" id="hosted_button_id" value="MUXXK4XFJJ5EE">
                                <input type="hidden" name="return" value="/thank-you">
                                <input type="hidden" id="amount" name="amount" value="">
                                <input type="hidden" id="frequency" name="frequency" value="Một lần">
                                <input type="hidden" name="currency_code" value="USD">

                                <h4 class="tertiary-color text-uppercase">Vui lòng chọn số tiền quyên góp:</h4>
                                <div id="myDIV" class="text-center" style="padding: 20px 0px;height: 100px;">
                                    <a id="btn-10" class="btn btn-amount active" onclick="setDataType(this)" role="button">10 USD</a>
                                    <a id="btn-50" class="btn btn-amount" onclick="setDataType(this)" role="button">50 USD</a>
                                    <a id="btn-100" class="btn btn-amount" onclick="setDataType(this)" role="button">100 USD</a>
                                    <a id="btn-500" class="btn btn-amount btn-active" onclick="setDataType(this)" role="button">500 USD</a>
                                    <div class="text-left d-none" style="border-bottom: 1px solid #d9d9d9; ">
                                        <input id="other-amount" class="" type="number" onchange="setDataType_Other()" placeholder="Số khác">
                                    </div>
                                </div>
                                {{-- <div class="donationFrequency">
                                    <div id="donationFrequencyHeader" class="heading">
                                        Quyên góp định kỳ <span class="recurring_support">Đồng hành lâu dài cùng One Health Foundation<br>chung tay ươm mầm khát vọng Việt</span>
                                    </div>
                                </div>

                                <div class="frequency clearfix">
                                    <a id="freqOne Time" onclick="ChangeSelectedFrequency('One Time', this);return ChangeAmountMode('inactive');" class="tertiary-bg on" role="button">Một lần</a>
                                    <a id="freqMonthly" onclick="ChangeSelectedFrequency('Monthly', this);return ChangeAmountMode('inactive');" class="tertiary-bg" role="button">Hàng Tháng</a>
                                    <a id="freqQuarterly" onclick="ChangeSelectedFrequency('Quarterly', this);return ChangeAmountMode('inactive');" class="tertiary-bg" role="button">Hàng Quý</a>
                                    <a id="freqAnnual" onclick="ChangeSelectedFrequency('Annual', this);return ChangeAmountMode('inactive');" class="tertiary-bg" role="button">Hàng Năm</a>
                                </div> --}}
                            </div>
                            <div class="amountDiv donate-payment-option mb-3 d-none">
                                <h4 class="tertiary-color text-uppercase">Thông tin quyên góp:</h4>
                                <div class="text-center p-3">
                                    <input type="hidden" id="payment_Mode" name="payment_Mode" value="paypal">
                                    <a id="epay" onclick="check_payment_option('epay', this);" class="tertiary-bg" role="button">Thẻ tín dụng/ Thẻ ghi nợ</a>
                                    <a id="paypal" onclick="check_payment_option('paypal', this);" class="tertiary-bg on" role="button"><img src="https://onehealth.foundation/wp-content/themes/thewish/img/logo/logo-paypal.png"></a>
                                    <div id="selectBank" class="selectBank">
                                        <input type="hidden" class="input_text" name="userName" value="Nguyen Van An">
                                        <input type="hidden" class="input_text" name="txnAmount" id="txnAmount" value="11500000">
                                        <input type="hidden" class="input_text" name="fee" value="11000">
                                        <input type="hidden" class="input-text" id="bankID_text" name="bankID_text" value="">
                                        <select id="bankID" name="bankID" class="input_text d-none" onchange="setBankField(this)">
                                            <option value="0">Chọn ngân hàng</option>
                                            <option value="99001">Agribank</option>
                                            <option value="99002">Saigonbank</option>
                                            <option value="99003">PG Bank</option>
                                            <option value="99004">GP Bank</option>
                                            <option value="99005">Sacombank</option>
                                            <option value="99006">Nam Á Bank</option>
                                            <option value="99007">Đông Á bank</option>
                                            <option value="99008">Vietinbank</option>
                                            <option value="99009">Techcombank</option>
                                            <option value="99010">VIB</option>
                                            <option value="99011">HDBank</option>
                                            <option value="99012">Eximbank</option>
                                            <option value="99013">TienphongBank</option>
                                            <option value="99014">Maritime Bank</option>
                                            <option value="99015">BIDV</option>
                                            <option value="99016">MB</option>
                                            <option value="99017">Seabank</option>
                                            <option value="99018">SHB</option>
                                            <option value="99019">Việt Á Bank</option>
                                            <option value="99020">OceanBank</option>
                                            <option value="99021">Vietcombank</option>
                                            <option value="99022">VP Bank</option>
                                            <option value="99023">ACB</option>
                                            <option value="99027">NaviBank</option>
                                            <option value="99026">Bắc á</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="amountDiv donate-payment-account">
                                <h4 class="tertiary-color text-uppercase">@lang('Contact information'):</h4>
                                <div class="text-center">
                                    <input id="f-name" name="f-name" type="text" placeholder="Họ" required>
                                    <input id="l-name" name="l-name" type="text" placeholder="Tên" required>
                                    <input id="email" name="email" type="email" placeholder="Email" required>
                                    <input id="mobile" name="mobile" type="number" placeholder="mobile" required>
                                </div>
                            </div>
                            <div class="donationCampaignHeader">
                                <img src="https://onehealth.foundation/wp-content/themes/thewish/img/icon/icon-ohf-white.png" class="img-fluid">
                                <span>nếu bạn muốn quyên góp<br>cho các chiến dịch riêng biệt</span>
                            </div>

                            {{-- Dự án (Campaign) --}}
                            @php
                                $project = \App\Campaign::where('status', 1)->limit(3)->get();
                            @endphp

                            <div class="amountDiv donationCampaign">
                                <div id="" class="content clearfix paddingtopmore item-form-container paddingbottom15 uniform-designation">
                                    <span class="heading">Tôi muốn đóng góp cho chương trình:</span>
                                    <div class="selector" id="">
                                        <input type="hidden" name="selectcampagin" id="selectcampagin" value="">

                                        <select class="form-control" id="sel1" onchange="ChangeCampaign(this)">
                                            @empty(!$project)
                                                <option value="">Chọn chiến dịch</option>
                                                @foreach ($project as $item)
                                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                                @endforeach
                                            @endempty
                                        </select>
                                    </div>
                                    <div class="delicationDiv">
                                        <span class="heading">Tôi muốn khoản đóng góp của tôi được gửi đến:</span>
                                        <input type="text" id="delication" name="delication">
                                    </div>
                                </div>
                                {{-- START MAIL --}}
                                <label for="chkPassport">
                                    <input type="checkbox" id="chkPassport">
                                    Vui lòng gửi xác nhận cho cá nhân hay tổ chức mà tôi đã quyên góp </label>
                                <hr>
                                <div id="dvPassport" style="display: none">
                                    <input type="email" id="txtEmail" name="txtEmail" placeholder="Email người nhận" style="background: #ebebeb;border: 0px;height: 40px;width: 100%;border-radius: 20px;padding: 20px;margin-bottom: 10px;">
                                    <textarea rows="5" id="txtMessage" name="txtMessage" placeholder="Nội dung tin nhắn" style="background: #ebebeb;border: 0px;width: 100%;border-radius: 20px;padding: 20px;margin-bottom: 10px;"></textarea>
                                </div>
                                {{-- END MAIL --}}
                            </div>
                            <div class="text-center btn-submit">
                                <button type="submit" id="submit" class="text-uppercase" onclick="submitTwice(this.form)"><img src="https://onehealth.foundation/wp-content/themes/thewish/img/icon/icon-ohf-white.png">quyên góp ngay </button>
                            </div>
                            <input type="hidden" name="task" value="donate">
                        </form>
                    </div>

                    <div class="col-md-4 form-donate-info">
                        <div>
                            <div class="text-center" style="margin-bottom: 15px;">
                                <img class="img-fluid" src="https://onehealth.foundation/wp-content/themes/thewish/img/logo/logo_OHF_color.png">
                            </div>
                            <p>Khoản tiền tài trợ của bạn, dù lớn hay nhỏ, đều quan trọng với chúng tôi trên hành trình mang lại nụ cười và tương lai cho trẻ em có hoàn cảnh khó khăn, cải thiện chất lượng các cơ sở y tế và tuổi trẻ Việt Nam. </p>
                            <img class="img-fluid w-100 mb-3" src="https://onehealth.foundation/wp-content/themes/thewish/img/demo/Img_donate_frm1.jpg">
                            <img class="img-fluid w-100" src="https://onehealth.foundation/wp-content/themes/thewish/img/demo/Img_donate_frm2.jpg">
                        </div>
                    </div>
                </div>
            </div>
        </section>

        {{-- Subscribe --}}
        @include('theme.includes.subscribe')
    </main>
@endsection

@push('scripts')
    <script>
        $(function() {
            $("#chkPassport").click(function() {
                if ($(this).is(":checked")) {
                    $("#dvPassport").show();
                    $("#AddPassport").hide();
                } else {
                    $("#dvPassport").hide();
                    $("#AddPassport").show();
                }
            });
        });

        function reset() {
            document.getElementById('btn-10').classList.remove('btn-active');
            document.getElementById('btn-50').classList.remove('btn-active');
            document.getElementById('btn-100').classList.remove('btn-active');
            document.getElementById('btn-500').classList.remove('btn-active');
        }

        function setDataType(ele) {
            //var current = document.getElementsByClassName("btn-active");
            //document.getElementsByClassName("btn").classList.remove("btn-active");
            var x = ele.innerHTML;
            var y = 23000;
            if (x == "10 USD") {
                document.getElementById('hosted_button_id').value = '5UWGESJZVYST4';
                document.getElementById('txnAmount').value = 10 * y;
                reset();
                ele.classList.add('btn-active');
            }
            if (x == "50 USD") {
                document.getElementById('hosted_button_id').value = '7E6T7S4TSBKZG';
                document.getElementById('txnAmount').value = 50 * y;
                reset();
                ele.classList.add('btn-active');
            }
            if (x == "100 USD") {
                document.getElementById('hosted_button_id').value = '394Z7KQKEHAQC';
                document.getElementById('txnAmount').value = 100 * y;
                reset();
                ele.classList.add('btn-active');
            }
            if (x == "500 USD") {
                document.getElementById('hosted_button_id').value = 'MUXXK4XFJJ5EE';
                document.getElementById('txnAmount').value = 500 * y;
                reset();
                ele.classList.add('btn-active');
            }
            document.getElementById('other-amount').value = "";
        }

        function setDataType_Other() {
            //document.getElementById('amount').value = document.getElementById('other-amount').value;
            document.getElementById('hosted_button_id').value = '457ND4KRSN2WE';
            reset();
        }


        function ChangeSelectedFrequency(frequency, obj) {
            $("div.frequency").find("a").removeClass("on");
            $(obj).addClass("on");
            $('#frequency').val(frequency);

            var prvSelectedFrequencyID = $(".prvSelectedFrequencyID");
            var prvSelectedFrequencyIDVal = $(prvSelectedFrequencyID).val();
            if (prvSelectedFrequencyID != undefined && $(prvSelectedFrequencyID).val() != null && $(prvSelectedFrequencyID).val() != '') {
                $(prvSelectedFrequencyID).val(obj.id);
            }
            var paymentMode = $(".PaymentMode").val();
            if (frequency != "One Time") {
                if ($(".dvRDStartDate").length > 0) {
                    $(".dvRDStartDate").show();
                    $(".editAmountDiv").addClass("extrapadding");
                }
                if (paymentMode === 'PayPal' && prvSelectedFrequencyIDVal === "freqOne Time") {
                    ResetBillingInfo();
                }
            } else {
                $(".dvRDStartDate").hide();
                $(".editAmountDiv").removeClass("extrapadding");
                $(".RdStartDate").removeClass("error");
                var elementName = $(".RdStartDate").attr("id");
                if ($('span[for=' + elementName + ']').length > 0) {
                    $('span[for=' + elementName + ']').remove();
                }
                if (paymentMode === 'PayPal' && prvSelectedFrequencyIDVal !== "freqOne Time") {
                    ResetBillingInfo();
                }
            }
        }

        function ChangeAmountMode(mode) {
            if (mode == "active") {
                document.getElementById("amountDiv").className = "content-block default-mode";
                $("#amountDiv").find(".complete-wrapper").attr("style", "display:none;");
                if (($('#amountDiv').find(".selectedfrequency").val().toLowerCase() != "one time") && ($('#amountDiv').find(".RdStartDate").length > 0)) {
                    $('#amountDiv').find(".editAmountDiv").addClass("extrapadding");
                } else {
                    $('#amountDiv').find(".editAmountDiv").removeClass("extrapadding");
                }
            }
        }
    </script>
@endpush
