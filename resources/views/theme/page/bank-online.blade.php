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

                            <div class="amountDiv donate-payment-account">
                                <h4 class="tertiary-color text-uppercase mb-3">@lang('Contact information'):</h4>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-floating form-floating-sm mb-3">
                                            <input type="text" name="lastname" class="form-control" id="lastname" placeholder="@lang('Last name')" required>
                                            <label for="lastname">@lang('Last name')</label>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-floating form-floating-sm">
                                            <input type="text" name="firstname" class="form-control" id="firstname" placeholder="@lang('Last name')" required>
                                            <label for="firstname">@lang('First name')</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-floating form-floating-sm mb-3">
                                            <input type="email" name="email" class="form-control" id="email" placeholder="@lang('Email')" required>
                                            <label for="email">@lang('Email address')</label>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-floating form-floating-sm">
                                            <input type="text" name="phone" class="form-control" id="phone" placeholder="@lang('Phone')" required>
                                            <label for="phone">@lang('Phone')</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="donationCampaignHeader">
                                <img src="https://onehealth.foundation/wp-content/themes/thewish/img/icon/icon-ohf-white.png" class="img-fluid">
                                <span>nếu bạn muốn quyên góp cho các chiến dịch riêng biệt</span>
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
