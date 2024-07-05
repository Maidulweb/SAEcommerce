@extends('admin.layouts.master')
@section('content')
<section class="section">
    <div class="section-header">
      <h1>Pending Vendor</h1>
    </div>

    <div class="section-body mb-0">
          <div class="card">
            <div class="card-body">
             <table class="table">
                <tr>
                    <td style="width: 15%">Banner</td>
                    <td><img src="{{asset($vendor->banner)}}" alt=""></td>
                </tr>
                <tr>
                    <td style="width: 15%">Shop Name</td>
                    <td>{{$vendor->shop_name}}</td>
                </tr>
                <tr>
                    <td style="width: 15%">Phone</td>
                    <td>{{$vendor->phone}}</td>
                </tr>
                <tr>
                    <td style="width: 15%">Email</td>
                    <td>{{$vendor->email}}</td>
                </tr>
                <tr>
                    <td style="width: 15%">Address</td>
                    <td>{{$vendor->address}}</td>
                </tr>
                <tr>
                    <td style="width: 15%">Description</td>
                    <td>{{$vendor->description}}</td>
                </tr>
             </table>
             <form action="{{route('admin.vendor-request.status', $vendor->id)}}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group col-4">
                    <select name="status" id="" class="form-control">
                       <option value="">Select</option>
                       <option value="1">Approved</option>
                    </select>
                </div>
              <div style="padding-left: 15px">
                <button class="btn btn-primary" type="submit">Approved</button>
              </div>
             </form>
            </div>
          </div>
    </div>
  </section>
@endsection