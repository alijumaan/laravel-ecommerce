@extends('layouts.admin')

@section('content')

    <div class="row">
        <div class="col-md-12">
            <div class="card shadow-sm mb-4">
                <div class="card-header d-flex py-3">
                    <h4 class="m-0 font-weight-bold text-success">Sign Roles To Users</h4>
                </div>
                <div class="card-body">
                    <form method="post" action="{{ route('permissions.store') }}">
                        @csrf
                        <div class="card-header">
                            <div class="col-lg-6 form-group">
                                <label for="role_id">Sign role</label>
                                <select name="role_id" id="role_id" class="form-control">
                                    @foreach($roles as $role)
                                        <option value=" {{$role->id}} "> {{$role->role}} </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="card-body row">
                            @foreach( $permissions as $permission )
                                <div class="col-lg-4">
                                    <label for="permission">
                                        <input type="checkbox" class="" name="permission[]" value="{{ $permission->id }}" {{ $permission->roles()->find(1)? 'checked' : '' }}>
                                        {{ $permission->desc }}
                                    </label>
                                </div>
                            @endforeach
                        </div>
                        <div class="card-footer small text-muted">
                            <input type="submit" class="btn btn-primary" name=""  value="Save" >
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection


@section('script')

    <script>
        $('#role_id').on('change', function(event){
            let role_id = $(this).val();
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: '{{ route("permission_byRole") }}',
                type: 'post',
                data: {
                    'id': role_id
                },
                success: function(data)
                {
                    $('input[type=checkbox]').each(function () {
                        let ThisVal =parseInt(this.value) ;
                        if(data.includes(ThisVal))
                            this.checked = true;
                        else
                            this.checked = false;
                    });
                }
            })
        });
    </script>
@endsection
