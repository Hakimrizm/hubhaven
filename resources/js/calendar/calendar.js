import { Calendar } from "@fullcalendar/core";
import dayGridPlugin from "@fullcalendar/daygrid";
import timeGridPlugin from "@fullcalendar/timegrid";
import interactionPlugin from "@fullcalendar/interaction";

export function renderBookingCalendar(placeId, elementId = "calendar") {
  const calendarEl = document.getElementById(elementId);
  if (!calendarEl) return;

  const calendar = new Calendar(calendarEl, {
    plugins: [dayGridPlugin, timeGridPlugin, interactionPlugin],
    initialView: "timeGridWeek",
    selectable: true,
    events: `/api/booking/${placeId}`,
    selectOverlap: false,
    select: function (info) {
      console.log("User selected:", info.startStr, info.endStr);
    },
  });

  calendar.render();
}
