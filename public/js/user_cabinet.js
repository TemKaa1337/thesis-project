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
        data: {},
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
        data: {  },
        headers: {
            'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content'),
            'Authorization': 'Bearer ' + $('meta[name="api_token"]').attr('content'),
        },
        success: function (data) {
            document.getElementsByClassName('navigation_content')[0].innerHTML = data['result'];
            document.getElementById('change_credentials').onclick = changeCredentials;
        }
    });
}

function changeCredentials(event) {
    let name = document.getElementById('name').value;
    let surname = document.getElementById('name').value;
    let email = document.getElementById('email').value;
    let oldPassword = document.getElementById('old_password').value;
    let password = document.getElementById('password').value;
    let confirmPassword = document.getElementById('confirm_password').value;
    let phone = document.getElementById('phone').value;
    let isChecked = checkCredentials(name, surname, email, oldPassword, password, confirmPassword, phone);

    alert(isChecked);
}

function checkCredentials(name, surname, email, oldPassword, password, confirmPassword, phone) {
    if (
        name !== '' &&
        surname !== '' &&
        email !== '' &&
        oldPassword !== '' &&
        password !== '' &&
        confirmPassword !== ''
    ) {
        let isPasswordValid;

        $.ajax({
            url: '/api/check/old/password',
            type: "POST",
            async: false,
            data: { password: oldPassword },
            headers: {
                'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content'),
                'Authorization': 'Bearer ' + $('meta[name="api_token"]').attr('content'),
            },
            success: function (data) {
                isPasswordValid = data['result'];
            }
        });

        if (isPasswordValid) {
            if (password === confirmPassword) {
                let result;

                $.ajax({
                    url: '/api/save/new/user/credentials',
                    type: "POST",
                    async: false,
                    data: {
                        name: name,
                        surname: surname,
                        email: email,
                        password: password,
                        phone: phone
                    },
                    headers: {
                        'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content'),
                        'Authorization': 'Bearer ' + $('meta[name="api_token"]').attr('content'),
                    },
                    success: function (data) {
                        result = data['result'];
                    }
                });

                return result;
            } else {
                return 'Пароли не совпадают';
            }
        } else {
            return 'Старный пароль неверен!';
        }
    } else {
        return 'Введите данные корректно!';
    }
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