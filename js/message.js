function errorMsgBox(msg){

  bootbox.alert("<h4 align=\'center\' style=\'color:red\'>"+msg+"<h4>")
	 .find(".btn-primary")
	 .removeClass("btn-primary")
	 .addClass("btn-danger btn-large").css({"margin-right":"225px"})
	 .parent("div")
	 .parent("div").css({"margin-top":function(){return ($(this).outerHeight())}});

}


function successMsgBox(msg){

  bootbox.alert("<h4 align=\'center\' style=\'color:#468847\'>"+msg+"<h4>")
	 .find(".btn-primary")
	 .removeClass("btn-primary")
	 .addClass("btn-success btn-large").css({"margin-right":"225px"})
	 .parent("div")
	 .parent("div").css({"margin-top":function(){return ($(this).outerHeight())}});

}

function confirmMsgBox(data){
  var that = data;
  
  bootbox.confirm('<h4 style=\'text-align:center\'>' + that.message +' <br/> print receipt ?</h4>', function(result) {
    if (result){
                          
			var x = screen.width/2 - 290/2;
            var y = screen.height/2 - 400/2;
            var printWindow = window.open("", "", "height=400,width=290,left="+x+",top="+y);
            printWindow.document.write(that.receipt);
            printWindow.document.close();
            //printWindow.print();
                        
    }
  }).find('.btn-primary').removeClass('btn-primary')
    .addClass('btn-inverse btn-large').css({'margin-right':'265px'}).text('Yes').prev()
    .addClass('btn-large').text('No').css({'margin-right':'-145px'})
    .parent('div').parent('div').css({'margin-top':function(){return ($(this).outerHeight())}});
  
}

var liveClock = function(servertime) {
            var currDateTime = servertime;
            var addLeadingZero = function(s) {
                return (s<10)?('0'+s):s;    
            };
            var formattedDate = function(date) {
                var h = date.getHours(), hour = ((h>12)?(h-12):h), a = (h<12)?' AM':' PM';
                return date.getDate()+'/'+(date.getMonth()+1)+'/'+date.getFullYear()+' '+hour+':'+addLeadingZero(date.getMinutes())+':'+addLeadingZero(date.getSeconds())+a;    
            };
            var setDateTime = function() {
                currDateTime.setSeconds(currDateTime.getSeconds()+1);
                $('#server-time').html(formattedDate(currDateTime));
                return false;    
            };
            var everySec = setInterval(setDateTime, 1000);
        };
        liveClock(new Date());
$(function() {
 
   $("#accordion h3").eq(0).find('a').prop("href","?r=app");

   /*$( "#accordion" ).on( "accordionbeforeactivate", function( event, ui ) {
       alert($.trim($( ui.newPanel ).html()).length);
       if($.trim($( ui.newPanel ).html()).length == 0)
          event.preventDefault();

    });*/
   
   //capture the click on the a tag
   $("#accordion h3 a").click(function() {
	  if ($(this).attr('href') != '#') {
       window.location = $(this).attr('href');
       return false;
	  }
   });
        
             
});
