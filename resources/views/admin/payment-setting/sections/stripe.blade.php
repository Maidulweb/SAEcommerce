<div class="tab-pane fade show" id="list-stripe" role="tabpanel" aria-labelledby="list-stripe-list">
    <div class="card border">
      <div class="card-header">
        <h6>Stripe Setting</h6>
      </div>
      <div class="card-body">
        <form action="{{route('admin.stripe.update', 1)}}" method="POST">
          @csrf
          @method('PUT')
          <div class="form-group">
            <label for="">Paypal Status</label>
            <select name="status" class="form-control">
              <option {{$stripeData->status == 1 ? 'selected' : ''}} value="1">Enable</option>
              <option {{$stripeData->status == 0 ? 'selected' : ''}} value="0">Disable</option>
            </select>
          </div>
          <div class="form-group">
            <label for="">Account Mode</label>
            <select name="mode" class="form-control">
              <option {{$stripeData->mode == 0 ? 'selected' : ''}} value="0">Sandbox</option>
              <option {{$stripeData->mode == 1 ? 'selected' : ''}}  value="1">Live</option>
            </select>
          </div>
          <div class="form-group">
            <label for="">Country Name</label>
            <select name="country_name" class="form-control select2">
              <option value="">Select</option>
              @foreach (config('setting.country_lists') as $country)
              <option {{$stripeData->country_name == $country ? 'selected' : ''}} value="{{$country}}">{{$country}}</option>
              @endforeach
            </select>
          </div>
          <div class="form-group">
            <label for="">Currency Name</label>
            <select name="currency_name" class="form-control select2">
              <option value="">Select</option>
              @foreach (config('setting.currency_list') as $key=>$currency)
              <option {{$stripeData->currency_name == $currency ? 'selected' : ''}} value="{{$currency}}">{{$key}}</option>
              @endforeach
            </select>
          </div>
          <div class="form-group">
            <label for="">Currency Rate (Per USD)</label>
            <input type="text" name="currency_rate" class="form-control" value="{{$stripeData->currency_rate}}">
          </div>
          <div class="form-group">
            <label for="">Paypal Client ID</label>
            <input type="text" name="client_id" class="form-control" value="{{$stripeData->client_id}}">
          </div>
          <div class="form-group">
            <label for="">Paypal Secret Key</label>
            <input type="text" name="secret_key" class="form-control" value="{{$stripeData->secret_key}}">
          </div>
          <button type="submit" class="btn btn-primary">Setting</button>
        </form>
      </div>
    </div>
</div>