$(".navbar-toggle.collapsed").click(function() {
    $('.navbar-collapse.collapse.in').toggleClass( "mobil_nav" );
    $('#content-main').toggleClass( "mobil" );
});

$('#header_sidebar').hover(
    function(){
        $('#header_sidebar').css('width', '220');

        $('.user_logo a span').html('Профиль');
        $('.logo_profile_link_admin a span').html('Профиль');

        $('.logo_recomendations a span').html('Рекомендации');
        $('.logo_change_experience a span').html('Обмен опытом');

        $('.logo_adminpanel_link_admin a span').html('Админпанель');
        $('.logo_statistics_link_admin a span').html('Статистика');
        $('.logo_projects_link_admin a span').html('Проекты');

        $('.logo_leaders_link_admin a span').html('Лидеры');
        $('.logo_doubles_link_admin a span').html('Привязки');
        $('.logo_recommend_link_admin a span').html('Рекомендации');

        $('.logo_tags_link_admin a span').html('Теги');
        $('.logo_news_link_admin a span').html('Новости');
        $('#header_sidebar').css('box-shadow', '20px 0 43px 0 rgba(62, 62, 162, 0.2)');
    },
    function(){
        $('.logo_cl a span').html('');

        $('#header_sidebar').css('box-shadow', 'none');
        $('#header_sidebar').css('width', '80');
});

function up() {
    var top = Math.max(document.body.scrollTop,document.documentElement.scrollTop);
    if(top > 0) {
        window.scrollBy(0,-100);
        var t = setTimeout('up()',5);
    } else clearTimeout(t);
    return false;
};

function selectText(elementId) {
    var doc = document,
        text = doc.getElementById(elementId),
        range,
        selection;
    if (doc.body.createTextRange) {
        range = document.body.createTextRange();
        range.moveToElementText(text);
        range.select();
    } else if (window.getSelection) {
        selection = window.getSelection();
        range = document.createRange();
        range.selectNodeContents(text);
        selection.removeAllRanges();
        selection.addRange(range);
    }
}
$(".copy").click(function() {
    selectText(this.id);
    document.execCommand("copy");
    $('.user_status.register.copy').addClass('active');

    setTimeout(function () {
        $('.user_status.register.copy').removeClass('active')
    }, 3000);
});


function add_leader_block() {
    $.post(
        '/ajax/index/blocks/add/leader',
        {
            counter: $('.checkSizeLeader').length,
        },
        AjaxSuccess
    );

    function AjaxSuccess(data) {
        $('.content_leader_main').last().after(data);
        $('.no_leader_main').css('display', 'none');
    }
}
function add_links_block() {
    $.post(
        '/ajax/index/blocks/add/link',
        {
            counter: $('.checkSizeLink').length,
        },
        AjaxSuccess
    );

    function AjaxSuccess(data) {
        $('.content_link_main').last().after(data);
        $('.no_link_main').css('display', 'none');
    }
}
function add_file_block() {
    $.post(
        '/ajax/index/blocks/add/file',
        {
            counter: $('.checkSizeFile').length,
        },
        AjaxSuccess
    );

    function AjaxSuccess(data) {
        // $('.content_leader_file').last().after(data);
        $('.content_file_main').last().after(data);
        $('.no_file_main').css('display', 'none');
    }
}
function readImage ( input ) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
            $('.image_name').css('background-image', 'url(' + e.target.result + ')');
        }
        reader.readAsDataURL(input.files[0]);
    }
}
function upload($id_type, $id_change, $progressbar, $id_preview, $counter){


    if($id_preview == undefined){ $id_preview = 'preview'; }
    if($counter == undefined){ $counter = ''; }

    if($id_type == 'img') {
        $url = '/ajax/index/upload/img';
    }
    if($id_type == 'file') {
        $url = '/ajax/index/upload/file';
    }

    $('#' + $progressbar).css('display', 'block');
    var progressBar = $('#' + $progressbar);
    var file_data = $('#' + $id_change).prop('files')[0];
    var form_data = new FormData();
    readImage(this);
    form_data.append('file', file_data);
    form_data.append('id', $counter);
    $.ajax({
        url: $url,
        dataType: 'json',
        cache: false,
        contentType: false,
        processData: false,
        data: form_data,
        type: 'post',
        xhr: function(){
            var xhr = $.ajaxSettings.xhr(); // получаем объект XMLHttpRequest
            xhr.upload.addEventListener('progress', function(evt){ // добавляем обработчик события progress (onprogress)
                if(evt.lengthComputable) { // если известно количество байт
                    // высчитываем процент загруженного
                    var percentComplete = Math.ceil(evt.loaded / evt.total * 100);
                    // устанавливаем значение в атрибут value тега <progress>
                    // и это же значение альтернативным текстом для браузеров, не поддерживающих <progress>
                    progressBar.val(percentComplete).text('Загружено ' + percentComplete + '%');
                }
            }, false);
            return xhr;
        },
        success: function(json){
            if(json == 'Неверный формат файла!'){
                $('#' + $progressbar).css('display', 'none');
                $('#mark_' + $counter).addClass('error');
                $('#mark_' + $counter).html('Неподдерживаемый формат!');
            }else{
                if(json){
                    if($id_type == 'img') {
                        $('#' + $id_preview).html(json);
                        $('#' + $progressbar).css('display', 'none');
                        $('.notice_load').css('color', 'transparent');
                        $('#mark_img').html('<img src="/assets/images/checkmark.svg">');
                    }
                    if($id_type == 'file') {
                        $('#' + $id_preview).html(json);
                        $('#' + $progressbar).css('display', 'none');
                        $('#mark_' + $counter).html('<img src="/assets/images/checkmark.svg">');
                    }

                }
            }
        },
    });
}

function lookVideo($url){
    $arr = $url.split('/');
    $url_link = $arr[$arr.length - 1];
    $('#videoModal .modal-dialog .modal-content').html('<iframe width="720" height="405" src="https://www.youtube.com/embed/'+$url_link+'?rel=0&amp;showinfo=0" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>');
    $('#videoModal').modal('show');
}