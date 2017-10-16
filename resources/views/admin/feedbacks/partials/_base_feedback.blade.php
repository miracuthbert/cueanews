<div class="card mb-2">
    <div class="card-header">
        <div class="header-block">
            <p class="title">
                {{ $feedback->user->first_name }} {{ $feedback->user->last_name }}
            </p>
        </div>
    </div>
    <div class="card-block">
        <div class="no-overflow">
            {{ $feedback->body }}
            <div class="mt-1"></div>
        </div>
    </div>
    <div class="card-footer">
        <ul class="list-inline">
            <li class="list-inline-item">{{ $feedback->created_at->diffForHumans() }}</li>
            <li class="list-inline-item">
                <a class="remove" href="#" data-toggle="modal"
                   data-target="#confirm-modal-{{ $feedback->id }}">
                    <i class="fa fa-trash-o "></i> Delete
                </a>

                <form id="feedback-destroy-{{ $feedback->id }}-form"
                      action="{{ route('admin.feedbacks.destroy', [$post, $comment]) }}"
                      method="POST" style="display: none;">
                    {{ csrf_field() }}
                    {{ method_field('DELETE') }}
                </form>

                @include('layouts.admin.partials._confirm_modal', ['modal_id' => "confirm-modal-{$feedback->id}", 'title' => "Delete Confirmation", 'message' => "Are you sure you want to delete '{$feedback->body}' posted by {$feedback->user->first_name}?", 'action' => "feedback-destroy-{$feedback->id}-form"])
            </li>
        </ul>
    </div>
</div>