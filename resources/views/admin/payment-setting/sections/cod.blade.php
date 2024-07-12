<div class="tab-pane fade" id="list-cod" role="tabpanel" aria-labelledby="list-cod-list">
    <div class="card border">
      <div class="card-header">
        <h6>Cash On Delivery Setting</h6>
      </div>
      <div class="card-body">
        <form action="{{route('admin.cod.update', 1)}}" method="POST">
          @csrf
          @method('PUT')
          <div class="form-group">
            <label for="">Payment Status</label>
            <select name="status" class="form-control">
              <option {{-- {{$codData->status == 1 ? 'selected' : ''}} --}} value="1">Enable</option>
              <option {{-- {{$codData->status == 0 ? 'selected' : ''}} --}} value="0">Disable</option>
            </select>
          </div>
          <button type="submit" class="btn btn-primary">Setting</button>
        </form>
      </div>
    </div>
</div>