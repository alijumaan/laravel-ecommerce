<div class="card-body">

    {!! Form::open(['route' => 'admin.categories.index', 'method' => 'get']) !!}

    <div class="row">
        <div class="col-2">
            <div class="form-group">
                {!! Form::text('keyword', old('keyword', request()->input('keyword')), ['class' => 'form-control', 'placeholder' => 'Search here']) !!}
            </div>
        </div>

        <div class="col-2">
            <div class="form-group">
                {!! Form::select('status', ['' => '---', '1' => 'Active', '0' => 'Inactive' ], old('status', request()->input('status')), ['class' => 'form-control']) !!}
            </div>
        </div>
        <div class="col-2">
            <div class="form-group">
                {!! Form::select('sort_by', ['' => '---','id' => 'ID', 'name' => 'Name', 'created_at' => 'Created at' ], old('sort_by', request()->input('sort_by')), ['class' => 'form-control']) !!}
            </div>
        </div>
        <div class="col-2">
            <div class="form-group">
                {!! Form::select('order_by', ['' => '---', 'asc' => 'Ascending', 'desc' => 'Descending' ], old('order_by', request()->input('order_by')), ['class' => 'form-control']) !!}
            </div>
        </div>
        <div class="col-1">
            <div class="form-group">
                {!! Form::select('limit_by', ['' => '---', '10' => '10', '15' => '15', '20' => '20', '25' => '25', '30' => '30' ], old('limit_by', request()->input('limit_by')), ['class' => 'form-control']) !!}
            </div>
        </div>
        <div class="col-1">
            <div class="form-group">
                {!! Form::button('Search', ['class' => 'btn btn-link', 'type' => 'submit']) !!}
            </div>
        </div>
        <div class="col-2"></div>
    </div>

    {!! Form::close() !!}

</div>
