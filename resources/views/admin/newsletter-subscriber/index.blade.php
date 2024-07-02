@extends('admin.layouts.master')
@section('content')
<section class="section">
      <h2 class="mt-5">Newsletter Subscriber List</h2>
    <div class="section-body">
        <div class="card">
          <div class="card-body">
              <form action="{{route('admin.subscriber-send-mail')}}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="">Subject</label>
                    <input type="text" name="subject" class="form-control">
                </div>
                <div class="form-group">
                    <label for="">Message</label>
                    <textarea name="message" id="" cols="30" rows="10" class="form-control"></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Send</button>
              </form>
          </div>
        </div>
   </div>
    <div class="section-body mb-0">
          <div class="card">
            <div class="card-body">
                {{ $dataTable->table() }}
            </div>
          </div>
    </div>
  </section>
  
@endsection
@push('scripts')
    {{ $dataTable->scripts(attributes: ['type' => 'module']) }}
@endpush

