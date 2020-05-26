document.getElementById('my_tickets').onclick = getMyTickets;
document.getElementById('my_bonuses').onclick = getMyBonuses;
document.getElementById('my_info').onclick = getMyInfo;
document.querySelectorAll('.unbook_button').forEach((element) => {
    element.onclick = removeTicket;
})

function changeSelected() {
    document.getElementsByClassName('selected')[0].className = '';
}

function getMyTickets(event) {
    changeSelected();
    this.className = 'selected';

    $.ajax({
        url: '/api/get/user/tickets',
        type: "POST",
        data: {},
        headers: {
            'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content'),
            'Authorization': 'Bearer ' + $('meta[name="api_token"]').attr('content'),
        },
        success: function (data) {
            document.getElementsByClassName('navigation_content')[0].innerHTML = data['result'];
            document.querySelectorAll('.unbook_button').forEach((element) => {
                element.onclick = removeTicket;
            })
        }
    });
}

function getMyBonuses(event) {
    changeSelected();
    this.className = 'selected';

    $.ajax({
        url: '/api/get/user/bonuses',
        type: "POST",
        data: { paramName: parameter, paramValue: this.value},
        headers: {
            'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content'),
            'Authorization': 'Bearer ' + $('meta[name="api_token"]').attr('content'),
        },
        success: function (data) {
            document.getElementsByClassName('navigation_content')[0].innerHTML = data['result'];
        }
    });
}

function getMyInfo(event) {
    changeSelected();
    this.className = 'selected';

    $.ajax({
        url: '/api/get/user/info',
        type: "POST",
        data: { paramName: parameter, paramValue: this.value},
        headers: {
            'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content'),
            'Authorization': 'Bearer ' + $('meta[name="api_token"]').attr('content'),
        },
        success: function (data) {
            document.getElementsByClassName('navigation_content')[0].innerHTML = data['result'];
        }
    });
}

function removeTicket(event) {
    $.ajax({
        url: '/api/remove/user/ticket',
        type: "POST",
        data: { 
            cinemaName: this.getAttribute('data-cinema'),
            row: this.getAttribute('data-row'),
            place: this.getAttribute('data-place'),
            date: this.getAttribute('data-date'),
            filmName: this.getAttribute('data-film')
        },
        headers: {
            'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content'),
            'Authorization': 'Bearer ' + $('meta[name="api_token"]').attr('content'),
        },
        success: function (data) {
            document.getElementsByClassName('navigation_content')[0].innerHTML = data['result'];
            document.querySelectorAll('.unbook_button').forEach((element) => {
                element.onclick = removeTicket;
            })
        }
    });
}