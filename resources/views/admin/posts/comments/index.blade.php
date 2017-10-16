@component('layouts.admin.master')

@section('title')
    {{ $post->title }} Comments
@endsection

@slot('page_theme_name') {{ 'items-list' }} @endslot

@section('content')

    <div class="title-search-block">
        <div class="title-block">
            <div class="row">
                <div class="col-md-6">
                    <h3 class="title"><i class="fa fa-comments"></i> Manage Comments
                        <a href="{{ route('admin.posts.edit', [$post]) }}" class="btn btn-primary btn-sm rounded-s">
                            Go to Post </a>
                        <!-- -->
                    </h3>
                    <p class="title-description"> List of '{{ $post->title }}' comments. </p>
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
    <div class="comments">

        @foreach($comments as $comment)
            @include('admin.posts.comments.partials._comment')
        @endforeach

        <hr>
        {{ $comments->links('layouts.admin.partials._pagination') }}
    </div>

@endsection

@endcomponent