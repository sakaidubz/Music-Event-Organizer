<section class="space-y-6">
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('あなたのイベント') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __('あなたは以下のイベント企画に参加しています。') }}
        </p>
    </header>

    <ul>
        @foreach(auth()->user()->events as $event)
        <li>
            {{ $event->name }}
            <form actions="{{ route('events.leave', $event->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit">退出する</button>
            </form>
        </li>
        @endforeach
    </ul>
</section>
