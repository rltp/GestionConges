var $uploadCrop;

document.addEventListener('change', function (e) {
    e = e || window.event;
    var target = e.target || e.srcElement;
    var input = this;

    if (input.files && input.files[0]) {
        var reader = new FileReader();
        
        reader.onload = function (e) {
            $('.upload-demo').addClass('ready');
            
            $uploadCrop.croppie('bind', {
                url: e.target.result
            }).then(function(){
                console.log('jQuery bind fait');
            });
            
        }
        
        reader.readAsDataURL(input.files[0]);
    }
    else {
        console.log("Erreur FileReader");
    }

    $uploadCrop = $('#upload-demo').croppie({
        viewport: {
            width: 100,
            height: 100,
            type: 'circle'
        },
        enableExif: true
    });

    $uploadCrop.croppie('result', {
        type: 'canvas',
        size: 'viewport'
    }).then(function (resp) {
        popupResult({
            src: resp
        });
    });

    if (target.hasAttribute('data-toggle') && target.getAttribute('data-toggle') == 'modal') {
        if (target.hasAttribute('data-target')) {
            var m_ID = target.getAttribute('data-target');
            document.getElementById(m_ID).classList.add('open');
        }
    }
}, false);

document.addEventListener('click', function (e) {
    e = e || window.event;
    var target = e.target || e.srcElement;
    if ((target.hasAttribute('data-dismiss') && target.getAttribute('data-dismiss') == 'modal') || target.classList.contains('modal')) {
        var modal = document.querySelector('[class="modal open"]');
        modal.classList.remove('open');
    }
}, false);