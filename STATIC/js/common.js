

function newAlert(text){
    Swal.fire({
      text: text,
      showCancelButton: false,
      confirmButtonColor: '#4dac27',
      confirmButtonText: '확인',
    });
}

function showSwalAlert(message, confirmButtonText, confirmCallback, ...args) {
    Swal.fire({
        text: message,
        confirmButtonColor: '#4dac27',
        confirmButtonText: confirmButtonText,
    }).then((result) => {
        if (result.isConfirmed) {
            confirmCallback(...args);
        }
    });
}


function chkSwalAlert(message,confirmCallback, ...args){
	Swal.fire({
	  	text: message,
	  	showCancelButton: true,
	  	confirmButtonColor: '#4dac27',
	  	cancelButtonColor: '#767676',
	  	confirmButtonText: '확인',
	  	cancelButtonText: '취소',
	}).then((result) => {
	  	if (result.isConfirmed) {
	   		confirmCallback(...args);
	  	} else if (result.dismiss === Swal.DismissReason.cancel) {
	    // Swal.fire('취소', '작업이 취소되었습니다.', 'error');
	    // 여기에 취소 버튼을 눌렀을 때의 동작을 추가할 수 있습니다.
	  	}
	});
}
// /* custom selector */
// function CustomSelectBox(selector){
//     this.$selectBox = null,
//     this.$select = null,
//     this.$list = null,
//     this.$listLi = null;
//     CustomSelectBox.prototype.init = function(selector){
//         this.$selectBox = $(selector);
//         this.$select = this.$selectBox.find('.box__ .select__');
//         this.$list = this.$selectBox.find('.box__ .list__');
//         this.$listLi = this.$list.children('li');
//     }
//     CustomSelectBox.prototype.initEvent = function(e){
//         var that = this;
//         this.$select.on('click', function(e){
//             that.listOn();
//             e.preventDefault();
// 			e.stopPropagation();
//         });
//         this.$listLi.on('click', function(e){
//             that.listSelect($(this));
//             e.preventDefault();
// 			e.stopPropagation();
//         });
//         $(document).on('click', function(e){
//             that.listOff($(e.target));
//         });
//     }
//     CustomSelectBox.prototype.listOn = function(){
//         this.$selectBox.toggleClass('on');
//         // if(this.$selectBox.hasClass('on')){
//         //     this.$list.show(100);
//         // }else{
//         //     this.$list.hide(100);
//         // };
//     }
//     CustomSelectBox.prototype.listSelect = function($target){
//         $target.addClass('selected').siblings('li').removeClass('selected');
//         this.$selectBox.removeClass('on');
//         this.$selectBox.find('.holder').removeClass('holder');

//        	// select 
//         this.$select.find('.text').text($target.find('.text').text());
//     }
//     CustomSelectBox.prototype.listOff = function($target){
//         if(!$target.is(this.$select) && this.$selectBox.hasClass('on')){
//             this.$selectBox.removeClass('on');
//         };
//     }
//     this.init(selector);
//     this.initEvent();
// }

// $( function(){

// 	// 전체 메뉴
// 	$('.menu_all').click( function(){
// 		$('.menu_all_area').toggleClass('active');
// 	});

// 	// 모바일 메뉴
// 	$('.m_trigger').click( function(){
// 		$('#header .side_area').toggleClass('active');
// 	});

// 	// 모바일 검색
// 	$('.searchBtn').click( function(){
// 		$('#header .search_area').toggleClass('active');
// 	});

// 	// 모바일 검색 & 메뉴 닫기
// 	$('#header .close').click( function(){
// 		$('#header').find('.active').removeClass('active');
// 	});

// 	// 모바일 드롭다운
// 	$('.menu_area .title').click( function(){
// 		var $target = $(this).parent();
// 		var depth = $target.find('.depth');
// 		 $target.toggleClass('active');
// 		 if($target.hasClass('active')){
// 		 	depth.slideDown(300);
// 		 } else {
// 		 	depth.slideUp(300);
// 		 }
// 	});

// })