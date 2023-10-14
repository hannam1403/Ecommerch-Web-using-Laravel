@extends('layouts.app')
@section('content')
<div class="col py-3 main-panel">
    <section>
        <div class="row">
          <div class="d-flex justify-content-between align-items-end flex-wrap">
            <button type="button" class="btn btn-light bg-white btn-icon me-3 d-none d-md-block ">
              <i class="mdi mdi-download text-muted"></i>
            </button>
            <button type="button" class="btn btn-light bg-white btn-icon me-3 mt-2 mt-xl-0">
              <i class="mdi mdi-clock-outline text-muted"></i>
            </button>
            <button type="button" class="btn btn-light bg-white btn-icon me-3 mt-2 mt-xl-0">
              <i class="mdi mdi-plus text-muted"></i>
            </button>
            <button class="btn btn-primary mt-2 mt-xl-0" data-bs-toggle="modal" data-bs-target="#modalAddAddress">
              Add Address
            </button>
          </div>     
          <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
              <div class="card-body">
                <h4 class="card-title">Thông tin địa chỉ</h4>
                <div class="table-responsive">
                  <table class="table table-hover">
                    <thead>
                      <tr>
                        <th hidden>Id</th>
                        <th style="width: 70%">Default Address</th>
                        <th style="width: 30%">Action</th>
                      </tr>
                    </thead>
                    <tbody> 
                      @foreach($addresses as $address) 
                      <tr>
                        <td hidden>{{ $address->ID }}</td>
                        <td>{{ $address->Name }}</td>
                        <td>
                          <button class="btn-edit btn btn-primary btn-rounded"
                              data-bs-toggle="modal" data-bs-target="#modalEditAddress">Edit</button>                       
                          <a href="/AddressManager/Delete/{{$address->ID}}">
                            <button class=" btn btn-rounded btn-danger btn-fw mt-2 mt-xl-0">Delete</button>
                          </a>                       
                        </td>
                      </tr>
                      @endforeach
                    </tbody>
                  </table>
                  <table class="table table-hover">
                    <thead>
                      <tr>
                        <th hidden>Id</th>
                        <th style="width: 70%">Other Address</th>
                        <th style="width: 30%">Action</th>
                      </tr>
                    </thead>
                    <tbody> 
                      @foreach($oaddresses as $oaddress) 
                      <tr>
                        <td hidden>{{ $oaddress->ID }}</td>
                        <td>{{ $oaddress->Name }}</td>
                        <td>
                          <a href="/AddressManager/MakeDefault/{{$oaddress->ID}}">
                            <button class=" btn btn-rounded btn-success btn-fw mt-2 mt-xl-0">Make Default</button>
                          </a>     
                          <button class="btn-edit btn btn-primary btn-rounded"
                              data-bs-toggle="modal" data-bs-target="#modalEditAddress">Edit</button>                       
                          <a href="/AddressManager/Delete/{{$oaddress->ID}}">
                            <button class=" btn btn-rounded btn-danger btn-fw mt-2 mt-xl-0">Delete</button>
                          </a>                       
                        </td>
                      </tr>
                      @endforeach
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
    </section>
    @include('Account.editAddress')
    @include('Account.addAddress')
    
@endsection