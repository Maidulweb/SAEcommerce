@extends('frontend.dashboard.layouts.master')
@section('content')
<div class="row">
    <div class="col-xl-9 col-xxl-10 col-lg-9 ms-auto">
      <div class="dashboard_content mt-2 mt-md-0">
        <h3><i class="fal fa-gift-card"></i>Update address</h3>
        <div class="wsus__dashboard_add wsus__add_address">
          <form action="{{route('user.user-address.update', $userAddress->id)}}" method="POST">
            @csrf
            @method('PUT')
            <div class="row">
              <div class="col-xl-6 col-md-6">
                <div class="wsus__add_address_single">
                  <label>name <b>*</b></label>
                  <input type="text" name="name" value="{{$userAddress->name}}" placeholder="Name">
                </div>
              </div>
              <div class="col-xl-6 col-md-6">
                <div class="wsus__add_address_single">
                  <label>email</label>
                  <input type="email" name="email" value="{{$userAddress->email}}"  placeholder="Email">
                </div>
              </div>
              <div class="col-xl-6 col-md-6">
                <div class="wsus__add_address_single">
                  <label>phone <b>*</b></label>
                  <input type="text" name="phone" value="{{$userAddress->phone}}"  placeholder="Phone">
                </div>
              </div>
              <div class="col-xl-6 col-md-6">
                <div class="wsus__add_address_single">
                  <label>countery <b>*</b></label>
                  <div class="wsus__topbar_select">
                    <select class="select_2" name="country">
                      @foreach (config('setting.country_lists') as $country)
                      <option {{$userAddress->country == $country ? 'selected' : ''}} value="{{$country}}">{{$country}}</option>
                      @endforeach  
                    </select>
                  </div>
                </div>
              </div>
              <div class="col-xl-6 col-md-6">
                <div class="wsus__add_address_single">
                  <label>state <b>*</b></label>
                  <input type="text" name="state" value="{{$userAddress->state}}"  placeholder="State">
                </div>
              </div>
              <div class="col-xl-6 col-md-6">
                <div class="wsus__add_address_single">
                  <label>city <b>*</b></label>
                  <input type="text" name="city" value="{{$userAddress->city}}"  placeholder="City">
                </div>
              </div>
              <div class="col-xl-6 col-md-6">
                <div class="wsus__add_address_single">
                  <label>zip code <b>*</b></label>
                  <input type="text" name="zip_code" value="{{$userAddress->zip_code}}"  placeholder="Zip Code">
                </div>
              </div>
              <div class="col-xl-6 col-md-6">
                <div class="wsus__add_address_single">
                  <label>address <b>*</b></label>
                  <input type="text" name="address" value="{{$userAddress->address}}"  placeholder="Address">
                </div>
              </div>
              <div class="col-xl-6">
                <button type="submit" class="common_btn">Update Address</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
@endsection