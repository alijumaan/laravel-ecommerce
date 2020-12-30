{!! Form::select('tag_id', ['' => '---' ] + $tags->toArray(), old('tag_id', request()->input('tag_id')), ['class' => 'form-control']) !!}
