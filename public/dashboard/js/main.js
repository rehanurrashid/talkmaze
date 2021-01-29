$(function(){
    $("#form-total").steps({
        bodyTag: "section",
        transitionEffect: "fade",
        enableAllSteps: true,
        autoFocus: true,
        transitionEffectSpeed: 300,
        titleTemplate : '<span class="title">#title#</span>',
        labels: {
            previous : 'ffff',
            next : 'Next Step',
            finish : ' YES',
            current : ''
        },
        onFinished: function () {
            $.ajax({
                url:'user/request',
                method:'POST',
                data:{
                    'why_would_you_like_to_be_matched_with_a_coach':$('#message-text').val(),
                    'experience_of_public_speaking':$('#message-text').val(),
                    'do_you_have_access_to_a_webcam_and_mic':1,
                    '_token':$('#csrf').val()
                },
                success:function(data){
                    if(data) {
                        window.location.replace('https://talkmaze.com/talkmaze_test/tutor-list/'+data.id);
                    }
                },
                error:function (error) {
                    $('#gotopay').attr("href", "https://talkmaze.com/talkmaze_test/private-coaching?redirect=dashboard&data_id="+error.responseJSON.id);
                    $("#form-total").hide();
                    $("#lastmodal").show();
                }
            })
        }
    });
});


