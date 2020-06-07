@extends('layouts.app')
@section('content')


    <!-- The justified navigation menu is meant for single line per list item.
         Multiple lines will require custom code not provided by Bootstrap. -->
{{--<div class="container">--}}
{{--    <div class="container-fluid">--}}
    <div class="col-md-9 col-lg-9 col-sm-3 pull-left container" style="padding-left: 50px" >
    <!-- Jumbotron -->
    <div class="well well-lg">
        <h1>{{ $project->name }}</h1>
        <p class="lead">{{ $project->description }}</p>
        <!-- <p><a class="btn btn-lg btn-success" href="#" role="button">Get started today</a></p> -->
    </div>

    <!-- Example row of columns -->
    <div class="row col-md-12 col-lg-12 col-sm-12" style="background-color: papayawhip; margin: 10px">
      {{--  <a href="/projects/create" class="pull-right btn btn-default btn-sm">Create a Comment</a>--}}

        <form method="post" action="{{ route('comments.store') }}">
            {{ csrf_field() }}

            <input type="hidden" name="commentable_type" value="App\Project">
            <input type="hidden" name="commentable_id" value="{{$project->id}}">


            <div class="form-group">
                <label for="comment-content">Comment</label>
                <textarea placeholder="Enter Comment"
                          style="resize: vertical"
                          id="comment-content"
                          name="comment-body"
                          rows="3"
                          spellcheck="false"
                          class="form-control autosize-target text-left">
                        </textarea>
            </div>

            <div class="form-group">
                <label for="comment-content">Proof of Work Done (Url / Photo)</label>
                <textarea placeholder="Enter a proof"
                          style="resize: vertical"
                          id="comment-content"
                          name="url"
                          rows="3"
                          spellcheck="false"
                          class="form-control autosize-target text-left">
                        </textarea>
            </div>

            <div class="form-group">
                <input type="submit" class="btn btn-success" value="submit">
            </div>
        </form>



    </div>


        @include('partials.comments')
    </div>
{{--</div>--}}
{{--</div>--}}
    <div class="col-sm-3 col-lg-3 col-md-3 pull-right">
        <!--<div class="sidebar-module sidebar-module-inset">
            <h4>About</h4>
            <p>Etiam porta <em>sem malesuada magna</em> mollis euismod. Cras mattis consectetur purus sit amet fermentum. Aenean lacinia bibendum nulla sed consectetur.</p>
        </div>-->
        <div class="sidebar-module">
            <h4>Actions</h4>
            <ol class="list-unstyled">
                <li><a href="/projects/{{ $project->id }}/edit">Edit</a></li>
                <li><a href="/projects/create">Create New Project</a></li>
                <li><a href="/projects">View Projects</a></li>


                <br/>
                {{-- Enabling only the owner of the project to be able to delete it.--}}
                @if( $project->user_id == Auth::user()->id)
                <li><a href="#"
                    onclick="
                            var result = confirm('Are you sure you would like to delete this Project');
                            if(result){
                                event.preventDefault();
                                document.getElementById('delete-form').submit();
                            }
                             "

                    >Delete</a>
                <form id="delete-form" action="{{ route('projects.destroy',[$project->id]) }}" method="POST" style="display: none;">
                    <input type="hidden" name="_method" value="delete">
                        {{ csrf_field() }}
                </form></li>
                @endif
                {{--<li><a href="#">Add New Member</a></li>--}}
            </ol>


            <hr/>
            <h4 style="padding-left: 20px;">Add Members</h4>
            <div class="col-lg-12 col-md-12 ">
                <form id="addUser" action="{{route('projects.adduser')}}" method="POST">
                    {{ csrf_field() }}
                <div class="input-group">
                    <input type="hidden" value="{{ $project->id }}" name="project_id">
                    <input type="text" class="form-control" name="email" placeholder="Email...">
                    <span class="input-group-btn">
                        <button class="btn btn-success" type="submit">Add</button>
                    </span>
                </div>
                </form>
            </div>
        </div>

        <br/>
        <hr/>

        <h4 style="padding-left: 20px;">Team-Members</h4>
        <ol class="list-unstyled" style="padding-left: 20px;font-family: Rockwell;">
            @foreach($project->users as $user)
                <li><a href="#">{{ $user->email }}</a></li>
            @endforeach


        </ol>

        {{--<div class="sidebar-module">
            <h4>Archives</h4>
            <ol class="list-unstyled">
                <li><a href="#">March 2014</a></li>
            </ol>
        </div>--}}

    </div>


    @endsection