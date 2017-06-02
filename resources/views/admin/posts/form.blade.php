<div class="form-group {{ $errors->has('title') ? 'has-error' : ''}}">
    {!! Form::label('title', 'Title', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::text('title', null, ['class' => 'form-control', 'required' => 'required']) !!}
        {!! $errors->first('title', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('description') ? 'has-error' : ''}}">
    {!! Form::label('description', 'Description', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::textarea('description', null, ['class' => 'form-control ckeditor', 'required' => 'required']) !!}
        {!! $errors->first('description', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('content') ? 'has-error' : ''}}">
    {!! Form::label('content', 'Content', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::textarea('content', null, ['class' => 'form-control ckeditor', 'required' => 'required']) !!}
        {!! $errors->first('content', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('slug') ? 'has-error' : ''}}">
    {!! Form::label('tag', 'Tag', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::text('tag', null, ['class' => 'form-control ']) !!}
        {!! $errors->first('tag', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('published_at') ? 'has-error' : ''}}">
    {!! Form::label('published_at', 'Published At', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::input('datetime-local', 'published_at', null, ['class' => 'form-control', 'required' => 'required']) !!}
        {!! $errors->first('published_at', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('publish') ? 'has-error' : ''}}">
    {!! Form::label('publish', 'Publish', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::number('publish', null, ['class' => 'form-control', 'required' => 'required']) !!}
        {!! $errors->first('publish', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('thumbnails') ? 'has-error' : ''}}">
    {!! Form::label('thumbnails', 'Thumbnails', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::text('thumbnails', null, ['class' => 'form-control']) !!}
        {!! $errors->first('thumbnails', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group">
    <div class="col-md-offset-4 col-md-4">
        {!! Form::submit(isset($submitButtonText) ? $submitButtonText : 'Create', ['class' => 'btn btn-primary']) !!}
    </div>
</div>

@section('footer')
<script src="/vendor/unisharp/laravel-ckeditor/ckeditor.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
 <script>

      CKEDITOR.replace( 'ckeditor' );
  </script>
<script type="text/javascript">
  $('select').select2();
</script>


@endsection
