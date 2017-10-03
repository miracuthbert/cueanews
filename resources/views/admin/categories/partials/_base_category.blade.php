<li class="item">
    <div class="item-row">
        <div class="item-col fixed">
            <label>
                <input type="checkbox" name="category_ids[]" value="{{ $category->id }}">
            </label>
        </div>
        <div class="item-col fixed pull-left item-col-title">
            <div class="item-heading">Title</div>
            <div>
                <a href="{{ route('admin.categories.edit', [$category]) }}" class="">
                    <h4 class="item-title"> {{ $category->name }}</h4>
                </a>
            </div>
        </div>
        <div class="item-col item-col-category">
            <div class="item-heading">Slug</div>
            <div><a href="{{ route('admin.posts.index', ['category' => $category]) }}">{{ $category->slug }}</a></div>
        </div>
        <div class="item-col item-col-stats no-overflow">
            <div class="item-heading">Posts</div>
            <div class="no-overflow">
                <div class="item-stats">
                    <span class="badge badge-pill badge-primary">{{ $category->posts->count() }}</span>
                </div>
            </div>
        </div>
        <div class="item-col item-col-category no-overflow">
            <div class="item-heading">Status</div>
            <div class="no-overflow">
                <a href="">{{ $category->status ? 'Active' : 'Disabled' }}</a>
            </div>
        </div>
        <div class="item-col item-col-date">
            <div class="item-heading">Added</div>
            <div class="no-overflow">{{ $category->created_at->diffForHumans() }}</div>
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
                               data-target="#confirm-modal-{{ $category->id }}">
                                <i class="fa fa-trash-o "></i>
                            </a>

                            <form id="category-destroy-{{ $category->id }}-form"
                                  action="{{ route('admin.categories.destroy', [$category]) }}"
                                  method="POST" style="display: none;">
                                {{ csrf_field() }}
                                {{ method_field('DELETE') }}
                            </form>

                            @include('layouts.admin.partials._confirm_modal', ['modal_id' => "confirm-modal-{$category->id}", 'title' => "Delete Confirmation", 'message' => "Are you sure you want to delete {$category->name}?", 'action' => "category-destroy-{$category->id}-form"])
                        </li>
                        <li>
                            <a class="edit" href="{{ route('admin.categories.edit', [$category]) }}">
                                <i class="fa fa-pencil"></i>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</li>