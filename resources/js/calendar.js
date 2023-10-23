// calendar.js

import axios from "axios";
import { Calendar } from "@fullcalendar/core";
import dayGridPlugin from "@fullcalendar/daygrid";
import timeGridPlugin from '@fullcalendar/timegrid';

var calendarEl = document.getElementById("calendar");

if (calendarEl !== null) {
  axios.get('/calendar/getPlans')
    .then((response) => {
      const plans = response.data.map(plan => {
        return {
          title: `${plan.title}`,
          start: plan.start_date,
          end: plan.end_date,
          discription: plan.description,
          backgroundColor: plan.event_color,
          borderColor: plan.event_color
        };
      });

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
      });

      calendar.render();
      
      window.closeAddModal = function(){
        document.getElementById('modal-add').style.display = 'none';
      }
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
      })
    .catch(error => {
      console.log('Error fetching user events', error);
    });
  });
}
