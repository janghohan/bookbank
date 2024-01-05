
var modalDialog = {
    timer : 300,
    confirm : function(id, callback){
        if(callback == null || typeof callback != 'function'){
            console.log("callback is null or not function.");
            return;
        }else{
        	if(id == null || id.trim() == ""){
	            console.log("not property is "+ id);
	            return;
	        }else{
	            $(".modal-content .submit").off('click').on("click", function(){
	                //$(this).unbind("click");
	                modalDialog.close(this);
	                callback(true);
	            });
	            this.open(id);
	        }
        }
    },

    alert : function(id){
        if(id == null || id.trim() == ""){
            console.log("confirm message is empty.");
            return;
        }else{
            this.open(id);
        }
    },

    open : function(id){
    	var modal = $('.modal-dialog');
        var popup = modal.find(id);
        var dimLayer = popup.closest('.modal-dialog').find('.dim');

        popup.closest('.modal-dialog').fadeIn(this.timer);
        dimLayer.fadeIn(this.timer);
        popup.fadeIn(this.timer);
    },

    close: function (target) {
        var modal = $(target).closest(".modal-dialog");
        var modal_content = modal.find('.modal-content');

        var dimLayer = modal.find('.dim');

        modal.fadeOut(this.timer);
        modal_content.fadeOut(this.timer);
        dimLayer.fadeOut(this.timer);
    }
};

function ModalConfirm(target, callback){
    modalDialog.confirm(target, callback);
}


$( function (){
	$(".modal-dialog .closer").on("click", function () {
        modalDialog.close(this);
    });
    $(".modal-dialog .cancle").on("click", function () {
        modalDialog.close(this);
    });
});



/* confirm
function modalConfirm(){
    modalDialog.confirm('취소 / 환불 요청하시겠습니까?', function(res) {
        if(res){
            modalDialog.alert('orderCancle');
        } else {
            modalDialog.confirmMsg('요청실패!');
        }

    });
}
*/

/* alert msg
    modalDialog.alert(obj key);
    obj = alert_mag;
*/

/*  html 
    <div class="modal-dialog">
        <div class="modal-content alert-msg">
            <div class="content">
                <div class="msg"></div>
            </div>
            <div class="btn btn100 modal_close closer">확인</div>
        </div>
    </div>

    <div class="modal-dialog">
        <div class="modal-content alert-confirm">
            <div class="content table_content">
                <div class="msg">취소 / 환불 요청하시겠습니까?</div>
            </div>
            <div class="btn_box">
                <div class="btn modal_close closer">취소</div>
                <div class="btn submit">보내기</div>
            </div>
        </div>
    </div>

*/