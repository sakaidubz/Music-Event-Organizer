<!-- タイムテーブル表示 -->
<div>
    <h2 class="text-xl font-semibold mb-2">タイムテーブル</h2>
    <table class="w-full border-collapse border border-gray-300">
        <thead>
            <tr>
                <th class="border border-gray-300 p-2">名前</th>
                <th class="border border-gray-300 p-2">連絡先</th>
                <th class="border border-gray-300 p-2">開始時間</th>
                <th class="border border-gray-300 p-2">終了時間</th>
                <th class="border border-gray-300 p-2">ステータス</th>
            </tr>
        </thead>
        <tbody>
            @php
                $bookedCount = 0;
            @endphp
            @foreach($performers as $performer)
                @if ($performer->status !== 'booked')
                    <tr>
                        <td class="border border-gray-300 p-2">{{ $performer->performer_name }}</td>
                        <td class="border border-gray-300 p-2">{{ $performer->contact_details }}</td>
                        <td class="border border-gray-300 p-2">{{ $performer->start_time ? $performer->start_time : '未定' }}</td>
                        <td class="border border-gray-300 p-2">{{ $performer->end_time ? $performer->end_time : '未定' }}</td>
                        <td class="border border-gray-300 p-2">{{ $performer->status }}</td>
                    </tr>
                @else
                    @php
                        $bookedCount++;
                    @endphp
                    @if ($bookedCount === 1)
                        <tr>
                    @endif
                    <td class="border border-gray-300 p-2">{{ $performer->performer_name }}</td>
                    @if ($bookedCount === 2)
                        </tr>
                    @endif
                @endif
            @endforeach
            @if ($bookedCount === 1)
                <td class="border border-gray-300 p-2">未</td></tr>
            @endif
        </tbody>
    </table>
</div>
