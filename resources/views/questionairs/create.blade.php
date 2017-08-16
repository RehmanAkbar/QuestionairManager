@extends('common.default')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-10 ">
                {{ Form::open(array('route' => 'questionair.store', 'class' => 'form-horizontal')) }}
                    <div id="step_1">
                        <h2>Create</h2>
                        <div class="form-group">
                            <label class="control-label col-sm-4" for="name">Questionair Name:</label>
                            <div class="col-sm-5">
                                <input type="text" class="form-control" name="name" id="name" placeholder="Enter Questionair name">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-4" for="duration">Duration:</label>
                            <div class="col-sm-3">
                                <input type="text" class="form-control" name="duration" id="duration" placeholder="Enter Duration">
                            </div>
                            <div class="col-sm-2">
                                <select class="form-control" name="type">
                                    <option value="m">Minutes</option>
                                    <option value="hr" >Hours</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-4" for="pwd">Can Resume:</label>
                            <div class="col-sm-5">
                                <label class="radio-inline">
                                    <input type="radio" name="resumeable" value="1">Yes
                                </label>
                                <label class="radio-inline">
                                    <input type="radio" name="resumeable" value="0">No
                                </label>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-offset-4 col-sm-10">
                                <button  type="button" class="step_1 btn btn-default">Save</button>
                            </div>
                        </div>
                    </div>
                    <div id="step_2" style="display: none">
                        <h2>Add Questions</h2>
                        <div id="xyz">
                            <div class="questions">
                                <div class="form-group">
                                    <label class="control-label col-sm-4" for="email">Question Type:</label>
                                    <div class="col-sm-5">
                                        <select  class="question_type form-control" name="" >
                                            <option value="text" > Text </option>
                                            <option value="mcso" >Multiple Choice (Single Option)</option>
                                            <option value="mcmo" >Multiple Choice (Multiple Option)</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="group">
                                    <div class="form-group">
                                        <label class="control-label col-sm-4" for="question">Question:</label>
                                        <div class="col-sm-5">
                                            <input type="text" class="form-control"  name="" placeholder="Enter Question">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-sm-4" for="pwd">Answer:</label>
                                        <div class="col-sm-5">
                                            <input type="text" class="form-control"  name="" placeholder="Enter Answer">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <p><a  id="add" style="text-decoration: underline" href="#">Add Question</a></p>
                        </div>
                        <div class="row">
                            <div class="col-xs-12">
                                <div class="text-left">
                                    <button type="submit" class="pull-left btn btn-default">Save Questions</button>
                                </div>
                            </div>
                        </div>
                    </div>
                {{ Form::close() }}
            </div>
        </div>
    </div>
@endsection

