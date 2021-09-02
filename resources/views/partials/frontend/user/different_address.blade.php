<div class="different-address">
    <div class="ship-different-title">
        <h3>
            <label>Ship to a different address?</label>
            <input id="ship-box" type="checkbox" name="billing_order"/>
        </h3>
    </div>
    <div id="ship-box-info" class="row">
        <div class="col-md-12">
            <div class="checkout-form-list">
                {!! Form::label('text', 'First name*') !!}
                {!! Form::text('billing_first_name', old('billing_first_name'), ['placeholder' => 'First name']) !!}
                @error('billing_first_name')<span class="text-danger">{{ $message }}</span>@enderror
            </div>
        </div>
        <div class="col-md-12">
            <div class="checkout-form-list">
                {!! Form::label('text', 'Last name*') !!}
                {!! Form::text('billing_last_name', old('billing_last_name'), ['placeholder' => 'Last name']) !!}
                @error('billing_last_name')<span class="text-danger">{{ $message }}</span>@enderror
            </div>
        </div>
        <div class="col-md-12">
            <div class="checkout-form-list">
                {!! Form::label('text', 'State*') !!}
                {!! Form::text('billing_state', old('billing_state'), ['placeholder' => 'State']) !!}
                @error('billing_state')<span class="text-danger">{{ $message }}</span>@enderror
            </div>
        </div>
        <div class="col-md-12">
            <div class="checkout-form-list">
                {!! Form::label('text', 'City*') !!}
                {!! Form::text('billing_city', old('billing_city'), ['placeholder' => 'City']) !!}
                @error('billing_city')<span class="text-danger">{{ $message }}</span>@enderror
            </div>
        </div>
        <div class="col-md-12">
            <div class="checkout-form-list">
                {!! Form::label('text', 'Address*') !!}
                {!! Form::text('billing_address', old('billing_address'), ['placeholder' => 'Address']) !!}
                @error('billing_address')<span class="text-danger">{{ $message }}</span>@enderror
                <input type="text" placeholder="Apartment, suite, unit etc. (optional)"/>
            </div>
        </div>
        <div class="col-md-12">
            <div class="checkout-form-list">
                {!! Form::label('text', 'Phone*') !!}
                {!! Form::text('billing_phone', old('billing_phone'), ['placeholder' => 'Phone']) !!}
                @error('billing_phone')<span class="text-danger">{{ $message }}</span>@enderror
            </div>
        </div>
    </div>
    <div class="order-notes">
        <div class="checkout-form-list mrg-nn">
            {!! Form::label('text', 'Order Notes') !!}
            {!! Form::textarea('shipping_notes', old('shipping_notes'), ['placeholder' => 'Notes about your order, e.g. special notes for delivery.', 'id' => 'checkout-mess']) !!}
            @error('shipping_notes')<span class="text-danger">{{ $message }}</span>@enderror
        </div>
    </div>
</div>
