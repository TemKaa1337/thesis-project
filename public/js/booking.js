document.querySelectorAll('.film_date').forEach((item) => {
    item.onclick = showCinemaSessionTime;
});

document.querySelectorAll('.session_time').forEach((item) => {
    item.onclick = bookTicket;
});

function showCinemaSessionTime(event) {
    let aTags = this.parentElement.parentElement.getElementsByTagName('td');
    for(let i = 0; i < aTags.length; i ++) {
        aTags[i].className = "disabled";
    }

    this.parentElement.className = "enabled";
    // tut ajax zapros
}

function bookTicket(event) {
    let selectedDate = document.getElementsByClassName('enabled')[0].getAttribute('data-date');
    let cinema = this.getAttribute('data-cinema');
    let sessiontime = this.textContent;
    console.log(selectedDate, cinema, sessiontime);
}
