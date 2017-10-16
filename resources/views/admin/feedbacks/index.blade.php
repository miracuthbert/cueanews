@component('layouts.admin.master')

    @section('title', 'Feedbacks')

@slot('page_theme_name') {{ 'items-list' }} @endslot

@section('content')

    <div class="title-search-block">
        <div class="title-block">
            <div class="row">
                <div class="col-md-6">
                    <h3 class="title"><i class="fa fa-lightbulb-o"></i> Feedbacks</h3>
                    <p class="title-description"> List of feedbacks. </p>
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

        @forelse($feedbacks as $feedback)
            @include('admin.feedbacks.partials._feedback')
        @empty
            <h4>No feedbacks found.</h4>
        @endforelse

        <hr>
        {{ $feedbacks->links('layouts.admin.partials._pagination') }}
    </div>

@endsection

@endcomponent