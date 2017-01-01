@extends('master')

@section('css')
<link rel="stylesheet" href="{{asset('plugins/tooltipster/tooltipster.css')}}">
<!-- bootstrap datepicker -->
<link rel="stylesheet" href="{{asset('plugins/datepicker/datepicker3.css')}}">
<!-- Bootstrap time Picker -->
<link rel="stylesheet" href="{{asset('plugins/timepicker/bootstrap-timepicker.min.css')}}">
<!-- bootstrap lightbox -->
<link rel="stylesheet" href="{{asset('plugins/lightbox/ekko-lightbox.min.css')}}">
<link rel="stylesheet" href="{{asset('plugins/CustomizeFileInput/normalize.css')}}">

<link rel="stylesheet" href="{{asset('plugins/CustomizeFileInput/component.css')}}">

@endsection

@section('scripts')
<script src="{{asset('plugins/validation/dist/jquery.validate.js')}}"></script>
<script src="{{asset('plugins/tooltipster/tooltipster.js')}}"></script>
<!-- bootstrap datepicker -->
<script src="{{asset('plugins/datepicker/bootstrap-datepicker.js')}}"></script>
<!-- bootstrap time picker -->
<script src="{{asset('plugins/timepicker/bootstrap-timepicker.min.js')}}"></script>

<!-- bootstrap lightbox -->
<script src="{{asset('plugins/lightbox/ekko-lightbox.min.js')}}"></script>
<script>
    // add the rule here
    $.validator.addMethod("valueNotEquals", function (value, element, arg) {
        return arg != value;
    }, "Value must not equal arg.");

    $(document).ready(function () {
        // initialize tooltipster on text input elements
        $('form input,select,textarea').tooltipster({
            trigger: 'custom',
            onlyOne: false,
            position: 'right'
        });

        // initialize validate plugin on the form
        $('#add_event_form').validate({
            errorPlacement: function (error, element) {

                var lastError = $(element).data('lastError'),
                        newError = $(error).text();

                $(element).data('lastError', newError);

                if (newError !== '' && newError !== lastError) {
                    $(element).tooltipster('content', newError);
                    $(element).tooltipster('show');
                }
            },
            success: function (label, element) {
                $(element).tooltipster('hide');
            },
            rules: {
                name: {
                    required: true
                },
                start_date: {
                    required: true
                },
                end_date: {
                    required: true
                },
                time: {
                    required: true
                },
                venue: {
                    required: true
                },
                banner: {
                    required: false
                }
            },
            messages: {
                name: {
                    required: "provide event name"
                },
                start_date: {
                    required: "provide start date"
                },
                end_date: {
                    required: "provide end date"
                },
                time: {
                    required: "provide time"
                },
                venue: {
                    required: "provide venue"
                },
                banner: {
                    required: "provide a banner"
                }
            }
        });

        //Date picker 1
        $('#datepicker1').datepicker({
          format: 'dd/mm/yyyy',
          autoclose: true
        });

        //Date picker 2 
        $('#datepicker2').datepicker({
          format: 'dd/mm/yyyy',
          autoclose: true
        });

        //Timepicker
        $(".timepicker").timepicker({
          showInputs: false
        });
        var max_fields      = "{{ $imageLength }}"; //maximum input boxes allowed
        var wrapper         = $(".input_fields_wrap"); //Fields wrapper
        var add_button      = $(".add_field_button"); //Add button ID
        
        var x = 0; //initlal text box count
        $(add_button).click(function(e){ //on add input button click
            e.preventDefault();
            if(x < max_fields){ //max input box allowed
                x++; //text box increment
                $(wrapper).append("<div><input type='file' name='event_image[]' id='img1' class='inputfile inputfile-3'><a href='#'' class='remove_field'>Remove</a></div>"); //add input box
            }
        });
        
        $(wrapper).on("click",".remove_field", function(e){ //user click on remove text
            e.preventDefault(); $(this).parent('div').remove(); x--;
        });

        // $('.delete_image').click(function(event){
        //     // console.log(event.target.id);
        //     event.preventDefault();
        //     $.post( "/event_image/delete", { 
        //         image_id:  $(this).attr('id'),
        //     })
        //     .done(function() {
        //        location.reload();
        //     });
        // });
        var  image_id = "";
        $('#confirm_delete').on('show.bs.modal', function(e) {
            event.preventDefault();
            var  image_id = e.relatedTarget.id;
               console.log(image_id);
            $('#delete_event_image').click(function(e){    
                $.post( "/event_image/delete", { 
                    image_id:  image_id,
                })
                .done(function() {
                   location.reload();
                });
            });
            $('#cancel_event_image').click(function(e){    
                image_id = "";
            });
        });

        
        $('.input_fields_wrap').ready(function() {
            $(document).on('click', '[data-toggle="lightbox"]', function(event) {
                event.preventDefault();
                $(this).ekkoLightbox();
            });
        });               
        
    });
</script>


@endsection

@section('side_menu')

@endsection

@section('content')

