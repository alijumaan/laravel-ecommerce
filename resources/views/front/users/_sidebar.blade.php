

    <div>
        <ul>
            <li class="list-group-item">
                @if(auth()->user()->user_image)
                    <img class="avatar-round" src="{{ asset('uploads/users').'/'. auth()->user()->user_image }}"/>
                @else
                    <img style="width: 150px;" src="{{ asset('uploads/default.png') }}" alt="{{ auth()->user()->name }}">
                @endif
            </li>
{{--            @if(isset($orders[0]))--}}
{{--            <li class="list-group-item"><a href="{{route('dashboard').'/'.$orders[0]->id}}">My orders</a></li>--}}
{{--            @endif--}}
            <li class="list-group-item"><a href="{{route('dashboard')}}">My account</a></li>
            <li class="list-group-item"><a href="{{route('front.users.edit') }}">Update information</a></li>
            <li class="list-group-item"><a href="{{route('users.comments')}}">My comments</a></li>
            <li class="list-group-item"><a href="{{ route('front.logout') }}" onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();">Logout</a></li>
        </ul>
    </div>


