<div>
    @if (count($comments))
        <div class="bg-white shadow rounded-lg p-6 mb-8" style="margin-bottom: 5%;">
            <ul>
                @foreach ($comments as $comment)
                    <li>
                        {{ $comment }}
                    </li>
                @endforeach
            </ul>
        </div>
    @endif
</div>
