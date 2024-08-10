@extends('admin.layouts.master')
@section('content')
<section class="section">
    <div class="section-header">
      <h1>Setting</h1>
    </div>

    <div class="section-body mb-0">
          <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-2">
                      <div class="list-group" id="list-tab" role="tablist">
                        <a class="list-group-item list-group-item-action active" id="list-home-list" data-toggle="list" href="#list-home" role="tab">General Setting</a>
                        <a class="list-group-item list-group-item-action" id="list-smtp-list" data-toggle="list" href="#list-smtp" role="tab">smtp Setting</a>
                        <a class="list-group-item list-group-item-action" id="list-logo-list" data-toggle="list" href="#list-logo" role="tab">Logo Setting</a>
                        <a class="list-group-item list-group-item-action" id="list-pusher-setting" data-toggle="list" href="#list-pusher" role="tab">Pusher Setting</a>
                      </div>
                    </div>
                    <div class="col-10">
                      <div class="tab-content" id="nav-tabContent">
                        @include('admin.setting.general-setting')
                        @include('admin.setting.smtp-setting')
                        @include('admin.setting.logo-setting')
                        @include('admin.setting.pusher-setting')
                       </div>
                  </div>
            </div>
          </div>
    </div>
  </section>
  
@endsection

