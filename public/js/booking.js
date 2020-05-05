document.querySelectorAll('.film_date').forEach((item) => {
    item.onclick = showCinemaSessionTime;
});

document.getElementById('comment_submit').onsubmit = leaveCOmment;

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

function leaveCOmment(event) {
    event.preventDefault();
    let commentElement = document.getElementsByTagName('textarea')[0];

    if (commentElement.value !== '') {
        $.ajax({
            url: '/api/leave/comment',
            type: "POST",
            data: { comment: commentElement.value, filmId: commentElement.getAttribute('data-film') },
            headers: {
                'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content'),
                'Authorization': 'Bearer ' + $('meta[name="api_token"]').attr('content'),
            },
            success: function (data) {
                let comments = document.getElementById('comment_wrapper');
            }
        });
    }
}
