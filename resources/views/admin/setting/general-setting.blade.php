<div class="tab-pane fade show active" id="list-home" role="tabpanel" aria-labelledby="list-home-list">
    <div class="card border">
      <div class="card-header">
        <h6>General Setting</h6>
      </div>
      <div class="card-body">
        <form action="{{route('admin.general-setting.update')}}" method="POST">
          @csrf
          @method('PUT')
          <div class="form-group">
            <label for="">Site Name</label>
            <input type="text" name="site_name" class="form-control" value="{{$generalSetting->site_name}}">
          </div>
          <div class="form-group">
            <label for="">Layout</label>
            <select name="layout" class="form-control">
              <option {{$generalSetting->layout == 'ltr' ? 'selected' : ''}} value="ltr">LTR</option>
              <option {{$generalSetting->layout == 'rtl' ? 'selected' : ''}} value="rtl">RTL</option>
            </select>
          </div>
          <div class="form-group">
            <label for="">Contact Email</label>
            <input type="text" name="contact_email" class="form-control" value="{{$generalSetting->contact_email}}">
          </div>
          <div class="form-group">
            <label for="">Currency Name</label>
            <select name="currency_name" class="form-control select2">
              <option value="">Select</option>
              @foreach (config('setting.currency_list') as $currency)
              <option {{$generalSetting->currency_name == $currency ? 'selected' : ''}} value="{{$currency}}">{{$currency}}</option>
              @endforeach
            </select>
          </div>
          <div class="form-group">
            <label for="">Currency Icon</label>
            <input type="text" name="currency_icon" class="form-control" value="{{$generalSetting->currency_icon}}">
          </div>
          <div class="form-group">
            <label for="">Timezone</label>
            <select name="timezone" class="form-control select2">
              <option value="">Select</option>
              @foreach (config('setting.timezone') as $key => $timezone)
              <option {{$generalSetting->timezone == $key ? 'selected' : ''}} value="{{$key}}">{{$key}}</option>
              @endforeach
            </select>
          </div>
          <button type="submit" class="btn btn-primary">Update</button>
        </form>
      </div>
    </div>
  </div>