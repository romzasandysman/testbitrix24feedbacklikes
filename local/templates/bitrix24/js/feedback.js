BX.ready(function(){
    let modalFeedbackId = '#feedback',
        $body = $('body'),
        spiner = '<div class="spinner-border" role="status">\n' +
        '  <span class="sr-only">Loading...</span>\n' +
        '</div>';

    $(modalFeedbackId).on('show.bs.modal', function(){
        let $container = $(this).find('.modal-content');
        addSpinner($container);
        axios.get(
                SITE_DIR + 'ajax/getFormFeedback.php'
            )
           .then(function(response){
               let data = response.data;
               if (data.length){
                   $('<div></div>').html(data);
                   $container.html(data);
               }
            })
           .catch(function(e){
               console.log(e);
            })
    });

    $body.on('submit', modalFeedbackId + " form", function(e){
        e.preventDefault();
        let $form = $(this),
            formData = new FormData(this);
        formData.append('web_form_submit','Y');

        addSpinner($form);

        axios.post($form.attr('action'), formData)
            .then(function(response){
                let data = response.data,
                    $content = $('<div></div>').html(data);

                if (data.length){
                    $form.html($content.find('form').html());
                }
            })
            .catch(function(e){
                console.log(e);
            })
    });

    let addSpinner = ($container) => {
        $container.html(spiner);
    }
})