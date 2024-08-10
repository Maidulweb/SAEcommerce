<div class="tab-pane fade" id="list-pusher" role="tabpanel" aria-labelledby="list-pusher-setting">
    <div class="card border">
      <div class="card-header">
        <h6>Pusher Setting</h6>
      </div>
      <div class="card-body">
        <form action="{{route('admin.pusher.setting')}}" method="POST">
          @csrf
          @method('PUT')
          <div class="form-group">
            <label for="">App Id</label>
            <input type="text" name="app_id" class="form-control" value="{{$pusherSetting?->app_id}}">
          </div>
          <div class="form-group">
            <label for="">Key</label>
            <input type="text" name="key" class="form-control" value="{{$pusherSetting?->key}}">
          </div>
          <div class="form-group">
            <label for="">Secret</label>
            <input type="text" name="secret" class="form-control" value="{{$pusherSetting?->secret}}">
          </div>
          <div class="form-group">
            <label for="">Cluster</label>
            <input type="text" name="cluster" class="form-control" value="{{$pusherSetting?->cluster}}">
          </div>
          <button type="submit" class="btn btn-primary">Update Pusher Setting</button>
        </form>
      </div>
    </div>
  </div>