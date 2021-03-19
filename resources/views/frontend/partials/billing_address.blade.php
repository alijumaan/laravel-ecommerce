<div class="checkbox-form">
    <h3>{{ __('Billing Details') }}</h3>
    <div class="row">
        <div class="col-md-6">
            <div class="checkout-form-list">
                {!! Form::label('text', 'First name*') !!}
                {!! Form::text('shipping_first_name', old('shipping_first_name'), ['placeholder' => 'First name']) !!}
                @error('shipping_first_name')<span class="text-danger">{{ $message }}</span>@enderror
            </div>
        </div>
        <div class="col-md-6">
            <div class="checkout-form-list">
                {!! Form::label('text', 'Last name*') !!}
                {!! Form::text('shipping_last_name', old('shipping_last_name'), ['placeholder' => 'Last name']) !!}
                @error('shipping_last_name')<span class="text-danger">{{ $message }}</span>@enderror
            </div>
        </div>
        <div class="col-md-12">
            <div class="checkout-form-list">
                {!! Form::label('text', 'Address*') !!}
                {!! Form::text('shipping_address', old('shipping_address'), ['placeholder' => 'Address']) !!}
                @error('shipping_address')<span class="text-danger">{{ $message }}</span>@enderror
            </div>
        </div>
        <div class="col-md-6">
            <div class="checkout-form-list">
                {!! Form::label('text', 'State*') !!}
                {!! Form::text('shipping_state', old('shipping_state'), ['placeholder' => 'State']) !!}
                @error('shipping_state')<span class="text-danger">{{ $message }}</span>@enderror
            </div>
        </div>
        <div class="col-md-6">
            <div class="checkout-form-list">
                {!! Form::label('text', 'City*') !!}
                {!! Form::text('shipping_city', old('shipping_city'), ['placeholder' => 'City']) !!}
                @error('shipping_city')<span class="text-danger">{{ $message }}</span>@enderror
            </div>
        </div>
        <div class="col-md-6">
            <div class="checkout-form-list">
                {!! Form::label('email', 'Email*') !!}
                {!! Form::email('shipping_email', old('email'), ['placeholder' => 'Email']) !!}
                @error('shipping_email')<span class="text-danger">{{ $message }}</span>@enderror
            </div>
        </div>
        <div class="col-md-6">
            <div class="checkout-form-list">
                {!! Form::label('text', 'Phone*') !!}
                {!! Form::text('shipping_phone', old('shipping_phone'), ['placeholder' => 'Phone']) !!}
                @error('shipping_phone')<span class="text-danger">{{ $message }}</span>@enderror
            </div>
        </div>
        <div class="col-md-12">
            <div class="checkout-form-list create-acc">
                {!! Form::label('payment_method', 'Cash', ['class' => 'form-check-input', 'for' => 'cash_on_delivery']) !!}
                {!! Form::radio('payment_method', 'cash_on_delivery', ['class' => 'form-check-input', 'id' => 'cash_on_delivery']) !!}
            </div>
        </div>
        <div class="col-md-12">
            <div class="checkout-form-list create-acc">
                {!! Form::label('payment_method', 'mada', ['class' => 'form-check-input', 'for' => 'card']) !!}
                {!! Form::radio('payment_method', 'card', ['class' => 'form-check-input']) !!}
            </div>
        </div>

        <div class="col-md-12">
            <div class="checkout-form-list create-acc">
                <input id="cbox" type="checkbox"/>
                <label>Create an account?</label>
            </div>
            <div id="cbox_info" class="checkout-form-list create-account">
                <p>Create an account by entering the information below. If you are a returning customer please login at
                    the top of the page.</p>
                <label>Account password <span class="required">*</span></label>
                <input type="password" placeholder="password"/>
            </div>
        </div>

    </div>

</div>
