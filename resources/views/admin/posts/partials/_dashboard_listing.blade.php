@component('admin.posts.partials._base_listing', compact('post'))

    @slot('owner')

        <div class="item-col item-col-author">
            <div class="item-heading">Author</div>
            <div class="no-overflow">
                <a href="{{ route('admin.posts.index', ['author' => $post->user]) }}">{{ $post->user->first_name }} {{ $post->user->last_name }}</a>
            </div>
        </div>

    @endslot

    @slot('category')

        <div class="item-col item-col-category no-overflow">
            <div class="item-heading">Category</div>
            <div class="no-overflow">
                <a href="{{ route('admin.posts.index', ['category' => $post->category->slug]) }}">{{ $post->category->name }}</a>
            </div>
        </div>

    @endslot

@endcomponent