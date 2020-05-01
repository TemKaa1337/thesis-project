document.getElementById('filter').onchange = changeFilterOptions;
document.getElementById('filter_value').onchange = changeFilterValueOptions;
document.getElementById('reset_button').onclick = resetFilters;

function changeFilterOptions(event) {
    changeVisibility();
    $.ajax({
        url: '/api/get/filter/options',
        type: "POST",
        data: { parameter: this.value},
        headers: {
            'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
        },
        success: function (data) {
            document.getElementById('filter_value').innerHTML = data['result'];
        }
    });
}

function changeFilterValueOptions(event) {
    let parameter = document.getElementById('filter').value;
    $.ajax({
        url: '/api/get/filter/movies',
        type: "POST",
        data: { paramName: parameter, paramValue: this.value},
        headers: {
            'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
        },
        success: function (data) {

            document.getElementsByClassName('content')[0].innerHTML = data['result'];
        }
    });
}

function changeVisibility() {
    let elements = document.getElementsByClassName('detailed');
    
    for(let i = 0; i < elements.length; i ++) {
        elements[i].style.visibility = "visible";
    }
}

function resetFilters (event) {
    let elements = document.getElementsByClassName('detailed');
    document.getElementById('filter').selectedIndex = 0;
    document.getElementById('filter_value').selectedIndex = 0;
    
    for(let i = 0; i < elements.length; i ++) {
        elements[i].style.visibility = "hidden";
    }

    $.ajax({
        url: '/api/reset/filters',
        type: "POST",
        headers: {
            'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
        },
        success: function (data) {
            document.getElementsByClassName('content')[0].innerHTML = data['result'];
        }
    });
}