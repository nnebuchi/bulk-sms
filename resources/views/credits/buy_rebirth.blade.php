@extends('layouts.dashboard.rebirth.app')
@section('title', 'Buy Unit')
@section('content')
<div class="mx-auto">
    <div class="mb-6 bg-white shadow-lg rounded-md p-4 tabletmd:p-8">
    <h1 class="heading-2">Buy Unit</h1>
    <p class="text-sm text-gray-500 mt-1 flex items-center space-x-2">
        <span class="font-normal text-skzdark-200">Dashboard</span>
        <span>-</span>
        <a
        href="#"
        class="text-[#FFCB00] rounded-full text-sm font-medium"
        >Units/Credits</a
        >
    </p>
    </div>

    <div
    class="bg-white shadow-lg rounded-md p-4 tabletmd:p-8 divide-y divide-gray-200">
    <div class="mb-6 pb-4">
        <h2 class="heading-3">How to buy units?</h2>
        <p class="text-sm text-gray-500">
        You can buy unit by entering the number of units you want to
        purchase or buy entering the amount of funds you want to spend
        </p>
    </div>

    <div class="space-y-6 mb-8 w-full divide-y divide-gray-200">
        <div
        class="flex justify-between mobilemd:flex-nowrap flex-wrap items-center w-full tabletmd:gap-x-16 gap-x-4 pb-8">
        <div class="mobilemd:w-6/12 w-full">
            <label
            for="units"
            class="block text-gray-600 font-normal mb-2"
            >Units</label
            >
            <input
            type="number"
            id="unit-input"
            placeholder="Enter unit"
            class="w-full border border-gray-300 rounded-md p-3 focus:ring-[#FFCB00] focus:border-[#FFCB00] outline-none transition-colors" />
        </div>
        <div class="mobilemd:w-6/12 w-full">
            <label for="cost" class="block text-gray-600 font-normal mb-2"
            >Costs(NGN)</label
            >
            <input
            type="number"
            id="cost-input"
            placeholder="Amount to spend in NGN"
            class="w-full border border-gray-300 rounded-md p-3 focus:ring-[#FFCB00] focus:border-[#FFCB00] outline-none transition-colors" />
        </div>
        </div>
        <form id="paystack-form" action="{{ route('pay-with-paystack') }}" method="post">
            @csrf
            <input type="hidden" name="amount" value="" id="paystack-amount" />
            <input type="hidden" name="reference" value="" id="paystack-reference" />
            <input type="hidden" name="purpose" value="credit_purchase" />
         </form>
        <div class="flex flex-col items-center gap-y-4 justify-center space-y-4 sm:space-y-0 sm:space-x-4 mt-6">
        <button
            class="bg-[#FFCB00] text-skzdark-200 text-base px-4 tabletmd:w-4/12 mobilelg:w-6/12 w-8/12 min-h-12 py-2 rounded-md hover:opacity-80 transition-colors cursor-pointer font-medium flex items-center justify-center payment-btn" gateway="paystack" type="button" onClick="createPayment(event)" id="paystack-btn">
            Buy Now
            <span class="fa fa-arrow-right -rotate-45 ms-4"></span>
        </button>

        Secured payment powered by <img src="{{asset('rebirth/assets/images/paystack-seeklogo.png')}}" class="w-32" alt="" />
         {{-- <img src="{{ asset('assets/img/payment/paystack-cards.png') }}" class="mr-2 mb-2" height="50"> --}}
        </div>
    </div>
    </div>
</div>

