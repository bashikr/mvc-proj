@php
$request = request();

$todos = $request->session()->get('todos');
$user = Auth::user();
@endphp
@guest
@else
    <div class="d-flex" id="wrapper">
        <div class="bg-white border-left" id="sidebar-wrapper">
            <div class="sidebar-heading">My Notes </div>
            <ul class="list-group">
                @if ($todos != null)
                    @foreach ($todos as $todo)
                        @if ($todo->author_email === $user->email)
                            <li class="list-group-item"><a href="{{ URL::to('details', $todo->id) }}"
                                    style="color: cornflowerblue">{{ strlen($todo->title) >= 20 ? substr(strval($todo->title), 0, 23) . '...' : $todo->title }}</a>
                            </li>
                        @endif
                    @endforeach
                @endif
            </ul>
        </div>
    </div>
    </div>
@endguest
