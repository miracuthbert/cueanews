@component('layouts.admin.master')

    @section('title', 'Add Category')

    @slot('page_theme_name') {{ 'item-editor' }} @endslot

    @section('content')
        <div class="title-block">
            <h3 class="title"><i class="fa fa-sort"></i> Add Category <span class="sparkline bar"
                                                                                data-type="bar"></span></h3>
        </div>
        <form class="form-horizontal" role="form" method="POST" action="{{ route('admin.categories.store') }}">
            {{ csrf_field() }}

            <div class="card card-block">
                <div class="form-group row">
                    <label for="name" class="col-sm-2 form-control-label text-xs-right">Name</label>
                    <div class="col-sm-10">
                        <input type="text" name="name" class="form-control boxed" id="name"
                               placeholder="Enter Category Name" value="{{ old('name') }}" autofocus>
                        @if ($errors->has('name'))
                            <span class="help-block">
                                <strong>{{ $errors->first('name') }}</strong>
                            </span>
                        @endif
                    </div>
                </div><!-- /.form-group -->
                <div class="form-group row">
                    <label for="details" class="col-sm-2 form-control-label text-xs-right">Details</label>
                    <div class="col-sm-10">
                                    <textarea name="details" rows="5" class="form-control boxed" id="details"
                                              placeholder="Enter Category Details">{{ old('details') }}</textarea>
                        @if ($errors->has('details'))
                            <span class="help-block">
                                <strong>{{ $errors->first('details') }}</strong>
                            </span>
                        @endif
                    </div>
                </div><!-- /.form-group -->
                <div class="form-group row">
                    <label class="col-sm-2 form-control-label text-xs-right">Parent category</label>
                    <div class="col-sm-10">
                        <select name="parent" id="" class="form-control custom-select">
                            <option value=""></option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}"
                                        {{ old('parent', $category->parent_id) == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                    @if($category->ancestors->count())
                                        ({{ implode(' > ', $category->ancestors->pluck('name')->toArray()) }})
                                    @endif
                                </option>
                            @endforeach
                        </select>
                        @if ($errors->has('parent'))
                            <span class="help-block">
                                <strong>{{ $errors->first('parent') }}</strong>
                            </span>
                        @endif
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
                        @if ($errors->has('status'))
                            <span class="help-block">
                                <strong>{{ $errors->first('status') }}</strong>
                            </span>
                        @endif
                    </div>
                </div><!-- /.form-group -->
                <div class="form-group row">
                    <div class="col-sm-10 offset-sm-2">
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </div><!-- /.form-group -->
            </div><!-- /.card -->
        </form>
    @endsection

@endcomponent