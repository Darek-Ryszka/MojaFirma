$(function() {
    $('a#filter-button').click(function() {
        const form = $('form.sidebar-filter').serialize();
        console.log(form);
        $.ajax({
            method: "GET",
            url: "/",
            data: form
        })
        .done(function (data) {
            alert("Jest w pyte");
        })
        .fail(function (data) {
            alert("Errrrrrrrrrrror");
        });
    })
});