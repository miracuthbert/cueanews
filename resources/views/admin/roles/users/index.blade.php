@component('layouts.admin.master')

    @section('title', 'Assign Role')

@slot('page_theme_name') {{ 'items-list' }} @endslot

@section('content')
    <div class="title-search-block">
        <div class="title-block">
            <div class="row">
                <div class="col-md-6">
                    <h3 class="title"><i class="fa fa-universal-access"></i> Manage <em>{{ $role->title }}</em> Role
                        Users
                        <a href="{{ route('admin.roles.show', [$role]) }}" class="btn btn-secondary btn-sm roundes-s">Assign
                            Role to Users</a>
                    </h3>
                    <p class="title-description"> List of users with: {{ $role->title }} role.</p>
                </div>
            </div>
        </div>
        <div class="items-search">
            <form class="form-inline">
                <div class="input-group"><input type="text" class="form-control boxed rounded-s"
                                                placeholder="Search for..."> <span class="input-group-btn">
                            <button class="btn btn-secondary rounded-s" type="button">
                                <i class="fa fa-search"></i>
                            </button>
                        </span></div>
            </form>
        </div>
    </div>
    <form class="form-horizontal" role="form" method="POST" action="{{ route('admin.roles.users.destroy', [$role]) }}"
          id="manage-users-form">
        {{ method_field('DELETE') }}
        {{ csrf_field() }}

        <div class="card card-block">
            <div>Select users below to relieve them of `{{ $role->title }}` role
                <button href="button" class="btn btn-primary btn-sm rounded-s pull-right"
                        onclick="event.preventDefault(); document.getElementById('manage-users-form').submit()">
                    Remove Users
                </button>
            </div>
        </div>
        <div class="card items">
            <ul class="item-list striped">
                <li class="item item-list-header hidden-sm-down">
                    <div class="item-row">
                        <div class="item-col fixed">
                            <label id="check-all-items">
                                <input type="checkbox" class="checkbox">
                            </label>
                        </div>
                        <div class="item-col item-col-header fixed item-col-img md">
                            <div><span>Avatar</span></div>
                        </div>
                        <div class="item-col item-col-header item-col-title">
                            <div><span>Name</span></div>
                        </div>
                        <div class="item-col item-col-header item-col-date">
                            <div class="no-overflow"><span>Added</span></div>
                        </div>
                        <div class="item-col item-col-header item-col-date">
                            <div class="no-overflow"><span>Expired At</span></div>
                        </div>
                        <div class="item-col item-col-header fixed item-col-actions-dropdown"></div>
                    </div>
                </li>

                @forelse($users as $user)
                    @include('admin.roles.partials._users', $user)
                @empty
                    <div class="mt-1 text-center lead">No users with `{{ $role->title }}` role found.</div>
                @endforelse
            </ul>
            <hr>
            {{ $users->links('layouts.admin.partials._pagination') }}
        </div>
    </form>
@endsection

@endcomponent