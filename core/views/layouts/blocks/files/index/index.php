<div class="content_file_main content_leader_file content_files_project file<?= $counter; ?> checkSizeFile">
    <div class="col-xs-5">
        <label for="file_<?= $counter ?>">Название*</label>
        <span class="error_message">Необходимо заполнить</span>
        <input required id="file_<?= $counter ?>" class="form-control" type="text" name="file[<?= $counter; ?>][title]">
    </div>
    <div class="col-xs-5">
        <label class="file_upload files">
            <span class="load_file">Выбрать файл*</span>
            <mark id="mark_<?= $counter ?>">файл не выбран</mark>
            <input id="user_file_<?= $counter ?>" type="file" onchange="upload('file', 'user_file_<?= $counter ?>', 'progressbar_<?= $counter ?>', 'preview_<?= $counter ?>', <?= $counter ?>);"/>
        </label>
        <span class="error_message">Необходимо заполнить</span>
        <progress id="progressbar_<?= $counter ?>" value="0" max="100" style="display: none;"></progress>
        <div id="preview_<?= $counter ?>" style="display: none">
            <input id="preview_file_<?= $counter ?>" class="form-control" type="text" name="file[<?= $counter; ?>][filename]">
        </div>
    </div>
    <div class="col-xs-2 buttons">
        <a class="trash_btn" href="javascript:void(0)" onclick='trash(".file<?= $counter; ?>");'></a>

        <a class="add_btn btn_file" onclick="add_file_block()" href="javascript:void(0)"></a>
    </div>
    <div class="col-xs-12">
        <label for="description_<?= $counter ?>">Описание*</label>
        <span class="error_message">Необходимо заполнить</span>
        <textarea required id="description_<?= $counter ?>" class="form-control" name="file[<?= $counter; ?>][description]" cols="30" rows="5"></textarea>
    </div>
</div>
<input type="hidden" name="file[<?= $counter; ?>][new]">


<script>
    function trash($id){
        $($id).remove();
        if ($('.checkSizeFile').length == 1){
            $('.no_files_user').css('display', 'inline-block');
            $('.no_files_project').css('display', 'inline-block');
        }
    }
    $('input').change(function(){
        if( $.trim( $(this).val() ) != '' ) {
            $(this).addClass('check_full');
        }else{
            $(this).removeClass('check_full');
        }
    });
    $('textarea').change(function(){
        if( $.trim( $(this).val() ) != '' ) {
            $(this).addClass('check_full');
        }else{
            $(this).removeClass('check_full');
        }
    });


    $('.form-control').change(function(){
        if($.trim($(this).val()) != '' ) {
            $(this).addClass('check_full');
            $(this).removeClass('error_empty');
        }else{
            $(this).removeClass('check_full');
        }
    });

    $('.form-control').each(function(i, el){
        if($.trim($(el).val()) != '' ) {
            $(el).addClass('check_full');
        }else{
            $(el).removeClass('check_full');
        }
    });

    $(".form-control").keydown(function(){
        if($.trim($(this).val()) != '' ) {
            $(this).addClass('check_full');
            $(this).removeClass('error_empty');
            $(this).prev('span').css('display', 'none');
            $(this).prevAll('label').css('color', '#3E3EA2').css('opacity', '1');
            $(this).css('border', '1px solid #3E3EA2');
        }else{
            $(this).removeClass('check_full');
        }
    });

    $(".form-control").hover(function(){
        $(".form-control").css('border', '1px solid #ccc');
        $(this).css('border', '1px solid #3E3EA2');
        $(this).prevAll('label').css('color', '#3E3EA2').css('opacity', '1');
    }, function(){
        $(".form-control").css('border', '1px solid #ccc');
        $(".form-control").prevAll('label').css('color', '#242424').css('opacity', '0.7');
    });

</script>

