<div class="content_link_main content_leader_link link<?= $counter; ?> checkSizeLink">
    <div class="col-lg-10">
        <label for="link_<?= $counter ?>">Название*</label>
        <input required id="link_<?= $counter ?>" class="form-control" type="text" name="link[<?= $counter; ?>][title]">
    </div>
    <div class="col-lg-2 buttons hidden-xs">
        <a class="trash_btn" href="javascript:void(0)" onclick='AjaxCheckLeaderDbLink("del", ".link<?= $counter; ?>");'></a>

        <a class="add_btn btn_link" onclick="add_links_block()" href="javascript:void(0)"></a>
    </div>
    <div class="col-xs-12">
        <label for="description_link_<?= $counter ?>">Ссылка*</label>
        <input required placeholder="http://" id="description_link_<?= $counter ?>" class="form-control valid_url" name="link[<?= $counter; ?>][link]">
    </div>
    <div class="col-lg-2 buttons visible-xs">
        <a class="trash_btn" href="javascript:void(0)" onclick='AjaxCheckLeaderDbLink("del", ".link<?= $counter; ?>");'></a>

        <a class="add_btn btn_link" onclick="add_links_block()" href="javascript:void(0)"></a>
    </div>
</div>

<script>
    function AjaxCheckLeaderDbLink($check, $id){
         if ($check == 'del') {
             $($id).remove();
         }
        if ($('.checkSizeLink').length == 1){
            $('.no_links_user').css('display', 'inline-block');
            $('.no_links_project').css('display', 'inline-block');
        }
    }
    $(".valid_url").each(function (item) {
        $(this).rules("add", {
            url: true,
        });
    });
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
    // $('.link_site').change(function(){
    //     //Если возвращает положительное значение, значит есть. Если ноль - нету.
    //     if(!($(this).val().indexOf("http") + 1)) {
    //         $(this).removeClass('check_full');
    //         $(this).addClass('error_empty');
    //         $(this).prev('span').css('display', 'inline');
    //         $(this).prev('.link_error_http').addClass('error');
    //     }else{
    //         $(this).addClass('check_full');
    //         $(this).removeClass('error_empty');
    //         $(this).prev('span').css('display', 'none');
    //         $(this).prev('span').removeClass('error');
    //
    //     }
    // });
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