<script>
       
        const ravePubKey = "{{ env('RAVE_PUB_KEY') }}";
        function createPayment(event) {
            let clickedBtn = event.target;

            clickedBtn.innerHTML=('<i class="fa fa-spin fa-spinner"></i> connecting...');
            $('payment-btn').prop('disabled', true);
            $.ajax({
                type:'POST',
                url: "{{ route('create-payment') }}",
                data:{
                    description:"Unit Purchase by {{ Auth::user()->username }}",
                    currency: "NGN",
                    gateway: clickedBtn.getAttribute('gateway'),
                    amount: $('#cost-input').val(),
                    purpose: "credit_purchase",
                    _token:universal_token,
                },
                success:function(data){
                    feedback = JSON.parse(data);
                    if (feedback.status == 'success') {
                        // if the flutterave option is used
                        if (clickedBtn.id == 'rave-btn') {
                            payWithRave(feedback);
                        }
                        // if paystack option is used
                        if (clickedBtn.id == 'paystack-btn') {
                           $('#paystack-reference').val(feedback.reference)
                           $('#paystack-form').submit();
                        }
                       
                    }
                    
                },
                error:function(param1, param2, param3){
                     $('#rave-btn').html(oldHtml);
                    $('#rave-btn').prop('disabled', false);
                    alert(param3);
                }
           });
        }

        function payWithRave(feedback){
            var x = getpaidSetup({
                PBFPubKey: ravePubKey,
                customer_email: "{{ Auth::user()->email }}",
                amount: feedback.amount,
                currency: "NGN",
                txref: feedback.reference,
                meta: [{
                    metaname: "SkezzoleRef",
                    metavalue: feedback.reference,
                }],
                onclose: function(){
                    $('#rave-btn').html(oldHtml);
                    $('#rave-btn').prop('disabled', false);
                },
                callback: function(response) {
                   
                    console.log(response.data);
                    // return;
                    if(response.data.data.responsecode == "00" || response.data.data.responsecode == "0"){
                        
                        $.ajax({
                            type:'POST',
                            url: "{{ route('update-payment') }}",
                            data:{
                                reference:response.data.tx.txRef,
                                id:response.data.tx.id,
                                amount: response.data.tx.amount,
                                payResponse: response.tx,
                                _token: universal_token
                            },
                            success:function(updateData){
                                updateData = JSON.parse(updateData)
                                if(updateData.status =='success'){
                                    window.location.replace("{{ url('home') }}");
                                }else{
                                   console.log(updateData)
                                    alert('payment failed. Something went wrong');
                                }
                            },
                            error:function(xhr,status,error){
                                alert(error)
                            },
                        });

                    }else {

                        if (response.data.respcode == "00" || response.data.respcode == "0") {
                            $.ajax({
                                type:'POST',
                                url: "{{ route('update-payment') }}",
                                data:{
                                    reference:response.data.transactionobject.txRef,
                                    id:response.data.transactionobject.id,
                                    amount: response.data.transactionobject.amount,
                                    payResponse: response.data.transactionobject,
                                    _token: universal_token
                                },
                                success:function(updateData){
                                    updateData = JSON.parse(updateData)
                                    if(updateData.status =='success'){
                                        window.location.replace("{{ url('home') }}");
                                    }else{
                                       console.log(updateData)
                                        alert('payment failed. Something went wrong');
                                    }
                                },
                                error:function(xhr,status,error){
                                    alert(error)
                                },
                            });
                        }else{
                            alert('Something went wrong. It seems there is something wrong with your card. and try the following: <ul> <li> Check if your card is funded. If not, reload page, fund card and try again</li> <li>Try another card</li> <i>If Error Persists, Contact support with error code: SK-002</i>');
                        }
                        
                    }
                    $('#rave-btn').html(oldHtml)
                    $('#rave-btn').prop('disabled', false)
                    // x.close(); // use this to close the modal immediately after payment.
                }       
            })
        }
        

        $(document).ready(function(){
            togglePaymentButton()
            // Initiate validation on input fields
            $('#card_number, #expiry_month, #expiry_year, #cvv').on('keyup',function(){
                cardFormValidate();
            });


            // Submit card form
            $("#cardSubmitBtn").on('click',function(){
                var oldHtml = $(this).html();
                $("#cardSubmitBtn").prop('disabled', true)
                $('.status-msg').remove();
                if(cardFormValidate()){
                    // var formData = $('#paymentForm').serialize();
                    var card_holder = $('#name_on_card').val();

                    var card_number = $('#card_number').val();
                    var expiry = $('#expiry_year').val()+'-'+$('#expiry_month').val();
                    var cvv = $('#cvv').val();
                    var card_type = $('#card_type').val();
                    $.ajax({
                        type:'POST',
                        url: "",
                        data:{
                            card_holder:card_holder,
                            expiry: expiry,
                            cvv: cvv,
                            card_number: card_number,
                            card_type: card_type,
                            plan_id: "",
                            amount: $('cost-input').val(),
                            plan: "",
                            qty: '1',
                            plan_unique_id: ""
                        },
                        beforeSend: function(){
                            $("#cardSubmitBtn").prop('disabled', true);
                            $("#cardSubmitBtn").html('Processing....');
                        },
                        success:function(data){
                            // console.log(data);
                            data = JSON.parse(data)

                            if (data.status == 'success') {

                                $('#loading').removeClass('d-none')
                                setTimeout(function(){ 
                                     activateStatus();
                                   
                                 }, 15000);
                                 
                                 
                            }
                            // console.log(data['ResponseMetadata']);
                           

                            $("#cardSubmitBtn").prop('disabled', false);
                            $("#cardSubmitBtn").html(oldHtml);
                        },
                        error:function(xhr,status,error){
                            alert(error)
                            $("#cardSubmitBtn").prop('disabled', false);
                            $("#cardSubmitBtn").html(oldHtml);
                        }
                    });
                }
            });

            // calcultae cost once unit is inputed
            $('#unit-input').on('input', function(){

                calculateCost();
            })

            $('#cost-input').on('input', function(){

                calculateUnit();
            })
            function calculateCost(){
                var unitCost = parseFloat({{ siteSetting()->cost_per_unit }});
                let unit = parseFloat($('#unit-input').val());
                $('#cost-input').val(unit*unitCost);
                $('#cost').text(unit*unitCost);
                $('#paystack-amount').val(unit*unitCost)
                togglePaymentButton();
            }


            function calculateUnit(){
                var unitCost = parseFloat({{ siteSetting()->cost_per_unit }});
                let cost = parseFloat($('#cost-input').val());
                $('#unit-input').val(cost/unitCost);
                $('#cost').text(cost);
                $('#paystack-amount').val(cost);
                togglePaymentButton();
            }

            function activateStatus(){
                $.ajax({
                    url: "",
                    type: "POST",
                    data: {
                    },
                    success:function(data){
                        
                        if (data == '1') {
                            window.location.replace("");
                        }else{
                            console.log('nothing');
                        }
                        
                    }
                })
            }

            function togglePaymentButton(){
                if(parseFloat($('#cost-input').val()) > 0){
                    $('.payment-btn').prop('disabled', false)
                }else{
                    $('.payment-btn').prop('disabled', true)
                }
            }


        });
    </script>
@endsection