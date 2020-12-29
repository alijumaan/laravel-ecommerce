@extends('backend.layouts.app')
@section('content')

    <div class="row">
        <div class="col-3">
            <div class="card">
                <div class="card-header">Settings</div>
                <ul class="list-group list-group-flush">
                    @foreach($setting_sections as $setting_section)
                        <li class="list-group-item">
                            <a href="{{ route('admin.settings.index', ['section' => $setting_section]) }}" class="nav-link">
                                <i class="fa fa-gear"></i>
                                {{ $setting_section }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
        <div class="col-9">
            <div class="card">
                <div class="card-header">Settings {{ $section }}</div>
                <div class="card-body">
                    {!! Form::model($settings, ['route' => ['admin.settings.update', 1], 'method' => 'patch']) !!}
                    @foreach($settings as $setting)
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label for="title">{{ $setting->display_name }}</label>
                                @if($setting->type == 'text')
                                    <input type="text" name="value[{{ $loop->index }}]" id="value" class="form-control" value="{{ $setting->value }}">
                                @elseif($setting->type == 'textarea')
                                    <textarea name="value[{{ $loop->index }}]" id="value" class="form-control" cols="30" rows="10">{{ $setting->value }}</textarea>
                                @elseif($setting->type == 'image')
                                    <input type="file" name="value[{{ $loop->index }}]" id="value" class="form-control">
                                @elseif($setting->type == 'select')
                                    {!! Form::select('value[' . $loop->index . ']', explode('|', $setting->details), $setting->value, ['id' => 'value', 'class' => 'form-control']) !!}
                                @elseif($setting->type == 'checkbox')
                                    {!! Form::checkbox('value[' . $loop->index . ']', 1, $setting->value == 1 ? true : false ,['id' => 'value', 'class' => 'styled']) !!}
                                @elseif($setting->type == 'radio')
                                    {!! Form::radio('value[' . $loop->index . ']', 1, $setting->value == 1 ? true : false ,['id' => 'value', 'class' => 'styled']) !!}
                                @endif

                                <input type="hidden" name="key[{{ $loop->index }}]" id="key" class="form-control" value="{{ $setting->key }}" readonly>
                                <input type="hidden" name="id[{{ $loop->index }}]" id="key" class="form-control" value="{{ $setting->id }}" readonly>
                                <input type="hidden" name="ordering[{{ $loop->index }}]" id="key" class="form-control" value="{{ $setting->ordering }}" readonly>

                                @error('value')<span class="text-danger">{{ $message }}</span>@enderror
                            </div>
                        </div>
                    </div>
                    @endforeach

                    <div class="text-right">
                        {!! Form::button('submit', ['type' => 'submit', 'class' => 'btn btn-primary']) !!}
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>

@endsection
