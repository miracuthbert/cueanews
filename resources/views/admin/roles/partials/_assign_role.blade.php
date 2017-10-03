<li class="item">
    <div class="item-row">
        <div class="item-col fixed">
            <label>
                <input type="checkbox" name="users_ids[]" value="{{ $user->id }}">
            </label>
        </div>
        <div class="item-col fixed item-col-img md">
            <a href="{{ route('admin.users.edit', [$user]) }}">
                <div class="item-img rounded"
                     style="background-image: url(https://s3.amazonaws.com/uifaces/faces/twitter/_everaldo/128.jpg)"></div>
            </a>
        </div>
        <div class="item-col fixed pull-left item-col-title">
            <div class="item-heading">Name</div>
            <div>
                <a href="{{ route('admin.users.edit', [$user]) }}" class="">
                    <h4 class="item-title"> {{ $user->first_name }} {{ $user->last_name }}</h4>
                </a>
            </div>
        </div>
        <div class="item-col item-col-date">
            <div class="item-heading">Joined</div>
            <div class="no-overflow">{{ $user->created_at->diffForHumans() }}</div>
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
                            <a class="edit" href="{{ route('admin.users.edit', [$user]) }}">
                                <i class="fa fa-pencil"></i>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</li>