let editFilm = document.getElementById('edit_film');
if (editFilm !== null) {
    editFilm.onclick = editFilmData;
}

function editFilmData(event) {
    let button = document.getElementById('edit_film');

    if (button.innerText == 'Редактировать') {
        let datetimeShown = document.getElementById('datetime_shown_edit');
        let country = document.getElementById('country_edit');
        let duration = document.getElementById('duration_edit');
        let genre = document.getElementById('genre_edit');
        let producer = document.getElementById('producer_edit');
        let actors = document.getElementById('actors_edit');
        let ageRestrictions = document.getElementById('age_restrictions_edit');
        let description = document.getElementById('p_description');
        let filmName = document.getElementById('film_name');

        datetimeShownText = datetimeShown.innerText.replace('С ', '');
        datetimeShownText = datetimeShownText.split(' по ');
        datetimeShownText[0] = datetimeShownText[0].split(".").reverse().join("-");
        datetimeShownText[1] = datetimeShownText[1].split(".").reverse().join("-");

        datetimeShown.innerHTML = `
            С <input id = "datetime_shown_from_input" type = "date" value="` + datetimeShownText[0] + `" required> 
            По <input id = "datetime_shown_to_input" type = "date" value="` + datetimeShownText[1] + `" required> 
        `;
        country.innerHTML = `
            <input id = "country_input" type = "text" class = "" name = "country" value = "` + country.innerText + `" required>
        `;
        duration.innerHTML = `
            <input id = "duration_input" type = "text" class = "" name = "duration" value = "` + duration.innerText + `" required>
        `;
        genre.innerHTML = `
            <input id = "genre_input" type = "text" class = "" name = "genre" value = "` + genre.innerText + `" required>
        `;
        producer.innerHTML = `
            <input id = "producer_input" type = "text" class = "" name = "producer" value = "` + producer.innerText + `" required>
        `;
        actors.innerHTML = `
            <textarea id = "actors_input" type = "text" class = "" name = "actors" required> `+ actors.innerText + `</textarea>
        `;
        ageRestrictions.innerHTML = `
            <input id = "age_restrictions_input" type = "text" class = "" name = "age_restrictions" value = "` + ageRestrictions.innerText + `" required>
        `;
        description.innerHTML = `
            <textarea style = "height: 100px;" id = "description_input" type = "text" class = "" name = "age_restrictions" required>` + description.innerText + `</textarea>
        `;
        filmName.innerHTML = `
            <input id = "filmname_input" type = "text" value = "`+ filmName.innerText + `"class = "" name = "age_restrictions" required> 
        `;
        button.innerText = 'Сохранить';
    } else {
        let datetimeShownFrom = document.getElementById('datetime_shown_from_input').value;
        let datetimeShownTo = document.getElementById('datetime_shown_to_input').value;
        let country = document.getElementById('country_input').value;
        let year = country.split(', ')[1];
        country = country.split(', ')[0];
        let duration = document.getElementById('duration_input').value;
        let genre = document.getElementById('genre_input').value;
        let producer = document.getElementById('producer_input').value;
        let actors = document.getElementById('actors_input').value;
        let ageRestrictions = document.getElementById('age_restrictions_input').value;
        let filmName = document.getElementById('filmname_input').value;
        let description = document.getElementById('description_input').value;

        $.ajax({
            url: '/api/save/film/info',
            type: "POST",
            data: {
                oldFilmName: $('meta[name="film_name"]').attr('content'),
                datetimeShownFrom: datetimeShownFrom,
                datetimeShownTo: datetimeShownTo,
                country: country,
                year: year,
                duration: duration,
                genre: genre,
                producer: producer,
                actors: actors,
                ageRestrictions: ageRestrictions,
                filmName: filmName,
                description: description,
            },
            async: false,
            headers: {
                'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content'),
                'Authorization': 'Bearer ' + $('meta[name="api_token"]').attr('content'),
            },
            success: function (data) {
                document.getElementById('datetime_shown_edit').innerHTML = 'С ' + datetimeShownFrom.split("-").reverse().join(".") + ' по ' + datetimeShownTo.split("-").reverse().join(".");
                document.getElementById('country_edit').innerHTML = country + ', ' + year;
                document.getElementById('duration_edit').innerHTML = duration;
                document.getElementById('genre_edit').innerHTML = genre;
                document.getElementById('producer_edit').innerHTML = producer;
                document.getElementById('actors_edit').innerHTML = actors;
                document.getElementById('age_restrictions_edit').innerHTML = ageRestrictions;
                document.getElementById('p_description').innerHTML = description;
                document.getElementById('film_name').innerHTML = filmName;
                button.innerText = 'Редактировать';
            }
        });
    }
}