@extends('Admin.Layouts.layoutManager')
@section('content')
<div class="col py-3 main-panel">
    <section>     
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
            <div class="card-body">
                <h4 class="card-title">List Notification</h4>
                <div class="table-responsive">
                <table class="table table-hover text-center text-center">
                    <thead>
                    <tr>
                        <th>ID Member</th>
                        <th>Content</th>
                        <th>Time</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody> 
                    @foreach($notifications as $notification) 
                    <tr>
                        <td>{{ $notification->IdAboutMember }}</td>
                        <td>{{ $notification->Content }}</td>
                        <td>{{ $notification->Create_at }}</td>
                        <td>                    
                        <a href="/Notification/Done/{{$notification->Id}}">
                            <button class=" btn btn-rounded btn-primary btn-fw mt-2 mt-xl-0">Done</button>
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
</div>
@endsection