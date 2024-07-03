<div class="tab-pane fade show active" id="list-advetisement-one" role="tabpanel" aria-labelledby="list-advetisement-one-list">
    <div class="card border">
      <div class="card-header">
        <h6>Advertisement Banner one</h6>
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
        <form action="{{route('admin.advertisement-banner-one')}}" method="POST" enctype="multipart/form-data">
          @csrf
          @method('PUT')
          @php
            $banner_one = json_decode($advertisement_banner_one->value);
          @endphp
          <div class="form-group">
            <label class="custom-switch mt-2">
                <input type="checkbox" {{$banner_one->banner_one->status == 1 ? 'checked' : ''}}  name="status" class="custom-switch-input change-status">
                <span class="custom-switch-indicator"></span>
              </label>
          </div>
          <img src="{{asset($banner_one->banner_one->banner)}}" alt="Nai">
          <div class="form-group">
            <label for="">Banner</label>
            <input type="file" name="banner" class="form-control">
            <input type="hidden" name="banner_empty" value="{{$banner_one->banner_one->banner}}" class="form-control">
          </div>
          <div class="form-group">
            <label for="">URL</label>
            <input type="text" name="url" class="form-control" value="{{$banner_one->banner_one->url}}">
          </div>
          <button type="submit" class="btn btn-primary">Update</button>
        </form>
      </div>
    </div>
  </div>