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
            playerProgressBarWidth: '100%',
            playerProgressBarHeight: '50px',
            playerProgressBarColor: '#22ccff',
            playerProgressBarBGColor: '',
            defaultVolume: 0.8
        };

        if (settings) {
            $.extend(config, settings);
        }

        var playControl = '<span class="icon-play"></span>';
        var stopControl = '<span class="icon-pause"></span>';

        var source = $('.player').attr('src');
        var output = source.substr(0, source.lastIndexOf('.')) || source;
        var waveform = output + ".png";

        this.each(function() {
            $(this).wrap(
                '<div class="playerWrapper"' +
                    ' />').parent().prepend(
                    '<img class="waveform" src="' + waveform + '" />' +
                    '<div class="progress progress-warning active playerProgressWrapper" style="display: inline-block; cursor: pointer; width:' + config.playerProgressBarWidth + ';">' +
                          '<span style="display: block; width: 100%; ">' +
                              '<span class="bar playerProgressBar" style="display: block; background-color: ' + config.playerProgressBarColor +
                              '; height: ' + config.playerProgressBarHeight + '; width: 0%; ">' +
                          '</span>' +
                        '</span>' +
                    '</div>').append(
                    '<div class="btn-group playerControls">' +
                        '<a class="start-button btn btn-mini" href="javascript:void(0)">' + playControl + '</a>' +
                        '<a class="download-button btn btn-mini" href="javascript:void(0)"><span class="icon-download-alt"></span></a>' +
                    '</div>' +
                '</div>');

            var simplePlayer = $(this).get(0);
            var button = $(this).parent().find('.start-button');
	        var download = $(this).parent().find('.download-button');
            var playerProgressWrapper = $(this).parent().find('.playerProgressWrapper');
            var playerProgressBar = $(this).parent().find('.playerProgressBar');

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

                $('#debugger').append( ' > Downloading: ' + source );
                e.preventDefault();  //stop the browser from following
                window.location.href = source;
            });

            playerProgressWrapper.click(function(e) {
                if (simplePlayer.duration != 0) {
                    left = $(this).offset().left;
                    offset = e.pageX - left;
                    percent = offset / playerProgressWrapper.width();
                    duration_seek = percent * simplePlayer.duration;
                    simplePlayer.currentTime = duration_seek;
                }
            });


            $(simplePlayer).bind('ended', function(evt) {
                simplePlayer.pause();
                button.find('.icon-pause').addClass('icon-play').removeClass('icon-pause');
                playerProgressBar.css('width', '0%');
            });

            $(simplePlayer).bind('timeupdate', function(e) {
                duration = this.duration;
                time = this.currentTime;
                fraction = time / duration;
                percent = fraction * 100;
                if (percent) playerProgressBar.css('width', percent + '%');
            });

            if (simplePlayer.duration > 0) {
                $(this).parent().css('display', 'inline-block');
            }
        });

        return this;
    };
})(jQuery);
