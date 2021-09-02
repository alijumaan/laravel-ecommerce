{!! Form::select('permissions[]', [] + $permissions->toArray() , old('permissions'), ['class' => 'form-control select-multiple-tags', 'multiple' => 'multiple']) !!}
