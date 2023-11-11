<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Calendar') }}
        </h2>
    </x-slot>

    <!--カレンダーの表示-->
    <div class="w-4/5 mx-auto max-w-7xl">
        <div id="calendar"></div>
    </div>
    
    <!--カレンダー新規追加モーダル-->
    <div id="modal-add" class="modal" @if($errors->any()) style="display: flex;" @endif>
        <div class="modal-contents">
            <form method="POST" action="{{ route('calendar.create') }}">
                @csrf
                <input id="new-id" type="hidden" name="id" value="" />
                <input type="hidden" name="event_id" value="" id="selected-event-id" />
                
                <label for="event">イベント</label>
                <select id="new-event"></select>
                
                <label for="title">タイトル</label>
                <input id="new-title" class="input-title" type="text" name="title" value="" />
                @error('title')
                    <span class="text-red-500">{{ $message }}</span>
                @enderror
                
                <label for="start_date">開始日</label>
                <input id="new-start_date" class="input-start_date" type="date" name="start_date" value="" />
                @error('start_date')
                    <span class="text-red-500">{{ $message }}</span>
                @enderror
                
                <label for="end_date">終了日</label>
                <input id="new-end_date" class="input-end_date" type="date" name="end_date" value="" />
                @error('end_date')
                    <span class="text-red-500">{{ $message }}</span>
                @enderror
                
                <label for="description" style="display: block">内容</label>
                <textarea id="new-description" name="description" rows="3"></textarea>
                @error('description')
                    <span class="text-red-500">{{ $message }}</span>
                @enderror
                
                <button type="button" onclick="closeAddModal()">閉じる</button>
                <button type="submit">保存</button>
            </form>
        </div>
    </div>
    
    <!--カレンダー編集モーダル-->
    <div id="modal-update" class="modal" @if($errors->any()) style="display: flex;" @endif>
        <div class="modal-contents">
            <form method="POST" action="{{ route('plan.update') }}" >
                @csrf
                @method('PUT')
                <input type='hidden' id='id' name='id' value="{{ old("id") }}" />
                
                <label for="title">タイトル</label>
                <input id="title" class="input-title" type="text" name="title" value="{{ old("title") }}" />
                @error('title')
                    <span class="text-red-500">{{ $message }}</span>
                @enderror
                
                <label for="start_date">開始日</label>
                <input id="start_date" class="input-start_date" type="date" name="start_date" value="{{ old("start_date") }}" />
                @error('start_date')
                    <span class="text-red-500">{{ $message }}</span>
                @enderror
                
                <label for="end_date">終了日</label>
                <input id="end_date" class="input-end_date" type="date" name="end_date" value="{{ old("end_date") }}" />
                @error('end_date')
                    <span class="text-red-500">{{ $message }}</span>
                @enderror
                
                <label for="description" style="display: block">内容</label>
                <textarea id="description" name="description" rows="3">{{ old("description") }}</textarea>
                @error('description')
                    <span class="text-red-500">{{ $message }}</span>
                @enderror
                
                <button type="button" onclick="closeUpdateModal()">閉じる</button>
                <button type="submit">保存</button>
            </form>
            
            <form id="delete-form" method="post" action="{{ route('plan.destroy') }}">
                @csrf
                @method('DELETE')
                <input type="hidden" id="delete-id" name="id" value="" />
                <button class="delete" type="button" onclick="deletePlan()">削除</button>
            </form>
            

        </div>
    </div>

    <x-slot name="footer">
        <x-footer />
    </x-slot>
</x-app-layout>

<style scoped>
    /*モーダルのオーバーレイ*/
    .modal{
        display: none;
        justify-content: center;
        align-items: center;
        position: absolute;
        z-index: 10;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        height: 100%;
        width: 100%;
        background-color: rgba(0,0,0,0.5);
    }
    /*モーダル*/
    .modal-contents{
        background-color: white;
        height: 400px;
        width: 600px;
        padding: 20px;
    }
    /* 以下モーダル内要素のデザイン調整 */
    input{
        padding: 2px;
        border: 1px solid black;
        border-radius: 5px;
    }
    .input-title{
        display: block;
        width: 80%;
        margin: 0 0 20px;
        border-radius: 5px;
    }
    .input-date{
        width: 27%;
        margin: 0 5px 20px 0;
    }
    textarea{
        display: block;
        width: 80%;
        margin: 0 0 20px;
        padding: 2px;
        border: 1px solid black;
        border-radius: 5px;
        resize: none;
    }
    select{
        display: block;
        width: 20%;
        margin: 0 0 20px;
        padding: 2px;
        border: 1px solid black;
        border-radius: 5px;
    }
    /*予定の上ではカーソルがポインターになる*/
    .fc-event-title-container{
        cursor: pointer;
    }
</style>