<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Events
        <small>add event page</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Examples</a></li>
        <li class="active">Blank page</li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
    <!-- Horizontal Form -->
    <div class="box box-info">
        <div class="box-header with-border">
            <h3 class="box-title">Add an Event</h3>
        </div>
        <div class="form-group">
            @if (count($errors) > 0)
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
        </div>
        <!-- /.box-header -->
        <!-- form starts here -->        
        {!! Form::open(array('url' => '/update/'.$EventsDetail->id.'/', 'id' => 'add_event_form', 'class' => 'form-horizontal', 'enctype' => 'multipart/form-data')) !!}

        {!! csrf_field() !!}
		{{ method_field('PATCH') }}

            <div class="box-body">
                <div class="col-md-6">
                    <!-- Event name -->
                    <div class="form-group">
                        <label for="name" >Event Name*</label>
                        <input type="text" class="form-control" id="name" name="name" value="{{$EventsDetail->name}}" size="35">
                    </div>
                    <!-- Start date -->
                    <div class="form-group">
                        <label for="start_date" >Start Date*</label>
                        <div class="input-group date">
                            <div class="input-group-addon">
                                <i class="fa fa-calendar"></i>
                            </div>
                            <input type="text" class="form-control" id="datepicker1" name="start_date" value="{{$EventsDetail->start_date}}" autocomplete="off">
                        </div>
                    </div>
                    <!-- End date -->
                     <div class="form-group">
                        <label for="end_date" >End Date</label>
                        <div class="input-group date">
                            <div class="input-group-addon">
                                <i class="fa fa-calendar"></i>
                            </div>
                            <input type="text" class="form-control" id="datepicker2" name="end_date" value="{{$EventsDetail->end_date}}" autocomplete="off">
                        </div>
                    </div>
                    <!-- Event time -->
                    <div class="bootstrap-timepicker">
                        <div class="form-group">
                            <label for="time" >Event Time*</label>
                            <div class="input-group">
                                <input type="text" class="form-control timepicker" name="event_Time" value="{{$EventsDetail->time}}">
                                <div class="input-group-addon">
                                  <i class="fa fa-clock-o"></i>
                                </div>
                            </div>
                        </div>
                        <!-- /.form group -->
                    </div>
                    <div class="form-group">
                        <label for="venue">Venue*</label>
                        <textarea class="form-control" rows="3" id="venue" name="venue">{{$EventsDetail->venue}}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="description">Event Description</label>
                        <textarea class="form-control" rows="3" id="description" name="description">{{$EventsDetail->description}}</textarea>
                        
                    </div>
                    <div class="form-group">
                        <label for="banner">Upload Banner*</label>
                        
                            <!-- {{Form::file('pic')}} -->
                            <input type="file" name="banner" id="banner" value="$EventsDetail->banner">
                            <!-- <input type="hidden" name="_token" value="{{ csrf_token() }}"> -->
                    </div>
                </div>
                <div class="col-md-1"></div>
                <div class="col-md-5">
                    <div class="form-group input_fields_wrap">
                        <label for="event_image">Upload Images*</label><br>
                        
                        <button class="btn btn-info add_field_button">Add More Fields</button>
                        <br><br>
                        @foreach ($EventsDetail->eventImage as $image)
                        <!-- <div class="row">    
                            <div class="col-xs-2">  -->
                                <!-- <img src="{{ URL::to($image->event_image) }}" alt="profile Pic" height="100" width="100"> -->
                                
                                <a href="{{ URL::to($image->event_image) }}" data-toggle="lightbox" data-type="image" data-gallery="event-gallery">
                                <img src="{{ URL::to($image->event_image) }}" class="img-fluid" height="100" width="100">
                                </a>
                                &nbsp;&nbsp;                                
                            <!-- </div> 
                            <div class="col-xs-2"> -->  
                                <button id="{{ $image->id }}" class="btn btn-danger delete_image" data-toggle="modal" data-target="#confirm_delete">Delete</button>
                        <!--     </div>
                        </div> -->
                        <br><br>
                        @endforeach
                        
                    </div>
                </div>



            </div>
            <!-- /.box-body -->
            <div class="box-footer">
                <button type="submit" class="btn btn-primary pull-right">Submit</button>
            </div>
            <!-- /.box-footer -->
        </form>
        <!-- /.form ends here -->
    </div>
    <!-- /.box -->


    <!-- Delete Event Modal -->
   <div class="modal fade" id="confirm_delete" role="dialog">
       <div class="modal-dialog">
           <!-- Modal content-->
           <div class="modal-content">
               <div class="modal-header">
                   <button type="button" class="close" data-dismiss="modal">&times;</button>
                   <h4 class="modal-title">Remove Parmanently</h4>
               </div>
               <div class="modal-body">
                   <p>Are you sure about this ?</p>
               </div>
               <div class="modal-footer">
                   <button type="button" class="btn btn-danger" id="delete_event_image">Delete</button>
                   <button type="button" class="btn btn-default" data-dismiss="modal" id="cancel_event_image">Cancel</button>
               </div>
           </div>
           <!-- /. Modal content ends here -->
       </div>
   </div>
   <!--  Delete Event Modal ends here -->

</section>
<!-- /.content -->

@endsection