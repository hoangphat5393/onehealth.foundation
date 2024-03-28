@extends('theme.layouts.index')

@section('seo')
    @include($templatePath . '.layouts.seo', $seo ?? [])
@endsection

@section('content')
    <main id="donate_online">

        {!! htmlspecialchars_decode($page->content) !!}

        <section class="block17">
            <div class="container">
                <div class="row mb-5">
                    <div class="col-lg-8 mb-3">
                        {{-- <form name="donateForm" method="post" target="_self" action="https://onehealth.foundation/paypal"> --}}
                        {{-- <form id="payment_online" method="post" action="{{ route('payment_test') }}"> --}}
                        <form id="payment_online" method="post" action="https://api-sandbox.mbbank.com.vn/private/ms/pg-paygate/paygate/v2/create-order">
                            @csrf
                            {{-- display error/success message --}}

                            <div class="amountDiv mb-3">
                                <div class="alert alert-success d-none  ">
                                    <strong>Giao dịch Thất bại !</strong>
                                    <p><strong>Mã giao dịch: </strong> </p>
                                    <span>Thông tin lỗi: ()<br> </span>
                                </div>

                                <h4 class="text-main text-uppercase">@lang('Please select the donation amount'):</h4>

                                <ul id="" class="list-inline list-donate-price pt-3 d-flex">
                                    <li class="list-inline-item"><button type="button" class="btn donate-price active" data-price-id="0" value="805.000" data-default="1">805.000 ₫</button></li>
                                    <li class="list-inline-item"><button type="button" class="btn donate-price" data-price-id="1" value="1.500.000" data-default="0">1.500.000 ₫</button></li>
                                    <li class="list-inline-item"><button type="button" class="btn donate-price" data-price-id="1" value="1.500.000" data-default="0">1.500.000 ₫</button></li>
                                    <li class="list-inline-item"><button type="button" class="btn donate-price" data-price-id="1" value="1.500.000" data-default="0">1.500.000 ₫</button></li>
                                    <li class="list-inline-item"><button type="button" class="btn donate-price" data-price-id="1" value="1.500.000" data-default="0">1.500.000 ₫</button></li>
                                    <li class="list-inline-item"><button type="button" class="btn donate-price" data-price-id="1" value="1.500.000" data-default="0">1.500.000 ₫</button></li>
                                    <li class="list-inline-item"><button type="button" class="btn donate-price" data-price-id="1" value="1.500.000" data-default="0">1.500.000 ₫</button></li>
                                    <li class="list-inline-item"><button type="button" class="btn donate-price" data-price-id="1" value="1.500.000" data-default="0">1.500.000 ₫</button></li>
                                    <li class="list-inline-item"><button type="button" class="btn donate-price" data-price-id="1" value="1.500.000" data-default="0">1.500.000 ₫</button></li>
                                    <li class="list-inline-item"><button type="button" class="btn donate-price" data-price-id="1" value="1.500.000" data-default="0">1.500.000 ₫</button></li>
                                    <li class="list-inline-item"><button type="button" class="btn donate-price" data-price-id="1" value="1.500.000" data-default="0">1.500.000 ₫</button></li>
                                </ul>

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

                            <div class="wrap-block mb-3">
                                <div class="p-3">
                                    <h4 class="bg-main text-uppercase mb-2">@lang('Contact information'):</h4>
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="form-floating form-floating-sm mb-3">
                                                <input type="text" name="lastname" class="form-control" id="lastname" placeholder="@lang('Last name')">
                                                <label for="lastname">@lang('Last name')</label>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-floating form-floating-sm">
                                                <input type="text" name="firstname" class="form-control" id="firstname" placeholder="@lang('Last name')">
                                                <label for="firstname">@lang('First name')</label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="form-floating form-floating-sm mb-3 mb-lg-0">
                                                <input type="email" name="email" class="form-control" id="email" placeholder="@lang('Email')">
                                                <label for="email">@lang('Email address')</label>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-floating form-floating-sm mb-3 mb-lg-0">
                                                <input type="text" name="phone" class="form-control" id="phone" placeholder="@lang('Phone')">
                                                <label for="phone">@lang('Phone')</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="wrap-block">
                                <div class="donationCampaignHeader d-flex align-items-center p-3">
                                    <img src="{{ asset('images/icon/icon-ohf-white.png') }}" class="img-fluid me-3" style="width: 40px" />
                                    <h5>@lang('If you want to donate for separate campaigns')</h5>
                                </div>

                                {{-- Dự án (Campaign) --}}
                                @php
                                    $project = \App\Campaign::where('status', 1)->limit(3)->get();
                                @endphp
                                <div class="p-3">
                                    <div class="mb-3">
                                        <label for="campagin" class="form-label">@lang('I want to contribute to the program'):</label>
                                        <select name="campagin" class="form-select" id="campagin">
                                            @empty(!$project)
                                                <option value="">@lang('Select campaign')</option>
                                                @foreach ($project as $item)
                                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                                @endforeach
                                            @endempty
                                        </select>
                                    </div>

                                    <div class="mb-3">
                                        <label for="delication" class="form-label">@lang('I want my donation sent to'):</label>
                                        <input type="text" id="delication" name="delication" class="form-control">
                                    </div>

                                    {{-- START MAIL --}}
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="" id="chkPassport">
                                        <label class="form-check-label" for="chkPassport">
                                            @lang('Send confirmation to the individual or organization')
                                        </label>
                                    </div>

                                    <hr>

                                    <div id="dvPassport" style="display: none">
                                        <input type="email" id="txtEmail" name="txtEmail" placeholder="@lang('Email')" style="background: #ebebeb;border: 0px;height: 40px;width: 100%;border-radius: 20px;padding: 20px;margin-bottom: 10px;">
                                        <textarea id="txtMessage" name="txtMessage" rows="5" placeholder="@lang('Message')" style="background: #ebebeb;border: 0px;width: 100%;border-radius: 20px;padding: 20px;margin-bottom: 10px;"></textarea>
                                    </div>
                                    {{-- END MAIL --}}
                                </div>
                            </div>

                            <div class="btn-submit mt-3">
                                <button type="submit" id="submit" class="btn btn-lg d-flex justify-content-center align-items-center" onclick="submitTwice(this.form)">
                                    <img src="{{ asset('images/icon/icon-ohf-white.png') }}" class="img-fluid me-3" style="width: 40px" />
                                    @lang('Donate now')
                                </button>
                            </div>

                            <input type="hidden" name="task" value="donate">

                        </form>
                    </div>

                    <div class="col-lg-4 mb-3 form-donate-info">
                        <div class="text-center">
                            <img class="img-fluid" src="{{ setting_option('logo') }}">
                        </div>
                        <p>Khoản tiền tài trợ của bạn, dù lớn hay nhỏ, đều quan trọng với chúng tôi trên hành trình mang lại nụ cười và tương lai cho trẻ em có hoàn cảnh khó khăn, cải thiện chất lượng các cơ sở y tế và tuổi trẻ Việt Nam. </p>
                        <img class="img-fluid w-100 mb-3" src="{{ asset('images/donate_frm1.jpg') }}">
                        <img class="img-fluid w-100" src="{{ asset('images/donate_frm2.jpg') }}">
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
