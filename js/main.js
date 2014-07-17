$(document).ready(function($) {
    var doing = false;
	var url_lv = '';
	getUrl();

	function getUrl() {
        var v = window.location.href;
        var index = v.lastIndexOf('/');

        url_lv = v.substring(0, index);
    }

    $(window).bind('scroll', function() {
        if(doing == true)
            return;

    	if($(window).scrollTop() + $(window).height() >= $(document).height() - 30) {
    		doing = true;
            $.ajax({
    			url: url_lv + '/cms/Server/index.php/CMSTest/getD',
    			type: 'post',
    			dataType: 'json',
    			beforeSend:function() {
    				console.log('loading...')
    			},
    			success:function(data) {
    				// var notice = data;
    				show(data,true);
                    // doing = false;
    			},
    			complete:function() {
    				console.log('complete.')
    			}
    		})
    	}
    })

    function show(data, refresh) {
    	var html = '';
    	$.each(data, function(i, item) {
    		html += '<li>';
    		html += '<h3>' + item.Time + '</h3>';
    		html += '<dl><dt>' + item.Title + '</dt></dl>';
    		html += '</li>';
    		 /* iterate through array or object */
    	});
        if(refresh == true) {
    	   $(".show-content").append($(html));
        }
    }

    $(".show-content dl dt").live('click', function() {
    	// alert("hello");
    	var Url = $(this).attr("href");
    	// $(".show-content").load(url_lv + '/cms/Server/index.php/CMSTest/getdetail');
    	// alert(url);
    	// $.ajax({
    	// 	url: url_lv + '/cms/Server/index.php/CMSTest/getDetail',
    	// 	type: 'post',
    	// 	dataType: 'json',
    	// })
    })




})