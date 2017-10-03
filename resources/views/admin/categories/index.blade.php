@component('layouts.admin.master')

    @section('title', 'Categories')

    @slot('page_theme_name') {{ 'items-list' }} @endslot

    @section('content')
        <div class="title-search-block">
            <div class="title-block">
                <div class="row">
                    <div class="col-md-6">
                        <h3 class="title"><i class="fa fa-sort"></i> Categories
                            <a href="{{ route('admin.categories.create') }}" class="btn btn-primary btn-sm rounded-s">
                                Add New </a>
                        </h3>
                        <p class="title-description"> List of categories. </p>
                    </div>
                </div>
            </div>
            <div class="items-search">
                <form class="form-inline">
                    <div class="input-group">
                        <input type="text" class="form-control boxed rounded-s" placeholder="Search for...">
                        <span class="input-group-btn">
                            <button class="btn btn-secondary rounded-s" type="button">
                                    <i class="fa fa-search"></i>
                                </button>
                        </span>
                    </div>
                </form>
            </div>
        </div>
        <div class="card items">
            <ul class="item-list striped">
                <li class="item item-list-header hidden-sm-down">
                    <div class="item-row">
                        <div class="item-col fixed">
                            <label id="check-all-items">
                                <input type="checkbox" class="checkbox">
                                <span></span>
                            </label>
                        </div>
                        <div class="item-col item-col-header item-col-title">
                            <div><span>Name</span></div>
                        </div>
                        <div class="item-col item-col-header item-col-category">
                            <div><span>Slug</span></div>
                        </div>
                        <div class="item-col item-col-header item-col-stats">
                            <div class="no-overflow"><span>Posts</span></div>
                        </div>
                        <div class="item-col item-col-header item-col-category">
                            <div class="no-overflow"><span>Status</span></div>
                        </div>
                        <div class="item-col item-col-header item-col-date">
                            <div class="no-overflow"><span>Added</span></div>
                        </div>
                        <div class="item-col item-col-header fixed item-col-actions-dropdown"></div>
                    </div>
                </li>

                @forelse($categories as $category)
                    @include('admin.categories.partials._category')
                @empty
                    <div class="mt-1 text-center lead">No categories found.</div>
                @endforelse
            </ul>
        </div>
    @endsection

@endcomponent