$(() => {
    var form = $(".email");
    var url = form.attr('action');
    var formMessages = $('.error');

    form.submit(function(e) {
        e.preventDefault();

        $.ajax({
            type: form.attr('method'),
            url: url,
            data: form.serialize(),
            
            success: function(response) {
                $(formMessages).text("");
                $(formMessages).append(response);
            },
            error: function(data) {
                $(formMessages).text("");

                if (data.responseText !== '') {
                    let obj = JSON.parse(data.responseText);
                    Object.values(obj.errors).forEach((value) => {
                        $(formMessages).append(value);
                    });
                } else {
                    $(formMessages).append('Oops an error occurred');
                }
            }
        });

        return false; // Prevent the default form submission behavior
    });
});
