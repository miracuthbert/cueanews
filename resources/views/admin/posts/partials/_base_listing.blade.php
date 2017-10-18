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
            <div class="item-heading">Rating</div>
            <div class="no-overflow">
                <div class="item-stats"> {{ $post->averageRating() }} by {{ $post->ratings->count() }} readers </div>
            </div>
        </div>
        <div class="item-col item-col-stats">
            <div class="item-heading">Views</div>
            <div class="no-overflow">
                <div class="item-stats"> {{ $post->views() }} </div>
            </div>
        </div>
        <div class="item-col item-col-stats">
            <div class="item-heading">Comments</div>
            <div class="no-overflow">
                <div class="item-stats"> {{ $post->comments->count() }} </div>
            </div>
        </div>
        {{ $category or '' }}
        <div class="item-col item-col-date">
            <div class="item-heading">Published</div>
            <div> {{ $post->created_at->diffForHumans() }}</div>
        </div>
        <div class="item-col fixed item-col-actions-dropdown">
            <div class="item-actions-dropdown">
                <a class="item-actions-toggle-btn">
                    <span class="inactive">
                        <i class="fa fa-cog"></i>
                    </span>
                    <span class="active">
                        <i class="fa fa-chevron-circle-right"></i>
                    </span>
                </a>
                <div class="item-actions-block">
                    <ul class="item-actions-list">
                        <li>
                            <a class="remove" href="#" data-toggle="modal"
                               data-target="#confirm-modal-{{ $post->id }}">
                                <i class="fa fa-trash-o "></i>
                            </a>

                            <form id="posts-destroy-{{ $post->id }}-form"
                                  action="{{ route('admin.posts.destroy', [$post]) }}"
                                  method="POST" style="display: none;">
                                {{ csrf_field() }}
                                {{ method_field('DELETE') }}
                            </form>

                            @include('layouts.admin.partials._confirm_modal', ['modal_id' => "confirm-modal-{$post->id}", 'title' => "Delete Confirmation", 'message' => "Are you sure you want to delete {$post->title}?", 'action' => "posts-destroy-{$post->id}-form"])
                        </li>
                        <li>
                            <a class="edit" href="{{ route('admin.posts.edit', [$post]) }}">
                                <i class="fa fa-pencil"></i>
                            </a>
                        </li>
                        <li>
                            <a class="edit" href="{{ route('admin.comments.index', [$post]) }}">
                                <i class="fa fa-comments"></i>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</li>