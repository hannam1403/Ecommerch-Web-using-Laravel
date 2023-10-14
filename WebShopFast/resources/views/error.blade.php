<!-- /resources/views/post/create.blade.php -->
<script src="/jquery.min.js"></script>
<link rel="stylesheet" href="/toastr/toastr.min.css">
<script src="/toastr/toastr.min.js"></script>
@if ($errors->any())
    <?php $errorMessages = [] ?>
    @foreach ($errors->all() as $error)
        @if (is_string($error))
            <?php $errorMessages[] = $error ?>  
        @endif
    @endforeach
    @if (! empty($errorMessages))
        <script>
            toastr.error("{!! implode('<br>', $errorMessages) !!}");
        </script>
    @endif
@endif 

@if(Session::has('toastr'))
    <script>
        toastr.{{Session()->get('toastr.type')}}('{{Session()->get('toastr.message')}}');
        {{ Session()->forget('toastr') }} // xóa session toastr
    </script>
@endif

@if(Session::has('error_No_Toastr'))
<div class="alert alert-danger">
    {{Session::get('error_No_Toastr')}}
</div>
@endif

@if(Session::has('success_No_Toastr'))
<div class="alert alert-success">
    {{Session::get('success_No_Toastr')}}
</div>
@endif