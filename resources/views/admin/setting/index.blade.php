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
                        <a class="list-group-item list-group-item-action" id="list-profile-list" data-toggle="list" href="#list-profile" role="tab">Profile</a>
                        <a class="list-group-item list-group-item-action" id="list-messages-list" data-toggle="list" href="#list-messages" role="tab">Messages</a>
                        <a class="list-group-item list-group-item-action" id="list-settings-list" data-toggle="list" href="#list-settings" role="tab">Settings</a>
                      </div>
                    </div>
                    <div class="col-10">
                      <div class="tab-content" id="nav-tabContent">
                        <div class="tab-pane fade show active" id="list-home" role="tabpanel" aria-labelledby="list-home-list">
                          <div class="card border">
                            <div class="card-header">
                              <h6>General Setting</h6>
                            </div>
                            <div class="card-body">
                              <form action="{{route('admin.general-setting.update')}}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="form-group">
                                  <label for="">Site Name</label>
                                  <input type="text" name="site_name" class="form-control" value="{{$generalSetting->site_name}}">
                                </div>
                                <div class="form-group">
                                  <label for="">Layout</label>
                                  <select name="layout" class="form-control">
                                    <option {{$generalSetting->layout == 'ltr' ? 'selected' : ''}} value="ltr">LTR</option>
                                    <option {{$generalSetting->layout == 'rtl' ? 'selected' : ''}} value="rtl">RTL</option>
                                  </select>
                                </div>
                                <div class="form-group">
                                  <label for="">Contact Email</label>
                                  <input type="text" name="contact_email" class="form-control" value="{{$generalSetting->contact_email}}">
                                </div>
                                <div class="form-group">
                                  <label for="">Currency Name</label>
                                  <select name="currency_name" class="form-control select2">
                                    <option value="">Select</option>
                                    @foreach (config('setting.currency_list') as $currency)
                                    <option {{$generalSetting->currency_name == $currency ? 'selected' : ''}} value="{{$currency}}">{{$currency}}</option>
                                    @endforeach
                                  </select>
                                </div>
                                <div class="form-group">
                                  <label for="">Currency Icon</label>
                                  <input type="text" name="currency_icon" class="form-control" value="{{$generalSetting->currency_icon}}">
                                </div>
                                <div class="form-group">
                                  <label for="">Timezone</label>
                                  <select name="timezone" class="form-control select2">
                                    <option value="">Select</option>
                                    @foreach (config('setting.timezone') as $key => $timezone)
                                    <option {{$generalSetting->timezone == $key ? 'selected' : ''}} value="{{$key}}">{{$key}}</option>
                                    @endforeach
                                  </select>
                                </div>
                                <button type="submit" class="btn btn-primary">Update</button>
                              </form>
                            </div>
                          </div>
                      </div>
                    </div>
                  </div>
            </div>
          </div>
    </div>
  </section>
  
@endsection

