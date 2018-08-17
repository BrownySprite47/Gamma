<div class="content_leader_main content_leader leader<?= $counter; ?> checkSizeLeader col-xs-12 leaders_bl mobile_wrap" >
    <div class="col-lg-6 mobile_wrap">
        <div class="col-xs-12">
            <label for="fio_<?= $counter ?>">Название проекта*</label>
            <select id="fio_<?= $counter ?>" data-live-search="true" class="selectpicker form-control" name="leader[<?= $counter; ?>][id_lid]">
                <option value="">Не выбрано</option>
                <?php foreach ($leaders as $leader): ?>
                    <option value="<?= $leader['id_lid'] ?>"><?= $leader['fio'] ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="col-xs-12">
            <label for="role_<?= $counter ?>">Роль лидера в проекте*</label>
            <input required id="role_<?= $counter ?>" class="form-control" type="text" name="leader[<?= $counter; ?>][role]">
        </div>
        <div class="col-xs-12">
            <label for="start_<?= $counter ?>">Старт работы над проектом*</label>
            <div class="input-group date form_date" data-date-format="dd.mm.yyyy" data-link-format="yyyy.mm.dd">
                <input required id="start_<?= $counter ?>" name="leader[<?= $counter; ?>][start]" class="form-control" type="text" readonly>
                <span class="input-group-addon"><i class="fa fa-calendar" aria-hidden="true"></i></span>
            </div>
        </div>


        <div class="col-xs-12">
            <label for="end_<?= $counter ?>">Окончание работы над проектом</label>
            <div id="end_<?= $counter ?>_box" class="input-group date form_date" data-date-format="dd.mm.yyyy" data-link-format="yyyy.mm.dd">
                <input id="end_<?= $counter ?>" name="leader[<?= $counter; ?>][end]" class="form-control" type="text" readonly>
                <span class="input-group-addon"><i class="fa fa-calendar" aria-hidden="true"></i></span>
            </div>
        </div>
        <label class="still_work_main_label" for="still_work_<?= $counter ?>"><input id="still_work_<?= $counter ?>" class="form-control still_work still_work_label_<?= $counter ?>" type="checkbox" name="leader[<?= $counter; ?>][still_work]">
            <span style="font-size: 13px;"> Продолжаю работать над проектом</span>
        </label>
    </div>
    <div class="col-xs-12 col-lg-6 buttons">
        <a class="trash_btn" href="javascript:void(0)" onclick='trash(".leader<?= $counter; ?>");'></a>

        <a class="add_btn" onclick="add_leader_block()" href="javascript:void(0)"></a>
    </div>
</div>
<script>
    $('.still_work_label_<?= $counter; ?>').click(function () {
        $('#end_<?= $counter; ?>').val('');
        $('#end_<?= $counter; ?>_box').toggle();
    });
</script>
<script>
    $('.selectpicker').selectpicker('refresh');
    $('.selectpicker').selectpicker({ size: 8 });

    $('.form_date').datetimepicker({
        language:  'ru',
        weekStart: 1,
        todayBtn:  1,
        autoclose: 1,
        todayHighlight: 1,
        startView: 2,
        minView: 2,
        forceParse: 0
    });
</script>

<script>
    function trash($id){
        $($id).remove();
        if ($('.checkSizeLeader').length == 1){
            $('.no_leaders_project').css('display', 'inline-block');
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

