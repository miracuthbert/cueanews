@component('layouts.admin.master')

    @section('title')
        {{ $user->first_name }} {{ $user->last_name }}
    @endsection

    @slot('page_theme_name') {{ 'item-editor' }} @endslot

    @section('content')
        <div class="title-block">
            <h3 class="title"><i class="fa fa-edit"></i> Edit User <span class="sparkline bar" data-type="bar"></span> </h3>
        </div>
        <form class="form-horizontal" role="form" method="POST"
              action="{{ route('admin.users.update', [$user]) }}">
            {{ method_field('put') }}
            {{ csrf_field() }}

            <div class="card">
                <div class="card-header">
                    <div class="header-block">
                        <div class="title">User details</div>
                    </div>
                </div>
                <div class="card-block">

                    <div class="form-group row{{ $errors->has('first_name') ? ' has-error' : '' }}">
                        <label for="first_name" class="col-md-4 form-control-label">First name</label>

                        <div class="col-md-6">
                            <p class="form-static-control">{{ $user->first_name }}</p>
                        </div>
                    </div>

                    <div class="form-group row{{ $errors->has('last_name') ? ' has-error' : '' }}">
                        <label for="last_name" class="col-md-4 form-control-label">Last name</label>

                        <div class="col-md-6">
                            <p class="form-static-control">{{ $user->last_name }}</p>
                        </div>
                    </div>

                    <div class="form-group row{{ $errors->has('username') ? ' has-error' : '' }}">
                        <label for="username" class="col-md-4 form-control-label">Username</label>

                        <div class="col-md-6">
                            <p class="form-static-control">{{ $user->username }}</p>
                        </div>
                    </div>

                    <div class="form-group row{{ $errors->has('email') ? ' has-error' : '' }}">
                        <label for="email" class="col-md-4 form-control-label">E-Mail Address</label>

                        <div class="col-md-6">
                            <p class="form-static-control" id="email">{{ $user->email }} <a href="">Send message</a></p>
                        </div>
                    </div>

                    <div class="form-group row{{ $errors->has('country') ? ' has-error' : '' }}">
                        <label for="country" class="col-md-4 form-control-label">Country</label>

                        <div class="col-md-6">
                            <p class="form-static-control" id="country">{{ $user->country }}</p>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="listings" class="col-md-4 form-control-label">Posts</label>

                        <div class="col-md-6">
                            <p class="form-static-control" id="listings">{{ $user->posts->count() }}</p>
                        </div>
                    </div>

                </div>
            </div>
        </form>
    @endsection

@endcomponent