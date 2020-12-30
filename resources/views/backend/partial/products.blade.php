{!! Form::select('product_id', ['' => '---' ] + $products->toArray(), old('product_id', request()->input('product_id')), ['class' => 'form-control']) !!}
