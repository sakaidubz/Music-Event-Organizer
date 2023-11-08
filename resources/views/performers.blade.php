<!-- 出演者登録フォーム -->
<div class="mb-4">
    <h2 class="text-xl font-semibold mb-2">出演者登録</h2>
    <form action="{{ route('performers.store', ['event_id' => $event->id]) }}" method="POST">
        @csrf
        <input type="hidden" name="event_id" value="{{ $event->id }}">
        <div class="mb-2">
            <label for="performer_name">名前</label>
            <input type="text" id="performer_name" name="performer_name" class="border rounded-md p-2" required>
        </div>
        <div class="mb-2">
            <label for="contact_details">連絡先</label>
            <input type="text" id="contact_details" name="contact_details" class="border rounded-md p-2" required>
        </div>
        <div class="mb-2">
            <label for="status">ステータス</label>
            <select id="status" name="status" class="border rounded-md p-2" required>
                <option value="picked">候補</option>
                <option value="booking">ブッキング中</option>
                <option value="booked">出演確定</option>
            </select>
        </div>
        <div class="mb-2">
            <label for="start_time">開始時間</label>
            <input type="time" id="start_time" name="start_time" class="border rounded-md p-2">
        </div>
        <div class="mb-2">
            <label for="end_time">終了時間</label>
            <input type="time" id="end_time" name="end_time" class="border rounded-md p-2">
        </div>
        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-md">登録</button>
    </form>
</div>
