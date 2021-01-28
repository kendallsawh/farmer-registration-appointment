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
        	<div class="card ">
        		<div class="card-header text-center text-white bg-info">
        			<h3>{{$title ?? ''}}</h3>
        			<h5>Please enter your information correctly</h5>
        		</div>

        		<div class="card-body ">
        			<form method="post" action="{{route('storeNewAppointment') }}" enctype="multipart/form-data" id="newFileRecord">

        				<!-- CROSS Site Request Forgery Protection -->
        				@csrf
                        
        				<!-- <div class="wizard-header">
        					<h2 class="wizard-title text-center">{{$title ?? ''}}</h2>
        					<h5 class="text-center">Please enter your information correctly</h5>


        				</div> -->
        				<hr>
                        <div class="text-center"><strong>Application Type</strong></div>
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="btn-group btn-group-toggle" data-toggle="buttons">
                                    <label class="btn btn-info">
                                        <input type="radio" name="options" id="option2" autocomplete="off" value="1"> New
                                    </label>
                                    <label class="btn btn-info">
                                        <input type="radio" name="options" id="option3" autocomplete="off" value="2"> Renewal
                                    </label>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="text-center"><strong>Applicant Information</strong></div>
        				<div class="row">
        					<div class="col-sm-12">
        						<div class="form-group">
        							<!-- <span class="input-group-addon"><i class="material-icons">date_range</i></span> -->
        							<div id="grp-firstname" class="form-group{{ $errors->has('firstname') ? ' has-error' : '' }} label-floating">
        								<label class="control-label ">First Name <star>*</star></label>
        								<input id="firstname" name="firstname" type="text" class="form-control upper-case" autocomplete="off" value="{{old('firstname')}}">

        								<span class="help-block">
        									<strong id="err-firstname"  class="red">{{ $errors->first('firstname') }}</strong>
        								</span>
        							</div>
        						</div>
        					</div>

        				</div>

        				<div class="row">
        					<div class="col-sm-12">
        						<div class="form-group">
        							<!-- <span class="input-group-addon"><i class="material-icons">date_range</i></span> -->
        							<div id="grp-lastname" class="form-group{{ $errors->has('lastname') ? ' has-error' : '' }} label-floating">
        								<label class="control-label">Last Name <star>*</star></label>
        								<input id="lastname" name="lastname" type="text" class="form-control upper-case" autocomplete="off" value="{{old('lastname')}}">

        								<span class="help-block">
        									<strong id="err-lastname"  class="red">{{ $errors->first('lastname') }}</strong>
        								</span>
        							</div>
        						</div>
        					</div>

        				</div>

                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <div id="grp-gender" class="form-group{{ $errors->has('gender') ? ' has-error' : '' }} label-floating">
                                        <label class="control-label">Gender <span class="red">*</span></label>
                                        <select id="gender" name="gender" class="form-control dropdown">
                                            <option disabled="" selected=""></option>
                                            @foreach($genders as $gender)
                                            <option value="{{$gender->slug}}" {{old('gender')==$gender->slug ? 'selected' : '' }}>{{$gender->gender}}</option>
                                            @endforeach
                                        </select>

                                        <span class="help-block">
                                            <strong id="err-gender">{{ $errors->first('gender') }}</strong>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <div id="grp-email" class="form-group{{ $errors->has('email') ? ' has-error' : '' }} label-floating">
                                        <label class="control-label">Email</label>
                                        <input id="email" name="email" type="email" class="form-control" value="{{old('email')}}"/>

                                        <span class="help-block">
                                            <strong id="err-email">{{ $errors->first('email') }}</strong>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div id="grp-mobilenumber" class="form-group{{ $errors->has('mobilenumber') ? ' has-error' : '' }} label-floating">
                                    <label class="control-label">Contact <i class="fa fa-exclamation-circle" aria-hidden="true"></i></label>
                                    <input id="mobilenumber" name="mobilenumber" type="text" class="form-control contact" value="{{old('mobilenumber')}}" autocomplete="false">

                                    <span class="help-block">
                                        <strong id="">Enter at least one type of contact</strong><br>
                                        <strong id="">Format (xxx) xxx-xxxx</strong><br>
                                        <strong id="err-mobilenumber">{{ $errors->first('mobilenumber') }}</strong>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="text-center"><strong>Applicant Address</strong></div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <div id="grp-lot_type" class="form-group{{ $errors->has('lot_type') ? ' has-error' : '' }} label-floating">
                                        <label>Lot Type <star>*</star></label>

                                        <select id="lot_type" name="lot_type" class="form-control dropdown  upper-case">
                                            @foreach($lot_types as $lot_type)
                                            <option value="{{$lot_type->id}}" {{old('hometype')==$lot_type->id ? 'selected' : '' }}>{{$lot_type->lot_type}}</option>
                                            @endforeach    
                                        </select>

                                        <span class="help-block">
                                            <strong id="err-lot_type">{{ $errors->first('lot_type') }}</strong>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <!--  -->
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <!-- <span class="input-group-addon"><i class="material-icons">date_range</i></span> -->
                                    <div id="grp-house_no" class="form-group{{ $errors->has('house_no') ? ' has-error' : '' }} label-floating">
                                        <label class="control-label">Lot number <star>*</star></label>
                                        <input id="house_no" name="house_no" type="number" class="form-control upper-case" autocomplete="off" value="{{old('house_no')}}">

                                        <span class="help-block">
                                            <strong id="err-house_no"  class="red">{{ $errors->first('house_no') }}</strong>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            

                        </div>

                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <!-- <span class="input-group-addon"><i class="material-icons">date_range</i></span> -->
                                    <div id="grp-road" class="form-group{{ $errors->has('road') ? ' has-error' : '' }} label-floating">
                                        <label class="control-label">Street <star>*</star></label>
                                        <input id="road" name="road" type="text" class="form-control upper-case" autocomplete="off" value="{{old('road')}}">

                                        <span class="help-block">
                                            <strong id="err-road"  class="red">{{ $errors->first('road') }}</strong>
                                        </span>
                                    </div>
                                </div>
                            </div>

                        </div>

        				<div class="row">
        					<div class="col-sm-12">
        						<div class="form-group">
        							<div id="grp-district" class="form-group{{ $errors->has('district') ? ' has-error' : '' }} label-floating">
        								<label>Town/Village</label>

        								<select id="district" name="district" class="form-control dropdown">
        								@foreach($districts as $district)
                                        <option value="{{$district->id}}" {{old('town_village')==$district->id ? 'selected' : '' }}>{{$district->district}}</option>
                                        @endforeach	
        								</select>

        								<span class="help-block">
        									<strong id="err-district">{{ $errors->first('district') }}</strong>
        								</span>
        							</div>
        						</div>
        					</div>
        				</div>
        				
        				<hr>
                        <div class="text-center"><strong>Additional Details</strong></div>
        				<div class="row">
        					<div class="col-sm-12">                    
        						<div id="grp-comment" class="form-group{{ $errors->has('comments') ? ' has-error' : '' }}">
        							<label class="control-label">Reason (Optional)</label>
        							<textarea class="form-control comments upper-case" name="comments" id="comments" rows="2" placeholder="Optionally state the reason you are interested in registering as a farmer">{{old('comments')}}</textarea>
        							
        							<span class="help-block text-danger">
        								<strong id="err-comments">{{ $errors->first('comments') }}</strong>
        							</span>
        						</div>

        					</div>
        				</div>
                        <hr>
                        <div class="text-center"><strong>Appointment Date Selection</strong></div>
                        <br>
        				<div class="row">
        					<div class="col-sm-8">
        						<div class="form-group available-dates" id="available-dates">
                                    
                                    <div class="form-check custom-control custom-radio radio-date" id="radio-date">
                                        <input type="text" class="form-control" name="appointmentdate" id="appointmentdate" value="{{old('dateofbirth')}}" readonly="true" placeholder="available date">
                                    </div>
        							
        							
                                    
        						</div>
        					</div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <button type="button" id="btn-check" class="btn btn-primary">Check Available Appointment Date</button>
                                </div>
                            </div>
        				</div>
                        <hr>
        				<input type="submit" name="send" value="Book Available Date" class="btn btn-dark btn-block">
        			</form>
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.2/bootstrap3-typeahead.min.js" integrity="sha512-HWlJyU4ut5HkEj0QsK/IxBCY55n5ZpskyjVlAoV9Z7XQwwkqXoYdCIC93/htL3Gu5H3R4an/S0h2NXfbZk3g7w==" crossorigin="anonymous"></script>

<script type="text/javascript">
    $("#btn-check").click(function() {
        //alert("f");
        ajaxAppointment($('#district').val())
    })
    var listingPath = "{{route('ajaxGetAppointment')}}"
	function ajaxAppointment(searchValue) {
        //alert(searchValue);
        /*$.get(listingPath,{searchvalue:searchValue},function(data,status,xhr){
                
                $('#appointmentdate').val(data);
            },"html");*/


         
        $.ajax({
            type: "POST",
            url: '{{url('get_appointment')}}',
            data: {
                districtid:searchValue,
                _token: "{{ csrf_token() }}",
            },
            dataType: "html",
            success: function(res) {
                
                    //alert(res.count);
                    //$('#appointmentdate').val(res.count)
                    $('#radio-date').empty().html(res);
                    console.log(res);
                    /*$('#county_check').empty();
                    $('#county_check').text('This town is in county '+ res.assinged_county + res.assinged_farmdistrict + ' and this application will be assigned to ' + res.assinged_user);
                    $('#county_check').removeClass('hide');*/
                
            },
            error: function (data) {
                var errors = data.responseJSON;
                console.log(data.responseText);
                
               
                

            }
        });
    };
</script>
@endsection
