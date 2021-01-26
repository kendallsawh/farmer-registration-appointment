@extends('layouts.app')
@section('css')
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/smoothness/jquery-ui.css">
<style type="text/css">
    .upper-case{text-transform:uppercase}
</style>
<!-- <link href="{{ asset('css/jquery.datetimepicker.min.css') }}" rel="stylesheet"> -->
@stop

@section('title')

   {{$title ?? ''}}

@stop
@section('content')
<div class="container mt-5">
	<!-- Success message -->
        @if(Session::has('success'))
            <div class="alert alert-success">
                {{Session::get('success')}}
            </div>
        @endif


        <div class="row justify-content-center">
        	<div class="col-md-10">
        	<div class="card">
        		<div class="card-header text-center">
        			<h3>{{$title ?? ''}}</h3>
        			<h5>Please enter your information correctly</h5>
        		</div>

        		<div class="card-body ">
        			<div class="card-content table-responsive">
                            <table class="table table-striped table-hover">
                                <thead class="">

                                    <th>Portfolio No</th>
                                    <th>Date Entered</th>
                                    <th>Current Location</th>

                                    <!-- <th>Contract End</th> -->
                                    <th>Details</th>
                                    <th>File Type</th>
                                    <th class="text-center"><i class="fa fa-cogs"></i></th>
                                </thead>
                                <tbody>
                                    @foreach($appointments as $appointment)


                                    <tr class="" title="" data-toggle="tooltip" >


                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        
                                        <td></td>
                                        <td></td>
                                        <td class="td-actions text-center">
                                            <a href="" rel="tooltip" class="btn btn-info" data-original-title="View Application" title="View More Details">
                                                <i class="fa fa-eye" aria-hidden="true"></i>
                                                <div class="ripple-container"></div>
                                            </a>

                                        </td>
                                    </tr>




                                    @endforeach
                                </tbody>
                            </table>

                        </div>
                        {{ $appointments->links() }}
        		</div>
        	</div>
        </div>
        </div>
</div>
@endsection
@section('scripts')
<script src="https://kit.fontawesome.com/7be7b3aac4.js" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>


@endsection
