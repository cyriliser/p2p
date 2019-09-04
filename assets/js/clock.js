var clock;
		





// 12hr verification clock
$(document).ready(function() {
    var clock;

    clock = $('.clock_verification').FlipClock({
        clockFace: 'DailyCounter',
        autoStart: false,
        callbacks: {
            stop: function() {
                $('.message').html('The clock has stopped!')
            }
        }
    });
    
    const time_value = document.querySelector('#time_value').innerHTML;
    clock.setTime(time_value);
    clock.setCountdown(true);
    clock.start();

});

// 5days allocation clock
$(document).ready(function() {
    var clock;

    clock = $('.clock-allocation').FlipClock({
        clockFace: 'DailyCounter',
        autoStart: false,
        callbacks: {
            stop: function() {
                $('.message').html('The clock has stopped!')
            }
        }
    });
    
    const time_value = document.querySelector('#time_value').innerHTML;
    clock.setTime(time_value);
    clock.setCountdown(true);
    clock.start();

});

$(document).ready(function() {
    var clock;

    clock = $('.clock_test').FlipClock({
        clockFace: 'DailyCounter',
        autoStart: false,
        callbacks: {
            stop: function() {
                $('.message').html('The clock has stopped!')
            }
        }
    });
    
    const time_value = document.querySelector('#time_value').innerHTML;
    clock.setTime(time_value);
    clock.setCountdown(true);
    clock.start();

});