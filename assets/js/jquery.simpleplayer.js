/*
 * SimplePlayer - A jQuery Plugin
 * @requires jQuery v1.4.2 or later
 *
 * SimplePlayer is a html5 audio player
 *
 * Licensed under the MIT:
 * http://www.opensource.org/licenses/mit-license.php
 *
 * Copyright (c) 2010-, Yuanhao Li (jay_21cn -[at]- hotmail [*dot*] com)
 */
(function($) {
    $.fn.player = function(settings) {
        var config = {
            progressbarWidth: '200px',
            progressbarHeight: '5px',
            progressbarColor: '#22ccff',
            progressbarBGColor: '#eeeeee',
            defaultVolume: 0.8
        };

        if (settings) {
            $.extend(config, settings);
        }

        var playControl = '<span class="icon-play"></span>';
        var stopControl = '<span class="icon-pause"></span>';

        this.each(function() {
            $(this).wrap('<div class="simple-player-container"' + 
                         ' />').parent().prepend(
		'<div class="progressbar-wrapper" style="display: inline-block; cursor: pointer; width:' + config.progressbarWidth + ';">' + 
                      '<span style="display: block; background-color: ' + config.progressbarBGColor + '; width: 100%; ">' + 
                      '<span class="progressbar" style="display: block; background-color: ' + config.progressbarColor +
                        '; height: ' + config.progressbarHeight + '; width: 0%; ">' +
                      '</span></span>' + 
                '</div>' +				 
                '<div class="btn-group">' + 
                    '<a class="start-button btn" href="javascript:void(0)">' + playControl + '</a>' +
		    '<a class="download-button btn" href="javascript:void(0)"><span class="icon-download-alt"></span></a>' +
		 '</div>'                  
            );

            var simplePlayer = $(this).get(0);
            var button = $(this).parent().find('.start-button');
	    var download = $(this).parent().find('.download-button');
            var progressbarWrapper = $(this).parent().find('.progressbar-wrapper');
            var progressbar = $(this).parent().find('.progressbar');

            simplePlayer.volume = config.defaultVolume;

            button.click(function() {
                if (simplePlayer.paused) {
                    simplePlayer.play();
                    $(this).find('.icon-play').addClass('icon-pause').removeClass('icon-play');
                } else {
                    simplePlayer.pause();
                    $(this).find('.icon-pause').addClass('icon-play').removeClass('icon-pause');
                }
            });
	    download.click(function() {
		var source = $('.player').attr('src');
		alert( 'Downloading: ' + source.substr(14) );
		e.preventDefault();  //stop the browser from following
		window.location.href = source.substr(14);
	    });

            progressbarWrapper.click(function(e) {
                if (simplePlayer.duration != 0) {
                    left = $(this).offset().left;
                    offset = e.pageX - left;
                    percent = offset / progressbarWrapper.width();
                    duration_seek = percent * simplePlayer.duration;
                    simplePlayer.currentTime = duration_seek;
                }
            });


            $(simplePlayer).bind('ended', function(evt) {
                simplePlayer.pause();
                button.find('.icon-pause').addClass('icon-play').removeClass('icon-pause');
                progressbar.css('width', '0%');
            });

            $(simplePlayer).bind('timeupdate', function(e) {
                duration = this.duration;
                time = this.currentTime;
                fraction = time / duration;
                percent = fraction * 100;
                if (percent) progressbar.css('width', percent + '%');
            });

            if (simplePlayer.duration > 0) {
                $(this).parent().css('display', 'inline-block');
            }
        });

        return this;
    };
})(jQuery);
