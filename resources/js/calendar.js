// calendar.js

import axios from "axios";
import { Calendar } from "@fullcalendar/core";
import dayGridPlugin from "@fullcalendar/daygrid";
import timeGridPlugin from '@fullcalendar/timegrid';

// カレンダーを表示させたいタグのidを取得
var calendarEl = document.getElementById("calendar");

// new Calender(カレンダーを表示させたいタグのid, {各種カレンダーの設定});
// "calendar"というidがないbladeファイルではエラーが出てしまうので、if文で除外。
if (calendarEl !== null) {
  // ここでAPIから予定を取得する
  axios.get('/calendar/getPlans')
    .then((response) => {
      const plans = response.data.map(plan => {
        return {
          title: `${plan.description}`,
          start: plan.date,
          backgroundColor: plan.event_color,
          borderColor: plan.event_color
        };
      });

      let calendar = new Calendar(calendarEl, {
        // プラグインの導入(import忘れずに)
        plugins: [dayGridPlugin, timeGridPlugin],

        // カレンダー表示
        initialView: "dayGridMonth", // 最初に表示させるページの形式
        customButtons: {
          eventAddButton: {
            text: '予定を追加',
            click: function() {
              document.getElementById("new-id").value = "";
              document.getElementById("new-title").value = "";
              document.getElementById("new-start_date").value = "";
              document.getElementById("new-end_date").value = "";
              document.getElementById("new-description").value = "";
              
              document.getElementById('modal-add').style.display = 'flex';
            }
          }
        },
        headerToolbar: { // ヘッダーの設定
          start: "prev,next today", // ヘッダー左（前月、次月、今日の順番で左から配置）
          center: "title", // ヘッダー中央（今表示している月、年）
          end: "eventAddButton dayGridMonth,timeGridWeek", // ヘッダー右（月形式、時間形式）
        },
        height: "auto", // 高さをウィンドウサイズに揃える
        
        // DBに登録した予定を表示する
        events: function (info, successCallback, failureCallback) {
          axios
            .post("/calendar/get", {
              start_date: info.start.valueOf(),
              end_date: info.end.valueOf(),
            })
            .then((response) => {
              calendar.removeAllEvents();
              successCallback(response.data);
            })
            .catch((error) => {
              alert("保存に失敗しました。");
            });
        },
      });

      // カレンダーのレンダリング
      calendar.render();
      
      // 新規予定追加モーダルを閉じる
      window.closeAddModal = function(){
        document.getElementById('modal-add').style.display = 'none';
      }
    })
    .catch((error) => {
      console.log("Error fetching plans", error);
    });
}
