@extends('Admin.Layouts.layoutManager')
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
            {{-- <button class="btn btn-primary mt-2 mt-xl-0" data-bs-toggle="modal" data-bs-target="#modalAddProduct">
              Add Product
            </button> --}}
          </div>
          <div class="col-lg-12 grid-margin stretch-card">
            <form action="/MemberManager/search" method="PUT">
              <div class="input-group">
                <input type="search" id="var_search" name="var_search"  class="form-control rounded" placeholder="Tìm tài khoản theo username hoặc id" aria-label="Search" aria-describedby="search-addon" />
                <label for="var_search">
                  <button type="submit" class="btn btn-outline-primary">Search</button>
                </label>
              </div>
            </form>
          </div>   
          <br><br>  
          <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
              <div class="card-body">
                <h4 class="card-title">Thông tin tài khoản khách hàng</h4>
                <div class="table-responsive">
                  <table class="table table-hover text-center">
                    <thead>
                      <tr>
                        <th>Customer Id</th>
                        <th>Customer Name</th>
                        <th>Role</th>
                        <th>Phone</th>
                        <th>Username</th>
                        <th>Account Balance</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody> 
                      @foreach($members as $member) 
                      <tr class="member-row" data-member-id="{{ $member->Id }}">
                        <td>{{ $member->Id }}</td>
                        <td>{{ $member->Name }}</td>
                        <td>{{ $member->RoleId }}</td>
                        <td>{{ $member->Phone }}</td>
                        <td>{{ $member->Username }}</td>
                        <td>{{ $member->AccountBalance }}</td>
                        <td>
                          {{-- <button class="btn-edit btn btn-primary btn-rounded"
                              data-bs-toggle="modal" data-bs-target="#modalEditProduct">Edit</button>                        --}}
                          {{-- <a href="/MemberManager/Delete/{{$member->Id}}">
                            <button class=" btn btn-rounded btn-danger btn-fw mt-2 mt-xl-0">Lock Account</button>
                          </a>--}}
                          <button id={{ $member->Id }} class=" btn btn-edit btn-rounded btn-danger btn-fw mt-2 mt-xl-0"
                            data-bs-toggle="modal" data-bs-target="#modalReasonLock">Lock Account
                          </button>
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

    <div class="pagination justify-content-center pt-5">
      {{ $members->withQueryString()->links('pagination::bootstrap-4' , ['showInfo' => false]) }}
    </div>
    @include('Admin.ReasonLockMember')
@endsection