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
                    <div class="col-2 pt-2">
                      <div class="list-group" id="list-tab" role="tablist">
                        <a class="list-group-item list-group-item-action active" id="list-home-list" data-toggle="list" href="#list-home" role="tab">Paypal Setting</a>
                        <a class="list-group-item list-group-item-action" id="list-stripe-list" data-toggle="list" href="#list-stripe" role="tab">Stripe</a>
                        <a class="list-group-item list-group-item-action" id="list-settings-list" data-toggle="list" href="#list-settings" role="tab">Settings</a>
                      </div>
                    </div>
                    <div class="col-10">
                      <div class="tab-content" id="nav-tabContent">
                        @include('admin.payment-setting.sections.paypal')
                        @include('admin.payment-setting.sections.stripe')
                    </div>
                  </div>
            </div>
          </div>
    </div>
  </section>
  
@endsection