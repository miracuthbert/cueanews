<div class="card mb-2">
    <div class="card-header">
        <div class="header-block">
            <p class="title">
                {{ $comment->user->first_name }} {{ $comment->user->last_name }}
            </p>
        </div>
    </div>
    <div class="card-block">
        <div class="no-overflow">
            {{ $comment->body }}
            <div class="mt-1"></div>
        </div>
    </div>
    <div class="card-footer">
        <ul class="list-inline">
            <li class="list-inline-item">{{ $comment->created_at->diffForHumans() }}</li>
            <li class="list-inline-item">
                <a class="remove" href="#" data-toggle="modal"
                   data-target="#confirm-modal-{{ $comment->id }}">
                    <i class="fa fa-trash-o "></i> Delete
                </a>

                <form id="comments-destroy-{{ $comment->id }}-form"
                      action="{{ route('admin.comments.destroy', [$post, $comment]) }}"
                      method="POST" style="display: none;">
                    {{ csrf_field() }}
                    {{ method_field('DELETE') }}
                </form>

                @include('layouts.admin.partials._confirm_modal', ['modal_id' => "confirm-modal-{$comment->id}", 'title' => "Delete Confirmation", 'message' => "Are you sure you want to delete '{$comment->body}' comment by {$comment->user->first_name}?", 'action' => "comments-destroy-{$comment->id}-form"])
            </li>
        </ul>
    </div>
</div>