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