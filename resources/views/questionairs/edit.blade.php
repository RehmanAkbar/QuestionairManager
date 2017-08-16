@extends('common.default')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-10 ">
                {{ Form::model($questionair, array('route' => array('questionair.update', $questionair->id ),'class' => 'form-horizontal' , 'method' => 'PUT')) }}
                    <div class="form-group">
                        {{ Form::label('name', 'Questionair Name' ,array('class' => 'control-label col-sm-4')) }}
                        <div class="col-sm-5">
                            {{ Form::text('name', null, array('class' => 'form-control')) }}
                        </div>
                    </div>
                    <div class="form-group">
                        {{ Form::label('name', 'Duration:' ,array('class' => 'control-label col-sm-4')) }}
                        <div class="col-sm-3">
                            {{ Form::text('duration', null, array('class' => 'form-control')) }}
                        </div>
                        <div class="col-sm-2">
                            {{ Form::select('type', ['m' => 'Minute', 'hr' => 'Houre'] , null, ['class' => 'form-control'])  }}
                        </div>
                    </div>
                    <div class="form-group">
                        {{ Form::label('name', 'Can Resume:' ,array('class' => 'control-label col-sm-4')) }}
                        <div class="col-sm-5">
                            <label class="radio-inline">
                                {{ Form::radio('resumeable', '1') }}Yes
                            </label>
                            <label class="radio-inline">
                                {{ Form::radio('resumeable', '0') }}No
                            </label>
                        </div>
                    </div>
                <div class="form-group">
                    <div class="col-sm-offset-4 col-sm-10">
                        {{ Form::submit('Save', array('class' => 'btn btn-default')) }}
                    </div>
                </div>
                {{ Form::close() }}
            </div>
        </div>
    </div>
@endsection

@section('scripts')

    <script type="text/javascript">



        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    </script>

@endsection