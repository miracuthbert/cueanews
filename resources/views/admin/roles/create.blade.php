@component('layouts.admin.master')

    @section('title', 'Add Role')

    @slot('page_theme_name') {{ 'item-editor' }} @endslot

    @section('content')
        <div class="title-block">
            <h3 class="title"><i class="fa fa-universal-access"></i> Add Role <span class="sparkline bar"
                                                                                    data-type="bar"></span></h3>
        </div>
        <form class="form-horizontal" role="form" method="POST" action="{{ route('admin.roles.store') }}">
            {{ csrf_field() }}

            <div class="card card-block">
                <div class="form-group row">
                    <label for="title" class="col-sm-2 form-control-label text-xs-right">Title</label>
                    <div class="col-sm-10">
                        <input type="text" name="title" class="form-control boxed" id="title"
                               placeholder="Enter Role Title" value="{{ old('title') }}">
                    </div>
                </div><!-- /.form-group -->
                <div class="form-group row">
                    <label for="details" class="col-sm-2 form-control-label text-xs-right">Details</label>
                    <div class="col-sm-10">
                                <textarea name="details" rows="5" class="form-control boxed" id="details"
                                          placeholder="Enter Role Details">{{ old('details') }}</textarea>
                    </div>
                </div><!-- /.form-group -->
                <div class="form-group row">
                    <label class="col-sm-2 form-control-label text-xs-right">Status</label>
                    <div class="col-sm-10">
                        <label>
                            <input class="radio" name="status" type="radio"
                                   value="0" {{ old('status') == 0 ? 'checked' : '' }}>
                            <span>Disabled</span>
                        </label>
                        <label>
                            <input class="radio" name="status" type="radio"
                                   value="1" {{ old('status') == 1 ? 'checked' : '' }}>
                            <span>Active</span>
                        </label>
                    </div>
                </div><!-- /.form-group -->
                <div class="form-group row">
                    <div class="col-sm-10 offset-sm-2">
                        <button type="submit" class="btn btn-primary">Save</button>
                        <button type="submit" name="assignRole" class="btn btn-outline-primary pull-right" value="true">
                            Assign Role
                        </button>
                    </div>
                </div><!-- /.form-group -->
            </div><!-- /.card -->
        </form>
    @endsection

@endcomponent