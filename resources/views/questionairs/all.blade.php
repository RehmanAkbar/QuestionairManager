@extends('common.default')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <h2>Questionairs</h2>
                <div class="col-md-6">
                    <a class="btn btn-link" href="{{route('questionair.create')}}">Add</a>
                </div>
                <table class="table table-hover table-striped table-bordered">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Number of Questions</th>
                        <th>Duration</th>
                        <th>Resumeable</th>
                        <th>Published</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                        @if(isset($questions) && !empty($questions))
                            @foreach($questions as $question)
                                <tr>
                                    <td scope="row">{{$index++}}</td>
                                    <td>{{$question->name}}</td>
                                    <td>{{$question->questions_count}} | <a href="{{route('questionair.create')}}">Add</a></td>
                                    <td>{{$question->duration}} hr</td>
                                    <td>{{($question->resumeable == '1' ?'Yes' : 'No')}}</td>
                                    <td>{{($question->published == '1' ? 'Yes' : 'No')}}</td>
                                    <td>
                                        <a class="btn btn-link" href="{{route('questionair.edit',[$question->id])}}">Edit</a> |
                                        {{ Form::open(array('route' => ['questionair.destroy' , $question->id], 'class' => 'pull-right')) }}
                                        {{ Form::hidden('_method', 'DELETE') }}
                                        {{ Form::submit('Delete',['class' => 'btn btn-link']) }}
                                        {{ Form::close() }}
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
