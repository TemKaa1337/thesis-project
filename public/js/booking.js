document.querySelectorAll('.film_date').forEach((item) => {
    item.onclick = showCinemaSessionTime;
});

let commentButton = document.getElementById('comment_submit');
if (commentButton !== null) {
    commentButton.onsubmit = leaveComment;
}
// document.getElementById('comment_submit').onsubmit = leaveComment;

document.querySelectorAll('.button_delete').forEach((item) => {
    item.onclick = deleteComment;
});
document.querySelectorAll('.button_ban').forEach((item) => {
    item.onclick = banUser;
});

let wannaSee = document.querySelectorAll('.want_to_see');
if (wannaSee.length !== 0) {
    wannaSee[0].onclick = addFilmToWanted;
}

function addFilmToWanted(event) {
    event.preventDefault();
    console.log('asdasd');
    $.ajax({
        url: '/api/save/user/wanted',
        type: "POST",
        data: { filmName: document.querySelectorAll('.want_to_see')[0].getAttribute('data-cinema')},
        headers: {
            'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content'),
            'Authorization': 'Bearer ' + $('meta[name="api_token"]').attr('content'),
        },
        success: function (data) {
            alert('Фильм успешно добавлен с список желаемых к просмотру!');
            let h1 = document.querySelectorAll('.want_to_see')[0];
            let newH1 = '<h1>' + h1.getAttribute('data-cinema') + '</h1>';
            document.getElementsByTagName('h1')[0].remove();
            document.querySelectorAll('.film_page_description')[0].insertAdjacentHTML('afterbegin', newH1)
        }
    });
}

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

function leaveComment(event) {
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
                let comments = document.getElementsByClassName('comment_wrapper')[0];
                comments.insertAdjacentHTML('afterbegin', data['result']);
                document.getElementsByTagName('textarea')[0].value = '';
            }
        });
    }
}

function deleteComment(event) {
    $.ajax({
        url: '/api/delete/comment',
        type: "POST",
        data: { 
            commentId: this.getAttribute('data-comment'),
            filmId: this.getAttribute('data-film'),
            option: 'delete'
        },
        headers: {
            'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content'),
            'Authorization': 'Bearer ' + $('meta[name="api_token"]').attr('content'),
        },
        success: function (data) {
            document.getElementsByClassName('comment_wrapper')[0].innerHTML = data['result'];
            document.querySelectorAll('.button_delete').forEach((item) => {
                item.onclick = deleteComment;
            });
            document.querySelectorAll('.button_ban').forEach((item) => {
                item.onclick = banUser;
            });
        }
    });
}

function banUser(event) {
    $.ajax({
        url: '/api/delete/comment',
        type: "POST",
        data: { 
            userId: this.getAttribute('data-user'),
            filmId: this.getAttribute('data-film'),
            option: 'ban'
        },
        headers: {
            'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content'),
            'Authorization': 'Bearer ' + $('meta[name="api_token"]').attr('content'),
        },
        success: function (data) {
            document.getElementsByClassName('comment_wrapper')[0].innerHTML = data['result'];
            document.querySelectorAll('.button_delete').forEach((item) => {
                item.onclick = deleteComment;
            });
            document.querySelectorAll('.button_ban').forEach((item) => {
                item.onclick = banUser;
            });
        }
    });
}
