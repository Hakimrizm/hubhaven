import "./bootstrap";
import { renderBookingCalendar } from "./calendar/calendar";

document.addEventListener("DOMContentLoaded", function () {
  const calendarEl = document.getElementById("calendar");
  const placeId = calendarEl?.dataset.placeId;

  if (calendarEl && placeId) {
    renderBookingCalendar(placeId);
  }
});
