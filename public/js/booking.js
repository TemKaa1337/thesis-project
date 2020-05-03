document.querySelectorAll('.film_date').forEach((item) => {
    item.onclick = showCinemaSessionTime;
});

// document.querySelectorAll('.session_time').forEach((item) => {
//     item.onclick = bookTicket;
// });

function showCinemaSessionTime(event) {
    let aTags = this.parentElement.parentElement.getElementsByTagName('td');
    let chosenDate = this.parentElement.getAttribute('data-date');
    let filmId = this.parentElement.getAttribute('data-film');
    let token = $('meta[name="csrf-token"]').attr('content');

    for(let i = 0; i < aTags.length; i ++) {
        aTags[i].className = "disabled";
    }

    this.parentElement.className = "enabled";
    $.ajax({
        url: '/api/get/session/times',
        type: "POST",
        data: { sessionDate: chosenDate, filmId: filmId, _token: token },
        headers: {
            'X-CSRF-Token': token
        },
        success: function (data) {
            document.getElementById('sessions_table').innerHTML = data['result'];
            console.log('nice');
        }
    });
}

// function bookTicket(event) {
//     let selectedDate = document.getElementsByClassName('enabled')[0].getAttribute('data-date');
//     let cinema = this.getAttribute('data-cinema');
//     let sessiontime = this.textContent;
// }
