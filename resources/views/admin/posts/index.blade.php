@component('layouts.admin.master')

    @section('title')
        Posts
    @endsection

    @slot('page_theme_name') {{ 'items-list' }} @endslot

    @section('content')

        <div class="title-search-block">
            <div class="title-block">
                <div class="row">
                    <div class="col-md-6">
                        <h3 class="title"><i class="fa fa-newspaper-o"></i> Posts
                            <a href="{{ route('admin.posts.create') }}" class="btn btn-primary btn-sm rounded-s"> Add
                                New </a>
                            <!-- -->
                            @can('admin-listings-update')
                                <div class="action dropdown">
                                    <button class="btn  btn-sm rounded-s btn-secondary dropdown-toggle" type="button"
                                            id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true"
                                            aria-expanded="false"> Index...
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenu1">
                                        <a href="" class="dropdown-item"
                                           onclick="event.preventDefault(); document.getElementById('listings-published-index-form').submit();">Published
                                            Listings</a>
                                        <form action="{{ route('posts') }}" method="post"
                                              style="display: none;"
                                              id="listings-published-index-form">
                                            {{ csrf_field() }}
                                        </form>
                                        <a href="" class="dropdown-item"
                                           onclick="event.preventDefault(); document.getElementById('listings-unpublished-index-form').submit();">Remove
                                            Unpublished Listings</a>
                                        <form action="{{ route('admin.listings.search.unpublished') }}" method="post"
                                              style="display: none;"
                                              id="listings-unpublished-index-form">
                                            {{ csrf_field() }}
                                        </form>
                                        <a href="" class="dropdown-item"
                                           onclick="event.preventDefault(); document.getElementById('listings-reset-index-form').submit();">Reset
                                            Listings Index</a>
                                        <form action="{{ route('posts') }}" method="post"
                                              style="display: none;"
                                              id="listings-reset-index-form">
                                            {{ csrf_field() }}
                                        </form>
                                    </div>
                                </div>
                            @endcan
                            <div class="action dropdown">
                                <button class="btn  btn-sm rounded-s btn-secondary dropdown-toggle" type="button"
                                        id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true"
                                        aria-expanded="false"> More actions...
                                </button>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenu1">
                                    <a class="dropdown-item" href="#"
                                       onclick="event.preventDefault(); document.getElementById('posts-form').submit();">
                                        <i class="fa fa-message icon"></i> Message
                                    </a>
                                    <a class="dropdown-item" href="#" data-toggle="modal" data-target="#confirm-modal">
                                        <i class="fa fa-close icon"></i> Delete
                                    </a>
                                </div>
                            </div>
                        </h3>
                        <p class="title-description"> List of posts with: author, category, etc... </p>
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
        <div class="card items">
            <ul class="item-list striped">
                <li class="item item-list-header hidden-sm-down">
                    <div class="item-row">
                        <div class="item-col fixed">
                            <label id="check-all-items">
                                <input type="checkbox" class="checkbox">
                            </label>
                        </div>
                        <div class="item-col item-col-header fixed item-col-img xs"></div>
                        <div class="item-col item-col-header item-col-title">
                            <div><span>Name</span></div>
                        </div>
                        <div class="item-col item-col-header item-col-author">
                            <div><span>Author</span></div>
                        </div>
                        <div class="item-col item-col-header item-col-stats">
                            <div class="no-overflow"><span>Views</span></div>
                        </div>
                        <div class="item-col item-col-header item-col-stats">
                            <div class="no-overflow"><span>Comments</span></div>
                        </div>
                        <div class="item-col item-col-header item-col-category">
                            <div class="no-overflow"><span>Category</span></div>
                        </div>
                        <div class="item-col item-col-header item-col-date">
                            <div><span>Published</span></div>
                        </div>
                        <div class="item-col item-col-header fixed item-col-actions-dropdown"></div>
                    </div>
                </li>

                @foreach($posts as $post)
                    @include('admin.posts.partials._listing')
                @endforeach

            </ul>
            <hr>
            {{ $posts->appends(['category' => $category, 'author' => $author])->links('layouts.admin.partials._pagination') }}
        </div>

    @endsection

@endcomponent