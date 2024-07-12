<div class="tab-pane fade" id="list-logo" role="tabpanel" aria-labelledby="list-logo-list">
    <div class="card border">
      <div class="card-header">
        <h6>General Setting</h6>
      </div>
      <div class="card-body">
        <form action="{{route('admin.logo.setting')}}" method="POST" enctype="multipart/form-data">
          @csrf
          @method('PUT')
          <div class="form-group">
            <label for="">Logo</label>
            <img src="{{asset(@$logoSetting->logo)}}" alt="Nai">
            <input type="file" name="logo" class="form-control">
            <input type="hidden" name="old_logo" class="form-control" value="{{@$logoSetting->logo}}">
          </div>
          <div class="form-group">
            <label for="">Favicon</label>
            <input type="file" name="favicon" class="form-control">
            <input type="hidden" name="old_favicon" class="form-control" value="{{@$logoSetting->favicon}}">
          </div>
          <div class="form-group">
            <label for="">Footer Logo</label>
            <input type="file" name="footer_logo" class="form-control">
            <input type="hidden" name="old_footer_logo" class="form-control" value="{{@$logoSetting->footer_logo}}">
          </div>
          <button type="submit" class="btn btn-primary">Update Logo Setting</button>
        </form>
      </div>
    </div>
  </div>