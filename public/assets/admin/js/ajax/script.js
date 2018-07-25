// function up() {
//     var top = Math.max(document.body.scrollTop,document.documentElement.scrollTop);
//     if(top > 0) {
//         window.scrollBy(0,-100);
//         var t = setTimeout('up()',5);
//     } else clearTimeout(t);
//     return false;
// };
//
// $('#check_double_no').on('click', function() {
//     $.post(
//         '/ajax/doubles/check_double',
//         {
//             check_double_no: 'true',
//         },
//         AjaxSuccess
//     );
//
//     function AjaxSuccess(data) {
//         if (data == 'no') {
//             $('#check_double').css('display', 'none');
//         }
//     }
// });
//
// function num_double_leader(id){
//     $.post(
//         '/ajax/doubles/check_double',
//         {
//             check_double_num: id,
//         },
//         AjaxSuccess
//     );
//
//     function AjaxSuccess(data) {
//         //alert(data);
//         if (data == 'num') {
//             //alert(data);
//         }
//
//     }
// }
//
// $('#check_double_yes').on('click', function() {
//     $.post(
//         '/ajax/doubles/check_double',
//         {
//             check_double_yes: 'true',
//             check_double_email: $('#check_double_email').val(),
//             check_double_phone: $('#check_double_phone').val(),
//         },
//         AjaxSuccess
//     );
//
//     function AjaxSuccess(data) {
//         if (data == 'empty') {
//             $('.error_double').html('Заполните все поля');
//         }
//         if (data == 'yes') {
//             $('.selectboxss').css('display', 'none');
//             $('.message_ok').css('display', 'block');
//             $('#check_double_no2').css('display', 'none');
//             $('#check_double_yes').css('display', 'none');
//             $('.check_double_wrap').css('display', 'none');
//             $('#check_double_ok').css('display', 'inline-block');
//             $('#check_double').css('display', 'none');
//             $('#error_pass').css('display', 'none');
//         }
//     }
// });
//
//
//
//
//
// $('#upload').on('click', function() {
//     var file_data = $('#sortpicture').prop('files')[0];
//     var form_data = new FormData();
//     form_data.append('file', file_data);
//     $.ajax({
//         url: '/ajax/general/upload_img',
//         dataType: 'text',
//         cache: false,
//         contentType: false,
//         processData: false,
//         data: form_data,
//         type: 'post',
//         success: function(php_script_response){
//             $('#preview').html(php_script_response);
//         }
//     });
// });
//
//
// $('.form_date').datetimepicker({
//     language:  'ru',
//     weekStart: 1,
//     todayBtn:  1,
//     autoclose: 1,
//     todayHighlight: 1,
//     startView: 2,
//     minView: 2,
//     forceParse: 0
// });
//
//
// $(document).ready(function(){
//     $('.open-modal').click(function(){
//         $('#myModal').modal('show');
//     });
// });
//
// $(document).ready(function(){
//     $('.open-modal2').click(function(){
//         $('#myModal2').modal('show');
//     });
// });
//
//
// $('#addLeader').click(function () {
//     var count = $('.checkSize').length;
//     if (count > 3) {
//         AjaxAddLeader();
//         $("head").append($("<style type='text/css'> #addLeader {display: none; }</style>"));
//     }else {
//         AjaxAddLeader();
//     }
// });
//
// $('#addProject').click(function () {
//     var count = $('.checkSize').length;
//     if (count > 3) {
//         AjaxAddProject();
//         $("head").append($("<style type='text/css'> #addProject {display: none; }</style>"));
//     }else {
//         AjaxAddProject();
//     }
// });
//
//
// $('#addFile').click(function () {
//     var count = $('.checkSizeFile').length;
//     if (count > 3) {
//         AjaxAddLeaderFile();
//         $("head").append($("<style type='text/css'> #addFile {display: none; }</style>"));
//     }else {
//         AjaxAddLeaderFile();
//     }
// });
//
//
// $(document).ready(function(){
//     $('.open-modal').click(function(){
//         $('#myModal').modal('show');
//     });
//     var count = $('.checkSize').length;
//     if (count == 5) {
//         $("head").append($("<style type='text/css'> #addLeader {display: none; }</style>"));
//     }else if (count > 3) {
//         AjaxAddLeader();
//         $("head").append($("<style type='text/css'> #addLeader {display: none; }</style>"));
//     }
// });
//
// $(document).ready(function(){
//     $('.open-modal-recom').click(function(){
//         $.post(
//             '/ajax/recommends/create_recom',
//             {
//                 id_lid: $('#id_lid_num').val(),
//                 project: $('#project').val(),
//                 city: $('#city').val(),
//                 social: $('#social').val(),
//                 email: $('#email').val(),
//                 reason: $('#textfield_recom').val(),
//             },
//             AjaxSuccess
//         );
//
//         function AjaxSuccess(data) {
//             //alert(data);
//             if (data == 'leader_recom_success') {
//                 $('#myModal').modal('show');
//             }
//         }
//
//     });
// });
// function AjaxSendStatusLeader($checked, $id_lid){
//     $.post(
//         '/ajax/general/check_status',
//         {
//             id_lid: $id_lid,
//             checked: $checked,
//         },
//         AjaxSuccess
//     );
//
//     function AjaxSuccess(data) {
//         if (data == 'leader_update_success') {
//             $(".relat_box_leader_" + $id_lid).hide();
//             $("#result_status").html('Ваши изменения сохранены!');
//         }
//     }
// }
//
// function AjaxSendStatusNews($status, $id_news){
//     $.post(
//         '/ajax/general/check_status',
//         {
//             status: $status,
//             id_news: $id_news,
//         },
//         AjaxSuccess
//     );
//
//     function AjaxSuccess(data) {
//         if (data == 'news_update_success') {
//             $(".relat_box_news_" + $id_news).hide();
//             if($status == 2){
//                 window.location.href = "/admin/news";
//             }
//
//             // $(this).closest(".relat_box").remove();
//         }
//     }
// }
//
// function AjaxSendStatusLeaderDouble($checked, $id, $id_user, $type){
//     $.post(
//         '/ajax/doubles/check_status_double',
//         {
//             id: $id,
//             checked: $checked,
//             type: $type,
//         },
//         AjaxSuccess
//     );
//
//     function AjaxSuccess(data) {
//         if (data == 'leader_double_success') {
//             $(".relat_box_leader_" + $id_user).hide();
//         }
//     }
// }
//
// function AjaxSendStatusProject($checked, $id_proj){
//     $.post(
//         '/ajax/general/check_status',
//         {
//             id_proj: $id_proj,
//             checked: $checked,
//         },
//         AjaxSuccess
//     );
//
//     function AjaxSuccess(data) {
//         if (data == 'project_update_success') {
//             $(".relat_box_project_" + $id_proj).hide();
//             $("#result_status").html('Ваши изменения сохранены!');
//         }
//     }
// }
//
// function AjaxSendStatusLeaderRecommend($checked, $id_lid_recom, $user_id, $exist='0', $direction = ''){
//     $.post(
//         '/ajax/general/check_status',
//         {
//             id_lid_recom:  $id_lid_recom,
//             user_id:       $user_id,
//             exist:         $exist,
//             checked:       $checked,
//             direction:     $direction,
//         },
//         AjaxSuccess
//     );
//
//     function AjaxSuccess(data) {
//         if (data == 'recom_update_success') {
//             $(".relat_box_leader_" + $user_id + '_' + $id_lid_recom).hide();
//         }
//         // else{
//         //     alert(data);
//         // }
//     }
// }
//
// function delete_leader($del_lid_id){
//     $.post(
//         '/ajax/leaders/delete_leader',
//         {
//             del_lid_id: $del_lid_id,
//         },
//         AjaxSuccess
//     );
//
//     function AjaxSuccess(data) {
//         if (data == "leader_deleted_admin") {
//             $('.menu_edit').html('<h2>РЕДАКТИРОВАНИЕ ПРОЕКТА</h2><p class="del_btn_abs">Лидер успешно удален!</p>');
//             $("#back_link").attr("href", "javascript:history.go(-2)");
//         }if (data == "leader_deleted_user") {
//             $('.menu_edit').html('<h2>РЕДАКТИРОВАНИЕ ПРОЕКТА</h2><p class="del_btn_abs">Лидер успешно удален!</p>');
//             $("#back_link").attr("href", "javascript:history.go(-2)");
//         }
//         // else{
//         //     alert(data);
//         // }
//     }
// }
//
// function delete_project($del_proj_id){
//     $.post(
//         '/ajax/projects/delete_project',
//         {
//             del_proj_id: $del_proj_id,
//         },
//         AjaxSuccess
//     );
//
//     function AjaxSuccess(data) {
//         if (data == "project_deleted_admin") {
//             $('.menu_edit').html('<h2>РЕДАКТИРОВАНИЕ ПРОЕКТА</h2><p class="del_btn_abs">Проект успешно удален!</p>');
//             $("#back_link").attr("href", "javascript:history.go(-2)");
//         }if (data == "project_deleted_user") {
//             $('.menu_edit').html('<h2>РЕДАКТИРОВАНИЕ ПРОЕКТА</h2><p class="del_btn_abs">Проект успешно удален!</p>');
//             $("#back_link").attr("href", "javascript:history.go(-2)");
//             window.location.href = "/user/";
//         }
// //                    else{
// //                        alert(data);
// //                    }
//     }
// }
//
//
//
//
//
// $('#sortpicture').on('change', function() {
//     $('#progressbar').css('display', 'block');
//     //$('#add_lid_btn').attr('disabled',true);
//     //$('#edit_lid_btn').attr('disabled',true);
//     //$('#save_btn').attr('disabled',true);
//     var progressBar = $('#progressbar');
//     var file_data = $('#sortpicture').prop('files')[0];
//     var form_data = new FormData();
//     form_data.append('file', file_data);
//     $.ajax({
//         url: '/ajax/general/upload_img',
//         dataType: 'json',
//         cache: false,
//         contentType: false,
//         processData: false,
//         data: form_data,
//         type: 'post',
//         xhr: function(){
//             var xhr = $.ajaxSettings.xhr(); // получаем объект XMLHttpRequest
//             xhr.upload.addEventListener('progress', function(evt){ // добавляем обработчик события progress (onprogress)
//                 if(evt.lengthComputable) { // если известно количество байт
//                     // высчитываем процент загруженного
//                     var percentComplete = Math.ceil(evt.loaded / evt.total * 100);
//                     // устанавливаем значение в атрибут value тега <progress>
//                     // и это же значение альтернативным текстом для браузеров, не поддерживающих <progress>
//                     progressBar.val(percentComplete).text('Загружено ' + percentComplete + '%');
//                 }
//             }, false);
//             return xhr;
//         },
//         success: function(json){
//             if(json){
//                 $('#preview').html(json);
//                 $('#progressbar').css('display', 'none');
//                 //$('#add_lid_btn').removeAttr('disabled');
//                 //$('#edit_lid_btn').removeAttr('disabled');
//                 // $('#save_btn').removeAttr('disabled');
//             }
//         }
//     });
// });
//
// function recoverRecommend_Yes($leader){
//     $.post(
//         '/ajax/recommends/recover_recommend',
//         {
//             leader: $leader,
//         },
//         AjaxSuccess
//     );
//
//     function AjaxSuccess(data) {
//         if (data == "success") {
//             $('.recommend_result').html('<p>Ваша рекомендация успешно восстановлена!</p><p><a href="/user/recommend">Перейти к рекомендациям</a></p>');
//         }
//         // else{
//         //     alert(data);
//         // }
//     }
// }
//
// function recoverRecommend_No(){
//     $('.recommend_result').html('<p>Вы уже рекомендовали данного лидера.</p><p><a href="/user/recommend">Перейти к рекомендациям</a></p>');
// }
//
// function changeVisibility(){
//     $.post(
//         '/ajax/user/change_visibility',
//         {
//             check: $('input[name=visible]:checked').val()
//         },
//         AjaxSuccess
//     );
//
//     function AjaxSuccess(data) {
//         if (data == "success") {
//             $('#save_private').css('display', 'none')
//             $('#myModal4').modal('show');
//         }
//         // else{
//         //     alert(data);
//         // }
//     }
// }
//
//
//
// function AjaxSendStatusLeaderRecomDelete($id, $id_lid){
//     $.post(
//         '/ajax/admin/check_delete_recom',
//         {
//             user:     $id,
//             leader:    $id_lid,
//         },
//         AjaxSuccess
//     );
//
//     function AjaxSuccess(data) {
//         if (data == 'leader_recom_success') {
//             // $(".relat_box_leader_" + $id_lid).hide();
//             // $("#result_status").html('Ваши изменения сохранены!');
//             $(".relat_box_leader_" + $id + "_" + $id_lid).hide();
//         }
//     }
// }
//
// function AjaxSendPost($numpage = 1) {
//     $.post(
//         '/projects',
//         {
//             age: $('#age').val(),
//             predmet: $('#predmet').val(),
//             metapredmet: $('#metapredmet').val(),
//             title: $('#title').val(),
//             city: $('#city').val(),
//             count_on_page: $('#count_on_page').val(),
//             numpage: $numpage,
//         },
//         AjaxSuccess
//     );
//
//     function AjaxSuccess(data) {
//         $('#content-main').html(data);
//     }
// }
// function AjaxSendPostRefresh($numpage = 1) {
//     $.post(
//         '/projects',
//         {
//             age: 'all',
//             predmet: 'all',
//             metapredmet: 'all',
//             title: 'all',
//             city: $('#city').val(),
//             count_on_page: $('#count_on_page').val(),
//             numpage: $numpage,
//         },
//         AjaxSuccess
//     );
//
//     function AjaxSuccess(data) {
//         $('#content-main').html(data);
//     }
// }
// function AjaxSendPostRecom($numpage = 1) {
//     $.post(
//         '/admin/recommends',
//         {
//             filter:  $('#filter_recommend').val(),
//             numpage: $numpage,
//         },
//         AjaxSuccess
//     );
//
//     function AjaxSuccess(data) {
//         $('#content-main').html(data);
//     }
// }
//
// function AjaxSendPostTag($type = '', $numpage = 1) {
//     $.post(
//         '/admin/tags',
//         {
//             tag: $('#tag').val(),
//             type: $type,
//             condition: $('#condition_filter').val(),
//             count_on_page: $('#count_on_page').val(),
//             numpage: $numpage,
//         },
//         AjaxSuccess
//     );
//
//     function AjaxSuccess(data) {
//         $('#content-main').html(data);
//     }
// }
// function AjaxSendPostNewProject($type = '', $numpage = 1) {
//     $.post(
//         '/admin/projects',
//         {
//             project: $('#project').val(),
//             type: $type,
//             status: $('#status_filter').val(),
//             condition: $('#condition_filter').val(),
//             count_on_page: $('#count_on_page').val(),
//             numpage: $numpage,
//         },
//         AjaxSuccess
//     );
//
//     function AjaxSuccess(data) {
//         $('#content-main').html(data);
//     }
// }
// function AjaxSendPostNewLeader($type = '', $numpage = 1) {
//     $.post(
//         '/admin/leaders',
//         {
//             leader: $('#leader').val(),
//             type: $type,
//             status: $('#status_filter').val(),
//             condition: $('#condition_filter').val(),
//             count_on_page: $('#count_on_page').val(),
//             numpage: $numpage,
//         },
//         AjaxSuccess
//     );
//
//     function AjaxSuccess(data) {
//         $('#content-main').html(data);
//     }
// }
//
//
// function AjaxSendPostNewDoubles($type = '', $numpage = 1) {
//     $.post(
//         '/admin/doubles',
//         {
//             condition: $('#condition_filter').val(),
//             type: $type,
//             count_on_page: $('#count_on_page').val(),
//             numpage: $numpage,
//         },
//         AjaxSuccess
//     );
//
//     function AjaxSuccess(data) {
//         $('#content-main').html(data);
//     }
// }
//
//
// function AjaxSendPostNewRecommend($type = '', $numpage = 1) {
//     $.post(
//         '/admin/recommends',
//         {
//             to_recommend: $('#to_recommend').val(),
//             type: $type,
//             from_recommend: $('#from_recommend').val(),
//             condition: $('#condition_filter').val(),
//             count_on_page: $('#count_on_page').val(),
//             numpage: $numpage,
//         },
//         AjaxSuccess
//     );
//
//     function AjaxSuccess(data) {
//         $('#content-main').html(data);
//     }
// }
//
// function isChecked($checkbox) {
//     if($($checkbox).is(":checked")) {
//         return '1';
//     }else{
//         return '0';
//     }
// }
//
// function AjaxSendAddProject() {
//     $.post(
//         '/ajax/projects/add_projects',
//         {
//             project_title: $('#project_title').val(),
//             short_title: $('#short_title').val(),
//             project_description: $('#project_description').val(),
//             site: $('#site').val(),
//             id_lid: $('#id_lid').val(),
//
//             'metapredmets[business]': isChecked("input#business"),
//             'metapredmets[engineer]': isChecked("input#engineer"),
//             'metapredmets[eq]': isChecked("input#eq"),
//             'metapredmets[it_prof]': isChecked("input#it_prof"),
//             'metapredmets[personal]': isChecked("input#personal"),
//             'metapredmets[proforient]': isChecked("input#proforient"),
//
//             'predmets[arts]': isChecked("input#arts"),
//             'predmets[lingvistic]': isChecked("input#lingvistic"),
//             'predmets[pedagogy]': isChecked("input#pedagogy"),
//             'predmets[sport]': isChecked("input#sport"),
//             'predmets[social]': isChecked("input#social"),
//             'predmets[techno]': isChecked("input#techno"),
//             'predmets[naturall]': isChecked("input#naturall"),
//
//             'ages[r_00_07]': isChecked("input#r_00_07"),
//             'ages[r_12_15]': isChecked("input#r_12_15"),
//             'ages[r_16_18]': isChecked("input#r_16_18"),
//             'ages[r_19_25]': isChecked("input#r_19_25"),
//             'ages[r_08_11]': isChecked("input#r_08_11"),
//             'ages[r_all_life]': isChecked("input#r_all_life"),
//             'ages[r_others]': isChecked("input#r_others"),
//             'ages[r_parents]': isChecked("input#r_parents"),
//             'ages[r_teachers]': isChecked("input#r_teachers"),
//             leaders_photo: $('.leaders_photo').attr('src'),
//
//             method: $('#method').val(),
//             author: $('#author').val(),
//             'level[first_level]': isChecked("input#first_level"),
//             'level[second_level]': isChecked("input#second_level"),
//             'level[third_level]': isChecked("input#third_level"),
//             filial: $('#filial').val(),
//             stage_of_project: $('#stage_of_project').val(),
//             author_location: $('#author_location').val(),
//             start_year: $('#start_year').val(),
//             offline_geography: $('#offline_geography').val(),
//
//             'leader0[fio]': $('#fio0').val(),
//             'leader1[fio]': $('#fio1').val(),
//             'leader2[fio]': $('#fio2').val(),
//             'leader3[fio]': $('#fio3').val(),
//             'leader4[fio]': $('#fio4').val(),
//
//             'leader0[role]': $('#role0').val(),
//             'leader1[role]': $('#role1').val(),
//             'leader2[role]': $('#role2').val(),
//             'leader3[role]': $('#role3').val(),
//             'leader4[role]': $('#role4').val(),
//
//             'file0[name]': $('#preview_file_0').val(),
//             'file1[name]': $('#preview_file_1').val(),
//             'file2[name]': $('#preview_file_2').val(),
//             'file3[name]': $('#preview_file_3').val(),
//             'file4[name]': $('#preview_file_4').val(),
//
//             'file0[description]': $('#description0').val(),
//             'file1[description]': $('#description1').val(),
//             'file2[description]': $('#description2').val(),
//             'file3[description]': $('#description3').val(),
//             'file4[description]': $('#description4').val(),
//
//             'leader0[start_year]': $('#start_year_lid_0').val(),
//             'leader1[start_year]': $('#start_year_lid_1').val(),
//             'leader2[start_year]': $('#start_year_lid_2').val(),
//             'leader3[start_year]': $('#start_year_lid_3').val(),
//             'leader4[start_year]': $('#start_year_lid_4').val(),
//
//             'leader0[end_year]': $('#end_year_lid_0').val(),
//             'leader1[end_year]': $('#end_year_lid_1').val(),
//             'leader2[end_year]': $('#end_year_lid_2').val(),
//             'leader3[end_year]': $('#end_year_lid_3').val(),
//             'leader4[end_year]': $('#end_year_lid_4').val(),
//
//         },
//         AjaxSuccess
//     );
//
//     function AjaxSuccess(data) {
//         //alert(data);
//         if (data == "success_user") {
//             $('.save_project').remove();
//             $('#myModal').modal('show');
//             javascript:history.back();
//         }
//         if (data == "success_admin") {
//             $('.save_project').remove();
//             $('#myModal').modal('show');
//             javascript:history.back();
//         }
//         if(data == "empty"){
//             $('#myModal3').modal('show');
//         }
//
//         // else{
//         //     $('#result_public').html(data);
//         // }
//     }
// }
//
// function AjaxSendAddLeader($type = '') {
//     $.post(
//         '/ajax/leaders/add_leader',
//         {
//             familya: $('#familya').val(),
//             type: $type,
//             name: $('#name').val(),
//             otchestvo: $('#otchestvo').val(),
//             city: $('#city').val(),
//             telephone: $('#telephone').val(),
//             project: $('#project').val(),
//             email: $('#email').val(),
//             region: $('#region').val(),
//             birthday: $('#birthday').val(),
//             social: $('#social').val(),
//             contact_info: $('#contact_info').val(),
//             reason: $('#reason').val(),
//             i_can: $('#i_can').val(),
//             i_need: $('#i_need').val(),
//             id_lid: $('#id_lid').val(),
//             leaders_photo: $('.leaders_photo').attr('src'),
//             male_female: $('#male_female').val(),
//
//             'file0[name]': $('#preview_file_0').val(),
//             'file1[name]': $('#preview_file_1').val(),
//             'file2[name]': $('#preview_file_2').val(),
//             'file3[name]': $('#preview_file_3').val(),
//             'file4[name]': $('#preview_file_4').val(),
//
//             'file0[description]': $('#description0').val(),
//             'file1[description]': $('#description1').val(),
//             'file2[description]': $('#description2').val(),
//             'file3[description]': $('#description3').val(),
//             'file4[description]': $('#description4').val(),
//
//             'project0[project_title]': $('#fio0').val(),
//             'project1[project_title]': $('#fio1').val(),
//             'project2[project_title]': $('#fio2').val(),
//             'project3[project_title]': $('#fio3').val(),
//             'project4[project_title]': $('#fio4').val(),
//
//             'project0[role]': $('#role0').val(),
//             'project1[role]': $('#role1').val(),
//             'project2[role]': $('#role2').val(),
//             'project3[role]': $('#role3').val(),
//             'project4[role]': $('#role4').val(),
//
//             'project0[start_year]': $('#start_year_lid_0').val(),
//             'project1[start_year]': $('#start_year_lid_1').val(),
//             'project2[start_year]': $('#start_year_lid_2').val(),
//             'project3[start_year]': $('#start_year_lid_3').val(),
//             'project4[start_year]': $('#start_year_lid_4').val(),
//
//             'project0[end_year]': $('#end_year_lid_0').val(),
//             'project1[end_year]': $('#end_year_lid_1').val(),
//             'project2[end_year]': $('#end_year_lid_2').val(),
//             'project3[end_year]': $('#end_year_lid_3').val(),
//             'project4[end_year]': $('#end_year_lid_4').val(),
//
//             'project0[end_year_input]': $('#checkboxEndYear_0').val(),
//             'project1[end_year_input]': $('#checkboxEndYear_1').val(),
//             'project2[end_year_input]': $('#checkboxEndYear_2').val(),
//             'project3[end_year_input]': $('#checkboxEndYear_3').val(),
//             'project4[end_year_input]': $('#checkboxEndYear_4').val(),
//         },
//         AjaxSuccess
//     );
//
//     function AjaxSuccess(data) {
//         if (data == "success_user") {
//             // $('#result_public').html("Лидер успешно добавлен");
//             $('#myModal').modal('show');
//             $('.save_leader').remove();
//             // window.location.href = "/user";
//         }
//         if (data == "success_admin") {
//             //$('#result_public').html("Лидер успешно добавлен");
//             $('#myModal').modal('show');
//             $('.save_leader').remove();
//             // window.location.href = "/admin";
//         }
//         if(data == "empty fio"){
//             $('#myModal3').modal('show');
//         }
//         if(data == "empty"){
//             $('#myModal3').modal('show');
//         }
//
//         // else{
//         //     $('#result_public').html(data);
//         // }
//
//
//     }
// }
//
//
// function AjaxSendActualRecomUpdate($actual, $id) {
//     $.post(
//         '/ajax/recommends/recom_leader_update_actual',
//         {
//             actual: $actual,
//             id_lid: $id,
//         },
//         AjaxSuccess
//     );
//
//     function AjaxSuccess(data) {
//         if (data == "success_user") {
//             $('#result_public').html("Рекомендация успешно обновлена!");
//             $('#myModal').modal('show');
//             $('#recom_' + $id).css('display', 'none');
//         }
//     }
// }
//
//
// function AjaxSendAddLeaderUpdate($id) {
//
//     $.post(
//         '/ajax/leaders/recom_leader_update',
//         {
//             familya: $('#familya').val(),
//             name: $('#name').val(),
//             city: $('#city').val(),
//             project: $('#project').val(),
//             email: $('#email').val(),
//             social: $('#social').val(),
//             reason: $('#reason').val(),
//             id_lid: $id,
//             leaders_photo: $('.leaders_photo').attr('src'),
//         },
//         AjaxSuccess
//     );
//     function AjaxSuccess(data) {
//         if(data == "empty"){
//             $('#myModal3').modal('show');
//         }
//         if (data == "success_user") {
//             //$('#result_public').html("Рекомендация успешно обновлена!");
//             $('#myModal').modal('show');
//             $('#add_lid_btn').remove();
//             $('#tags').css('display', 'inline');
//             $('#next_recommend').css('display', 'inline');
//         }
//
//         // else{
//         //     $('#result_public').html(data);
//         // }
//
//
//     }
// }
// function AjaxAddLeader() {
//     $.post(
//         '/ajax/projects/add_leader_to_project',
//         {
//             button: 'AddLeader',
//             counter: $('.checkSize').length,
//             leader0: $('.leader0').length,
//             leader1: $('.leader1').length,
//             leader2: $('.leader2').length,
//             leader3: $('.leader3').length,
//             leader4: $('.leader4').length,
//         },
//         AjaxSuccess
//     );
//
//     function AjaxSuccess(data) {
//         $('.content_leader').last().after(data);
//     }
// }
//
// function AjaxAddProject() {
//     $.post(
//         '/ajax/leaders/add_projects_to_leader',
//         {
//             button: 'AddProject',
//             counter: $('.checkSize').length,
//             leader0: $('.leader0').length,
//             leader1: $('.leader1').length,
//             leader2: $('.leader2').length,
//             leader3: $('.leader3').length,
//             leader4: $('.leader4').length,
//         },
//         AjaxSuccess
//     );
//
//     function AjaxSuccess(data) {
//         $('.content_leader').last().after(data);
//     }
// }
//
// function AjaxAddLeaderFile() {
//     $.post(
//         '/ajax/projects/add_leader_file_to_project',
//         {
//             button: 'AddFile',
//             counter: $('.checkSizeFile').length,
//             file0: $('.file0').length,
//             file1: $('.file1').length,
//             file2: $('.file2').length,
//             file3: $('.file3').length,
//             file4: $('.file4').length,
//         },
//         AjaxSuccess
//     );
//
//     function AjaxSuccess(data) {
//         $('.content_leader_file').last().after(data);
//     }
// }
//
// function AjaxSendUpdateLeader($type = '', $status = '3') {
//     $.post(
//         '/ajax/user/edit_user',
//         {
//             id_lid: $('#id_lid').val(),
//             type: $type,
//             familya: $('#familya').val(),
//             name: $('#name').val(),
//             otchestvo: $('#otchestvo').val(),
//             city: $('#city').val(),
//             telephone: $('#telephone').val(),
//             email: $('#email').val(),
//             region: $('#region').val(),
//             birthday: $('#birthday').val(),
//             social: $('#social').val(),
//             contact_info: $('#contact_info').val(),
//             img: $('#photoimg').val(),
//             i_can: $('#i_can').val(),
//             i_need: $('#i_need').val(),
//             leaders_photo: $('.leaders_photo').attr('src'),
//             male_female: $('#male_female').val(),
//
//             'file0[name]': $('#preview_file_0').val(),
//             'file1[name]': $('#preview_file_1').val(),
//             'file2[name]': $('#preview_file_2').val(),
//             'file3[name]': $('#preview_file_3').val(),
//             'file4[name]': $('#preview_file_4').val(),
//
//             'file0[description]': $('#description0').val(),
//             'file1[description]': $('#description1').val(),
//             'file2[description]': $('#description2').val(),
//             'file3[description]': $('#description3').val(),
//             'file4[description]': $('#description4').val(),
//
//             'project0[project_title]': $('#fio0').val(),
//             'project1[project_title]': $('#fio1').val(),
//             'project2[project_title]': $('#fio2').val(),
//             'project3[project_title]': $('#fio3').val(),
//             'project4[project_title]': $('#fio4').val(),
//
//             'project0[role]': $('#role0').val(),
//             'project1[role]': $('#role1').val(),
//             'project2[role]': $('#role2').val(),
//             'project3[role]': $('#role3').val(),
//             'project4[role]': $('#role4').val(),
//
//             'project0[start_year]': $('#start_year_lid_0').val(),
//             'project1[start_year]': $('#start_year_lid_1').val(),
//             'project2[start_year]': $('#start_year_lid_2').val(),
//             'project3[start_year]': $('#start_year_lid_3').val(),
//             'project4[start_year]': $('#start_year_lid_4').val(),
//
//             'project0[end_year]': $('#end_year_lid_0').val(),
//             'project1[end_year]': $('#end_year_lid_1').val(),
//             'project2[end_year]': $('#end_year_lid_2').val(),
//             'project3[end_year]': $('#end_year_lid_3').val(),
//             'project4[end_year]': $('#end_year_lid_4').val(),
//
//             'project0[end_year_input]': $('#checkboxEndYear_0').val(),
//             'project1[end_year_input]': $('#checkboxEndYear_1').val(),
//             'project2[end_year_input]': $('#checkboxEndYear_2').val(),
//             'project3[end_year_input]': $('#checkboxEndYear_3').val(),
//             'project4[end_year_input]': $('#checkboxEndYear_4').val(),
//         },
//         AjaxSuccess
//     );
//
//     function AjaxSuccess(data) {
//         //alert(data);
//         if (data == "success_user") {
//             //$('#result_public').html("Лидер успешно обновлен");
//             $('#save_btn').remove();
//             $('#next_project').css('display', 'inline');
//             $('#myModal').modal('show');
//         }
//         if (data == "success_admin") {
//             $('#result_public').html("Лидер успешно обновлен");
//             $('.save_leader').remove();
//         }
//         if(data == "empty"){
//             $('#myModal3').modal('show');
//         }
//         // else{
//         //     $('#result_public').html(data);
//         // }
//     }
// }
//
//
// function AjaxSendUpdateProject() {
//     $.post(
//         '/ajax/projects/update_project',
//         {
//             id_proj: $('#id_proj').val(),
//             project_title: $('#project_title').val(),
//             short_title: $('#short_title').val(),
//             project_description: $('#project_description').val(),
//             site: $('#site').val(),
//             id_lid: $('#id_lid').val(),
//
//             'metapredmets[business]': isChecked("input#business"),
//             'metapredmets[engineer]': isChecked("input#engineer"),
//             'metapredmets[eq]': isChecked("input#eq"),
//             'metapredmets[it_prof]': isChecked("input#it_prof"),
//             'metapredmets[personal]': isChecked("input#personal"),
//             'metapredmets[proforient]': isChecked("input#proforient"),
//
//             'predmets[arts]': isChecked("input#arts"),
//             'predmets[lingvistic]': isChecked("input#lingvistic"),
//             'predmets[pedagogy]': isChecked("input#pedagogy"),
//             'predmets[sport]': isChecked("input#sport"),
//             'predmets[social]': isChecked("input#social"),
//             'predmets[techno]': isChecked("input#techno"),
//             'predmets[naturall]': isChecked("input#naturall"),
//
//             'ages[r_00_07]': isChecked("input#r_00_07"),
//             'ages[r_12_15]': isChecked("input#r_12_15"),
//             'ages[r_16_18]': isChecked("input#r_16_18"),
//             'ages[r_19_25]': isChecked("input#r_19_25"),
//             'ages[r_08_11]': isChecked("input#r_08_11"),
//             'ages[r_all_life]': isChecked("input#r_all_life"),
//             'ages[r_others]': isChecked("input#r_others"),
//             'ages[r_parents]': isChecked("input#r_parents"),
//             'ages[r_teachers]': isChecked("input#r_teachers"),
//
//             leaders_photo: $('.leaders_photo').attr('src'),
//             method: $('#method').val(),
//             author: $('#author').val(),
//
//             'level[first_level]': isChecked("input#first_level"),
//             'level[second_level]': isChecked("input#second_level"),
//             'level[third_level]': isChecked("input#third_level"),
//             stage_of_project: $('#stage_of_project').val(),
//             author_location: $('#author_location').val(),
//             start_year: $('#start_year').val(),
//             offline_geography: $('#offline_geography').val(),
//             filial: $('#filial').val(),
//
//             'leader0[fio]': $('#fio0').val(),
//             'leader1[fio]': $('#fio1').val(),
//             'leader2[fio]': $('#fio2').val(),
//             'leader3[fio]': $('#fio3').val(),
//             'leader4[fio]': $('#fio4').val(),
//
//             'leader0[role]': $('#role0').val(),
//             'leader1[role]': $('#role1').val(),
//             'leader2[role]': $('#role2').val(),
//             'leader3[role]': $('#role3').val(),
//             'leader4[role]': $('#role4').val(),
//
//             'file0[name]': $('#preview_file_0').val(),
//             'file1[name]': $('#preview_file_1').val(),
//             'file2[name]': $('#preview_file_2').val(),
//             'file3[name]': $('#preview_file_3').val(),
//             'file4[name]': $('#preview_file_4').val(),
//
//             'file0[description]': $('#description0').val(),
//             'file1[description]': $('#description1').val(),
//             'file2[description]': $('#description2').val(),
//             'file3[description]': $('#description3').val(),
//             'file4[description]': $('#description4').val(),
//
//             'leader0[start_year]': $('#start_year_lid_0').val(),
//             'leader1[start_year]': $('#start_year_lid_1').val(),
//             'leader2[start_year]': $('#start_year_lid_2').val(),
//             'leader3[start_year]': $('#start_year_lid_3').val(),
//             'leader4[start_year]': $('#start_year_lid_4').val(),
//
//             'leader0[end_year]': $('#end_year_lid_0').val(),
//             'leader1[end_year]': $('#end_year_lid_1').val(),
//             'leader2[end_year]': $('#end_year_lid_2').val(),
//             'leader3[end_year]': $('#end_year_lid_3').val(),
//             'leader4[end_year]': $('#end_year_lid_4').val(),
//
//         },
//         AjaxSuccess
//     );
//
//     function AjaxSuccess(data) {
//         if (data == "success_user") {
//             //$('#result_public').html("Проект успешно обновлен");
//             $('#myModal2').modal('show');
//             $('#project_send_public').remove();
//             $('#next_project').css('display', 'inline');
//             $('#next_recommend').css('display', 'inline');
//         }
//         if (data == "success_admin") {
//             $('.save_project').remove();
//             //$('#result_public').html("Проект успешно обновлен");
//             $('#myModal2').modal('show');
//         }
//         if(data == "empty"){
//             $('#myModal3').modal('show');
//         }
//         // else{
//         //     $('#result_public').html(data);
//         // }
//     }
// }
//
// function AjaxSendUpdateNews() {
//     $.post(
//         '/ajax/news/update_news',
//         {
//             title: $('#titleNews').val(),
//             id_news: $('#id_news').val(),
//             prev_content: $('#prev_content').val(),
//             content: $('#contentNews').val(),
//             image: $('.leaders_photo').attr('src')
//         },
//         AjaxSuccess
//     );
//
//     function AjaxSuccess(data) {
//         if (data == "success") {
//             $('#myModal2').modal('show');
//             javascript:history.back();
//         }
//         // else{
//         //     $('#result_public').html(data);
//         // }
//     }
// }
//
// function AjaxSendCreateNews() {
//     $.post(
//         '/ajax/news/create_news',
//         {
//             title: $('#titleNews').val(),
//             prev_content: $('#prev_content').val(),
//             content: $('#contentNews').val(),
//             image: $('.leaders_photo').attr('src')
//         },
//         AjaxSuccess
//     );
//
//     function AjaxSuccess(data) {
//         if (data == "success") {
//             $('#result_public').html("Новость успешно опубликована!");
//         }else{
//             $('#result_public').html(data);
//         }
//     }
// }
//
//
// function AjaxSendPostLeaders($numpage = 1) {
//     $.post(
//         '/leaders',
//         {
//             filter_leaders: $('#filter_leaders').val(),
//             filter_leaders_city: $('#filter_leaders_city').val(),
//             count_on_page: $('#count_on_page').val(),
//             numpage: $numpage,
//         },
//         AjaxSuccess
//     );
//
//     function AjaxSuccess(data) {
//         $('#content-main').html(data);
//     }
// }
//
// function AjaxSendPostNews($numpage = 1) {
//     $.post(
//         '/news',
//         {
//             numpage: $numpage,
//         },
//         AjaxSuccess
//     );
//
//     function AjaxSuccess(data) {
//         $('#content-main').html(data);
//     }
// }
//
// function AjaxSendPostNewsViewAdmin($numpage = 1) {
//     $.post(
//         '/admin/news',
//         {
//             numpage: $numpage,
//         },
//         AjaxSuccess
//     );
//
//     function AjaxSuccess(data) {
//         $('#content-main').html(data);
//     }
// }
//
//
// function AjaxSendPostNewsDeletedAdmin($numpage = 1) {
//     $.post(
//         '/admin/news/deleted',
//         {
//             numpage: $numpage,
//         },
//         AjaxSuccess
//     );
//
//     function AjaxSuccess(data) {
//         $('#content-main').html(data);
//     }
// }
//
// function AjaxSendPostLeadersCity($numpage = 1) {
//     $.post(
//         '/leaders',
//         {
//             filter_leaders: 'all',
//             filter_leaders_city: $('#filter_leaders_city').val(),
//             numpage: $numpage,
//         },
//         AjaxSuccess
//     );
//
//     function AjaxSuccess(data) {
//         $('#content-main').html(data);
//     }
// }
//
// function getDataUserDoubles() {
//     $.post(
//         '/ajax/doubles/get_data_doubles',
//         {
//             data_doubles: $('#dataUserDoubles').val(),
//         },
//         AjaxSuccess
//     );
//
//     function AjaxSuccess(data) {
//         $('#ajax_info_user').html(data);
//     }
// }
//
// function getDataLeaderDoubles() {
//     $.post(
//         '/ajax/doubles/get_data_doubles',
//         {
//             data_doubles: $('#dataLeaderDoubles').val(),
//         },
//         AjaxSuccess
//     );
//
//     function AjaxSuccess(data) {
//         $('#ajax_info_leader').html(data);
//     }
// }
//
// function AjaxSendConnectLeaderDouble() {
//     $.post(
//         '/ajax/doubles/add_data_doubles',
//         {
//             data_doubles_user: $('#dataUserDoubles').val(),
//             data_doubles_leader: $('#dataLeaderDoubles').val(),
//         },
//         AjaxSuccess
//     );
//
//     function AjaxSuccess(data) {
//         if (data == 'leader_double_success') {
//             $('#success_send_data').html('Профили успешно привязаны!');
//             $('#success_send_data_ok').css('display', 'none');
//             $('#success_send_data_again').css('display', 'inline');
//             $( "#dataUserDoubles" ).prop( "disabled", true );
//             $( "#dataLeaderDoubles" ).prop( "disabled", true );
//
//         }
//     }
// }
//
// function AjaxSendConnectLeaderRecommend() {
//     $.post(
//         '/ajax/recommends/add_data_recommend',
//         {
//             data_recommend_user: $('#dataUserDoubles').val(),
//             data_recommend_leader: $('#dataLeaderDoubles').val(),
//             data_reason: $('#reason_add_recom_admin').val(),
//         },
//         AjaxSuccess
//     );
//
//     function AjaxSuccess(data) {
//         if (data == 'leader_recom_success') {
//             $('#success_send_data').html('Рекомендация успешно добавлена!');
//             $('#success_send_data_ok').css('display', 'none');
//             $('#success_send_data_again').css('display', 'inline');
//             $( "#dataUserDoubles" ).prop( "disabled", true );
//             $( "#dataLeaderDoubles" ).prop( "disabled", true );
//         }
//         if (data == 'double') {
//             $('#success_send_data').html('Данная рекомендация уже существует!');
//         }
//     }
// }
//
//
//
// function AjaxSendPostTagEdit($id, $new='') {
//     $.post(
//         '/ajax/admin/edit_tag',
//         {
//             id_tag:   $id,
//             name_tag: $('#name_tag_' + $id).val(),
//             want_tag: $('#want_tag_' + $id).val(),
//             need_tag: $('#need_tag_' + $id).val(),
//             new: $new,
//         },
//         AjaxSuccess
//     );
//
//     function AjaxSuccess(data) {
//         if (data == 'success') {
//             if($new == ''){
//                 $name = $('#name_tag_' + $id).val();
//                 $want = $('#want_tag_' + $id).val();
//                 $need = $('#need_tag_' + $id).val();
//                 $('#name_tag_' + $id + '_name').html($name);
//                 $('#name_tag_' + $id + '_want').html($want);
//                 $('#name_tag_' + $id + '_need').html($need);
//                 $("#tag_" + $id + "_edit").css('display', 'none');
//                 $("#tag_" + $id).css('display', '');
//             }else{
//                 $("#tag_" + $id + "_edit").css('display', 'none');
//                 $("#tag_" + $id).css('display', 'none');
//             }
//
//         }
//     }
// }
//
// function AjaxSendAddTagAdmin() {
//     $.post(
//         '/ajax/admin/add_tag',
//         {
//             name_tag: $('#name_tag_new').val(),
//             want_tag: $('#want_tag_new').val(),
//             need_tag: $('#need_tag_new').val(),
//         },
//         AjaxSuccess
//     );
//
//     function AjaxSuccess(data) {
//         if (data == 'success') {
//             $('#result_status_new_tag').html('<span style="color: green">Тег успешно добавлен!</span>');
//             $('#name_tag_new').val('');
//             $('#want_tag_new').val('');
//             $('#need_tag_new').val('');
//         }
//         if (data == 'error') {
//             $('#result_status_new_tag').html('<span style="color: red">Все поля обязательны для заполнения!</span>');
//         }
//     }
// }
//
// function AjaxSendTagAdminStatus($id, $checked) {
//     $.post(
//         '/ajax/admin/status_tag',
//         {
//             id_tag:   $id,
//             checked:   $checked,
//         },
//         AjaxSuccess
//     );
//
//     function AjaxSuccess(data) {
//         if (data == 'success') {
//             $("#tag_" + $id).css('display', 'none');
//         }
//         if (data == 'exist') {
//             $('#myModal_error').modal('show');
//         }
//     }
// }
//
