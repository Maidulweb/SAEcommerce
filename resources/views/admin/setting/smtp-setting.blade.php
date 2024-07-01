<div class="tab-pane fade" id="list-smtp" role="tabpanel" aria-labelledby="list-smtp-list">
    <div class="card border">
      <div class="card-header">
        <h6>smtp Setting</h6>
      </div>
      <div class="card-body">
        <form action="{{route('admin.smtp-setting.update')}}" method="POST">
          @csrf
          @method('PUT')
          <div class="form-group">
            <label for="">Email</label>
            <input type="email" name="email" class="form-control" value="{{$smtpSetting->email}}">
          </div>
          <div class="form-group">
            <label for="">Host</label>
            <input type="text" name="host" class="form-control" value="{{$smtpSetting->host}}">
          </div>
          <div class="form-group">
            <label for="">Username</label>
            <input type="text" name="username" class="form-control" value="{{$smtpSetting->username}}">
          </div>
          <div class="form-group">
            <label for="">Password</label>
            <input type="password" name="password" class="form-control" value="{{$smtpSetting->password}}">
          </div>
          <div class="form-group">
            <label for="">Port</label>
            <input type="text" name="port" class="form-control" value="{{$smtpSetting->port}}">
          </div>
          <div class="form-group">
            <label for="">Encryption</label>
            <select name="encryption" class="form-control">
              <option value="">Select</option>
              <option {{$smtpSetting->encryption == 'tsl' ? 'selected' : ''}} value="TLS">TLS</option>
              <option {{$smtpSetting->encryption == 'ssl' ? 'selected' : ''}} value="ssl">SSL</option>
            </select>
          </div>
          <button type="submit" class="btn btn-primary">Update</button>
        </form>
      </div>
    </div>
  </div>