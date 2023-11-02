// calendar.js

import axios from "axios";
import { Calendar } from "@fullcalendar/core";
import dayGridPlugin from "@fullcalendar/daygrid";
import timeGridPlugin from '@fullcalendar/timegrid';

var calendarEl = document.getElementById("calendar");

function formatDate(date, type) {
    let formattedDate = date.toISOString().split('T')[0];
    if (type === "end" && date.getHours() === 0 && date.getMinutes() === 0 && date.getSeconds() === 0) {
        formattedDate = formattedDate;
    }
    return formattedDate;
}

// モーダルを閉じる関数
function closeUpdateModal() {
    document.getElementById('modal-update').style.display = 'none';
}

// 削除モーダルを開く関数
function openDeleteModal() {
    document.getElementById('modal-delete').style.display = 'flex';
}

// 削除モーダルを閉じる関数
function closeDeleteModal() {
    document.getElementById('modal-delete').style.display = 'none';
}

if (calendarEl !== null) {
  axios.get('/calendar/getPlans')
    .then((response) => {
      let calendar = new Calendar(calendarEl, {
        plugins: [dayGridPlugin, timeGridPlugin],
        initialView: "dayGridMonth",
        customButtons: {
          eventAddButton: {
            text: '予定を追加',
            click: function() {
              document.getElementById("new-id").value = "";
              document.getElementById("new-title").value = "";
              document.getElementById("new-start_date").value = "";
              document.getElementById("new-end_date").value = "";
              document.getElementById("new-description").value = "";
              document.getElementById("new-event").value = "";
              document.getElementById('modal-add').style.display = 'flex';
            }
          }
        },
        headerToolbar: {
          start: "prev,next today",
          center: "title",
          end: "eventAddButton dayGridMonth,timeGridWeek",
        },
        height: "auto",
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
        
        eventClick: function(info) {
          document.getElementById("id").value = info.event.id;
          document.getElementById("delete-id").value = info.event.id;
          document.getElementById("title").value = info.event.title;
          document.getElementById("start_date").value = formatDate(info.event.start);
          document.getElementById("end_date").value = formatDate(info.event.end, "end");
          document.getElementById("description").value = info.event.extendedProps.description;
  
          document.getElementById('modal-update').style.display = 'flex';
        },
      });

      calendar.render();
      
      window.closeAddModal = function(){
        document.getElementById('modal-add').style.display = 'none';
      };
      
      window.closeUpdateModal = function(){
        document.getElementById('modal-update').style.display = 'none';
      };
      
      window.deletePlan = function(){
        'use strict';
        
        if (confirm('本当に削除しますか？')) {
          const deleteForm = document.getElementById('delete-form');
          deleteForm.submit();
        }
      };
      
      window.closeUpdateModal = closeUpdateModal;
    })
    .catch((error) => {
      console.log("Error fetching plans", error);
    });
    
  axios.get('/user-events')
    .then(response => {
      const events = response.data;
      const selectEvent = document.getElementById("new-event");
      events.forEach(event => {
        const option = document.createElement("option");
        option.value = event.id;
        option.textContent = event.name;
        selectEvent.appendChild(option);
      });
      document.getElementById("new-event").addEventListener("change", function() {
        document.getElementById("selected-event-id").value = this.value;
      });
    })
    .catch(error => {
      console.log('Error fetching user events', error);
    });
}
