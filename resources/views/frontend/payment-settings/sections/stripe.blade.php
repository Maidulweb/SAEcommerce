<div class="tab-pane fade" id="v-pills-stripe" role="tabpanel" aria-labelledby="v-pills-stripe-tab">
    <div class="row">
        <div class="col-xl-12 m-auto">
            <div class="wsus__payment_area">
                <form action="{{route('user.stripe.payment')}}" id="submitForm" method="POST">
                    @csrf
                    <input type="hidden" id="result_token_id" name="token">
                    <div id="card-element"></div>
                   <button class="nav-link common_btn mt-5" id="pay_btn" onclick="createToken()" type="button">Pay with Stripe</button>
                </form>
            </div>
        </div>
    </div>
</div>
@php
    $stripe = \App\Models\StripeSetting::first();
@endphp
@push('scripts')
<script src="https://js.stripe.com/v3/"></script>
<script>
    var stripe = Stripe("{{$stripe->client_id}}");
    var elements = stripe.elements();
    var cardElement = elements.create('card');
    cardElement.mount('#card-element');

    function createToken(){
        document.getElementById('pay_btn').disabled = true;
        stripe.createToken(cardElement).then(function(result) {
           if(typeof result.error != 'undefined'){
            document.getElementById('pay_btn').disabled = false;
                toastr.error(result.error.message)
           }
           if(typeof result.token != 'undefined'){
            document.getElementById('result_token_id').value = result.token.id;
            console.log(result.token.id)
            console.log(document.getElementById('result_token_id').value)
            document.getElementById('submitForm').submit();
           }
        });
    }
</script>
@endpush