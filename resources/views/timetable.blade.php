<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Performers') }}
        </h2>
    </x-slot>
    
    
    <!-- タイムテーブル表示 -->
    <div>
        <h2 class="text-xl font-semibold mb-2">出演者一覧</h2>
        <!--暫定版出演者一覧テーブル-->
        <table class='table w-full border-collapse border border-gray-300'>
            <thead>
                <tr>
                    <th class="border border-gray-300 p-2" class="border border-gray-300 p-2">ID</th>
                    <th class="border border-gray-300 p-2">出演者名</th>
                    <th class="border border-gray-300 p-2">連絡先</th>
                    <th class="border border-gray-300 p-2">ステータス</th>
                    <th class="border border-gray-300 p-2">開始時間</th>
                    <th class="border border-gray-300 p-2">終了時間</th>
                </tr>
            </thead>
            <tbody>
                @foreach($performers as $performer)
                    <tr>
                        <td class="border border-gray-300 p-2">{{ $performer->id }}</td>
                        <td class="border border-gray-300 p-2">{{ $performer->performer_name }}</td>
                        <td class="border border-gray-300 p-2">{{ $performer->contact_details }}</td>
                        <td class="border border-gray-300 p-2">{{ $performer->status }}</td>
                        <td class="border border-gray-300 p-2">{{ $performer->start_time ?: '未定' }}</td>
                        <td class="border border-gray-300 p-2">{{ $performer->end_time ?: '未定' }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        
        <!--
        以下テーブルは将来的に実装する。タイムテーブル機能の設計を完璧に
        検討しなおしてから実装に再着手する。
        -->
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


    <x-slot name="footer">
        <x-footer />
    </x-slot>
</x-app-layout>

