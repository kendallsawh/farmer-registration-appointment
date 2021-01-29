@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('Success! Your application has been recorded. Please check your email for confirmation receipt') }}
                    <div class="text-center">
                        <h3>You will be redirected shortly.</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')
<script type="text/javascript">
    $(function() {
        setTimeout(function() {
            window.location.href = "/";
      }, 8000);
    });
    
</script>
@endsection
