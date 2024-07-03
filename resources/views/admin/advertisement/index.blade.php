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
                    <div class="col-3">
                      <div class="list-group" id="list-tab" role="tablist">
                        <a class="list-group-item list-group-item-action active" id="list-advetisement-one-list" data-toggle="list" href="#list-advetisement-one" role="tab">Homepage Banner One</a>
                        <a class="list-group-item list-group-item-action" id="list-advetisement-three-list" data-toggle="list" href="#list-advetisement-three" role="tab">Homepage Banner Bottom (3 Items)</a>
                        <a class="list-group-item list-group-item-action" id="list-advetisement-two-list" data-toggle="list" href="#list-advetisement-two" role="tab">Cart Page Banner (2 Items)</a>
                        <a class="list-group-item list-group-item-action" id="list-advetisement-four-list" data-toggle="list" href="#list-advetisement-four" role="tab">Product Page Banner</a>
                      </div>
                    </div>
                    <div class="col-9">
                      <div class="tab-content" id="nav-tabContent">
                        @include('admin.advertisement.advertisement-banner-one')
                        @include('admin.advertisement.advertisement-banner-three')
                        @include('admin.advertisement.advertisement-banner-two')
                        @include('admin.advertisement.advertisement-banner-four')
                       </div>
                  </div>
            </div>
          </div>
    </div>
  </section>
  
@endsection

