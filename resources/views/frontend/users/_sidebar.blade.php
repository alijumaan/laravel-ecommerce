

    <div>
        <ul>
            <li class="list-group-item">
                @if(auth()->user()->avatar)
                    <img class="avatar-round" src="{{ asset('storage').'/'. auth()->user()->avatar }}"/>
                @endif
            </li>
            <li class="list-group-item"><a href="{{route('userFav')}}">My favorite</a></li>
            <li class="list-group-item"><a href="{{route('dashboard')}}">My account</a></li>
            <li class="list-group-item"><a href="{{route('frontend.users.edit') }}">Update information</a></li>
            <li class="list-group-item"><a href="{{route('users.reviews')}}">My reviews</a></li>
            <li class="list-group-item"><a href="{{ route('frontend.logout') }}" onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();">Logout</a></li>
        </ul>
    </div>


