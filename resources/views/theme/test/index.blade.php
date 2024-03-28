@extends('theme.layouts.index')


@section('content')
    <div class="container my-5">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <form action="{{ route('test_payment_callback') }}" method="post">

                    {{-- <div class="row g-3 align-items-center">
                        <div class="col-auto">
                            <label for="inputPassword6" class="col-form-label">amount</label>
                        </div>
                        <div class="col-auto">
                            <input type="password" id="inputPassword6" class="form-control" aria-describedby="passwordHelpInline">
                        </div>
                    </div> --}}

                    <input type="text" class="form-control mb-3" name="amount" id="amount" value="100000">
                    <input type="text" class="form-control mb-3" name="currency" value="VND">
                    <input type="text" class="form-control mb-3" name="access_code" value="d37a8fd0076e056d5326968b32a7ea78">
                    <input type="text" class="form-control mb-3" name="mac_type" value="MD5">
                    <input type="text" class="form-control mb-3" name="mac" value="95DB33CA010DBF553516D8321C7">
                    <input type="text" class="form-control mb-3" name="merchant_id" value="100241">
                    <input type="text" class="form-control mb-3" name="order_info" value="testpayment">
                    <input type="text" class="form-control mb-3" name="order_reference" value="Q1TT12301245">
                    <input type="text" class="form-control mb-3" name="return_url" value="{{ route('test_payment_callback') }}">
                    <input type="text" class="form-control mb-3" name="cancel_url" value="https://domain.vn/">
                    <input type="text" class="form-control mb-3" name="cmd" value="_s-xclick">
                    <input type="text" class="form-control mb-3" name="hosted_button_id" id="hosted_button_id" value="MUXXK4XFJJ5EE">

                    <input type="text" class="form-control mb-3" name="return" value="/thank-you">
                    <input type="text" class="form-control mb-3" id="amount" name="amount" value="">
                    <input type="text" class="form-control mb-3" id="frequency" name="frequency" value="Một lần">
                    <input type="text" class="form-control mb-3" name="currency_code" value="USD">

                    <div class="text-center my-3">
                        <button type="submit" class="btn btn-lg btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
