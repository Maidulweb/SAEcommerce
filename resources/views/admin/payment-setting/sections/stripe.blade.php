<div class="tab-pane fade show" id="list-stripe" role="tabpanel" aria-labelledby="list-stripe-list">
    <div class="card border">
      <div class="card-header">
        <h6>Stripe Setting</h6>
      </div>
      <div class="card-body">
        <form action="" method="POST">
          @csrf
          @method('PUT')
          <div class="form-group">
            <label for="">Site Name</label>
            <input type="text" name="site_name" class="form-control" value="">
          </div>
          <div class="form-group">
            <label for="">Layout</label>
            <select name="layout" class="form-control">
              <option value="ltr">LTR</option>
              <option  value="rtl">RTL</option>
            </select>
          </div>
          <div class="form-group">
            <label for="">Contact Email</label>
            <input type="text" name="contact_email" class="form-control" value="">
          </div>
          <div class="form-group">
            <label for="">Currency Name</label>
            <select name="currency_name" class="form-control select2">
              <option value="">Select</option>
              @foreach (config('setting.currency_list') as $currency)
              <option value="{{$currency}}">{{$currency}}</option>
              @endforeach
            </select>
          </div>
          <div class="form-group">
            <label for="">Currency Icon</label>
            <input type="text" name="currency_icon" class="form-control" value="">
          </div>
          
          <button type="submit" class="btn btn-primary">Setting</button>
        </form>
      </div>
    </div>
</div>