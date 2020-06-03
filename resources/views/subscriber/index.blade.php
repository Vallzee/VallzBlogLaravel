hello im subscriber you are not activated
<div class=""{{--"dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown"--}}>
    <a class="btn btn-primary" href="{{ route('logout') }}"
       onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();">
        {{ __('Logout') }}
    </a>

    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        @csrf
    </form>
</div>