document.getElementById('add_film').onclick = getNewFilmHtml;
document.getElementById('add_session').onclick = getNewSession;
document.getElementById('remove_session').onclick = getRemoveSession;

function removeSelected() {
    document.getElementsByClassName('selected')[0].className = '';
}

function getNewSession(event) {
    this.className = 'selected';
    $.ajax({
        url: '/api/get/films/data',
        type: "POST",
        data: {},
        headers: {
            'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content'),
            'Authorization': 'Bearer ' + $('meta[name="api_token"]').attr('content'),
        },
        success: function (data) {
            getNewSessionHtml(data['result'])
        }
    });
}

function getRemoveSession(event) {
    removeSelected();
    this.className = 'selected';
    $.ajax({
        url: '/api/get/session/data',
        type: "POST",
        data: {},
        headers: {
            'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content'),
            'Authorization': 'Bearer ' + $('meta[name="api_token"]').attr('content'),
        },
        success: function (data) {
            document.getElementById('navigation_content').style.display = 'block';
            document.getElementById('navigation_content').innerHTML = data['result'];
            setListeners()
        }
    });
}

function setListeners() {
    let buttons = document.getElementsByClassName('remove_button');

    for (let i = 0; i < buttons.length; i ++) {
        buttons[i].onclick = removeSession;
    }
}

function getNewSessionHtml(data) {
    removeSelected()
    document.getElementById('navigation_content').style.display = 'block';
    let options = '<option disabled selected value>Название фильма</option>';

    for (let i = 0; i < data.length; i ++) {
        options += '<option value = "' + data[i].id + '">' + data[i].name + '</option>';
    }
    
    document.getElementById('navigation_content').innerHTML = `
        <div class = "sessions">
            <div>
                <span class = "dropdown">
                    <select id = "film_name" class = "film_filter_select">
                        ` + options + `
                    </select>
                </span>
            </div>
            <div>
                <span id = "cinema_span" class = "dropdown" style = "visibility: hidden;">
                    <select id = "cinema" class = "film_filter_select">
                        <option disabled selected value>Кинотеатр</option>
                    </select>
                </span>
            </div>
            <div>
                <span id = "hall_span" class = "dropdown" style = "visibility: hidden;">
                    <select id = "hall" class = "film_filter_select">
                        <option disabled selected value>Зал</option>
                    </select>
                </span>
            </div>
            <div>
                <span id = "session_datetime_span" class = "dropdown" style = "visibility: hidden;">
                    <input id = "datetime_shown" type = "datetime" placeholder = "Введите время сеанса в формате гггг-мм-дд ч:м" style = "width: 300px;"> 
                </span>
            </div>
            <div>
                <a id = "save_button" class = "save_button detailed" style = "visibility: hidden;">Сохранить</a>
            </div>
        </div>
    `;

    document.getElementById('film_name').onchange = changeFilmName;
    document.getElementById('cinema').onchange = changeCinema;
    document.getElementById('hall').onchange = changeHall;
    document.getElementById('save_button').onclick = saveSession;
}

function getRemoveSessionHtml() {
    removeSelected()
    this.className = 'selected';
    document.getElementById('navigation_content').style.display = 'block';
    document.getElementById('navigation_content').innerHTML = '';
}

