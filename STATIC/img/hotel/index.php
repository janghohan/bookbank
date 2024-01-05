<?php 
include '../dbConnect.php';

$adType = $_GET['adtype'];

?>
<!DOCTYPE html>
<html lang="ko" style="overflow-x: hidden;">
    <head>
		<!-- Google Tag Manager -->
		<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
		new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
		j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
		'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
		})(window,document,'script','dataLayer','GTM-PXT9VXHB');</script>
		<!-- End Google Tag Manager -->

		<!-- Google Tag Manager (noscript) -->
		<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-PXT9VXHB"
		height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
		<!-- End Google Tag Manager (noscript) -->
		
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1, user-scalable=0" >

        <title>비트랩</title>
        <meta name="robots" content="noindex /">
        <meta name="format-detection" content="telephone=no" />
        <meta property="og:title" content="비트랩" />
        <meta property="og:image:type" content="image/jpeg"/>
        <meta property="og:image:width" content="413"/>
        <meta property="og:image:height" content="207"/>
        <meta property="og:description" content=""/>
        <meta property="og:keywords" content="">
<!--         <link rel=" shortcut icon" href="img/favicon.ico"> -->
        <link rel="icon" href="img/favicon.ico">
        <link rel="stylesheet" href="./css/main.css">


    </head>
    <body>
        <div id="wrap">
            <section id="section1">
                <div class="content">
                    <img class="pc_div" src="./image/PC_20231127.jpg" alt="">
                    <img class="mob_div" src="./image/MOB_20231127.jpg" alt="">
                </div>
            </section>
            <section id="section2">
                <div class="title">
                    <img src="./image/img2-title.png">
                </div>
                <form action="./db_ok.php" method="post" id="form" >
                    <input type="hidden" name="mode" value="apply">
                    <input type="hidden" name="adType" value="<?=$adType?>">
                    <div class="inputBox">
                        <span>이름</span>
                        <div class="row1">
                            <input type="text" name="name" >
                        </div>
                    </div>
                    <div class="inputBox">
                        <span>연락처</span>
                        <div class="row1">
                            <input type="tel" name="number"  minlength="11" maxlength="11" id="tel_num">
                        </div>
                    </div>
                    <div class="info">
                        <div class="check">
                            <input type="checkbox" id="agree1" checked="true"> <label for="agree1">(필수)이벤트 참여 동의<a href="">[보기]</a></label>
                        </div>
                        <div class="check">
                            <input type="checkbox" id="agree2"  checked="true"> <label for="agree2">(필수)마케팅 정보 수신 동의<a href="">[보기]</a></label>
                        </div>
                    </div>
                    <div class="btnBox">
                        <img src="./image/highupNew_btn.png" class="submit">
                    </div>
                </form>
                
            </section>
            <!-- <section id="section3">
                <div class="content">
                    <img class="pc_div" src="./image/2.jpg" alt="">
                    <img class="mob_div" src="./image/mob2.jpg" alt="">
                </div>
            </section>
            <section id="section4">
                <div class="content">
                    <img class="pc_div" src="./image/3.jpg" alt="">
                    <img class="mob_div" src="./image/mob3.jpg" alt="">
                </div>
            </section>
            <section id="section5">
                <div class="content">
                    <img class="pc_div" src="./image/4.jpg" alt="">
                    <img class="mob_div" src="./image/mob4.jpg" alt="">
                </div>
            </section> -->
            <div class="footer">
                <div class="inner">
                    <div class="info">
                        본 사이트에서 제공되는 모든 정보는 투자판단의 참고자료이며, 서비스 이용에 따른 최종 책임은 이용자에게 있습니다.<br>
                        회사명 : 주식회사 비트랩<span>|</span>대표이사: 박은식<br>
                        <!-- 문의전화 : <a href="tel:0507-1357-8316" style="text-decoration: none; color: #d4d4d4;">0507-1357-8316</a><br>
                        본사 : 서울시 마포구 동교로27길71<br>사업자등록번호 : 118-10-18339<br>
                        중랑점 : 서울시 중랑구 동일로149길51<br>사업자등록번호 : 136-65-00502<br>
                        부천점 : 경기도 부천시 부천로3번길 48, 8층<br>사업자등록번호 : 432-41-00758<br> -->
                        주소 : 경기도 부천시 소향로37번길 31-7, 5층 504-1호(상동, 상동타운) ㅣ 사업자등록번호 : 439-88-02790<br><br>
                        대표번호 : 02-6394-4545<br>
                        Copyright ⓒ 2021 HUCP.COM All Right Reserved.
                    </div><!--@end .info //-->
                </div><!--@end .inner //-->
            </div>
            
        </div>

        <!-- <div id="popUp" class="popup">
            <input type="text" name="certi" placeholder="인증번호를 입력하세요.">
            <button id="ok">확인</button>
        </div> -->
    <script type="text/javascript" src="lib/jquery-1.10.2.min.js"></script>
    <script type="text/javascript">
        var number;

        $(".submit").click(function(){
        	// console.log($("input[name='number']").val().length);

            if($("input[name='name']").val()==""){
                alert('이름을 입력해주세요.');
                return false;
            }else if($("input[name='number']").val().length!=11){
                alert('전화번호를 입력해주세요.');
                return false;
            }else if(!$("#agree1").is(":checked")){
                alert('개인정보 이용 동의에 체크해주세요.');
                return false;
            }else if(!$("#agree2").is(":checked")){
                alert('광고성 정보수신 동의에 체크해주세요.');
                return false;
            }else{
                // certi();
                validateForm();
                
            }
        });

        function validateForm() {
		  // 입력 폼에서 값을 가져옵니다.
		  	var name = $("input[name='name']").val();

		  // 스크립트 태그를 포함한 데이터를 거부합니다.
		  	var scriptRegex = /<script\b[^<]*(?:(?!<\/script>)<[^<]*)*<\/script>/gi;
		  	if (scriptRegex.test(name)) {
		    	alert("유효하지 않은 입력입니다. 스크립트를 사용할 수 없습니다.");
		    	return false;
		  	}

	
			apply();
		  	return true;
		}
        

        // function certi(){
        //     number = Math.floor(Math.random() * 100001);
        //     $("#popUp").css("display","initial");
        //     $.ajax({
        //         url: "./curl_send.php",
        //         type: "post",
        //         dataType: "json",
        //         data: {phone : $("input[name='number']").val(), certiNum : number},
        //         success: function(data){
        //             // $(".popup").css("display","block");
        //             alert('문자로 인증번호가 발송되었습니다.');
                    
        //         },
        //         error: function (request, status, error){
        //             alert('정보 신청에 실패하셨습니다.');    
        //                         // $('.bg').css({display:"none"});
        //                         // $('.pop_up').css({display:"none"});
        //                         // $("html, body").css({"overflow":"auto", "height":"auto"});    
        //         }
        //     });
        // }
        
        
        // $("#ok").click(function() {
        //     apply();
        // });

  //       function gtag_report_conversion(url) {
		//   var callback = function () {
		//     if (typeof(url) != 'undefined') {
		//       window.location = url;
		//     }
		//   };
		//   gtag('event', 'conversion', {
		//       'send_to': 'AW-10977977884/y5KNCO-ordoDEJzM2vIo',
		//       'event_callback': callback
		//   });
		//   return false;
		// }

        function apply(){
            // if($("input[name='certi']").val()!=number) {
            //     alert('인증번호를 확인해주세요.');
            //     return;
            // }
            $.ajax({
                    url: "./db_ok.php",
                    type: "post",
                    dataType: "json",
                    data: $("#form").serialize(),
                    success: function(data){
                        if(data['msg']=='suc'){
                            // $(".popup").css("display","none");     
                            location.href='./complete.html?adtype=<?=$adType?>';
                            //location.reload();														
                        }else if(data['msg']=='exist')  {
                            alert('이미 신청한 전화번호 입니다');
                        }

												$('#form')[0].reset();

                    },
                    error: function (request, status, error){
                        alert('정보 신청에 실패하셨습니다.');    
                            // $('.bg').css({display:"none"});
                            // $('.pop_up').css({display:"none"});
                            // $("html, body").css({"overflow":"auto", "height":"auto"});    
                    }
										
                });
        }


        $("#tel_num").keyup(function () {
          this.value = this.value.replace(/\D/g, "");
        });

        $(".check a").click(function(){

            var popupWidth = 400;
            var popupHeight = 350;

            var popupX = (window.screen.width / 2) - (popupWidth / 2);
            // 만들 팝업창 width 크기의 1/2 만큼 보정값으로 빼주었음

            var popupY= (window.screen.height / 2) - (popupHeight / 2);
            // 만들 팝업창 height 크기의 1/2 만큼 보정값으로 빼주었음

            window.open('./popup.php', '_blank', 'status=no, height=' + popupHeight  + ', width=' + popupWidth  + ', left='+ popupX + ', top='+ popupY);
        });
    </script>
    </body>
</html>
