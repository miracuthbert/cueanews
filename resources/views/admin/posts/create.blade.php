@component('layouts.admin.master')

    @section('title', 'Add New Post')

    @slot('page_theme_name') {{ 'item-editor' }} @endslot

    @section('content')
        <div class="title-block">
            <h3 class="title"><i class="fa fa-newspaper-o"></i> Add New Post</h3>
        </div>
        <form class="form-horizontal" role="form" method="POST" action="{{ route('admin.posts.store') }}">
            {{ csrf_field() }}

            <div class="card card-block">
                <div class="form-group row">
                    <label for="title" class="col-sm-2 form-control-label text-xs-right">Title</label>
                    <div class="col-sm-10">
                        <input type="text" name="title" class="form-control boxed" id="title"
                               placeholder="Enter Post Title" value="{{ old('title') }}" autofocus>
                        @if ($errors->has('title'))
                            <span class="help-block">
                                    <strong>{{ $errors->first('title') }}</strong>
                                </span>
                        @endif
                    </div>
                </div><!-- /.form-group -->
                <div class="form-group row">
                    <label for="body" class="col-sm-2 form-control-label text-xs-right">Image</label>
                    <div class="col-sm-10">
                        <div class="input-group">
                           <span class="input-group-btn">
                             <a id="lfm" data-input="thumbnail" data-preview="holder" class="btn btn-primary">
                               <i class="fa fa-picture-o"></i> Choose
                             </a>
                           </span>
                            <input id="thumbnail" class="form-control" type="text" name="image"
                                   value="{{ old('image') }}">
                        </div>
                        <img id="holder" style="margin-top:15px;max-height:100px;" src="{{ old('image') }}">
                        @if ($errors->has('image'))
                            <span class="help-block">
                                <strong>{{ $errors->first('image') }}</strong>
                            </span>
                        @endif
                    </div>
                </div><!-- /.form-group -->
                <div class="form-group row">
                    <label for="excerpt" class="col-sm-2 form-control-label text-xs-right">Excerpt</label>
                    <div class="col-sm-10">
                            <textarea name="excerpt" rows="3" class="form-control boxed" id="excerpt"
                                      placeholder="Enter Post Excerpt (summary)" maxlength="50">{{ old('excerpt') }}</textarea>
                        @if ($errors->has('excerpt'))
                            <span class="help-block">
                                <strong>{{ $errors->first('excerpt') }}</strong>
                            </span>
                        @endif
                    </div>
                </div><!-- /.form-group -->
                <div class="form-group row">
                    <label for="body" class="col-sm-2 form-control-label text-xs-right">Body</label>
                    <div class="col-sm-10">
                        <textarea name="body" rows="5" class="form-control boxed" id="body"
                                  placeholder="Enter Post Details">{{ old('body') }}</textarea>
                        @if ($errors->has('body'))
                            <span class="help-block">
                                    <strong>{{ $errors->first('body') }}</strong>
                                </span>
                        @endif
                    </div>
                </div><!-- /.form-group -->
                <div class="form-group row">
                    <label class="col-sm-2 form-control-label text-xs-right">Category</label>
                    <div class="col-sm-10">
                        <select name="category" id="" class="form-control custom-select">
                            <option value=""></option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}"
                                        {{ old('category') == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                    @if($category->ancestors->count())
                                        ({{ implode(' > ', $category->ancestors->pluck('name')->toArray()) }})
                                    @endif
                                </option>
                            @endforeach
                        </select>
                        @if ($errors->has('category'))
                            <span class="help-block">
                                    <strong>{{ $errors->first('category') }}</strong>
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
                            <span>Draft</span>
                        </label>
                        <label>
                            <input class="radio" name="status" type="radio"
                                   value="1" {{ old('status') == 1 ? 'checked' : '' }}>
                            <span>Live</span>
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

    @section('scripts')
        <script>
            $('#lfm').filemanager('image');
        </script>
    @endsection

@endcomponent