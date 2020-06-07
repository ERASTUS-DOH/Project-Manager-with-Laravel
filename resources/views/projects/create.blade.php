@extends('layouts.app')
@section('content')


    <!-- The justified navigation menu is meant for single line per list item.
         Multiple lines will require custom code not provided by Bootstrap. -->
    <div class="container-fluid row" style="padding-left: 50px">
        <div class="col-md-8 col-lg-8 col-sm-8 pull-left" style="background: #98cbe8">
        <h1>Create New Project</h1>

        <!-- Jumbotron -->


        <!-- Example row of columns -->
        <div class="row col-md-12 col-lg-12 col-sm-12" >
            <form method="post" action="{{ route('projects.store') }}">
                {{ csrf_field() }}

                <div class="form-group">
                    <label for="project-name">Name<span class="required">*</span></label>
                    <input placeholder="Enter Name of New Project"
                           id="project-name"
                           required
                           name="projectName"
                           spellcheck="false"
                           class="form-control">

                </div>

                <input type="hidden"
                       name="company_id"
                       value="{{ $company_id }}">

                @if($companies != null)
                    <div class="form-group">
                        <label for="company-content">Select A Company </label>
                            <select class="form-control" name="company_id">
                                @foreach($companies as $company)
                                    <option value="{{ $company->id }}"> {{ $company->name }} </option>
                                @endforeach
                            </select>
                    </div>
                @endif

                <div class="form-group">
                    <label for="project-duration">Duration<span class="required">*</span></label>
                    <input placeholder="Enter Name of New Project"
                           id="project-duration"
                           name="projectDuration"
                           class="form-control">

                </div>


                <div class="form-group">
                    <label for="project-content">Description</label>
                    <textarea placeholder="Enter Description of Project"
                              style="resize: vertical"
                              id="project-content"
                              name="description"
                              rows="5"
                              spellcheck="false"
                              class="form-control autosize-target text-left">
                        </textarea>
                </div>
                <div class="form-group">
                    <input type="submit" class="btn btn-success" value="submit">
                </div>
            </form>
        </div>
    </div>



    <div class="col-sm-3 col-lg-3 col-md-3 pull-right">
            <!--<div class="sidebar-module sidebar-module-inset">
                <h4>About</h4>
                <p>Etiam porta <em>sem malesuada magna</em> mollis euismod. Cras mattis consectetur purus sit amet fermentum. Aenean lacinia bibendum nulla sed consectetur.</p>
            </div>-->
            <div class="sidebar-module">
                <h4>Actions</h4>
                <ol class="list-unstyled">
                    <li><a href="/companies">View AllCompanies</a></li>

                </ol>
            </div>
            {{--<div class="sidebar-module">
                <h4>Archives</h4>
                <ol class="list-unstyled">
                    <li><a href="#">March 2014</a></li>
                </ol>
            </div>--}}

        </div>
    </div>



@endsection
