@extends('layouts.app')
@section('content')


    <!-- The justified navigation menu is meant for single line per list item.
         Multiple lines will require custom code not provided by Bootstrap. -->
    <div class="container-fluid row" style="padding-left: 50px">
        <div class="col-md-8 col-lg-8 col-sm-8 pull-left" style="background: #a6e1ec" >
     <h1> Create New Company</h1>
        <!-- Jumbotron -->


        <!-- Example row of columns -->
        <div class="row col-md-12 col-lg-12 col-sm-12" >
            <form method="post" action="{{ route('companies.store') }}">
                {{ csrf_field() }}

                <div class="form-group">
                    <label for="company-name">Name<span class="required">*</span></label>
                    <input placeholder="Enter Name of New Company"
                           id="company-name"
                           required
                           name="companyName"
                           spellcheck="false"
                           class="form-control">

                </div>
                <div class="form-group">
                    <label for="company-content">Description</label>
                    <textarea placeholder="Enter Description of New Company"
                              style="resize: vertical"
                              id="company-content"
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
                <li><a href="/projects">View AllProjects</a></li>

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
