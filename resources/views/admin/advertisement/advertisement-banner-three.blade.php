<div class="tab-pane fade" id="list-advetisement-three" role="tabpanel" aria-labelledby="list-advetisement-three-list">
    <div class="card border">
      <div class="card-header">
        <h6>Advertisement Banner Two</h6>
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
        <form action="{{route('admin.advertisement-banner-three')}}" method="POST" enctype="multipart/form-data">
          @csrf
          @method('PUT')
          <h2>Banner One</h2>
          @php
            $advertisement_banner_three = json_decode($advertisement_banner_three->value);
          @endphp
          <div class="form-group">
            <label class="custom-switch mt-2">
                <input type="checkbox" {{ $advertisement_banner_three->banner_one->status == 1 ? 'checked' : ''}} name="status" class="custom-switch-input change-status">
                <span class="custom-switch-indicator"></span>
              </label>
          </div>
          <img src="{{asset($advertisement_banner_three->banner_one->banner)}}" alt="Nai">
          <div class="form-group">
            <label for="">Banner</label>
            <input type="file" name="banner" class="form-control">
            <input type="hidden" name="banner_empty" class="form-control" value="{{$advertisement_banner_three->banner_one->banner}}">
          </div>
          <div class="form-group">
            <label for="">URL</label>
            <input type="text" name="url" class="form-control" value="{{$advertisement_banner_three->banner_one->url}}">
          </div>
          <h3>Banner Two</h3>
          <div class="form-group">
            <label class="custom-switch mt-2">
                <input type="checkbox"  {{ $advertisement_banner_three->banner_two->status == 1 ? 'checked' : ''}}  name="status_two" class="custom-switch-input change-status">
                <span class="custom-switch-indicator"></span>
              </label>
          </div>
          <img src="{{asset($advertisement_banner_three->banner_two->banner)}}" alt="">
          <div class="form-group">
            <label for="">Banner</label>
            <input type="file" name="banner_img_two" class="form-control">
            <input type="hidden" name="banner_two_empty" class="form-control" value="{{$advertisement_banner_three->banner_two->banner}}">
          </div>
          <div class="form-group">
            <label for="">URL</label>
            <input type="text" name="url_two" class="form-control" value="{{$advertisement_banner_three->banner_two->url}}">
          </div>
          <h3>Banner Three</h3>
          <div class="form-group">
            <label class="custom-switch mt-2">
                <input type="checkbox"  {{ $advertisement_banner_three->banner_three->status == 1 ? 'checked' : ''}}  name="status_three" class="custom-switch-input change-status">
                <span class="custom-switch-indicator"></span>
              </label>
          </div>
          <img src="{{asset($advertisement_banner_three->banner_three->banner)}}" alt="">
          <div class="form-group">
            <label for="">Banner</label>
            <input type="file" name="banner_img_three" class="form-control">
            <input type="hidden" name="banner_three_empty" class="form-control" value="{{$advertisement_banner_three->banner_three->banner}}">
          </div>
          <div class="form-group">
            <label for="">URL</label>
            <input type="text" name="url_three" class="form-control" value="{{$advertisement_banner_three->banner_three->url}}">
          </div>
          <button type="submit" class="btn btn-primary">Update</button>
        </form>
      </div>
    </div>
  </div>