@section('scripts')

    <script type="text/javascript">

        $(function(){
            var question_number = 0;
            var choice_number = 1;
            $(document).on('change' , '.question_type',function(e){
                var $this = $(this);
                var type = $(this).val();
                switch(type){
                    case 'text':
                        var html =
                            '<div class="form-group">'+
                                '<label class="control-label col-sm-4" for="question">Question:</label>'+
                                '<div class="col-sm-5">'+
                                    '<input type="text" class="form-control"  name="mani['+question_number+'][name]" placeholder="Enter Question">'+
                                    '<input type="hidden" class="form-control"  name="mani['+question_number+'][type]" value="text" >'+
                            '</div>'+
                            '</div>'+
                            '<div class="form-group">'+
                                '<label class="control-label col-sm-4" for="pwd">Answer:</label>'+
                                '<div class="col-sm-5">'+
                                    '<input type="text" class="form-control" name="" placeholder="Enter Answer">'+
                                '</div>'+
                            '</div>';
                        $this.closest('.form-group').next('.group').empty().append(html);
                        break;
                    case 'mcso':
                        var html =
                            '<div class="form-group">'+
                                '<label class="control-label col-sm-4" for="question">Question</label>'+
                                '<div class="col-sm-5">'+
                                    '<input type="text" class="form-control"  name="mani['+question_number+'][name]" placeholder="Enter Question">'+
                                    '<input type="hidden" class="form-control"  name="mani['+question_number+'][type]" value="mcso" >'+
                            '</div>'+
                            '</div>';
                            for(var i=1; i <= 3; i++){
                               html += '<div class="form-group ">'+
                                    '<label class="control-label col-sm-4" for="choice">Choice '+ i +'</label>'+
                                        '<div class="col-sm-5">'+
                                            '<input type="text" class="form-control"  name="mani['+question_number+'][answer]['+ i +'][answer]" placeholder="Enter Choice">'+
                                        '</div>'+
                                    '<label class="col-sm-1 radio-inline"><input type="radio" value="1" name="mani['+question_number+'][answer]['+ i +'][correct]" >Correct?</label>'+
                                    '<a style="margin-top:6px;text-decoration: underline" class="col-sm-2 delete_choice" href="#">Delete Choice</a>'+
                                    '</div>';
                            }
                        html +=  '<a style="text-decoration: underline" data-type="mcso" class="col-lg-offset-4 add_choice" href="#">Add Choice</a>';
                        $this.closest('.form-group').next('.group').empty().append(html);
                    break;
                    case 'mcmo':
                        var html =
                            '<div class="form-group">'+
                                '<label class="control-label col-sm-4" for="question">Question</label>'+
                                '<div class="col-sm-5">'+
                                    '<input type="text" class="form-control" id="question" name="mani['+question_number+'][name]" placeholder="Enter Question">'+
                                    '<input type="hidden" class="form-control"  name="mani['+question_number+'][type]" value="mcmo" >'+
                            '</div>'+
                            '</div>';
                            for(var i = 1; i <= 3; i++){
                                html += '<div class="form-group">'+
                                        '<label class="control-label col-sm-4" for="choice">Choice '+ i +'</label>'+
                                            '<div class="col-sm-5">'+
                                                '<input type="text" class="form-control"  name="mani['+question_number+'][answer]['+ i +'][answer]" placeholder="Enter Choice">'+
                                        '</div>'+
                                        '<label class="col-sm-1 checkbox-inline"><input type="checkbox" name="mani['+question_number+'][answer]['+ i +'][correct]" value="">Correct?</label>'+
                                        '<a style="margin-top:6px;text-decoration: underline" class="col-sm-2 delete_choice" href="#">Delete Choice</a>'+
                                    '</div>';
                            }
                        html +=  '<a style="text-decoration: underline" data-type="mcmo" class="col-lg-offset-4 add_choice" href="#">Add Choice</a>';
                        $this.closest('.form-group').next('.group').empty().append(html);
                    break;
                }

            });

            $("#add").click(function(){
                question_number++;
                $("#xyz").append(
                    '<div class="form-group">'+
                        '<label class="control-label col-sm-4" for="email">Question Type:</label>'+
                        '<div class="col-sm-5">'+
                            '<select  class="question_type form-control" name="question_type[]" >'+
                                '<option value="text" > Text </option>'+
                                '<option value="mcso" >Multiple Choice (Single Option)</option>'+
                                '<option value="mcmo" >Multiple Choice (Multiple Option)</option>'+
                            '</select>'+
                        '</div>'+
                    '</div>'+
                    '<div class="group">'+
                    '</div>'+
                '<hr>'
                );
                $('.question_type').trigger('change');
            });

            $(document).on('click' , '.add_choice' , function(e){

                choice_number = $(this).prev('.form-group').siblings('.form-group').length + 1;
                if($(this).data('type') == 'mcso'){
                    var html = '<div class="form-group ">'+
                            '<label class="control-label col-sm-4" for="choice">Choice '+ choice_number +'</label>'+
                            '<div class="col-sm-5">'+
                            '<input type="text" class="form-control"  name="mani['+question_number+'][answer]['+ choice_number +'][answer]" placeholder="Enter Choice">'+
                            '</div>'+
                            '<label class="col-sm-1 radio-inline"><input type="radio" value="1" name="mani['+question_number+'][answer]['+ choice_number +'][correct]" >Correct?</label>'+
                            '<a style="margin-top:6px;text-decoration: underline" class="col-sm-2 delete_choice" href="#">Delete Choice</a>'+
                            '</div>';
                }else if($(this).data('type') == 'mcmo'){

                    var  html = '<div class="form-group">'+
                            '<label class="control-label col-sm-4" for="choice">Choice '+ choice_number +'</label>'+
                            '<div class="col-sm-5">'+
                            '<input type="text" class="form-control"  name="mani['+question_number+'][answer]['+ choice_number +'][answer]" placeholder="Enter Choice">'+
                            '</div>'+
                            '<label class="col-sm-1 checkbox-inline"><input type="checkbox" name="mani['+question_number+'][answer]['+ choice_number +'][correct]" value="">Correct?</label>'+
                            '<a style="margin-top:6px;text-decoration: underline" class="col-sm-2 delete_choice" href="#">Delete Choice</a>'+
                            '</div>';

                }


                $(this).prev('.form-group').after(html);

            });

            $('.step_1').click(function(e){

                $("#step_1").hide();

                $("#step_2").show();

            });


            $(document).on('click' , '.delete_choice' ,function(){

                $(this).parents('.form-group').remove();

            })

            $("#questionair_form").on('submit' , function(e){

                $this = $(this);
                e.preventDefault();

                var data = $("#questionair_form").serialize();
                $.ajax({
                    type   : "POST",
                    url    : "{{route('questionair.store')}}",
                    data   : data,
                    success: function(response){

                    },
                    error:function(msg){
                        //alert(msg);
                    }
                });

            });
        })


        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    </script>

@endsection