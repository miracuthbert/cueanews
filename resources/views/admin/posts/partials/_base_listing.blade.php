<li class="item">
    <div class="item-row">
        <div class="item-col fixed">
            <label>
                <input type="checkbox" name="post_ids" value="{{ $post->id }}">
            </label>
        </div>
        <div class="item-col fixed item-col-img xs">
            <a href="">
                <div class="item-img xs rounded"
                     style="background-image: url({{ !empty($post->image) ? url($post->image) : '' }})"></div>
            </a>
        </div>
        <div class="item-col item-col-title no-overflow">
            <div>
                <a href="{{ route('admin.posts.edit', [$post]) }}" class="">
                    <h4 class="item-title no-wrap"> {{ $post->title }} </h4>
                </a>
            </div>
        </div>
        {{ $owner or '' }}
        <div class="item-col item-col-stats">
            <div class="item-heading">Views</div>
            <div class="no-overflow">
                <div class="item-stats"> {{ 0 }} </div>
            </div>
        </div>
        {{ $category or '' }}
        <div class="item-col item-col-date">
            <div class="item-heading">Published</div>
            <div> {{ $post->created_at->diffForHumans() }}</div>
        </div>
    </div>
</li>