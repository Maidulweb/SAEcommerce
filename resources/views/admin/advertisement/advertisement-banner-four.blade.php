<div class="tab-pane fade" id="list-advetisement-four" role="tabpanel" aria-labelledby="list-advetisement-four-list">
    <div class="card border">
      <div class="card-header">
        <h6>Product Page Banner</h6>
      </div>
      <div class="card-body">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form action="{{route('admin.advertisement-banner-four')}}" method="POST" enctype="multipart/form-data">
          @csrf
          @method('PUT')
          @php
            $banner_four = json_decode($advertisement_banner_four->value);
          @endphp
          <div class="form-group">
            <label class="custom-switch mt-2">
                <input type="checkbox" {{$banner_four->banner_four->status == 1 ? 'checked' : ''}}  name="status" class="custom-switch-input change-status">
                <span class="custom-switch-indicator"></span>
              </label>
          </div>
          <img src="{{asset($banner_four->banner_four->banner)}}" alt="Nai">
          <div class="form-group">
            <label for="">Banner</label>
            <input type="file" name="banner" class="form-control">
            <input type="hidden" name="banner_empty" value="{{$banner_four->banner_four->banner}}" class="form-control">
          </div>
          <div class="form-group">
            <label for="">URL</label>
            <input type="text" name="url" class="form-control" value="{{$banner_four->banner_four->url}}">
          </div>
          <button type="submit" class="btn btn-primary">Update</button>
        </form>
      </div>
    </div>
  </div>