{!! Form::select('category_id', ['' => '---' ] + $categories->toArray(), old('category_id', request()->input('category_id')), ['class' => 'form-control']) !!}