function getNewFilmHtml(event) {
    removeSelected()
    this.className = 'selected';
    document.getElementById('navigation_content').style.display = 'grid';
    let firstBlock = `
        <div class = "content_item add_film">
            <div class = "upload_film_image_preview" >
                <p>Выберите изображение для превью фильма</p>
                <input type = "file" id = "upload_film_image_preview_input">
            </div>
            <!-- <div class = "new_film_image_preview">

            </div> -->
        </div>
    `;

    let secondBlock = `
        <div class = "content_item add_film">
            <div class = "upload_film_image" >
                <p>Выберите изображение для страницы фильма</p>
                <input type = "file" id = "upload_film_image_input">
            </div>
            <!-- <div class = "new_film_image">

            </div> -->
        </div>
    `;

    let thirdBlock = `
        <div class = "content_item add_film">
            <table>
                <tbody>
                    <tr>
                        <td>Дата показа:</td>
                        <td>С 
                            <input id = "date_shown_from" type = "date" class = "" name = "date_shown_from" required><br>
                            по
                            <input id = "date_shown_to" type = "date" class = "" name = "date_shown_to" required> 
                        </td>
                    </tr>
                    <tr>
                        <td>Страна:</td>
                        <td>
                            <input id = "country" type = "text" class = "" name = "country" required>
                        </td>
                    </tr>
                    <tr>
                        <td>Год:</td>
                        <td>
                            <input id = "year" type = "text" class = "" name = "year" required>
                        </td>
                    </tr>
                    <tr>
                        <td>Длительность:</td>
                        <td>
                            <input id = "length" type = "text" class = "" name = "length" required>
                        </td>
                    </tr>
                    <tr>
                        <td>Жанр:</td>
                        <td>
                            <input id = "genre" type = "text" class = "" name = "genre" required>
                        </td>
                    </tr>
                    <tr>
                        <td>Режиссер:</td>
                        <td>
                            <input id = "producer" type = "text" class = "" name = "producer" required>
                        </td>
                    </tr>
                    <tr>
                        <td>Актерский состав:</td>
                        <td>
                            <textarea rows = "" cols = "" id = "actors" type = "text" class = "" name = "actors" required>
                            </textarea>
                        </td>
                    </tr>
                    <tr>
                        <td>Возрастное ограничение:</td>
                        <td>
                            <input id = "age_restrictions" type = "text" class = "" name = "age_restrictions" required>
                        </td>
                    </tr>
                    <tr>
                        <td>Сылка на трейлер:</td>
                        <td>
                            <input id = "trailer" type = "text" class = "" name = "trailer" required>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    `;

    let fourthBlock = `
        <div class = "content_item new_film_name add_film">
            <label style = "" for = "film_name" class = "">Название фильма:</label>
            <div style = "" class = "input new_film_name_input">
                <input id = "film_name" value = "" type = "text" class = "" name = "film_name_text" required/>
            </div>
            <label style = "" for = "film_description" class = "">Описание фильма:</label>
            <div style = "" class = "input new_film_description">
                <textarea rows = "10" cols = "50" id = "film_description" type = "text" class = "" name = "film_description" required></textarea>
            </div>
            <a id = "button" class = "button" href = "" >Добавить фильм</a>
        </div>
    `;

    document.getElementById('navigation_content').innerHTML = firstBlock + secondBlock + thirdBlock + fourthBlock;
}

function changeFilmName(data) {

    $.ajax({
        url: '/api/get/cinema/data',
        type: "POST",
        data: {},
        headers: {
            'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content'),
            'Authorization': 'Bearer ' + $('meta[name="api_token"]').attr('content'),
        },
        success: function (data) {
            document.getElementById('cinema_span').style.visibility = 'visible';
            document.getElementById('hall_span').style.visibility = 'hidden';
            document.getElementById('session_datetime_span').style.visibility = 'hidden';

            let options = '<option disabled selected value>Кинотеатр</option>';
            for (let i = 0; i < data['result'].length; i ++) {
                options += '<option value = "' + data['result'][i].id + '">' + data['result'][i].name + '</option>';
            }

            document.getElementById('cinema').innerHTML = options;
        }
    });
}

function changeCinema(data) {
    $.ajax({
        url: '/api/get/hall/data',
        type: "POST",
        data: {
            cinemaId: document.getElementById('cinema').value
        },
        headers: {
            'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content'),
            'Authorization': 'Bearer ' + $('meta[name="api_token"]').attr('content'),
        },
        success: function (data) {
            document.getElementById('hall_span').style.visibility = 'visible';
            document.getElementById('session_datetime_span').style.visibility = 'hidden';

            let options = '<option disabled selected value>Зал</option>';
            for (let i = 0; i < data['result'].length; i ++) {
                options += '<option value = "' + data['result'][i] + '">' + data['result'][i] + ' зал' + '</option>';
            }

            document.getElementById('hall').innerHTML = options;
        }
    });
}

function changeHall(data) {
    document.getElementById('session_datetime_span').style.visibility = 'visible';
    document.getElementById('save_button').style.visibility = 'visible';
}

function saveSession(data) {
    $.ajax({
        url: '/api/save/session/data',
        type: "POST",
        data: {
            cinemaId: document.getElementById('cinema').value,
            filmId: document.getElementById('film_name').value,
            hallName: document.getElementById('hall').value,
            datetimeShown: document.getElementById('datetime_shown').value
        },
        headers: {
            'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content'),
            'Authorization': 'Bearer ' + $('meta[name="api_token"]').attr('content'),
        },
        success: function (data) {
            if (data['result'])
                alert('Сеанс успешно добавлен!');
        }
    });
}

function removeSession(event) {
    $.ajax({
        url: '/api/remove/session/data',
        type: "POST",
        data: {
            sessionId: this.getAttribute('data-session')
        },
        headers: {
            'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content'),
            'Authorization': 'Bearer ' + $('meta[name="api_token"]').attr('content'),
        },
        success: function (data) {
            if (data['result']) {
                document.getElementById('navigation_content').innerHTML = data['result'];
                setListeners()
            }
        }
    });
}